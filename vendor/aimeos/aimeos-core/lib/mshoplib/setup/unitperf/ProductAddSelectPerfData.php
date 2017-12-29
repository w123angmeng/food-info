<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds selection performance records to product table.
 */
class ProductAddSelectPerfData extends \Aimeos\MW\Setup\Task\ProductAddBasePerfData
{
	private $count = 10;


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return array(
			'MShopSetLocale', 'ProductAddBasePerfData', 'ProductAddTextPerfData',
			'ProductAddPricePerfData', 'ProductAddStockPerfData'
		);
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies()
	{
		return array( 'ProductAddMediaPerfData', 'CatalogRebuildPerfIndex' );
	}


	/**
	 * Insert product data.
	 */
	public function migrate()
	{
		$this->msg( 'Adding product selection performance data', 0 );


		$this->txBegin();

		$selProducts = $this->getSelectionProductIds();

		$this->txCommit();


		$productTypeItem = $this->getTypeItem( 'product/type', 'product', 'default' );
		$listTypeItem = $this->getTypeItem( 'product/lists/type', 'product', 'default' );


		$productListManager = \Aimeos\MShop\Factory::createManager( $this->getContext(), 'product/lists' );

		$listItem = $productListManager->createItem();
		$listItem->setTypeId( $listTypeItem->getId() );
		$listItem->setDomain( 'product' );


		$productManager = \Aimeos\MShop\Factory::createManager( $this->getContext(), 'product' );

		$search = $productManager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.typeid', $productTypeItem->getId() ) );
		$search->setSortations( array( $search->sort( '-', 'product.id' ) ) );


		$this->txBegin();

		$selCount = count( $selProducts );
		$selPrices = array();
		$start = $num = 0;

		do
		{
			$result = $productManager->searchItems( $search, array( 'price' ) );

			foreach( $result as $id => $product )
			{
				$pos = (int) ( ( $num / 9 ) % $selCount );
				$prices = $product->getRefItems( 'price', 'default', 'default' );
				$selPrices[$pos] = $this->getLowestPrice( ( isset( $selPrices[$pos] ) ? $selPrices[$pos] : null ), $prices );

				$listItem->setId( null );
				$listItem->setParentId( $selProducts[$pos] );
				$listItem->setRefId( $id );
				$productListManager->saveItem( $listItem, false );


				$pos = (int) ( ( $num / 9 + 1 ) % $selCount );
				$prices = $product->getRefItems( 'price', 'default', 'default' );
				$selPrices[$pos] = $this->getLowestPrice( ( isset( $selPrices[$pos] ) ? $selPrices[$pos] : null ), $prices );

				$listItem->setId( null );
				$listItem->setParentId( $selProducts[$pos] );
				$listItem->setRefId( $id );
				$productListManager->saveItem( $listItem, false );


				$pos = (int) ( ( $num / 9 + 2 ) % $selCount );
				$prices = $product->getRefItems( 'price', 'default', 'default' );
				$selPrices[$pos] = $this->getLowestPrice( ( isset( $selPrices[$pos] ) ? $selPrices[$pos] : null ), $prices );

				$listItem->setId( null );
				$listItem->setParentId( $selProducts[$pos] );
				$listItem->setRefId( $id );
				$productListManager->saveItem( $listItem, false );

				$num++;
			}

			$count = count( $result );
			$start += $count;
			$search->setSlice( $start );
		}
		while( $count == $search->getSliceSize() );

		$this->txCommit();


		$listTypeItem = $this->getTypeItem( 'product/lists/type', 'price', 'default' );

		$listItem->setTypeId( $listTypeItem->getId() );
		$listItem->setDomain( 'price' );

		$this->txBegin();

		foreach( $selPrices as $pos => $priceItem )
		{
			$listItem->setId( null );
			$listItem->setRefId( $priceItem->getId() );
			$listItem->setParentId( $selProducts[$pos] );
			$productListManager->saveItem( $listItem, false );
		}

		$this->txCommit();


		$this->status( 'done' );
	}


	/**
	 * Returns the price item with the lowest value
	 *
	 * @param \Aimeos\MShop\Price\Item\Iface|null $price
	 * @param array $prices
	 * @return \Aimeos\MShop\Price\Item\Iface
	 */
	protected function getLowestPrice( \Aimeos\MShop\Price\Item\Iface $price = null, array $prices = array() )
	{
		foreach( $prices as $item )
		{
			if( $price === null )
			{
				$price = $item;
				continue;
			}

			if( $price !== null && $item->getValue() < $price->getValue() ) {
				$price = $item;
			}
		}

		return $price;
	}


	/**
	 * Returns the product IDs for the selection products
	 *
	 * @throws \Exception
	 * @return array List of product IDs
	 */
	protected function getSelectionProductIds()
	{
		$textTypeItems = array();
		$context = $this->getContext();


		$textTypeManager = \Aimeos\MShop\Factory::createManager( $context, 'text/type' );

		$search = $textTypeManager->createSearch();
		$expr = array(
			$search->compare( '==', 'text.type.domain', 'product' ),
			$search->combine( '||', array(
				$search->compare( '==', 'text.type.code', 'short' ),
				$search->compare( '==', 'text.type.code', 'long' ),
			) ),
		);
		$search->setConditions( $search->combine( '&&', $expr ) );

		foreach( $textTypeManager->searchItems( $search ) as $item ) {
			$textTypeItems[$item->getCode()] = $item;
		}

		if( count( $textTypeItems ) !== 2 ) {
			throw new \Exception( 'Text type items not found' );
		}


		$textManager = \Aimeos\MShop\Factory::createManager( $context, 'text' );

		$textItem = $textManager->createItem();
		$textItem->setDomain( 'product' );
		$textItem->setStatus( 1 );


		$productListTypeManager = \Aimeos\MShop\Factory::createManager( $context, 'product/lists/type' );

		$expr = array();
		$search = $productListTypeManager->createSearch();
		$expr[] = $search->compare( '==', 'product.lists.type.domain', 'text' );
		$expr[] = $search->compare( '==', 'product.lists.type.code', 'default' );
		$search->setConditions( $search->combine( '&&', $expr ) );
		$types = $productListTypeManager->searchItems( $search );

		if( ( $productListTypeItem = reset( $types ) ) === false ) {
			throw new \Exception( 'Product list type item not found' );
		}


		$productListManager = \Aimeos\MShop\Factory::createManager( $context, 'product/lists' );

		$productListItem = $productListManager->createItem();
		$productListItem->setTypeId( $productListTypeItem->getId() );
		$productListItem->setDomain( 'text' );
		$productListItem->setStatus( 1 );


		$productTypeManager = \Aimeos\MShop\Factory::createManager( $context, 'product/type' );

		$expr = array();
		$search = $productTypeManager->createSearch();
		$expr[] = $search->compare( '==', 'product.type.domain', 'product' );
		$expr[] = $search->compare( '==', 'product.type.code', 'select' );
		$search->setConditions( $search->combine( '&&', $expr ) );
		$types = $productTypeManager->searchItems( $search );

		if( ( $productTypeItem = reset( $types ) ) === false ) {
			throw new \Exception( 'Product type item not found' );
		}


		$productManager = \Aimeos\MShop\Factory::createManager( $context, 'product' );

		$productItem = $productManager->createItem();
		$productItem->setTypeId( $productTypeItem->getId() );
		$productItem->setDateStart( '1970-01-01 00:00:00' );
		$productItem->setStatus( 1 );


		$selProducts = array();

		for( $i = 0; $i < $this->count; $i++ )
		{
			$productItem->setId( null );
			$productItem->setCode( 'perf-select-' . str_pad( $i, 5, '0', STR_PAD_LEFT ) );
			$productItem->setLabel( 'Selection product ' . ( $i + 1 ) );
			$productManager->saveItem( $productItem );

			$selProducts[] = $productItem->getId();


			$textItem->setId( null );
			$textItem->setTypeId( $textTypeItems['short']->getId() );
			$textItem->setLabel( 'Short description for ' . ( $i + 1 ) . '. selection product' );
			$textItem->setContent( 'Short description for ' . ( $i + 1 ) . '. selection product' );
			$textManager->saveItem( $textItem );

			$productListItem->setId( null );
			$productListItem->setParentId( $productItem->getId() );
			$productListItem->setRefId( $textItem->getId() );
			$productListManager->saveItem( $productListItem, false );


			$textItem->setId( null );
			$textItem->setTypeId( $textTypeItems['long']->getId() );
			$textItem->setLabel( 'Long description for ' . ( $i + 1 ) . '. selection product' );
			$textItem->setContent( 'Long description for ' . ( $i + 1 ) . '. selection product. This may contain some "Lorem ipsum" text' );
			$textManager->saveItem( $textItem );

			$productListItem->setId( null );
			$productListItem->setParentId( $productItem->getId() );
			$productListItem->setRefId( $textItem->getId() );
			$productListManager->saveItem( $productListItem, false );
		}

		return $selProducts;
	}
}
