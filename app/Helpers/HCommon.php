<?php

namespace App\Helpers;

class HCommon
{
    /**
     * Random a hex color
     *
     * @return string
     */
    public function randomHexColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
