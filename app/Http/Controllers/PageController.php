<?php

namespace App\Http\Controllers;

use App\Markdown\MarkdownConverter;

class PageController extends Controller
{
    public function __invoke($url)
    {
        abort_unless($page = app('navigation')->getPage($url), 404);

        $originUrl = "https://guidelines.spatie.be/" . $url;

        return view('page', [
            'title' => $page->title,
            'editUrl' => $page->edit_url,
            'contents' => MarkdownConverter::convert($page->contents),
            'originUrl' => $originUrl,
        ]);
    }
}
