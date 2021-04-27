<?php
declare(strict_types=1);

namespace Mixable\Test\TestCase\Color;

use Mixable\Color\Convert;

/**
 * Class ConvertTest
 *
 * @package Mixable\Test\TestCase\Color
 */
class ConvertTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Hex to RGB
     */
    public function testColorHex2rgb()
    {
        $result = Convert::hex2rgb('#ffffff');
        $expected = [255, 255, 255];
        $this->assertEquals($expected, $result);

        $result = Convert::hex2rgb('#fff');
        $expected = [15, 15, 15];
        $this->assertEquals($expected, $result);

        $result = Convert::hex2rgb('#777777');
        $expected = [119, 119, 119];
        $this->assertEquals($expected, $result);

        $result = Convert::hex2rgb('#777');
        $expected = [7, 7, 7];
        $this->assertEquals($expected, $result);

        $result = Convert::hex2rgb('#000000');
        $expected = [0, 0, 0];
        $this->assertEquals($expected, $result);

        $result = Convert::hex2rgb('#000');
        $expected = [0, 0, 0];
        $this->assertEquals($expected, $result);
    }

    /**
     * RGB to Hex
     */
    public function testColorRgb2hex()
    {
        $result = Convert::rgb2hex([255, 255, 255]);
        $expected = 'ffffff';
        $this->assertEquals($expected, $result);

        $result = Convert::rgb2hex([119, 119, 119]);
        $expected = '777777';
        $this->assertEquals($expected, $result);

        $result = Convert::rgb2hex([0, 0, 0]);
        $expected = '000000';
        $this->assertEquals($expected, $result);
    }

    /**
     * CMYK to RGB
     */
    public function testColorCmyk2rgb()
    {
        $result = Convert::cmyk2rgb([255, 255, 255, 0]);
        $expected = [0, 0, 0];
        $this->assertEquals($expected, $result);

        $result = Convert::cmyk2rgb([128, 128, 128, 128]);
        $expected = [63, 63, 63];
        $this->assertEquals($expected, $result);

        $result = Convert::cmyk2rgb([0, 0, 0, 255]);
        $expected = [0, 0, 0];
        $this->assertEquals($expected, $result);
    }
}