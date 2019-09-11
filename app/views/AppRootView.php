<?php
namespace App\Views;

use Lib\View;

class AppRootView extends View
{
	function render()
	{ ?>
		<div class="app">
			<?php reset($this->children)->render() ?>
		</div>
	<?php
	}
}
