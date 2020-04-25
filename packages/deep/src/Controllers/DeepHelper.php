<?php

namespace Deep\Controllers;

class DeepHelper
{
    public static function formatStyle($content)
    {
        $arrReplace = [
            '[c]' => '<div class="block-chinese">',
            '[/c]' => '</div>'
        ];
        foreach ($arrReplace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }
        return $content;
    }
}
