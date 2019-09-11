<?php
namespace Lib;

use Lib\View;

class RootView extends View
{
	public $body_view = NULL;
	public $page_title = "";

	private function body()
	{
		if (!is_null($this->body_view))
		{
			$this->body_view->render();
		}
	}

	function render()
	{ ?>
		<html>
			<head>
				<title><?= $this->page_title ?></title>
				<?php $this->stylesheets() ?>
			</head>
			<body>
				<?php $this->body() ?>
				<?php $this->scripts() ?>
			</body>
		</html>
	<?php
	}
}
