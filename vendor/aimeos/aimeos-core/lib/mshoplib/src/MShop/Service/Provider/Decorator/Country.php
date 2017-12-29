<?php

/**
 * @copyright Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Service
 */


namespace Aimeos\MShop\Service\Provider\Decorator;


/**
 * Country-limiting decorator for service providers.
 *
 * @package MShop
 * @subpackage Service
 */
class Country
	extends \Aimeos\MShop\Service\Provider\Decorator\Base
	implements \Aimeos\MShop\Service\Provider\Decorator\Iface
{
	private $beConfig = array(
		'country.billing-include' => array(
			'code' => 'country.billing-include',
			'internalcode'=> 'country.billing-include',
			'label'=> 'List of countries allowed for the billing address',
			'type'=> 'string',
			'internaltype'=> 'string',
			'default'=> '',
			'required'=> false,
		),
		'country.billing-exclude' => array(
			'code' => 'country.billing-exclude',
			'internalcode'=> 'country.billing-exclude',
			'label'=> 'List of countries not allowed for the billing address',
			'type'=> 'string',
			'internaltype'=> 'string',
			'default'=> '',
			'required'=> false,
		),
		'country.delivery-include' => array(
			'code' => 'country.delivery-include',
			'internalcode'=> 'country.delivery-include',
			'label'=> 'List of countries allowed for the delivery address',
			'type'=> 'string',
			'internaltype'=> 'string',
			'default'=> '',
			'required'=> false,
		),
		'country.delivery-exclude' => array(
			'code' => 'country.delivery-exclude',
			'internalcode'=> 'country.delivery-exclude',
			'label'=> 'List of countries not allowed for the delivery address',
			'type'=> 'string',
			'internaltype'=> 'string',
			'default'=> '',
			'required'=> false,
		),
	);


	/**
	 * Checks the backend configuration attributes for validity.
	 *
	 * @param array $attributes Attributes added by the shop owner in the administraton interface
	 * @return array An array with the attribute keys as key and an error message as values for all attributes that are
	 * 	known by the provider but aren't valid
	 */
	public function checkConfigBE( array $attributes )
	{
		$error = $this->getProvider()->checkConfigBE( $attributes );
		$error += $this->checkConfig( $this->beConfig, $attributes );

		return $error;
	}


	/**
	 * Returns the configuration attribute definitions of the provider to generate a list of available fields and
	 * rules for the value of each field in the administration interface.
	 *
	 * @return array List of attribute definitions implementing \Aimeos\MW\Common\Critera\Attribute\Iface
	 */
	public function getConfigBE()
	{
		$list = $this->getProvider()->getConfigBE();

		foreach( $this->beConfig as $key => $config ) {
			$list[$key] = new \Aimeos\MW\Criteria\Attribute\Standard( $config );
		}

		return $list;
	}


	/**
	 * Checks if the country code is allowed for the service provider.
	 *
	 * @param \Aimeos\MShop\Order\Item\Base\Iface $basket Basket object
	 * @return boolean True if payment provider can be used, false if not
	 */
	public function isAvailable( \Aimeos\MShop\Order\Item\Base\Iface $basket )
	{
		$addresses = $basket->getAddresses();

		$paymentType = \Aimeos\MShop\Order\Item\Base\Address\Base::TYPE_PAYMENT;
		$deliveryType = \Aimeos\MShop\Order\Item\Base\Address\Base::TYPE_DELIVERY;


		if( isset( $addresses[$deliveryType] ) )
		{
			$code = strtoupper( $addresses[$deliveryType]->getCountryId() );

			if( $this->checkCountryCode( $code, 'country.delivery-include' ) === false
				|| $this->checkCountryCode( $code, 'country.delivery-exclude' ) === true
			) {
				return false;
			}
		}
		else if( isset( $addresses[$paymentType] ) ) // use billing address if no delivery address is available
		{
			$code = strtoupper( $addresses[$paymentType]->getCountryId() );

			if( $this->checkCountryCode( $code, 'country.delivery-include' ) === false
				|| $this->checkCountryCode( $code, 'country.delivery-exclude' ) === true
			) {
				return false;
			}
		}

		if( isset( $addresses[$paymentType] ) )
		{
			$code = strtoupper( $addresses[$paymentType]->getCountryId() );

			if( $this->checkCountryCode( $code, 'country.billing-include' ) === false
				|| $this->checkCountryCode( $code, 'country.billing-exclude' ) === true
			) {
				return false;
			}
		}

		return $this->getProvider()->isAvailable( $basket );
	}


	/**
	 * Checks if the country code is in the list of codes specified by the given key
	 *
	 * @param string $code Two letter ISO country code in upper case
	 * @param string $key Configuration key referring to the country code configuration
	 */
	protected function checkCountryCode( $code, $key )
	{
		if( ( $str = $this->getConfigValue( array( $key ) ) ) === null ) {
			return null;
		}

		return in_array( $code, explode( ',', str_replace( ' ', '', strtoupper( $str ) ) ) );
	}
}