<?php
namespace App;

use App\Config\DevConfig;
use Lib\Application;
use Lib\Autoloader;
use Lib\ViewModel;

class Bootstrap extends Application
{
	function autoloader_init(): Autoloader
	{
        return parent::autoloader_init()
		    ->add_namespaces([
                "App" => "../app",
                "App\Controllers" => "../app/controllers",
                "App\Views" => "../app/views",
                "App\Dto" => "../app/dto",
                "App\Models" => "../app/models",
                "App\Repositories" => "../app/repositories",
                "App\Exceptions" => "../app/exceptions",
                "App\Config" => "../app/config"
            ]);
	}

	function config_init(): object
	{
        // Swap out configs based on current environment
        return new DevConfig();
	}

    function vm_init(): ViewModel
    {
        return parent::vm_init()
            ->add_stylesheet("main.css");
    }

    function pdo_init(): \PDO
    {
        return new \PDO("mysql:dbname=voidlink;host=db", "root", "");
    }
}
