<?php
namespace Lib;

abstract class Application
{
	public $router;
	public $autoloader;
	public $root_view;
	public $config;

	function autoloader_init(Autoloader &$autoloader)
	{
		$this->autoloader = $autoloader;
	}

	function config_init(&$config)
	{
		$this->config = $config;
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
