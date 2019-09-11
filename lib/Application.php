<?php
namespace Lib;

abstract class Application
{
	public $router = NULL;
	public $autoloader = NULL;
	public $root_view = NULL;

	function autoloader_init(Autoloader &$autoloader)
	{
		$this->autoloader = $autoloader;
	}

	function router_init(Router &$router)
	{
		$this->router = $router;
	}

	function root_view_init(RootView &$root_view)
	{
		$this->root_view = $root_view;
	}
}
