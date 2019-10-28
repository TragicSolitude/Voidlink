<?php
namespace Lib;

class Router
{
	function parse()
	{
		// Parse out route parameter hopefully given by mod_rewrite
		$query = [];
		parse_str($_SERVER["QUERY_STRING"], $query);

		$method = strtolower($_SERVER['REQUEST_METHOD']);
		$split = explode("/", $query["r"]);
        $controller = $split[1] ?: "index";
        $action = $split[2] ?: "index";

        $controller_name = ucfirst($controller);
        $controller_class = "App\\Controllers\\{$controller_name}Controller";
        $action_name = "{$method}_{$action}";

        return [$controller_class, $action_name];
	}
}
