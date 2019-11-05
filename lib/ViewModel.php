<?php
namespace Lib;

/**
 * Intermediate object for data passed from the controller to the view
 */
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

    /**
     * Add a script that will be loaded on this view
     */
	public function add_script($script_name): Self
	{
		$this->scripts[] = "/public/js/$script_name";
        return $this;
	}

    /**
     * Print the script tags for all scripts on this view
     */
	public function scripts()
	{
		foreach ($this->scripts as $script): ?>
			<script src="<?= $script ?>"></script>
		<?php endforeach;
		$this->scripts = [];
	}

    /**
     * Add a stylesheet that will be loaded on this view
     */
	public function add_stylesheet($stylesheet): Self
	{
        $this->stylesheets[] = "/public/css/$stylesheet";
        return $this;
	}

    /**
     * Print the stylesheet tags for all stylesheets on this view
     */
	public function stylesheets()
	{
		foreach ($this->stylesheets as $stylesheet): ?>
			<link rel="stylesheet" href="<?= $stylesheet ?>" />
		<?php endforeach;
		$this->stylesheets = [];
	}

}
