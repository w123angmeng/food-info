<?php
/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */

return array(
	'tag/type' => array(
		'tag/sort' => array( 'domain' => 'product', 'code' => 'sort', 'label' => 'Brand', 'status' => 1 ),
		'tag/taste' => array( 'domain' => 'product', 'code' => 'taste', 'label' => 'Taste', 'status' => 1 ),
	),

	'tag' => array(
		'tag/Expresso' => array( 'domain' => 'product', 'typeid' => 'tag/sort', 'langid' => 'de', 'label' => 'Expresso' ),
		'tag/Kaffee' => array( 'domain' => 'product', 'typeid' => 'tag/sort', 'langid' => 'de', 'label' => 'Kaffee' ),
		'tag/Cappuccino' => array( 'domain' => 'product', 'typeid' => 'tag/sort', 'langid' => 'de', 'label' => 'Cappuccino' ),
		'tag/herb' => array( 'domain' => 'product', 'typeid' => 'tag/taste', 'langid' => 'de', 'label' => 'herb' ),
		'tag/mild' => array( 'domain' => 'product', 'typeid' => 'tag/taste', 'langid' => 'de', 'label' => 'mild' ),
		'tag/cremig' => array( 'domain' => 'product', 'typeid' => 'tag/taste', 'langid' => 'de', 'label' => 'cremig' ),
	)
);