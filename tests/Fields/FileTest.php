<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class FileTest extends WarkhamTestCase
{
	public function testCanCreateFileInput()
	{
		$field = $this->warkham->file('dummy');

		$this->assertField($field, array(
			'type' => 'file',
		));
	}

	public function testCanCallOriginalFileMethods()
	{
		$field = $this->warkham->file('dummy');
		$field->accept('jpg');

		$this->assertField($field, array(
			'type'   => 'file',
			'accept' => 'image/jpeg',
		));
	}

	public function testCanSetProgressAttribute()
	{
		$field = $this->warkham->file('dummy')->progress(true);
		$this->assertField($field, array(
			'type'          => 'file',
			'data-progress' => 'true',
		));
	}

	public function testCanSetAsMultiple()
	{
		$field = $this->warkham->file('dummy');

		$field->multiple(true);
		$this->assertField($field, array(
			'type'          => 'file',
			'data-multiple' => 'true',
		));

		$field->multiple(false);
		$this->assertField($field, array(
			'type'          => 'file',
			'data-multiple' => 'false',
		));
	}

	public function testCanSetThumbnailAttributes()
	{
		$field = $this->warkham->file('dummy');
		$field->thumbnail(100, 200, 'foobar');

		$this->assertField($field, array(
			'type'                 => 'file',
			'data-thumbnail'       => 'true',
			'data-thumbnailwidth'  => '100',
			'data-thumbnailheight' => '200',
			'data-thumbnailclass'  => 'foobar',
		));
	}

	public function testCanSetUploadRoute()
	{
		$this->app['url'] = $this->mockUrlGenerator();

		$field = $this->warkham->file('dummy');
		$field->uploadRoute('foobar');

		$this->assertField($field, array(
			'type'     => 'file',
			'data-url' => 'http://localhost/route',
		));
	}
}
