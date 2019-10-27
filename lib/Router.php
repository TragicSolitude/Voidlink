<?php
namespace Lib;

class Router
{
	function parse()
	{
		// Parse out route parameter hopefully given by mod_rewrite
		$query = [];
		parse_str($_SERVER["QUERY_STRING"], $query);

		if (empty($query["r"]))
		{
			throw new HttpException(404);
		}

		$method = strtolower($_SERVER['REQUEST_METHOD']);
		$split = explode("/", $query["r"]);
		$controller_name = ucfirst($split[1]);
		$controller_class = "App\\Controllers\\{$controller_name}Controller";
		$action = "{$method}_{$split[2]}";
		// $controller = new $controller_class();

		return [$controller_class, $action];
	}
}
