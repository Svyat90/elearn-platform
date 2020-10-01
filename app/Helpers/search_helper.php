<?php

if (!function_exists('wrapQueryString')) {
    /**
     * @param string $query
     * @param string $str
     * @return string
     */
    function wrapQueryString(string $query, string $str) : string
    {
        return str_ireplace($query, '<b>' . $query . '</b>', $str);
    }
}
