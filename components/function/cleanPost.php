<?php

// preg_replace('/\s+/', ' ', $content);
// To add later: replace multiple spaces with a single space.
// Might be a problem for text areas because it removes tabs, spaces, and line breaks.

function cleanPostValue(array $post): array
{
    foreach ($post as $key => $value) {
        $post[$key] =  trim(strip_tags($value));
    }
    return $post;
}
