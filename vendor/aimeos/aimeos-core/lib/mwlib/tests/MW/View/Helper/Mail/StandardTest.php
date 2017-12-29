<?php

/**
 * @copyright Metaways Infosystems GmbH, 2013
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MW\View\Helper\Mail;


/**
 * Test class for \Aimeos\MW\View\Helper\Mail.
 */
class StandardTest extends \PHPUnit_Framework_TestCase
{
	private $object;
	private $message;


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 */
	protected function setUp()
	{
		$view = new \Aimeos\MW\View\Standard();

		$mail = new \Aimeos\MW\Mail\None();
		$this->message = $mail->createMessage();

		$this->object = new \Aimeos\MW\View\Helper\Mail\Standard( $view, $this->message );
	}


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 */
	protected function tearDown()
	{
		$this->object = null;
	}


	public function testTransform()
	{
		$this->assertSame( $this->message, $this->object->transform() );
	}

}
