<?php
namespace Lib;

class ViewModel
{
    private $scripts;
    private $stylesheets;
    public $page_title;

    function __construct()
    {
        $this->scripts = [];
        $this->stylesheets = [];
        $this->page_title = "";
    }

	public function add_script($script_name): Self
	{
		$this->scripts[] = "/public/js/$script_name";
        return $this;
	}

	public function scripts()
	{
		foreach ($this->scripts as $script): ?>
			<script src="<?= $script ?>"></script>
		<?php endforeach;
		$this->scripts = [];
	}

	public function add_stylesheet($stylesheet): Self
	{
        $this->stylesheets[] = "/public/css/$stylesheet";
        return $this;
	}

	public function stylesheets()
	{
		foreach ($this->stylesheets as $stylesheet): ?>
			<link rel="stylesheet" href="<?= $stylesheet ?>" />
		<?php endforeach;
		$this->stylesheets = [];
	}

}
