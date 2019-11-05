<?php
namespace Lib;

/**
 * HTTP status code in exception form. Can be thrown in a controller to show
 * a particular status page (e.g. 404, 500, etc.)
 */
class HttpException extends \Exception
{
	public $code;

	function __construct(int $code)
	{
		$this->code = $code;
	}
}
