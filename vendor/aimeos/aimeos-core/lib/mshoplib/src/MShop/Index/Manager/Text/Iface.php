<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Index
 */


namespace Aimeos\MShop\Index\Manager\Text;


/**
 * Text indexer interface for classes managing product indices.
 *
 * @package MShop
 * @subpackage Index
 */
interface Iface extends \Aimeos\MShop\Index\Manager\Iface
{
	/**
	 * Returns product IDs and texts that matches the given criteria.
	 *
	 * @param \Aimeos\MW\Criteria\Iface $search Search criteria
	 * @return array Associative list of the product ID as key and the product text as value
	 */
	public function searchTexts( \Aimeos\MW\Criteria\Iface $search );
}