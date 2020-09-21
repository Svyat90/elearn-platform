<?php

if (!function_exists('labelAccess')) {

    /**
     * @param string $accessType
     * @return string
     */
    function labelAccess(string $accessType) : string
    {
        switch ($accessType) {
            case 'private':
                return sprintf('<span class="badge badge-danger">%s</span>', 'private');
            case 'protected':
                return sprintf('<span class="badge badge-warning">%s</span>', 'protected');
            case 'public':
                return sprintf('<span class="badge badge-success">%s</span>', 'public');
            default:
                return sprintf('<span class="badge badge-dark">%s</span>', $accessType);
        }
    }
}

if (!function_exists('labelDocumentStatus')) {

    /**
     * @param string $status
     * @return string
     */
    function labelDocumentStatus(string $status) : string
    {
        switch ($status) {
            case 'initial':
                return sprintf('<span class="badge badge-info">%s</span>', 'initial');
            case 'updated':
                return sprintf('<span class="badge badge-warning">%s</span>', 'updated');
            case 'canceled':
                return sprintf('<span class="badge badge-danger">%s</span>', 'canceled');
            default:
                return sprintf('<span class="badge badge-dark">%s</span>', $status);
        }
    }
}
