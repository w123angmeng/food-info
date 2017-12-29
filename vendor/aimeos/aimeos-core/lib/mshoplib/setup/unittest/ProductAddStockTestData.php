<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds product stock test data.
 */
class ProductAddStockTestData extends \Aimeos\MW\Setup\Task\Base
{

	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return array( 'MShopSetLocale', 'MediaListAddTestData', 'PriceListAddTestData', 'ProductListAddTestData' );
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies()
	{
		return array( 'CatalogRebuildTestIndex', 'MShopAddWarehouseData' );
	}


	/**
	 * Adds product stock test data.
	 */
	public function migrate()
	{
		$iface = '\\Aimeos\\MShop\\Context\\Item\\Iface';
		if( !( $this->additional instanceof $iface ) ) {
			throw new \Aimeos\MW\Setup\Exception( sprintf( 'Additionally provided object is not of type "%1$s"', $iface ) );
		}

		$this->msg( 'Adding product stock test data', 0 );
		$this->additional->setEditor( 'core:unittest' );

		$ds = DIRECTORY_SEPARATOR;
		$path = __DIR__ . $ds . 'data' . $ds . 'productstock.php';

		if( ( $testdata = include( $path ) ) == false ) {
			throw new \Aimeos\MShop\Exception( sprintf( 'No file "%1$s" found for product stock domain', $path ) );
		}

		$this->addProductStockData( $testdata );

		$this->status( 'done' );
	}


	/**
	 * Adds the product stock test data.
	 *
	 * @param array $testdata Associative list of key/list pairs
	 * @throws \Aimeos\MW\Setup\Exception If no type ID is found
	 */
	private function addProductStockData( array $testdata )
	{
		$productManager = \Aimeos\MShop\Product\Manager\Factory::createManager( $this->additional, 'Standard' );
		$productStockManager = $productManager->getSubManager( 'stock', 'Standard' );
		$productStockWarehouse = $productStockManager->getSubManager( 'warehouse', 'Standard' );

		$prodcode = array();
		foreach( $testdata['product/stock'] as $dataset )
		{
			if( ( $pos = strpos( $dataset['parentid'], '/' ) ) === false || ( $str = substr( $dataset['parentid'], $pos + 1 ) ) === false ) {
				throw new \Aimeos\MW\Setup\Exception( sprintf( 'Some keys for parentid are set wrong "%1$s"', $dataset['parentid'] ) );
			}

			$prodcode[] = $str;
		}

		$search = $productManager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.code', $prodcode ) );

		$parentIds = array();
		foreach( $productManager->searchItems( $search ) as $item )
		{
			$parentIds['product/' . $item->getCode()] = $item->getId();
		}

		$wareIds = array();
		$ware = $productStockWarehouse->createItem();

		$this->conn->begin();

		foreach( $testdata['product/stock/warehouse'] as $key => $dataset )
		{
			$ware->setId( null );
			$ware->setCode( $dataset['code'] );
			$ware->setLabel( $dataset['label'] );
			$ware->setStatus( $dataset['status'] );

			$productStockWarehouse->saveItem( $ware );
			$wareIds[$key] = $ware->getId();
		}

		$stock = $productStockManager->createItem();
		foreach( $testdata['product/stock'] as $dataset )
		{
			if( !isset( $parentIds[$dataset['parentid']] ) ) {
				throw new \Aimeos\MW\Setup\Exception( sprintf( 'No product ID found for "%1$s"', $dataset['parentid'] ) );
			}

			if( !isset( $wareIds[$dataset['warehouseid']] ) ) {
				throw new \Aimeos\MW\Setup\Exception( sprintf( 'No warehouse ID found for "%1$s"', $dataset['warehouseid'] ) );
			}

			$stock->setId( null );
			$stock->setParentId( $parentIds[$dataset['parentid']] );
			$stock->setWarehouseId( $wareIds[$dataset['warehouseid']] );
			$stock->setStocklevel( $dataset['stocklevel'] );
			$stock->setDateBack( $dataset['backdate'] );

			$productStockManager->saveItem( $stock, false );
		}

		$this->conn->commit();
	}
}