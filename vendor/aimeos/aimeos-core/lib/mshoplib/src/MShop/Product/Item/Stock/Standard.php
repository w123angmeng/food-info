<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Product
 */


namespace Aimeos\MShop\Product\Item\Stock;


/**
 * Default product stock item implementation.
 *
 * @package MShop
 * @subpackage Product
 */
class Standard
	extends \Aimeos\MShop\Common\Item\Base
	implements \Aimeos\MShop\Product\Item\Stock\Iface
{
	private $values;

	/**
	 * Initializes the stock item object with the given values
	 *
	 * @param array $values Associative list of product stock key/value pairs
	 */
	public function __construct( array $values = array( ) )
	{
		parent::__construct( 'product.stock.', $values );

		$this->values = $values;
	}


	/**
	 * Returns the product ID
	 *
	 * @return integer|null Product ID
	 */
	public function getParentId()
	{
		if( isset( $this->values['product.stock.parentid'] ) ) {
			return (int) $this->values['product.stock.parentid'];
		}

		return null;
	}


	/**
	 * Sets the new product ID
	 *
	 * @param integer $parentid New product ID
	 * @return \Aimeos\MShop\Product\Item\Stock\Iface Product stock item for chaining method calls
	 */
	public function setParentId( $parentid )
	{
		if( $parentid == $this->getParentId() ) { return $this; }

		$this->values['product.stock.parentid'] = (int) $parentid;
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the warehouse Id.
	 *
	 * @return integer|null Warehouse Id
	 */
	public function getWarehouseId()
	{
		if( isset( $this->values['product.stock.warehouseid'] ) ) {
			return (int) $this->values['product.stock.warehouseid'];
		}

		return null;
	}


	/**
	 * Sets the warehouse Id.
	 *
	 * @param integer|null $warehouseid New warehouse Id
	 * @return \Aimeos\MShop\Product\Item\Stock\Iface Product stock item for chaining method calls
	 */
	public function setWarehouseId( $warehouseid )
	{
		if( $warehouseid == $this->getWarehouseId() ) { return $this; }

		$this->values['product.stock.warehouseid'] = (int) $warehouseid;
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the stock level.
	 *
	 * @return integer|null Stock level
	 */
	public function getStocklevel()
	{
		if( isset( $this->values['product.stock.stocklevel'] ) ) {
			return (int) $this->values['product.stock.stocklevel'];
		}

		return null;
	}


	/**
	 * Sets the stock level.
	 *
	 * @param integer|null $stocklevel New stock level
	 * @return \Aimeos\MShop\Product\Item\Stock\Iface Product stock item for chaining method calls
	 */
	public function setStocklevel( $stocklevel )
	{
		if( $stocklevel === $this->getStocklevel() ) { return $this; }

		$this->values['product.stock.stocklevel'] = ( is_numeric( $stocklevel ) ? (int) $stocklevel : null );
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the back in stock date of the product.
	 *
	 * @return string|null Back in stock date of the product
	 */
	public function getDateBack()
	{
		if( isset( $this->values['product.stock.backdate'] ) ) {
			return (string) $this->values['product.stock.backdate'];
		}

		return null;
	}


	/**
	 * Sets the product back in stock date.
	 *
	 * @param string|null $backdate New back in stock date of the product
	 * @return \Aimeos\MShop\Product\Item\Stock\Iface Product stock item for chaining method calls
	 */
	public function setDateBack( $backdate )
	{
		if( $backdate == $this->getDateBack() ) { return $this; }

		$this->values['product.stock.backdate'] = $this->checkDateFormat( $backdate );;
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the item type
	 *
	 * @return string Item type, subtypes are separated by slashes
	 */
	public function getResourceType()
	{
		return 'product/stock';
	}


	/**
	 * Sets the item values from the given array.
	 *
	 * @param array $list Associative list of item keys and their values
	 * @return array Associative list of keys and their values that are unknown
	 */
	public function fromArray( array $list )
	{
		$unknown = array();
		$list = parent::fromArray( $list );

		foreach( $list as $key => $value )
		{
			switch( $key )
			{
				case 'product.stock.parentid': $this->setParentId( $value ); break;
				case 'product.stock.warehouseid': $this->setWarehouseId( $value ); break;
				case 'product.stock.stocklevel': $this->setStocklevel( $value ); break;
				case 'product.stock.dateback': $this->setDateBack( $value ); break;
				default: $unknown[$key] = $value;
			}
		}

		return $unknown;
	}


	/**
	 * Returns the item values as array.
	 *
	 * @return array Associative list of item properties and their values
	 */
	public function toArray()
	{
		$list = parent::toArray();

		$list['product.stock.parentid'] = $this->getParentId();
		$list['product.stock.warehouseid'] = $this->getWarehouseId();
		$list['product.stock.stocklevel'] = $this->getStocklevel();
		$list['product.stock.dateback'] = $this->getDateBack();

		return $list;
	}

}