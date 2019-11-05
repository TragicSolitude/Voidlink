<?php
namespace Lib;

/**
 * Container for the whole site. All services and magic objects are stored in
 * an instance of this class so that base functionality can be configured on
 * a per-app basis by extending this class and overriding the various
 * lifecycle hooks.
 */
abstract class Application
{
	public $router;
	public $autoloader;
	public $root_view;
	public $config;
    public $vm;
    public $auth;

    /**
     * Initializes the autoloader. This is primarily used for adding additional
     * namespaces to the autoloader
     */
    function autoloader_init(): Autoloader
    {
        return new Autoloader();
    }

    /**
     * Choose and configure an arbitrary, ideally immutable config object that
     * is accessible to controllers
     */
	function config_init(): object
	{
        return new \stdClass();
	}

    /**
     * Initialize and configure the router
     */
	function router_init(): Router
	{
		return new Router();
	}

    /**
     * Get the base path for views
     */
    function view_base_path(): string
    {
        return "../app/views/";
    }

    /**
     * Get the name of the root view that wraps all other views
     */
    function view_root(): string
    {
        return "root";
    }

    /**
     * Initialize the viewmodel. Override this function to add scripts,
     * stylesheets, and values that are available to all views.
     */
    function vm_init(): ViewModel
    {
        return new ViewModel();
    }

    /**
     * Configure PDO
     */
    function pdo_init(): \PDO
    {
        $pdo = new \PDO("mysql:dbname=app;host=127.0.0.1", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    /**
     * Configure the auth class
     */
    function auth_init(): Auth
    {
        return new Auth();
    }
}
