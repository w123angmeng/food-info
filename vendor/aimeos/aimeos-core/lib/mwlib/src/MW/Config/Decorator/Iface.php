<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MW
 * @subpackage Config
 */


namespace Aimeos\MW\Config\Decorator;


/**
 * Decorator interface for configuration setting classes
 *
 * @package MW
 * @subpackage Config
 */
interface Iface extends \Aimeos\MW\Config\Iface
{
	/**
	 * Initializes the decorator.
	 *
	 * @param \Aimeos\MW\Config\Iface $object Config object or decorator
	 * @return null
	 */
	public function __construct( \Aimeos\MW\Config\Iface $object );
}
