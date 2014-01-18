<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class AutocompleteTest extends WarkhamTestCase
{
	public function testHasDefaultAutocompleteClass()
	{
		$field = $this->warkham->autocomplete('dummy');

		$this->assertField($field, array(
			'class' => 'wkm-autocomplete',
		));
	}

	public function testCanSetDataset()
	{
		$field = $this->warkham->autocomplete('dummy')->setDataset(['foo', 'bar']);

		$this->assertField($field, array(
			'class'     => 'wkm-autocomplete',
			'data-values' => '["foo","bar"]',
		));
	}

	public function testCanSetRemoteRoute()
	{
		$field = $this->warkham->autocomplete('dummy')->setRemoteRoute('route');

		$this->assertField($field, array(
			'class'    => 'wkm-autocomplete',
			'data-url' => 'http://localhost/route',
		));
	}
}
