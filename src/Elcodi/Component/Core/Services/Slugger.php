<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Core\Services;

/**
 * Class Slugger
 */
class Slugger
{
    /**
     * Create slug from string
     *
     * @param null|string $text
     *
     * @return string
     */
    public static function createSlugByText(?string $text) : string
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}