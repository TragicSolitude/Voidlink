<?php
namespace App\Controllers;

use Lib\Controller;
use App\Views\IndexView;

class IndexController extends Controller
{
	function __construct()
	{

	}

	function get_index()
	{
		return new IndexView();
	}

	function get_test()
	{
		return ['thing' => 3];
	}
}
