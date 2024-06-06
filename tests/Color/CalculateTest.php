<?php
declare(strict_types=1);

namespace Mixable\Test\TestCase\Color;

use Mixable\Color\Calculate;

/**
 * Class CalculateTest
 *
 * @package Mixable\Test\TestCase\Color
 */
class CalculateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testReadableTextColorForBackgroundColor()
    {
        $this->assertEquals('#000000', Calculate::readableTextColorForBackgroundColor('#ffffff'));
        $this->assertEquals('#ffffff', Calculate::readableTextColorForBackgroundColor('#555555'));
        $this->assertEquals('#ffffff', Calculate::readableTextColorForBackgroundColor('#000000'));
    }

    /**
     * @return void
     */
    public function testReadableColorForLightAndDarkBackground()
    {
        $this->assertEquals('be721b', Calculate::readableColorForLightAndDarkBackground('#f0c696'));
        $this->assertEquals('00b5b5', Calculate::readableColorForLightAndDarkBackground('#73feff'));
        $this->assertEquals('8f8f00', Calculate::readableColorForLightAndDarkBackground('#ffff00'));
    }
}