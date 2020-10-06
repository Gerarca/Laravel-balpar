<?php

namespace App\Helpers;

use Intervention\Image\Constraint;
use Image;

class Resizer
{
    public static function resize($imagen)
    {
        $image_path = public_path() . "/storage/productos/{$imagen}";
        $thumb_path = public_path() . "/storage/productos/thumbs/{$imagen}";
        list($width, $height) = getimagesize($image_path);
        $size = max($width, $height);

        Image::canvas(220, 326)->insert(Image::make($image_path)->resize(220, 326, function (Constraint $constraint) {
            $constraint->aspectRatio();
        }), 'center')->save($thumb_path);

        if ($width !== $height) {
            Image::canvas($size, $size)->insert($image_path, 'center')->save($image_path);
        }
    }

    public static function resizeMarca($imagen)
    {
        $image_path = public_path() . "/uploads/{$imagen}";
        Image::make($image_path)
            ->resize(260, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path);

    }

    public static function resizeTrabajoCatalogo($imagen)
    {
        $image_path = public_path() . "/uploads/{$imagen}";

        Image::make($image_path)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path);
    }

}
