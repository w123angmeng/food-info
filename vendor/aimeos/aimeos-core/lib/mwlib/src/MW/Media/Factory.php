<?php

/**
 * @copyright Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MW
 * @subpackage Media
 */


namespace Aimeos\MW\Media;


/**
 * Creates a new media object.
 *
 * @package MW
 * @subpackage Media
 */
class Factory
{
	/**
	 * Creates a new media object.
	 *
	 * Options for the factory are:
	 * - file: "file" command to determine the mime type (default: 'file -b --mime-type %1$s')
	 * - image: Associative list of image related options
	 * - application: Associative list of application related options
	 *
	 * @param string|null $filename Path to media file or null for new files
	 * @param array $options Associative list of options for configuring the media class
	 * @return \Aimeos\MW\Media\Iface Media object
	 */
	public static function get( $filename, array $options = array() )
	{
		if( class_exists( 'finfo' ) )
		{
			try
			{
				$finfo = new \finfo( FILEINFO_MIME_TYPE );
				$mimetype = $finfo->file( $filename );
			}
			catch( \Exception $e )
			{
				throw new \Aimeos\MW\Media\Exception( $e->getMessage() );
			}
		}
		else if( function_exists( 'mime_content_type' ) )
		{
			$mimetype = mime_content_type( $filename );
		}
		else
		{
			$msg = sprintf( 'No method for retrieving the mime type available: %1$s', 'finfo, mime_content_type' );
			throw new \Aimeos\MW\Media\Exception( $msg );
		}

		$mimeparts = explode( '/', $mimetype );

		switch( $mimeparts[0] )
		{
			case 'image':
				return new \Aimeos\MW\Media\Image\Standard( $filename, $mimetype, $options );
		}

		return new \Aimeos\MW\Media\Application\Standard( $filename, $mimetype, $options );
	}
}
