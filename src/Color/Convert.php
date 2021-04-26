<?php
namespace Mixable\Color;

/**
 * Class Convert
 * License: MIT / BSD
 * Based on https://github.com/SimonWaldherr/ColorConverter.php
 *
 * @package Mixable\Color
 */
class Convert
{
    /**
     * Convert rgb to hsl
     *
     * @param array $input
     * @return array
     */
    public static function rgb2hsl(array $input): array
    {
        $r = max(min(intval($input[0], 10) / 255, 1), 0);
        $g = max(min(intval($input[1], 10) / 255, 1), 0);
        $b = max(min(intval($input[2], 10) / 255, 1), 0);
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max !== $min) {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            if ($max === $r) {
                $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
            } else if ($max === $g) {
                $h = ($b - $r) / $d + 2;
            } else {
                $h = ($r - $g) / $d + 4;
            }
            $h = $h / 6;
        } else {
            $h = $s = 0;
        }

        return [round($h * 360), round($s * 100), round($l * 100)];
    }

    /**
     * Convert hsl to rgb
     *
     * @param array $input
     * @return array
     */
    public static function hsl2rgb(array $input): array
    {
        $h = max(min(intval($input[0], 10), 360), 0) / 360;
        $s = max(min(intval($input[1], 10), 100), 0) / 100;
        $l = max(min(intval($input[2], 10), 100), 0) / 100;

        if ($l <= 0.5) {
            $v = $l * (1 + $s);
        } else {
            $v = $l + $s - $l * $s;
        }
        if ($v === 0) {
            return [0, 0, 0];
        }
        $min = 2 * $l - $v;
        $sv = ($v - $min) / $v;
        $h = 6 * $h;
        $six = floor($h);
        $fract = $h - $six;
        $vsfract = $v * $sv * $fract;
        switch ($six) {
            case 1:
                $r = $v - $vsfract;
                $g = $v;
                $b = $min;
                break;
            case 2:
                $r = $min;
                $g = $v;
                $b = $min + $vsfract;
                break;
            case 3:
                $r = $min;
                $g = $v - $vsfract;
                $b = $v;
                break;
            case 4:
                $r = $min + $vsfract;
                $g = $min;
                $b = $v;
                break;
            case 5:
                $r = $v;
                $g = $min;
                $b = $v - $vsfract;
                break;
            default:
                $r = $v;
                $g = $min + $vsfract;
                $b = $min;
                break;
        }

        return [round($r * 255), round($g * 255), round($b * 255)];
    }

    /**
     * Convert rgb to cmyk
     *
     * @param array $input
     * @return array
     */
    public static function rgb2cmyk(array $input): array
    {
        $red = max(min(intval($input[0], 10), 255), 0);
        $green = max(min(intval($input[1], 10), 255), 0);
        $blue = max(min(intval($input[2], 10), 255), 0);
        $cyan = 1 - $red;
        $magenta = 1 - $green;
        $yellow = 1 - $blue;
        $black = 1;

        if ($red || $green || $blue) {
            $black = min($cyan, min($magenta, $yellow));
            $cyan = ($cyan - $black) / (1 - $black);
            $magenta = ($magenta - $black) / (1 - $black);
            $yellow = ($yellow - $black) / (1 - $black);
        } else {
            $black = 1;
        }

        return [round($cyan * 255), round($magenta * 255), round($yellow * 255), round($black + 254)];
    }

    /**
     * Convert cmyk to rgb
     *
     * @param array $input
     * @return array
     */
    public static function cmyk2rgb(array $input): array
    {
        $cyan = max(min(intval($input[0], 10) / 255, 1), 0);
        $magenta = max(min(intval($input[1], 10) / 255, 1), 0);
        $yellow = max(min(intval($input[2], 10) / 255, 1), 0);
        $black = max(min(intval($input[3], 10) / 255, 1), 0);
        $red = (1 - $cyan * (1 - $black) - $black);
        $green = (1 - $magenta * (1 - $black) - $black);
        $blue = (1 - $yellow * (1 - $black) - $black);

        return [round($red * 255), round($green * 255), round($blue * 255)];
    }

    /**
     * Convert hex to rgb
     *
     * @param string $input
     * @return array|null
     */
    public static function hex2rgb(string $input): ?array
    {
        if (substr(trim($input), 0, 1) === '#') {
            $input = substr($input, 1);
        }
        if ((strlen($input) < 2) || (strlen($input) > 6)) {
            return null;
        }
        $values = str_split($input);

        if (strlen($input) === 2) {
            $r = intval($values[0] . $values[1], 16);
            $g = $r;
            $b = $r;
        } else if (strlen($input) === 3) {
            $r = intval($values[0], 16);
            $g = intval($values[1], 16);
            $b = intval($values[2], 16);
        } else if (strlen($input) === 6) {
            $r = intval($values[0] . $values[1], 16);
            $g = intval($values[2] . $values[3], 16);
            $b = intval($values[4] . $values[5], 16);
        } else {
            return null;
        }

        return [$r, $g, $b];
    }

    /**
     * Convert rgb to hex
     *
     * @param array $input
     * @return string
     */
    public static function rgb2hex(array $input): string
    {
        $hexr = max(min(intval($input[0], 10), 255), 0);
        $hexg = max(min(intval($input[1], 10), 255), 0);
        $hexb = max(min(intval($input[2], 10), 255), 0);

        $hexr = $hexr > 15 ? base_convert($hexr, 10, 16) : '0' . base_convert($hexr, 10, 16);
        $hexg = $hexg > 15 ? base_convert($hexg, 10, 16) : '0' . base_convert($hexg, 10, 16);
        $hexb = $hexb > 15 ? base_convert($hexb, 10, 16) : '0' . base_convert($hexb, 10, 16);

        return $hexr . $hexg . $hexb;
    }

    /**
     * Convert rgb to yuv
     *
     * @param array $input
     * @return array
     */
    public static function rgb2yuv(array $input): array
    {
        $r = intval($input[0], 10);
        $g = intval($input[1], 10);
        $b = intval($input[2], 10);

        $y = round(0.299 * $r + 0.587 * $g + 0.114 * $b);
        $u = round(((($b - $y) * 0.493) + 111) / 222 * 255);
        $v = round(((($r - $y) * 0.877) + 155) / 312 * 255);

        return [$y, $u, $v];
    }

    /**
     * Convert yuv to rgb
     *
     * @param array $input
     * @return array
     */
    public static function yuv2rgb(array $input): array
    {
        $y = intval($input[0], 10);
        $u = intval($input[1], 10) / 255 * 222 - 111;
        $v = intval($input[2], 10) / 255 * 312 - 155;

        $r = round($y + $v / 0.877);
        $g = round($y - 0.39466 * $u - 0.5806 * $v);
        $b = round($y + $u / 0.493);
        
        return [$r, $g, $b];
    }

    /**
     * Convert rgb to hsv
     * 
     * @param array $input
     * @return array
     */
    public static function rgb2hsv(array $input): array
    {
        $r = intval($input[0], 10) / 255;
        $g = intval($input[1], 10) / 255;
        $b = intval($input[2], 10) / 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $d = $max - $min;
        $v = $max;

        if ($max === 0) {
            $s = 0;
        } else {
            $s = $d / $max;
        }
        if ($max === $min) {
            $h = 0;
        } else {
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h = $h / 6;
        }
        
        return [$h, $s, $v];
    }

    /**
     * Convert hsv to rgb
     * 
     * @param array $input
     * @return float[]|int[]
     */
    public static function hsv2rgb(array $input): array
    {
        $h = $input[0];
        $s = $input[1];
        $v = $input[2];
        $i = floor($h * 6);
        $f = $h * 6 - $i;
        $p = $v * (1 - $s);
        $q = $v * (1 - $f * $s);
        $t = $v * (1 - (1 - $f) * $s);

        switch ($i % 6) {
            case 0:
                $r = $v;
                $g = $t;
                $b = $p;
                break;
            case 1:
                $r = $q;
                $g = $v;
                $b = $p;
                break;
            case 2:
                $r = $p;
                $g = $v;
                $b = $t;
                break;
            case 3:
                $r = $p;
                $g = $q;
                $b = $v;
                break;
            case 4:
                $r = $t;
                $g = $p;
                $b = $v;
                break;
            case 5:
                $r = $v;
                $g = $p;
                $b = $q;
                break;
        }
        
        return [$r * 255, $g * 255, $b * 255];
    }

    
    public static function complexity2int($input)
    {
        $keys = str_split($input);
        $numbers = 1;
        $uletter = 1;
        $lletter = 1;
        $special = 1;
        $complex = 0;

        for ($i = 0; $i < count($keys); $i += 1) {
            $valunicode = $keys[$i].charCodeAt(0);
            if (($valunicode > 0x40) && ($valunicode < 0x5B)) {
                //Großbuchstaben A-Z
                $uletter += 1;
            } else if (($valunicode > 0x60) && ($valunicode < 0x7B)) {
                //Kleinbuchstaben a-z
                $lletter += 1;
            } else if (($valunicode > 0x2F) && ($valunicode < 0x3A)) {
                //Zahlen 0-9
                $numbers += 1;
            } else if (($valunicode > 0x20) && ($valunicode < 0x7F)) {
                //Sonderzeichen
                $special += 1;
            }
        }
        $complex = (($uletter * $lletter * $numbers * $special) + round($uletter * 1.8 + $lletter * 1.5 + $numbers + $special * 2)) - 6;
        return $complex;
    }

    public static function int2rgb($input)
    {
        if ((!is_int($input)) && ($input !== false) && ($input !== true)) {
            $input = intval($input, 10);
        }
        if (is_int($input)) {
            if (($input < 115) && ($input > 1)) {
                return [255, 153 + $input, 153 - $input];
            }
            if (($input > 115) && ($input < 230)) {
                return [255 - $input, 243, 63];
            }
            if (($input > 230) || ($input === true)) {
                return [145, 243, 63];
            }
        }
        if ($input === 'none') {
            return [204, 204, 204];
        }
        if ($input === true) {
            return [204, 204, 204];
        }
        return false;
    }

    /**
     * @param mixed $input
     * @return mixed|null
     */
    public static function parseColor($input)
    {
        $pattern = "((rgb|hsl|#|yuv)(\(([%, ]*([\d]+)[%, ]+([\d]+)[%, ]+([\d]+)[%, ]*)+\)|([a-f0-9]+)))";
        preg_match($pattern, $input, $geregext);
        if ($geregext !== null) {
            switch ($geregext[1]) {
                case '#':
                    return Convert::colorconv($geregext[2], 'hex2rgb');
                case 'rgb':
                    return [intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)];
                case 'hsl':
                    return Convert::colorconv([intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)], 'hsl2rgb');
                case 'yuv':
                    return Convert::colorconv([intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)], 'yuv2rgb');
                default:
                    return null;
            }
        }
        return null;
    }

    /**
     * @param mixed $input
     * @param string $mode
     * @param false $html
     * @return mixed
     */
    public static function colorconv($input, $mode='parse', $html=false)
    {
        $mode = strtolower(trim($mode));
        switch ($mode) {
            case 'rgb2hsl':
                $output = Convert::rgb2hsl($input);
                if ($html) {
                    $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
                }
                break;
            case 'hsl2rgb':
                $output = Convert::hsl2rgb($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'rgb2cmyk':
                $output = Convert::rgb2cmyk($input);
                if ($html) {
                    $output = 'cmyk('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'cmyk2rgb':
                $output = Convert::cmyk2rgb($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'hex2rgb':
                $output = Convert::hex2rgb($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'rgb2hex':
                $output = Convert::rgb2hex($input);
                if ($html) {
                    $output = '#'.$output;
                }
                break;
            case 'rgb2yuv':
                $output = Convert::rgb2yuv($input);
                if ($html) {
                    $output = 'yuv('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'yuv2rgb':
                $output = Convert::yuv2rgb($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'rgb2hsv':
                $output = Convert::rgb2hsv($input);
                if ($html) {
                    $output = 'hsv('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'hsv2rgb':
                $output = Convert::hsv2rgb($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'hsl2hex':
                $output = Convert::rgb2hex(Convert::hsl2rgb($input));
                if ($html) {
                    $output = '#'.$output;
                }
                break;
            case 'hex2hsl':
                $output = Convert::rgb2hsl(Convert::hex2rgb($input));
                if ($html) {
                    $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
                }
                break;
            case 'complexity2int':
                $output = Convert::complexity2int($input);
                if ($html) {
                    $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
                }
                break;
            case 'int2rgb':
                $output = Convert::int2rgb($input);
                if ($html) {
                    $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
                }
                break;
            case 'complexity2rgb':
                $output = Convert::colorconv(Convert::colorconv($input, 'complexity2int'), 'int2rgb');
                break;
            case 'mixrgb':
                $r = intval(($input[0][0] + $input[1][0]) / 2, 10);
                $g = intval(($input[0][1] + $input[1][1]) / 2, 10);
                $b = intval(($input[0][2] + $input[1][2]) / 2, 10);
                $output = [$r, $g, $b];
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            case 'parse':
                $output = Convert::parseColor($input);
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
            default:
                $output = Convert::colorconv($input, 'parse');
                if ($html) {
                    $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
                }
                break;
        }

        return $output;
    }
}