<?php

use Ottosmops\Pdftotext\Extract;

if (!function_exists('getContentPdf')) {

    /**
     * @param string $path
     * @return string
     */
    function getContentPdf(string $path): string
    {
        try {
            return (new Extract())
                ->pdf($path)
                ->text() ?? "";

        } catch (\Throwable $e) {
            return "";
        }
    }

}
