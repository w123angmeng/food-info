<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016
 * @package MW
 * @subpackage Config
 */


namespace Aimeos\MW\Config\Decorator;


/**
 * Protection decorator for config classes.
 *
 * @package MW
 * @subpackage Config
 */
class Protect
	extends \Aimeos\MW\Config\Decorator\Base
	implements \Aimeos\MW\Config\Decorator\Iface
{
	private $prefixes = array();


	/**
	 * Initializes the decorator
	 *
	 * @param \Aimeos\MW\Config\Iface $object Config object or decorator
	 * @param array $prefixes Allowed prefixes for getting and setting values
	 */
	public function __construct( \Aimeos\MW\Config\Iface $object, array $prefixes = array() )
	{
		parent::__construct( $object );

		foreach( $prefixes as $prefix ) {
			$this->prefixes[$prefix] = strlen( $prefix );
		}
	}


	/**
	 * Returns the value of the requested config key
	 *
	 * @param string $name Path to the requested value like tree/node/classname
	 * @param mixed $default Value returned if requested key isn't found
	 * @return mixed Value associated to the requested key
	 */
	public function get( $name, $default = null )
	{
		foreach( $this->prefixes as $prefix => $len )
		{
			if( strncmp( $name, $prefix, $len ) === 0 ) {
				return parent::get( $name, $default );
			}
		}

		throw new \Aimeos\MW\Config\Exception( sprintf( 'Not allowed to access "%1$s" configuration', $name ) );
	}


	/**
	 * Sets the value for the specified key
	 *
	 * @param string $name Path to the requested value like tree/node/classname
	 * @param mixed $value Value that should be associated with the given path
	 */
	public function set( $name, $value )
	{
		foreach( $this->prefixes as $prefix => $len )
		{
			if( strncmp( $name, $prefix, $len ) === 0 ) {
				return parent::set( $name, $value );
			}
		}

		throw new \Aimeos\MW\Config\Exception( sprintf( 'Not allowed to set "%1$s" configuration', $name ) );
	}
}