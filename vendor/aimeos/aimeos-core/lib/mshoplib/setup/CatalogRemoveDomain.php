<?php

/**
 * @copyright Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Removes domain column from catalog table.
 */
class CatalogRemoveDomain extends \Aimeos\MW\Setup\Task\Base
{
	private $mysql = array(
		'ALTER TABLE "mshop_catalog" DROP "domain"',
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
		return array( 'CatalogTreeToCatalog' );
	}


	/**
	 * Executes the task for MySQL databases.
	 */
	protected function mysql()
	{
		$this->process( $this->mysql );
	}


	/**
	 * Renames catalog_tree table if it exists.
	 *
	 * @param array $stmts Associative array of table name and lists of SQL statements to execute.
	 */
	protected function process( array $stmts )
	{
		$this->msg( 'Removing catalog "domain" column', 0 ); $this->status( '' );
		$this->msg( sprintf( 'Checking table "%1$s": ', 'mshop_catalog' ), 1 );

		if( $this->schema->tableExists( 'mshop_catalog' ) === true
			&& $this->schema->columnExists( 'mshop_catalog', 'domain' ) === true )
		{
			$this->executeList( $stmts );
			$this->status( 'removed' );
		}
		else
		{
			$this->status( 'OK' );
		}
	}
}
