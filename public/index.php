<?php

// Start application bootstrap
include "../lib/Autoloader.php";
include "../app/Bootstrap.php";

use App\Exceptions\HttpException;

try
{
	$bootstrap = new App\Bootstrap();
    $bootstrap->autoloader = $bootstrap->autoloader_init();
    $bootstrap->router = $bootstrap->router_init();
    $bootstrap->config = $bootstrap->config_init();
    $bootstrap->vm = $bootstrap->vm_init();

	[$controller_class, $action] = $bootstrap->router->parse();
    // TODO Convert to dynamic dependency injection
    $controller = new $controller_class($bootstrap->config, $bootstrap->vm);
	$response = $controller->handle($action);

	if (gettype($response) === "string")
	{
        // Restrict scope
        $vm = $bootstrap->vm;
        $viewpath = $bootstrap->view_base_path() . $response . ".php";
        $scope = function () use ($vm, $viewpath) {
            // Load view by path returned from action
            require $viewpath;
        };

        // Initialize view tree
        require $bootstrap->view_base_path() . $bootstrap->view_root() . ".php";
	}
	else
	{
		header("Content-Type: application/json");
		echo json_encode($response);
	}
}
catch (HttpException $e)
{
	$code = $e->code;
	include "../app/exceptions/$code.php"
		or include "../app/exceptions/generic.php";
}
catch (Exception $e)
{
	// do something with e message
	echo $e->getMessage();
	include "../app/exceptions/500.php";
}
