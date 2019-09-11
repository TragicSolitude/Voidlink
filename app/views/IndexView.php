<?php
namespace App\Views;

use Lib\View;

class IndexView extends View
{
	public $thing;

	function __construct(string $thing)
	{
		$this->add_script("something.js");
		$this->add_stylesheet("style.css");
		$this->thing = $thing;
	}

	function render()
	{ ?>
		<p>Index</p>
		<p><?= $this->thing ?></p>
	<?php
	}
}
