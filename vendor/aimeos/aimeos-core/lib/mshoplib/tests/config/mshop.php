<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


return array(
	'coupon' => array(
		'provider' => array(
			'decorators' => array(
				'Example',
			),
		),
	),
	'product' => array(
		'manager' => array(
			'decorators' => array(
				'global' => array(
					'Changelog',
				),
			),
		),
	),
	'service' => array(
		'provider' => array(
			'delivery' => array(
				'decorators' => array(
				),
			),
		),
	),
);