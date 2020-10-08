<?php

if (!function_exists('wrapQueryString')) {
    /**
     * @param string $query
     * @param string|null $str
     * @return string
     */
    function wrapQueryString(string $query, ? string $str) : string
    {
        if ( ! $str)
            return "";

        return str_ireplace($query, '<b>' . $query . '</b>', $str);
    }
}
