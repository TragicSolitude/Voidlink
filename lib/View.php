<?php
namespace Lib;

abstract class View
{
	private static $scripts = [];
	private static $stylesheets = [];
	public $children = [];

	abstract function render();

	protected function add_script($script_name)
	{
		View::$scripts[] = "public/js/$script_name";
	}

	protected function scripts()
	{
		foreach (View::$scripts as $script): ?>
			<script src="<?= $script ?>"></script>
		<?php endforeach;
		View::$scripts = [];
	}

	protected function add_stylesheet($stylesheet)
	{
		View::$stylesheets[] = "public/css/$stylesheet";
	}

	protected function stylesheets()
	{
		foreach (View::$stylesheets as $stylesheet): ?>
			<link rel="stylesheet" href="<?= $stylesheet ?>" />
		<?php endforeach;
		View::$stylesheets = [];
	}
}
