<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Extends the length of the attribute code column
 */
class AttributeExtendCodeLength extends Base
{
	private $sql = 'ALTER TABLE "mshop_attribute" CHANGE "code" "code" VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL';


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return array List of task names
	 */
	public function getPreDependencies()
	{
		return array( 'ColumnCodeCollateToUtf8Bin' );
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
		$this->msg( 'Extend length of attribute code', 0 );

		$schema = $this->getSchema( 'db-attribute' );

		if( $schema->tableExists( 'mshop_attribute' ) === true
			&& $schema->columnExists( 'mshop_attribute', 'code' ) === true
			&& $schema->getColumnDetails( 'mshop_attribute', 'code' )->getMaxLength() < 255
		) {
			$this->execute( $this->sql );
			$this->status( 'done' );
		}
		else
		{
			$this->status( 'OK' );
		}
	}
}