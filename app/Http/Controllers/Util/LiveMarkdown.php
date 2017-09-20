<?php

namespace App\Http\Controllers\Util;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;

class LiveMarkdown
{
    public function toMarkdown(Request $request)
    {
        return Markdown::convertToHTML("TEST");
    }
}
