<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Common
 */


namespace Aimeos\MShop\Common\Item\Position;


/**
 * Common interface for items that carry sorting informations.
 *
 * @package MShop
 * @subpackage Common
 */
interface Iface
{
	/**
	 * Returns the position of the item in the list.
	 *
	 * @return integer Position of the item in the list
	 */
	public function getPosition();

	/**
	 * Sets the new position of the item in the list.
	 *
	 * @param integer $pos position of the item in the list
	 * @return \Aimeos\MShop\Common\Item\Iface Item for chaining method calls
	 */
	public function setPosition( $pos );
}
