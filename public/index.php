<?php

// Start application bootstrap
include "../lib/Autoloader.php";
include "../app/Bootstrap.php";

try
{
	$bootstrap = new App\Bootstrap();
    $bootstrap->autoloader = $bootstrap->autoloader_init();
    $bootstrap->router = $bootstrap->router_init();
    $bootstrap->config = $bootstrap->config_init();
    $bootstrap->vm = $bootstrap->vm_init();
    // $bootstrap->pdo = $bootstrap->pdo_init();

    // TODO change this to RepositoryFactory that gets injected into
    // the controller
    Lib\Repository::$pdo = $bootstrap->pdo;

	[$controller_class, $action] = $bootstrap->router->parse();
    // TODO Convert to dynamic dependency injection
    $controller = new $controller_class($bootstrap->config, $bootstrap->vm);
	$response = $controller->handle($action);

	if (gettype($response) === "string")
	{
        [$action, $path] = explode(":", $response);
        switch ($action)
        {
            case "redirect":
                header("Location: $path");
                http_response_code(302);
                break;
            case "see":
                header("Location: $path");
                http_response_code(303);
                break;
            default:
                $basepath = $bootstrap->view_base_path();
                $rootpath = $basepath . $bootstrap->view_root() . ".php";

                // Restrict scope
                $vm = $bootstrap->vm;
                $viewpath = $basepath . $action . ".php";
                $scope = function () use ($vm, $viewpath) {
                    // Load view by path returned from action
                    require $viewpath;
                };

                // Initialize view tree
                require $rootpath;
                break;
        }
	}
	else
	{
		header("Content-Type: application/json");
		echo json_encode($response);
	}
}
catch (Lib\HttpException $e)
{
	$code = $e->code;
	if ((include "../app/exceptions/$code.php") === FALSE)
    {
		require "../app/exceptions/generic.php";
    }
}
catch (Exception $e)
{
	// do something with e message
	echo $e->getMessage();
	include "../app/exceptions/500.php";
}
