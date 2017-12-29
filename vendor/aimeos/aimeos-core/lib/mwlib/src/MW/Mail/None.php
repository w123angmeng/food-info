<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2016
 * @package MW
 * @subpackage Mail
 */


namespace Aimeos\MW\Mail;


/**
 * Black hole e-mail implementation.
 *
 * @package MW
 * @subpackage Mail
 */
class None implements \Aimeos\MW\Mail\Iface
{
	/**
	 * Creates a new e-mail message object.
	 *
	 * @param string $charset Default charset of the message
	 * @return \Aimeos\MW\Mail\Message\Iface E-mail message object
	 */
	public function createMessage( $charset = 'UTF-8' )
	{
		return new \Aimeos\MW\Mail\Message\None();
	}


	/**
	 * Sends the e-mail message to the mail server.
	 *
	 * @param \Aimeos\MW\Mail\Message\Iface $message E-mail message object
	 */
	public function send( \Aimeos\MW\Mail\Message\Iface $message )
	{
	}
}
