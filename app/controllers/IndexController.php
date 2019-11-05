<?php
namespace App\Controllers;

use App\Dao\PostDao;
use App\Dto\PostListDto;
use Lib\Controller;

class IndexController extends Controller
{
    /**
     * Formats a date into a string relative to now (e.g. "2d ago"). Only works
     * for past dates.
     *
     * Source: https://stackoverflow.com/a/2690541
     */
    private function relative_past_time($ts): string
    {
        if (!ctype_digit($ts))
        {
            $ts = strtotime($ts);
        }

        $diff = time() - $ts;
        $day_diff = floor($diff / 86400);
        if ($day_diff < 1)
        {
            if ($diff < 60) return "Just now";
            if ($diff < 3600) return floor($diff / 60)."m ago";
            if ($diff < 86400) return floor($diff / 3600)."h ago";
        }
        if ($day_diff < 7) return $day_diff."d ago";
        if ($day_diff < 31) return ceil($day_diff / 7)."w ago";
        return date("F Y", $ts);
    }

    /**
     * GET / or /index/index
     */
	function get_index()
	{
        $query = new PostListDto();
        $offset = $query->page * $query->count;
        $posts = PostDao::get_posts($query->count, $offset);

        foreach ($posts as &$post)
        {
            $post->relative_time = $this->relative_past_time($post->created);
        }

        $this->vm->page_title = "Posts";
        $this->vm->posts = $posts;

		return "index/index";
	}

    /**
     * GET /about
     */
    function get_about()
    {
        $this->vm->page_title = "About";

        return "index/about";
    }

    /**
     * GET /sitemap
     */
    function get_sitemap()
    {
        $this->vm->page_title = "Site Map";

        return "index/sitemap";
    }
}
