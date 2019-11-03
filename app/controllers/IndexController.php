<?php
namespace App\Controllers;

use Lib\Controller;

class IndexController extends Controller
{
	function get_index()
	{
        $this->vm->page_title = "Posts";

		return "index/index";
	}

    function get_about()
    {
        $this->vm->page_title = "About";

        return "index/about";
    }

    function get_sitemap()
    {
        $this->vm->page_title = "Site Map";

        return "index/sitemap";
    }

	function get_test()
	{
		return ['thing' => 3];
	}
}
