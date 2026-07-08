<?php

function validatePost(array $post, array $required): bool
{
    foreach ($required as $field) {
        if (!isset($post[$field]) || $post[$field] === '') {
            return false;
        }
    }
    return true;
}
