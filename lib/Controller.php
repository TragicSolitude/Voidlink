<?php
namespace Lib;

use Lib\ViewModel;

class Controller
{
	protected $config;
    protected $vm;

    function __construct(object $config, ViewModel $vm) {
        $this->config = $config;
        $this->vm = $vm;
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
