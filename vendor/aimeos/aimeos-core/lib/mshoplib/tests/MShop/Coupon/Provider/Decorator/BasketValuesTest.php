<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MShop\Coupon\Provider\Decorator;


/**
 * Test class for \Aimeos\MShop\Coupon\Provider\Decorator\BasketValues.
 */
class BasketValuesTest extends \PHPUnit_Framework_TestCase
{
	private $object;
	private $orderBase;
	private $couponItem;


	/**
	 * Sets up the fixture, especially creates products.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 */
	protected function setUp()
	{
		$orderProducts = array();
		$context = \TestHelperMShop::getContext();

		$couponManager = \Aimeos\MShop\Coupon\Manager\Factory::createManager( $context );
		$this->couponItem = $couponManager->createItem();

		$provider = new \Aimeos\MShop\Coupon\Provider\Example( $context, $this->couponItem, 'abcd' );
		$this->object = new \Aimeos\MShop\Coupon\Provider\Decorator\BasketValues( $provider, $context, $this->couponItem, 'abcd' );
		$this->object->setObject( $this->object );

		$orderManager = \Aimeos\MShop\Order\Manager\Factory::createManager( $context );
		$orderBaseManager = $orderManager->getSubManager( 'base' );
		$orderProductManager = $orderBaseManager->getSubManager( 'product' );

		$productManager = \Aimeos\MShop\Product\Manager\Factory::createManager( $context );
		$search = $productManager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.code', array( 'CNC' ) ) );
		$products = $productManager->searchItems( $search );

		$priceManager = \Aimeos\MShop\Price\Manager\Factory::createManager( $context );
		$price = $priceManager->createItem();
		$price->setValue( 321 );

		foreach( $products as $product )
		{
			$orderProduct = $orderProductManager->createItem();
			$orderProduct->copyFrom( $product );
			$orderProducts[$product->getCode()] = $orderProduct;
		}

		$orderProducts['CNC']->setPrice( $price );

		$this->orderBase = new \Aimeos\MShop\Order\Item\Base\Standard( $priceManager->createItem(), $context->getLocale() );
		$this->orderBase->addProduct( $orderProducts['CNC'] );
	}


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 */
	protected function tearDown()
	{
		unset( $this->object );
		unset( $this->orderBase );
		unset( $this->couponItem );
	}


	public function testIsAvailable()
	{
		$config = array(
			'basketvalues.total-value-min' => array( 'EUR' =>  320 ),
			'basketvalues.total-value-max' => array( 'EUR' => 1000 ),
		);

		$this->couponItem->setConfig( $config );
		$result = $this->object->isAvailable( $this->orderBase );

		$this->assertTrue( $result );
	}

	// // min value higher than order price
	public function testIsAvailableTestMinValue()
	{
		$config = array(
			'basketvalues.total-value-min' => array( 'EUR' =>  700 ),
			'basketvalues.total-value-max' => array( 'EUR' => 1000 ),
		);

		$this->couponItem->setConfig( $config );
		$result = $this->object->isAvailable( $this->orderBase );

		$this->assertFalse( $result );
	}

	// order price higher than max price
	public function testIsAvailableTestMaxValue()
	{
		$config = array(
			'basketvalues.total-value-min' => array( 'EUR' =>  50 ),
			'basketvalues.total-value-max' => array( 'EUR' => 320 ),
		);

		$this->couponItem->setConfig( $config );
		$result = $this->object->isAvailable( $this->orderBase );

		$this->assertFalse( $result );
	}

}
