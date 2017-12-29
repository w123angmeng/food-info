<?php

/**
 * @copyright Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MAdmin
 * @subpackage Common
 */


namespace Aimeos\MAdmin\Common\Factory;


/**
 * Common methods for all factories.
 *
 * @package MShop
 * @subpackage Common
 */
abstract class Base
	extends \Aimeos\MShop\Common\Factory\Base
{
	/**
	 * Adds the decorators to the manager object.
	 *
	 * @param \Aimeos\MShop\Context\Item\Iface $context Context instance with necessary objects
	 * @param \Aimeos\MShop\Common\Manager\Iface $manager Manager object
	 * @param string $domain Domain name in lower case, e.g. "product"
	 * @return \Aimeos\MShop\Common\Manager\Iface Manager object
	 */
	protected static function addManagerDecorators( \Aimeos\MShop\Context\Item\Iface $context,
		\Aimeos\MShop\Common\Manager\Iface $manager, $domain )
	{
		$config = $context->getConfig();

		/** madmin/common/manager/decorators/default
		 * Configures the list of decorators applied to all admin managers
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to configure a list of decorator names that should
		 * be wrapped around the original instances of all created managers:
		 *
		 *  madmin/common/manager/decorators/default = array( 'decorator1', 'decorator2' )
		 *
		 * This would wrap the decorators named "decorator1" and "decorator2" around
		 * all controller instances in that order. The decorator classes would be
		 * "\Aimeos\MShop\Common\Manager\Decorator\Decorator1" and
		 * "\Aimeos\MShop\Common\Manager\Decorator\Decorator2".
		 *
		 * @param array List of decorator names
		 * @since 2014.03
		 * @category Developer
		 */
		$decorators = $config->get( 'madmin/common/manager/decorators/default', array() );
		$excludes = $config->get( 'madmin/' . $domain . '/manager/decorators/excludes', array() );

		foreach( $decorators as $key => $name )
		{
			if( in_array( $name, $excludes ) ) {
				unset( $decorators[$key] );
			}
		}

		$classprefix = '\\Aimeos\\MShop\\Common\\Manager\\Decorator\\';
		$manager = self::addDecorators( $context, $manager, $decorators, $classprefix );

		$classprefix = '\\Aimeos\\MShop\\Common\\Manager\\Decorator\\';
		$decorators = $config->get( 'madmin/' . $domain . '/manager/decorators/global', array() );
		$manager = self::addDecorators( $context, $manager, $decorators, $classprefix );

		$classprefix = '\\Aimeos\\MShop\\' . ucfirst( $domain ) . '\\Manager\\Decorator\\';
		$decorators = $config->get( 'madmin/' . $domain . '/manager/decorators/local', array() );
		$manager = self::addDecorators( $context, $manager, $decorators, $classprefix );

		return $manager;
	}
}
