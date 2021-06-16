<?php

if (!function_exists('links_newlines_text')) {
    function links_newlines_text($text)
    {
        $text = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?%#=\-&_/]+!', "<a href=\"\\0\" target='_blank'>\\0</a>", $text);
        $text = preg_replace('/<(?!br\s*\/?)[^>]+>/', '', $text);

        return nl2br($text);
    }
}
