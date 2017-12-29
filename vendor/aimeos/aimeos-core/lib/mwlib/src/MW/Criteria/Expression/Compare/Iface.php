<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MW
 * @subpackage Common
 */


namespace Aimeos\MW\Criteria\Expression\Compare;


/**
 * Interface for comparing objects.
 *
 * @package MW
 * @subpackage Common
 */
interface Iface extends \Aimeos\MW\Criteria\Expression\Iface
{
	/**
	 * Returns the left side of the compare expression.
	 *
	 * @return string Name of variable or column that should be compared.
	 */
	public function getName();


	/**
	 * Returns the right side of the compare expression.
	 *
	 * @return string Value that the variable or column should be compared to.
	 */
	public function getValue();
}
