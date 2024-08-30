<?php
require "dotenv.php";

class ImageFeatures {
    public static function extractFeatures($imagePath) {
        $image = imagecreatefromjpeg($imagePath);
        if (!$image) {
            return false;
        }

        $size = getenv('DOWNSIZE') ?? 100;

        // Downsample the image
        $smallImage = imagecreatetruecolor($size, $size);
        imagecopyresampled($smallImage, $image, 0, 0, 0, 0, $size, $size, imagesx($image), imagesy($image));

        $features = [];
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $rgb = imagecolorat($smallImage, $x, $y);
                $gray = ($rgb >> 16) & 0xFF; // Simple grayscale conversion
                $features[] = $gray;
            }
        }

        imagedestroy($image);
        imagedestroy($smallImage);

        return $features;
    }
}