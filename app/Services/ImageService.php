<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Mockery\Exception;

class ImageService
{
    const IMAGE_TYPE_COURSE = 'course';
    const IMAGE_TYPE_DOCUMENT = 'document';

    /**
     * @var array|string[]
     */
    private array $allowTypes = [
        self::IMAGE_TYPE_COURSE,
        self::IMAGE_TYPE_DOCUMENT
    ];

    /**
     * @var array|int[][]
     */
    private array $documentSizes = [
        'small'     => ['width' => 50, 'height' => 50],
        'medium'    => ['width' => 250, 'height' => 353],
        'large'     => ['width' => 320, 'height' => 452],
    ];

    /**
     * @var array|int[][]
     */
    private array $courseSizes = [
        'small'     => ['width' => 50, 'height' => 50],
        'medium'    => ['width' => 330, 'height' => 220],
        'large'     => ['width' => 338, 'height' => 266],
    ];

    /**
     * @var ImageManager
     */
    private ImageManager $manager;

    /**
     * ImageService constructor.
     * @param ImageManager $manager
     */
    public function __construct(ImageManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $type
     * @param string $path
     */
    public function saveThumbs(string $type, string $path) : void
    {
        if ( ! in_array($type, $this->allowTypes)) {
            throw new Exception('Invalid type for saveThumbs');
        }

        $sizes = $this->getSizes($type);

        foreach ($sizes as $type => $size) {
            $thumbPath = $this->getThumbPath($type, $path);

            $this->manager
                ->make('storage/' . $path)
                ->fit($size['width'], $size['height'])
                ->save($thumbPath);
        }
    }

    /**
     * @param string $path
     */
    public function deleteThumbs(string $path) : void
    {
        $types = ['small', 'medium', 'large'];

        [$path, $exp] = explode(".", $path);
        foreach ($types as $type) {
            $thumbPath = sprintf('%s-%s.%s', $path, $type, $exp);

            File::delete(fileStoragePath($thumbPath));
        }
    }

    /**
     * @param string $type
     * @return array|int[][]
     */
    private function getSizes(string $type) : array
    {
        switch ($type) {
            case self::IMAGE_TYPE_DOCUMENT:
                return $this->documentSizes;
            case self::IMAGE_TYPE_COURSE:
                return $this->courseSizes;
            default:
                return [];
        }
    }

    /**
     * @param string $type
     * @param string $basePath
     * @return string
     */
    private function getThumbPath(string $type, string $basePath)
    {
        [$path, $exp] = explode(".", $basePath);

        return sprintf('storage/%s-%s.%s', $path, $type, $exp);
    }

}
