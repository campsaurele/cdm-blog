<?php

// return bool to check if post required fields are not empty.
// take required array as params so if fields is not required and can be null, it's not checked. $required is defin in switch.

function validatePost(array $post, array $required): bool
{
    foreach ($required as $field) {
        if (!isset($post[$field]) || $post[$field] === '') {
            return false;
        }
    }
    return true;
}
