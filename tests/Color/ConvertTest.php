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
     * RGB to HSL
     */
    public function testColorRgb2hsl()
    {
        $this->assertEquals([0, 0, 0], Convert::rgb2hsl([0, 0, 0]));
        $this->assertEquals([0, 0, 100], Convert::rgb2hsl([255, 255, 255]));
        $this->assertEquals([0, 100, 50], Convert::rgb2hsl([255, 0, 0]));
        $this->assertEquals([120, 100, 50], Convert::rgb2hsl([0, 255, 0]));
        $this->assertEquals([240, 100, 50], Convert::rgb2hsl([0, 0, 255]));
        $this->assertEquals([60, 100, 50], Convert::rgb2hsl([255, 255, 0]));
        $this->assertEquals([180, 100, 50], Convert::rgb2hsl([0, 255, 255]));
        $this->assertEquals([300, 100, 50], Convert::rgb2hsl([255, 0, 255]));
        $this->assertEquals([0, 0, 75], Convert::rgb2hsl([191, 191, 191]));
        $this->assertEquals([0, 0, 50], Convert::rgb2hsl([128, 128, 128]));
        $this->assertEquals([0, 100, 25], Convert::rgb2hsl([128, 0, 0]));
        $this->assertEquals([60, 100, 25], Convert::rgb2hsl([128, 128, 0]));
        $this->assertEquals([120, 100, 25], Convert::rgb2hsl([0, 128, 0]));
        $this->assertEquals([300, 100, 25], Convert::rgb2hsl([128, 0, 128]));
        $this->assertEquals([180, 100, 25], Convert::rgb2hsl([0, 128, 128]));
        $this->assertEquals([240, 100, 25], Convert::rgb2hsl([0, 0, 128]));
    }

    /**
     * HSL to RGB
     */
    public function testColorHsl2rgb()
    {
        $this->assertEquals([0, 0, 0], Convert::hsl2rgb([0, 0, 0]));
        $this->assertEquals([255, 255, 255], Convert::hsl2rgb([0, 0, 100]));
        $this->assertEquals([255, 0, 0], Convert::hsl2rgb([0, 100, 50]));
        $this->assertEquals([0, 255, 0], Convert::hsl2rgb([120, 100, 50]));
        $this->assertEquals([0, 0, 255], Convert::hsl2rgb([240, 100, 50]));
        $this->assertEquals([255, 255, 0], Convert::hsl2rgb([60, 100, 50]));
        $this->assertEquals([0, 255, 255], Convert::hsl2rgb([180, 100, 50]));
        $this->assertEquals([255, 0, 255], Convert::hsl2rgb([300, 100, 50]));
        $this->assertEquals([191, 191, 191], Convert::hsl2rgb([0, 0, 75]));
        $this->assertEquals([128, 128, 128], Convert::hsl2rgb([0, 0, 50]));
        $this->assertEquals([128, 0, 0], Convert::hsl2rgb([0, 100, 25]));
        $this->assertEquals([128, 128, 0], Convert::hsl2rgb([60, 100, 25]));
        $this->assertEquals([0, 128, 0], Convert::hsl2rgb([120, 100, 25]));
        $this->assertEquals([128, 0, 128], Convert::hsl2rgb([300, 100, 25]));
        $this->assertEquals([0, 128, 128], Convert::hsl2rgb([180, 100, 25]));
        $this->assertEquals([0, 0, 128], Convert::hsl2rgb([240, 100, 25]));
    }

    /**
     * RGB to CMYK
     */
    /*
    public function testColorRgb2cmyk()
    {
        $this->assertEquals([0.0, 0.0, 0.0, 100.0], Convert::rgb2cmyk([0, 0, 0]));
        $this->assertEquals([0.0, 0.0, 0.0, 0.0], Convert::rgb2cmyk([255, 255, 255]));
        $this->assertEquals([0.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([255, 0, 0]));
        $this->assertEquals([120.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([0, 255, 0]));
        $this->assertEquals([240.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([0, 0, 255]));
        $this->assertEquals([60.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([255, 255, 0]));
        $this->assertEquals([180.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([0, 255, 255]));
        $this->assertEquals([300.0, 100.0, 50.0, 0.0], Convert::rgb2cmyk([255, 0, 255]));
        $this->assertEquals([0.0, 0.0, 75.0, 0.0], Convert::rgb2cmyk([191, 191, 191]));
        $this->assertEquals([0.0, 0.0, 50.0, 0.0], Convert::rgb2cmyk([128, 128, 128]));
        $this->assertEquals([0.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([128, 0, 0]));
        $this->assertEquals([60.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([128, 128, 0]));
        $this->assertEquals([120.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([0, 128, 0]));
        $this->assertEquals([300.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([128, 0, 128]));
        $this->assertEquals([180.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([0, 128, 128]));
        $this->assertEquals([240.0, 100.0, 25.0, 0.0], Convert::rgb2cmyk([0, 0, 128]));
    }
    */

    /**
     * CMYK to RGB
     */
    public function testColorCmyk2rgb()
    {
        $this->assertEquals([0, 0, 0], Convert::cmyk2rgb([255, 255, 255, 0]));
        $this->assertEquals([63, 63, 63], Convert::cmyk2rgb([128, 128, 128, 128]));
        $this->assertEquals([0, 0, 0], Convert::cmyk2rgb([0, 0, 0, 255]));
    }

    /**
     * RGB to Hex
     */
    public function testColorRgb2hex()
    {
        $this->assertEquals('000000', Convert::rgb2hex([0, 0, 0]));
        $this->assertEquals('ffffff', Convert::rgb2hex([255, 255, 255]));
        $this->assertEquals('ff0000', Convert::rgb2hex([255, 0, 0]));
        $this->assertEquals('00ff00', Convert::rgb2hex([0, 255, 0]));
        $this->assertEquals('0000ff', Convert::rgb2hex([0, 0, 255]));
        $this->assertEquals('ffff00', Convert::rgb2hex([255, 255, 0]));
        $this->assertEquals('00ffff', Convert::rgb2hex([0, 255, 255]));
        $this->assertEquals('ff00ff', Convert::rgb2hex([255, 0 ,255]));
        $this->assertEquals('c0c0c0', Convert::rgb2hex([192, 192, 192]));
        $this->assertEquals('808080', Convert::rgb2hex([128, 128, 128]));
        $this->assertEquals('800000', Convert::rgb2hex([128, 0, 0]));
        $this->assertEquals('808000', Convert::rgb2hex([128, 128, 0]));
        $this->assertEquals('008000', Convert::rgb2hex([0, 128, 0]));
        $this->assertEquals('800080', Convert::rgb2hex([128, 0, 128]));
        $this->assertEquals('008080', Convert::rgb2hex([0, 128, 128]));
        $this->assertEquals('000080', Convert::rgb2hex([0, 0, 128]));
        $this->assertEquals('777777', Convert::rgb2hex([119, 119, 119]));
    }

    /**
     * Hex to RGB
     */
    public function testColorHex2rgb()
    {
        $this->assertEquals([0, 0, 0], Convert::hex2rgb('#000000'));
        $this->assertEquals([0, 0, 0], Convert::hex2rgb('#000'));
        $this->assertEquals([255, 255, 255], Convert::hex2rgb('#ffffff'));
        $this->assertEquals([255, 255, 255], Convert::hex2rgb('#fff'));
        $this->assertEquals([255, 0, 0], Convert::hex2rgb('#ff0000'));
        $this->assertEquals([0, 255, 0], Convert::hex2rgb('#00ff00'));
        $this->assertEquals([0, 0, 255], Convert::hex2rgb('#0000ff'));
        $this->assertEquals([255, 255, 0], Convert::hex2rgb('#ffff00'));
        $this->assertEquals([0, 255, 255], Convert::hex2rgb('#00ffff'));
        $this->assertEquals([255, 0 ,255], Convert::hex2rgb('#ff00ff'));
        $this->assertEquals([192, 192, 192], Convert::hex2rgb('#c0c0c0'));
        $this->assertEquals([128, 128, 128], Convert::hex2rgb('#808080'));
        $this->assertEquals([128, 0, 0], Convert::hex2rgb('#800000'));
        $this->assertEquals([128, 128, 0], Convert::hex2rgb('#808000'));
        $this->assertEquals([0, 128, 0], Convert::hex2rgb('#008000'));
        $this->assertEquals([128, 0, 128], Convert::hex2rgb('#800080'));
        $this->assertEquals([0, 128, 128], Convert::hex2rgb('#008080'));
        $this->assertEquals([0, 0, 128], Convert::hex2rgb('#000080'));
        $this->assertEquals([119, 119, 119], Convert::hex2rgb('#777777'));
        $this->assertEquals([119, 119, 119], Convert::hex2rgb('#777'));
    }

    /**
     * RGB to Hex
     */
    public function testColorRgb2hsv()
    {
        $this->assertEquals([0, 0, 0], Convert::rgb2hsv([0, 0, 0]));
        $this->assertEquals([0, 0, 1], Convert::rgb2hsv([255, 255, 255]));
        $this->assertEquals([0, 1, 1], Convert::rgb2hsv([255, 0, 0]));
        $this->assertEquals([120/360, 1, 1], Convert::rgb2hsv([0, 255, 0]));
        $this->assertEquals([240/360, 1, 1], Convert::rgb2hsv([0, 0, 255]));
        $this->assertEquals([60/360, 1, 1], Convert::rgb2hsv([255, 255, 0]));
        $this->assertEquals([180/360, 1, 1], Convert::rgb2hsv([0, 255, 255]));
        $this->assertEquals([300/360, 1, 1], Convert::rgb2hsv([255, 0 ,255]));
        $this->assertEqualsWithDelta([0, 0, 0.75], Convert::rgb2hsv([191, 191, 191]), 0.01);
        $this->assertEqualsWithDelta([0, 0, 0.5], Convert::rgb2hsv([128, 128, 128]), 0.01);
        $this->assertEqualsWithDelta([0, 1, 0.5], Convert::rgb2hsv([128, 0, 0]), 0.01);
        $this->assertEqualsWithDelta([60/360, 1, 0.5], Convert::rgb2hsv([128, 128, 0]), 0.01);
        $this->assertEqualsWithDelta([120/360, 1, 0.5], Convert::rgb2hsv([0, 128, 0]), 0.01);
        $this->assertEqualsWithDelta([300/360, 1, 0.5], Convert::rgb2hsv([128, 0, 128]), 0.01);
        $this->assertEqualsWithDelta([180/360, 1, 0.5], Convert::rgb2hsv([0, 128, 128]), 0.01);
        $this->assertEqualsWithDelta([240/360, 1, 0.5], Convert::rgb2hsv([0, 0, 128]), 0.01);
        $this->assertEqualsWithDelta([0, 0, 0.467], Convert::rgb2hsv([119, 119, 119]), 0.01);
    }

    /**
     * Hex to RGB
     */
    public function testColorHsv2rgb()
    {
        $this->assertEquals([0, 0, 0], Convert::hsv2rgb([0, 0, 0]));
        $this->assertEquals([255, 255, 255], Convert::hsv2rgb([0, 0, 1]));
        $this->assertEquals([255, 0, 0], Convert::hsv2rgb([0, 1, 1]));
        $this->assertEquals([0, 255, 0], Convert::hsv2rgb([120/360, 1, 1]));
        $this->assertEquals([0, 0, 255], Convert::hsv2rgb([240/360, 1, 1]));
        $this->assertEquals([255, 255, 0], Convert::hsv2rgb([60/360, 1, 1]));
        $this->assertEquals([0, 255, 255], Convert::hsv2rgb([180/360, 1, 1]));
        $this->assertEquals([255, 0 ,255], Convert::hsv2rgb([300/360, 1, 1]));
        $this->assertEqualsWithDelta([191, 191, 191], Convert::hsv2rgb([0, 0, 0.75]), 1);
        $this->assertEqualsWithDelta([128, 128, 128], Convert::hsv2rgb([0, 0, 0.5]), 1);
        $this->assertEqualsWithDelta([128, 0, 0], Convert::hsv2rgb([0, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([128, 128, 0], Convert::hsv2rgb([60/360, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([0, 128, 0], Convert::hsv2rgb([120/360, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([128, 0, 128], Convert::hsv2rgb([300/360, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([0, 128, 128], Convert::hsv2rgb([180/360, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([0, 0, 128], Convert::hsv2rgb([240/360, 1, 0.5]), 1);
        $this->assertEqualsWithDelta([119, 119, 119], Convert::hsv2rgb([0, 0, 0.467]), 1);
    }
}