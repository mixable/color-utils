<?php
declare(strict_types=1);

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
     * @see http://zoltanb.co.uk/how-to-calculate-the-perceived-brightness-of-a-colour/
     *
     * @param string $hex color as hex string
     * @return string readable text color in hex format (#ffffff or #000000)
     */
    public static function readableTextColorForBackgroundColor(string $hex): string
    {
        $rgb = Convert::hex2rgb($hex);
        $brightness = Calculate::weightedW3C($rgb);
        return $brightness < 127 ? '#ffffff' : '#000000';
    }

    /**
     * Calculate a color that is readable on light and dark backgrounds by using the equivalent _HSL_ color value.
     * The color value is based on the given hex color
     * This will use the weighted W3C formula as described at:
     * @see https://mixable.blog/black-or-white-text-on-a-colour-background/
     *
     * A detailed description of the outputs of this calculation is available at:
     * @see https://mixable.blog/adjust-text-color-to-be-readable-on-light-and-dark-backgrounds-of-user-interfaces/
     *
     * @param string $hex base color as hex string
     * @return string adjusted color for light and dark backgrounds
     */
    public static function readableColorForLightAndDarkBackground(string $hex): string
    {
        $rgb = Convert::hex2rgb($hex);
        $hsl = Convert::rgb2hsl($rgb);

        $step = 0.01;
        $brightness = Calculate::weightedW3C($rgb);
        if ($brightness < 127) {
            while ($brightness < 127 && $hsl[2] >= 0 && $hsl[2] <= 255) {
                $hsl[2] += $step;
                $brightness = Calculate::weightedW3C(Convert::hsl2rgb($hsl));
            }
        } else {
            while ($brightness > 127 && $hsl[2] >= 0 && $hsl[2] <= 255) {
                $hsl[2] -= $step;
                $brightness = Calculate::weightedW3C(Convert::hsl2rgb($hsl));
            }
        }

        return Convert::rgb2hex(Convert::hsl2rgb($hsl));
    }

    /**
     * Calculate a color that is readable on light and dark backgrounds by using the equivalent _HSV_ color value.
     * The color value is based on the given hex color.
     * This will use the weighted W3C formula as described at:
     * @see https://mixable.blog/black-or-white-text-on-a-colour-background/
     *
     * A detailed description of the outputs of this calculation is available at:
     * @see https://mixable.blog/adjust-text-color-to-be-readable-on-light-and-dark-backgrounds-of-user-interfaces/
     *
     * @param string $hex base color as hex string
     * @return string adjusted color for light and dark backgrounds
     */
    public static function readableColorForLightAndDarkBackgroundHsv(string $hex): string
    {
        $rgb = Convert::hex2rgb($hex);
        $hsv = Convert::rgb2hsv($rgb);

        $step = 0.01;
        $brightness = Calculate::weightedW3C($rgb);
        if ($brightness < 127) {
            while ($brightness < 127 && $hsv[2] >= 0 && $hsv[2] <= 1) {
                $hsv[2] += $step;
                $brightness = Calculate::weightedW3C(Convert::hsv2rgb($hsv));
            }
        } else {
            while ($brightness > 127 && $hsv[2] >= 0 && $hsv[2] <= 1) {
                $hsv[2] -= $step;
                $brightness = Calculate::weightedW3C(Convert::hsv2rgb($hsv));
            }
        }

        return Convert::rgb2hex(Convert::hsv2rgb($hsv));
    }

    /**
     * Calculate brightness based on weighted W3C formula
     * @see https://mixable.blog/black-or-white-text-on-a-colour-background/
     *
     * @param array $rgb Color as rgb array [r, g, b]
     * @return float
     */
    private static function weightedW3C(array $rgb): float
    {
        return $rgb[0] * 0.299 + $rgb[1] * 0.587 + $rgb[2] * 0.114;
    }

    /**
     * Calculate brightness based on weighted distance in 3D RGB space
     * @see https://mixable.blog/black-or-white-text-on-a-colour-background/
     *
     * @param array $rgb Color as rgb array [r, g, b]
     * @return float
     */
    private static function weightedDistancein3D(array $rgb): float
    {
        return sqrt(pow($rgb[0], 2) * 0.241 + pow($rgb[1], 2) * 0.691 + pow($rgb[2], 2) * 0.068);
    }
}
