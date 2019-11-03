<?php
namespace Lib;

abstract class Application
{
	public $router;
	public $autoloader;
	public $root_view;
	public $config;
    public $vm;
    public $auth;

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

    function pdo_init(): \PDO
    {
        $pdo = new \PDO("mysql:dbname=app;host=127.0.0.1", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    function auth_init(): Auth
    {
        return new Auth();
    }
}
