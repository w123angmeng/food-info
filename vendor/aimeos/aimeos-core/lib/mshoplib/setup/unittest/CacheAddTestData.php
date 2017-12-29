<?php

/**
 * @copyright Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds admin cache test data.
 */
class CacheAddTestData extends \Aimeos\MW\Setup\Task\Base
{
	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return array( 'MShopSetLocale' );
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return array List of task names
	 */
	public function getPostDependencies()
	{
		return array();
	}


	/**
	 * Adds admin log test data.
	 */
	public function migrate()
	{
		$iface = '\\Aimeos\\MShop\\Context\\Item\\Iface';
		if( !( $this->additional instanceof $iface ) ) {
			throw new \Aimeos\MW\Setup\Exception( sprintf( 'Additionally provided object is not of type "%1$s"', $iface ) );
		}

		$this->msg( 'Adding admin cache test data', 0 );
		$this->additional->setEditor( 'core:unittest' );

		$this->addCacheTestData();

		$this->status( 'done' );
	}


	/**
	 * Adds the cache test data.
	 *
	 * @throws \Aimeos\MW\Setup\Exception If a required ID is not available
	 */
	private function addCacheTestData()
	{
		$manager = \Aimeos\MAdmin\Cache\Manager\Factory::createManager( $this->additional, 'Standard' );

		$ds = DIRECTORY_SEPARATOR;
		$path = __DIR__ . $ds . 'data' . $ds . 'cache.php';

		if( ( $testdata = include( $path ) ) == false ) {
			throw new \Aimeos\MShop\Exception( sprintf( 'No file "%1$s" found for cache domain', $path ) );
		}

		$item = $manager->createItem();

		foreach( $testdata['cache'] as $dataset )
		{
			$item->setId( $dataset['id'] );
			$item->setValue( $dataset['value'] );
			$item->setTimeExpire( $dataset['expire'] );
			$item->setTags( $dataset['tags'] );

			$manager->saveItem( $item, false );
		}
	}

}