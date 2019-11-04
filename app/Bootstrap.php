<?php
namespace App;

use App\Config\Config;
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
                "App\Dao" => "../app/dao",
                "App\Exceptions" => "../app/exceptions",
                "App\Config" => "../app/config"
            ]);
	}

	function config_init(): object
	{
        // TODO Swap out configs based on current environment
        return new Config();
	}

    function vm_init(): ViewModel
    {
        return parent::vm_init()
            ->add_stylesheet("main.css");
    }

    function pdo_init(): \PDO
    {
        return new \PDO(
            $this->config->db_url,
            $this->config->db_username,
            $this->config->db_password
        );
    }
}
