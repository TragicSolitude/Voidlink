<?php
namespace App\Controllers;

use Lib\Controller;

class IndexController extends Controller
{
	function get_index()
	{
        $this->vm->page_title = "Voidlink";
        $this->vm->add_script("test.js");
        $this->vm->test = $this->config->thing;

		return "index/index";
	}

	function get_test()
	{
		return ['thing' => 3];
	}
}
