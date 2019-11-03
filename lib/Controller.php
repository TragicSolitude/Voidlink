<?php
namespace Lib;

use Lib\ViewModel;
use Lib\Auth;

class Controller
{
	protected $config;
    protected $vm;
    protected $auth;
    protected $errors;

    function __construct(object $config, ViewModel $vm, Auth $auth) {
        session_start();

        $this->config = $config;
        $this->vm = $vm;
        $this->auth = $auth;
        $this->errors = $_SESSION['errors'] ?: [];
    }

	function handle(string $action)
	{
		if (!method_exists($this, $action))
		{
			throw new HttpException(404);
		}

		$response = $this->$action();

        if (count($this->errors) > 0)
        {
            if (!isset($_SESSION['errors']))
            {
                $_SESSION['errors'] = [];
            }

            $_SESSION['errors'] = array_merge(
                $_SESSION['errors'],
                $this->errors
            );
        }

		return $response;
	}

    function shutdown()
    {
        // Cleanup session
        if (session_status() === PHP_SESSION_ACTIVE)
        {
            unset($_SESSION['errors']);
            unset($_SESSION['form']);
        }
    }
}
