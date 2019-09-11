<?php
namespace App;

use App\Views\AppRootView;
use Lib\Application;
use Lib\Autoloader;
use Lib\RootView;

class Bootstrap extends Application
{
	// Only Lib classes can be used before this point
	function autoloader_init(Autoloader &$autoloader)
	{
		parent::autoloader_init($autoloader);

		$this->autoloader->add_namespaces([
			"App" => "../app",
			"App\Controllers" => "../app/controllers",
			"App\Views" => "../app/views",
			"App\Models" => "../app/models",
			"App\Exceptions" => "../app/exceptions"
		]);
	}

	function root_view_init(RootView &$root_view)
	{
		parent::root_view_init($root_view);

		$root_view->body_view = new AppRootView();
		$root_view->page_title = "ASDF";
	}

	function config_init(&$config)
	{
		parent::config_init(new Config());
	}
}
