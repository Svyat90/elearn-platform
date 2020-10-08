<?php

namespace App\Helpers;

use Mockery\Exception;

class DocxConversion
{
    /**
     * @var string
     */
    private string $filename;

    /**
     * DocxConversion constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filename = $filePath;
    }

    /**
     * @return string
     */
    private function readDocx() : string
    {
        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip))
            return false;

        while ($zip_entry = zip_read($zip)) {
            if (zip_entry_open($zip, $zip_entry) == false)
                continue;

            if (zip_entry_name($zip_entry) != "word/document.xml")
                continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content ?? "";
    }

    /**
     * @return string
     */
    public function convertToText() : string
    {
        if (isset($this->filename) && ! file_exists($this->filename)) {
            throw new Exception("File Not exists");
        }

        $fileData = pathinfo($this->filename);
        $fileExt = $fileData['extension'];
        if ($fileExt === "docx") {
            return $this->readDocx();

        }

        return "";
    }

}
