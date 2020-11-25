<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Collection;

class TranslationService
{
    /**
     * @param string $folder
     * @return Collection
     */
    public function getFilesWithContent(string $folder) : Collection
    {
        return collect($this->getFolderFiles($folder))
            ->map(function (SplFileInfo $file) {
                return (object) [
                    'name' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'content' => include($file->getPathname())
                ];
            });
    }

    /**
     * @return Collection
     */
    public function getLanguages() : Collection
    {
        $directories = $this->getDirectories();

        return collect($directories)->map(function ($path) {
            return $this->fillLang($path);
        });
    }

    /**
     * @param string $path
     * @return \stdClass
     */
    private function fillLang(string $path) : \stdClass
    {
        $lang = new \stdClass();
        $lang->name = collect(explode(DIRECTORY_SEPARATOR, $path))->last();
        $lang->path = $path;

        return $lang;
    }

    /**
     * @param string $folder
     * @return SplFileInfo[]
     */
    public function getFolderFiles(string $folder)
    {
        return File::files($folder);
    }

    /**
     * @return array
     */
    public function getDirectories() : array
    {
        return File::directories(base_path('resources/lang'));
    }

}
