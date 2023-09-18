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
        $this->assertEquals([255, 255, 255], $result);

        $result = Convert::hex2rgb('#fff');
        $this->assertEquals([255, 255, 255], $result);

        $result = Convert::hex2rgb('#777777');
        $this->assertEquals([119, 119, 119], $result);

        $result = Convert::hex2rgb('#777');
        $this->assertEquals([119, 119, 119], $result);

        $result = Convert::hex2rgb('#000000');
        $this->assertEquals([0, 0, 0], $result);

        $result = Convert::hex2rgb('#000');
        $this->assertEquals([0, 0, 0], $result);
    }

    /**
     * RGB to Hex
     */
    public function testColorRgb2hex()
    {
        $result = Convert::rgb2hex([255, 255, 255]);
        $this->assertEquals('ffffff', $result);

        $result = Convert::rgb2hex([119, 119, 119]);
        $this->assertEquals('777777', $result);

        $result = Convert::rgb2hex([0, 0, 0]);
        $this->assertEquals('000000', $result);
    }

    /**
     * CMYK to RGB
     */
    public function testColorCmyk2rgb()
    {
        $result = Convert::cmyk2rgb([255, 255, 255, 0]);
        $this->assertEquals([0, 0, 0], $result);

        $result = Convert::cmyk2rgb([128, 128, 128, 128]);
        $this->assertEquals([63, 63, 63], $result);

        $result = Convert::cmyk2rgb([0, 0, 0, 255]);
        $this->assertEquals([0, 0, 0], $result);
    }
}