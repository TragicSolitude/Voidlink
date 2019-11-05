<?php
namespace Lib;

/**
 * Autoloads files based on a namespace => path mapping that can be extended
 * and configured.
 */
class Autoloader
{
	public static $namespaces = ["Lib" => "../lib"];

	function add_namespaces(array $map): Self
	{
        self::$namespaces = array_merge(self::$namespaces, $map);
        return $this;
	}

	static function autoload(string $class_name)
	{
		// Strip . out of class names to prevent navigating up tree
		$class_name = str_replace(".", "", $class_name);
		$parts = explode("\\", $class_name);
		$class = array_pop($parts);
		$class_ns = implode("\\", $parts);
		if (isset(self::$namespaces[$class_ns]))
		{
			require self::$namespaces[$class_ns]."/$class.php";
		}
	}
}

spl_autoload_register(['Lib\Autoloader', 'autoload']);
