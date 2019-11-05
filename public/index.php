<?php
// Entry point to the site

// Load libraries. Used only for Google Cloud Storage client library because
// manually spinning OAuth2.0 for it is unnecessarily hard and likely a huge
// security flaw.
//
// Hosting runs the site stateless so images must be saved on an external
// service
include "../vendor/autoload.php";

// Start application bootstrap
include "../lib/Autoloader.php";
include "../app/Bootstrap.php";

try
{
    session_start();

    // Run lifecycle hooks
	$bootstrap = new App\Bootstrap();
    $bootstrap->autoloader = $bootstrap->autoloader_init();
    $bootstrap->router = $bootstrap->router_init();
    $bootstrap->config = $bootstrap->config_init();
    $bootstrap->vm = $bootstrap->vm_init();
    $bootstrap->pdo = $bootstrap->pdo_init();
    $bootstrap->auth = $bootstrap->auth_init();

    // Initialize static lateinit PDO instance
    Lib\Dao::$pdo = $bootstrap->pdo;

    // Get the target controller and action based on url
	[$controller_class, $action] = $bootstrap->router->parse();
    // TODO Convert to dynamic dependency injection
    $controller = new $controller_class(
        $bootstrap->config,
        $bootstrap->vm,
        $bootstrap->auth
    );

    // Run the controller action and get the response
	$response = $controller->handle($action);

    // Break out functionality based on response.
	if (gettype($response) === "string")
	{
        [$action, $path] = explode(":", $response);
        switch ($action)
        {
            // 302 redirect to another page
            case "redirect":
                header("Location: $path");
                http_response_code(302);
                break;

            // 303 redirect to another page; better semantics for
            // POST-Redirect-GET pattern
            case "see":
                header("Location: $path");
                http_response_code(303);
                break;

            // 303 redirect to HTTP_REFERER; mostly used for returning back to
            // a form after an error
            case "go_back":
                $back = $_SERVER['HTTP_REFERER'] ?: "/";
                header("Location: $back");
                http_response_code(303);
                // Do not allow clean up
                die;
                // Turns out this "go_back" case works great even if it
                // incorrectly falls through to the default case because then
                // the default case has a fatal error where it require()s the
                // nonexistant $viewpath and prevents cleanup just like the die
                // does.

            // By default just take the returned string as a path to the view
            // to render
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
        // Otherwise return whatever is returned as JSON
		header("Content-Type: application/json");
		echo json_encode($response);
	}

    // Cleanup afterwards
    $controller->shutdown();
}
catch (Lib\HttpException $e)
{
    // Error handling
	$code = $e->code;
	if ((include "../app/exceptions/$code.php") === FALSE)
    {
		require "../app/exceptions/generic.php";
    }
}
catch (Exception $e)
{
    // Unknown error
	echo $e->getMessage();
	include "../app/exceptions/500.php";
}
