<?php
namespace Mixable\Color;

/**
 * Class Calculate
 *
 * @package Mixable\Color
 */
class Calculate
{
    /**
     * Calculate weather to use black or white text for given background color.
     * Based on 'Weighted W3C Formula' algorithm
     * http://zoltanb.co.uk/how-to-calculate-the-perceived-brightness-of-a-colour/
     *
     * @param string $hexColor Color as hex string
     * @return string readable text color in hex format (#ffffff or #000000)
     */
    public static function readableTextColorForBackgroundColor(string $hexColor): string
    {
        $c = Convert::hex2rgb($hexColor);
        $brightness = (($c[0] * 299) + ($c[0] * 587) + ($c[0] * 114)) / 1000;

        return $brightness < 127 ? '#ffffff' : '#000000';
    }
}