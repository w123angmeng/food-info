<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Renames index in the attribute tables.
 */
class AttributeModifyIndex extends \Aimeos\MW\Setup\Task\Base
{
	private $mysql = array(
		'mshop_attribute' => array(
				'dx_msatt_sid_dom_editor' => 'ALTER TABLE "mshop_attribute" DROP INDEX "dx_msatt_sid_dom_editor"',
			)
	);


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return array List of task names
	 */
	public function getPreDependencies()
	{
		return array();
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies()
	{
		return array( 'TablesCreateMShop' );
	}


	/**
	 * Executes the task for MySQL databases.
	 */
	protected function mysql()
	{
		$this->process( $this->mysql );
	}


	/**
	 * Modifies indexes in the mshop_attribute table.
	 *
	 * @param array $stmts List of SQL statements to execute for renaming columns
	 */
	protected function process( array $stmts )
	{
		$this->msg( sprintf( 'Modifying index in mshop_attribute table' ), 0 );
		$this->status( '' );

		foreach( $stmts as $table => $indexes )
		{
			foreach( $indexes as $index => $stmt )
			{
				$this->msg( sprintf( 'Checking index "%1$s": ', $index ), 1 );

				if( $this->schema->tableExists( $table ) === true
					&& $this->schema->indexExists( $table, $index ) === true )
				{
					$this->execute( $stmt );
					$this->status( 'dropped' );
				}
				else
				{
					$this->status( 'OK' );
				}
			}
		}
	}
}
