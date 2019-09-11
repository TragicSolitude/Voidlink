<?php
namespace Lib;

class Controller
{
	protected $config;

	function set_config($config)
	{
		$this->config = $config;
	}

	function handle(string $action)
	{
		if (!method_exists($this, $action))
		{
			throw new HttpException(404);
		}

		$response = $this->$action();

		// TODO set headers and stuff based on controller variables

		return $response;
	}
}
