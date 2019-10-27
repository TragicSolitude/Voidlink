<?php
namespace Lib;

abstract class Application
{
	public $router;
	public $autoloader;
	public $root_view;
	public $config;
    public $vm;

    function autoloader_init(): Autoloader
    {
        return new Autoloader();
    }

	function config_init(): object
	{
        return new \stdClass();
	}

	function router_init(): Router
	{
		return new Router();
	}

    function view_base_path(): string
    {
        return "../app/views/";
    }

    function view_root(): string
    {
        return "root";
    }

    function vm_init(): ViewModel
    {
        return new ViewModel();
    }
}
