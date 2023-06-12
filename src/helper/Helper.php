<?php

namespace Helper;

use Spipu\Html2Pdf\Html2Pdf;

class Helper
{
    public static function generateSlug($text):string
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function applyDataToTemplate(&$template, $data):void
    {
        foreach($data as $key =>$value)
        {
            $template = str_replace('{'.$key.'}', $value, $template);
        }
    }
}
