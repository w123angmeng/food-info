<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Service
 */


namespace Aimeos\MShop\Service\Provider\Decorator;


/**
 * Service decorator interface.
 *
 * @package MShop
 * @subpackage Service
 */
interface Iface
	extends \Aimeos\MShop\Service\Provider\Iface
{
	/**
	 * Initializes a new service provider object using the given context object.
	 *
	 * @param \Aimeos\MShop\Service\Provider\Iface $provider Service provider or decorator
	 * @param \Aimeos\MShop\Context\Item\Iface $context Context object with required objects
	 * @param \Aimeos\MShop\Service\Item\Iface $serviceItem Service item with configuration for the provider
	 * @return null
	 */
	public function __construct( \Aimeos\MShop\Service\Provider\Iface $provider,
		\Aimeos\MShop\Context\Item\Iface $context, \Aimeos\MShop\Service\Item\Iface $serviceItem );
}