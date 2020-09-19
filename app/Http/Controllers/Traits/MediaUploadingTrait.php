<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait MediaUploadingTrait
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $entity = strtolower(str_replace("Controller", "", class_basename(static::class)));
        $date = date("Y-m-d");
        $folder = sprintf("%s/%s/", $entity, $date);

        $path = storage_path('app/public/' . $folder);

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');
        $name = sprintf("%s.%s", uniqid(), $file->getClientOriginalExtension());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'file_path'     => $folder . $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

}
