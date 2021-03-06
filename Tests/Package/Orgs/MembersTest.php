<?php
/**
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Github\Tests;

use Joomla\Github\Package\Orgs\Members;
use Joomla\Github\Tests\Stub\GitHubTestCase;

/**
 * Test class for Members.
 *
 * @since  1.0
 */
class MembersTest extends GitHubTestCase
{
	/**
	 * @var Members
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @since   1.0
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->object = new Members($this->options, $this->client);
	}

	/**
	 * Tests the getList method
	 *
	 * @return  void
	 */
	public function testGetList()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getList('joomla'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}

	/**
	 * Tests the getListNotAMember method
	 *
	 * @return  void
	 */
	public function testGetListNotAMember()
	{
		$this->response->code = 302;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getList('joomla'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the getListUnexpected method
	 *
	 * @return  void
	 *
	 * @expectedException \UnexpectedValueException
	 */
	public function testGetListUnexpected()
	{
		$this->response->code = 666;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getList('joomla'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}

	/**
	 * Tests the check method
	 *
	 * @return  void
	 */
	public function testCheck()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->check('joomla', 'elkuku'),
			$this->equalTo(true)
		);
	}

	/**
	 * Tests the checkNoMember method
	 *
	 * @return  void
	 */
	public function testCheckNoMember()
	{
		$this->response->code = 404;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->check('joomla', 'elkuku'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the checkRequesterNoMember method
	 *
	 * @return  void
	 */
	public function testCheckRequesterNoMember()
	{
		$this->response->code = 302;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->check('joomla', 'elkuku'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the checkUnexpectedr method
	 *
	 * @return  void
	 *
	 * @expectedException \UnexpectedValueException
	 */
	public function testCheckUnexpectedr()
	{
		$this->response->code = 666;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->check('joomla', 'elkuku'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the remove method
	 *
	 * @return  void
	 */
	public function testRemove()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('delete')
			->with('/orgs/joomla/members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->remove('joomla', 'elkuku'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}

	/**
	 * Tests the getListPublic method
	 *
	 * @return  void
	 */
	public function testGetListPublic()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/public_members')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListPublic('joomla'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}

	/**
	 * Tests the checkPublic method
	 *
	 * @return  void
	 */
	public function testCheckPublic()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/public_members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->checkPublic('joomla', 'elkuku'),
			$this->equalTo(true)
		);
	}

	/**
	 * Tests the checkPublicNo method
	 *
	 * @return  void
	 */
	public function testCheckPublicNo()
	{
		$this->response->code = 404;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/public_members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->checkPublic('joomla', 'elkuku'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the checkPublicUnexpected method
	 *
	 * @return  void
	 *
	 * @expectedException \UnexpectedValueException
	 */
	public function testCheckPublicUnexpected()
	{
		$this->response->code = 666;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/public_members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->checkPublic('joomla', 'elkuku'),
			$this->equalTo(false)
		);
	}

	/**
	 * Tests the publicize method
	 *
	 * @return  void
	 */
	public function testPublicize()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('put')
			->with('/orgs/joomla/public_members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->publicize('joomla', 'elkuku'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}

	/**
	 * Tests the conceal method
	 *
	 * @return  void
	 */
	public function testConceal()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('delete')
			->with('/orgs/joomla/public_members/elkuku')
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->conceal('joomla', 'elkuku'),
			$this->equalTo(json_decode($this->sampleString))
		);
	}
}
