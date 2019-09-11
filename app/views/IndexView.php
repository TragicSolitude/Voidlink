<?php
namespace App\Views;

use Lib\View;

class IndexView extends View
{
	function __construct()
	{
		$this->add_script("something.js");
		$this->add_stylesheet("style.css");
	}

	function render()
	{ ?>
		<p>Index</p>
	<?php
	}
}
