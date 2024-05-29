<?php

if (!function_exists('truncateText')) {
    function truncateText($text, $limit = 100)
    {
        $text = strip_tags($text);
        $text = html_entity_decode($text);

        if (strlen($text) <= $limit) {
            return $text;
        }
        
        return substr($text, 0, $limit) . '...';
    }
}

?>