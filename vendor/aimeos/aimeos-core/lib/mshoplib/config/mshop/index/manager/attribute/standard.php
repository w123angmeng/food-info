<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */

return array(
	'delete' => array(
		'ansi' => '
			DELETE FROM "mshop_index_attribute"
			WHERE :cond AND "siteid" = ?
		'
	),
	'insert' => array(
		'ansi' => '
			INSERT INTO "mshop_index_attribute" (
				"prodid", "siteid", "attrid", "listtype", "type", "code",
				"mtime", "editor", "ctime"
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?
			)
		',
		'pgsql' => '
			INSERT INTO "mshop_index_attribute" (
				"prodid", "siteid", "attrid", "listtype", "type", "code",
				"mtime", "editor", "ctime"
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?
			)
			ON CONFLICT DO NOTHING
		',
	),
	'search' => array(
		'ansi' => '
			SELECT mpro."id"
			FROM "mshop_product" AS mpro
			:joins
			WHERE :cond
			GROUP BY mpro."id" /*-columns*/ , :columns /*columns-*/
			/*-orderby*/ ORDER BY :order /*orderby-*/
			LIMIT :size OFFSET :start
		'
	),
	'count' => array(
		'ansi' => '
			SELECT COUNT(*) AS "count"
			FROM (
				SELECT DISTINCT mpro."id"
				FROM "mshop_product" AS mpro
				:joins
				WHERE :cond
				LIMIT 1000 OFFSET 0
			) AS list
		'
	),
	'cleanup' => array(
		'ansi' => '
			DELETE FROM "mshop_index_attribute"
			WHERE "ctime" < ? AND "siteid" = ?
		'
	),
	'optimize' => array(
		'mysql' => array(
			'OPTIMIZE TABLE "mshop_index_attribute"',
		),
		'pgsql' => array(),
	),
);
