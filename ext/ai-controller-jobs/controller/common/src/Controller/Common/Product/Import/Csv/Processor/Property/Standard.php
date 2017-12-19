<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package Controller
 * @subpackage Common
 */


namespace Aimeos\Controller\Common\Product\Import\Csv\Processor\Property;


/**
 * Product property processor for CSV imports
 *
 * @package Controller
 * @subpackage Common
 */
class Standard
	extends \Aimeos\Controller\Common\Product\Import\Csv\Processor\Base
	implements \Aimeos\Controller\Common\Product\Import\Csv\Processor\Iface
{
	/** controller/common/product/import/csv/processor/property/name
	 * Name of the property processor implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Controller\Common\Product\Import\Csv\Processor\Property\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the processor class name
	 * @since 2015.10
	 * @category Developer
	 */


	/**
	 * Saves the product property related data to the storage
	 *
	 * @param \Aimeos\MShop\Product\Item\Iface $product Product item with associated items
	 * @param array $data List of CSV fields with position as key and data as value
	 * @return array List of data which hasn't been imported
	 */
	public function process( \Aimeos\MShop\Product\Item\Iface $product, array $data )
	{
		$manager = \Aimeos\MShop\Factory::createManager( $this->getContext(), 'product/property' );
		$manager->begin();

		try
		{
			$pos = 0;
			$delete = array();
			$map = $this->getMappedChunk( $data );
			$items = $this->getPropertyItems( $product->getId() );

			foreach( $items as $id => $item )
			{
				if( isset( $map[$pos] ) )
				{
					if( !isset( $map[$pos]['product.property.type'] ) || !isset( $map[$pos]['product.property.value'] ) )
					{
						unset( $map[$pos] );
						continue;
					}

					if( $map[$pos]['product.property.type'] === $item->getType()
						&& $map[$pos]['product.property.value'] === $item->getValue()
						&& ( !isset( $map[$pos]['product.property.languageid'] )
							|| isset( $map[$pos]['product.property.languageid'] )
							&& $map[$pos]['product.property.languageid'] === $item->getLanguageId()
						)
					) {
						$pos++;
						continue;
					}
				}

				$items[$id] = null;
				$delete[] = $id;
				$pos++;
			}

			$manager->deleteItems( $delete );

			foreach( $map as $pos => $list )
			{
				if( $list['product.property.type'] == '' || $list['product.property.value'] == '' ) {
					continue;
				}

				$typecode = $list['product.property.type'];
				$list['product.property.typeid'] = $this->getTypeId( 'product/property/type', 'product', $typecode );
				$list['product.property.parentid'] = $product->getId();

				if( ( $item = array_shift( $items ) ) === null ) {
					$item = $manager->createItem();
				}

				$item->fromArray( $list );
				$manager->saveItem( $item );
			}

			$remaining = $this->getObject()->process( $product, $data );

			$manager->commit();
		}
		catch( \Exception $e )
		{
			$manager->rollback();
			throw $e;
		}

		return $remaining;
	}


	/**
	 * Returns the product properties for the given product ID
	 *
	 * @param string $prodid Unique product ID
	 * @return array Associative list of product property items
	 */
	protected function getPropertyItems( $prodid )
	{
		$manager = \Aimeos\MShop\Factory::createManager( $this->getContext(), 'product/property' );

		$search = $manager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.property.parentid', $prodid ) );

		return $manager->searchItems( $search );
	}
}
