<?php
namespace Lib;

class HttpException extends \Exception
{
	public $code;

	function __construct(int $code)
	{
		$this->code = $code;
	}
}
