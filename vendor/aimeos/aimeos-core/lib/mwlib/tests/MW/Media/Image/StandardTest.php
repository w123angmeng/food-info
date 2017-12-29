<?php

namespace Aimeos\MW\Media\Image;


/**
 * Test class for \Aimeos\MW\Media\Image\Standard.
 *
 * @copyright Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */
class StandardTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructGif()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.gif';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/gif', array() );

		$this->assertEquals( 'image/gif', $media->getMimetype() );
	}


	public function testConstructJpeg()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.jpg';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/jpeg', array() );

		$this->assertEquals( 'image/jpeg', $media->getMimetype() );
	}


	public function testConstructPng()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );

		$this->assertEquals( 'image/png', $media->getMimetype() );
	}


	public function testConstructFileException()
	{
		$this->setExpectedException( '\\Aimeos\\MW\\Media\\Exception' );
		new \Aimeos\MW\Media\Image\Standard( 'notexisting', '', array() );
	}


	public function testConstructImageException()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'application.txt';

		$this->setExpectedException( '\\Aimeos\\MW\\Media\\Exception' );
		new \Aimeos\MW\Media\Image\Standard( $filename, 'text/plain', array() );
	}


	public function testDestruct()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );

		unset( $media );
	}


	public function testSaveGif()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.gif';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );
		$media->save( $dest, 'image/gif' );

		$this->assertEquals( true, file_exists( $dest ) );
		unlink( $dest );
	}


	public function testSaveGifInvalidDest()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = __DIR__ . $ds . 'notexisting' . $ds . 'media.gif';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );

		$this->setExpectedException( '\\Aimeos\\MW\\Media\\Exception' );
		$media->save( $dest, 'image/gif' );
	}


	public function testSaveJpeg()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.jpg';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/gif', array() );
		$media->save( $dest, 'image/jpeg' );

		$this->assertEquals( true, file_exists( $dest ) );
		unlink( $dest );
	}


	public function testSaveJpegInvalidDest()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = __DIR__ . $ds . 'notexisting' . $ds . 'media.jpg';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );

		$this->setExpectedException( '\\Aimeos\\MW\\Media\\Exception' );
		$media->save( $dest, 'image/jpeg' );
	}


	public function testSavePng()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.gif';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/gif', array() );
		$media->save( $dest, 'image/png' );

		$this->assertEquals( true, file_exists( $dest ) );
		unlink( $dest );
	}


	public function testSavePngInvalidDest()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.gif';
		$dest = __DIR__ . $ds . 'notexisting' . $ds . 'media.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/gif', array() );

		$this->setExpectedException( '\\Aimeos\\MW\\Media\\Exception' );
		$media->save( $dest, 'image/png' );
	}


	public function testScale()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );
		$media->scale( 100, 100, false );
		$media->save( $dest, 'image/png' );

		$info = getimagesize( $dest );
		unlink( $dest );

		$this->assertEquals( 100, $info[0] );
		$this->assertEquals( 100, $info[1] );
	}


	public function testScaleFit()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );
		$media->scale( 5, 100 );
		$media->save( $dest, 'image/png' );

		$info = getimagesize( $dest );
		unlink( $dest );

		$this->assertEquals( 5, $info[0] );
		$this->assertEquals( 5, $info[1] );
	}


	public function testScaleFitInside()
	{
		$ds = DIRECTORY_SEPARATOR;
		$filename = dirname( __DIR__ ) . $ds . '_testfiles' . $ds . 'image.png';
		$dest = dirname( dirname( dirname( __DIR__ ) ) ) . $ds . 'tmp' . $ds . 'media.png';

		$media = new \Aimeos\MW\Media\Image\Standard( $filename, 'image/png', array() );
		$media->scale( 100, 100 );
		$media->save( $dest, 'image/png' );

		$info = getimagesize( $dest );
		unlink( $dest );

		$this->assertEquals( 10, $info[0] );
		$this->assertEquals( 10, $info[1] );
	}
}
