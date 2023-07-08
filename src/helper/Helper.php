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
        $data = Helper::formatData($data);
        
        foreach($data as $key => $value)
        {
            $template = str_replace('{'.$key.'}', $value ?? '', $template);
        }
    }

    public static function formatData(array $data):array
    {
        $result = [];
        
        foreach($data as $key => $value)
        {
            if(gettype($data[$key]) == "array")
            {
                foreach($data[$key] as $key2 => $value2)
                {
                    if(gettype($data[$key][$key2]) == "array")
                    {
                        foreach($data[$key][$key2] as $key3 => $value3)
                        {
                            if(gettype($data[$key][$key2][$key3]) == "array")
                            {
                                foreach($data[$key][$key2][$key3] as $key4 => $value4)
                                {
                                    if(gettype($data[$key][$key2][$key3][$key4]) == "array")
                                    {
                                        foreach($data[$key][$key2][$key3][$key4] as $key5 => $value5)
                                        {
                                            if(gettype($data[$key][$key2][$key3][$key4][$key5]) == "array")
                                            {
                                                foreach($data[$key][$key2][$key3][$key4][$key5] as $key6 => $value6)
                                                {                                            
                                                    if(gettype($data[$key][$key2][$key3][$key4][$key5][$key6]) != "array")
                                                    {
                                                        $result[$key.'~'.$key2.'~'.$key3.'~'.$key4.'~'.$key5.'~'.$key6] = $value6;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $result[$key.'~'.$key2.'~'.$key3.'~'.$key4.'~'.$key5] = $value5;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $result[$key.'~'.$key2.'~'.$key3.'~'.$key4] = $value4;
                                    }
                                }
                            }
                            else
                            {
                                $result[$key.'~'.$key2.'~'.$key3] = $value3;
                            }
                        }
                    }
                    else
                    {
                        $result[$key.'~'.$key2] = $value2;
                    }
                }
            }
            else
            {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
