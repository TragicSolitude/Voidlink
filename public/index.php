<?php

// Start application bootstrap
include "../lib/Autoloader.php";
include "../app/Bootstrap.php";

use App\Exceptions\HttpException;
use Lib\View;
use Lib\RootView;
use Lib\Router;
use Lib\Autoloader;

try
{
	$bootstrap = new App\Bootstrap();
	$bootstrap->autoloader_init(new Autoloader());
	$bootstrap->router_init(new Router());

	$response = $bootstrap->router->handle();

	if (empty($response))
	{
		// What should happen here
	}
	else if ($response instanceof View)
	{
		$root_view = new RootView();
		$bootstrap->root_view_init($root_view);
		$root_view->body_view->children[] = $response;

		echo $root_view->render();
	}
	else
	{
		header("Content-Type: application/json");
		echo json_encode($response);
	}
	// TODO handle some kind of response type for customizing headers and stuff
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
