<?php

/**
 * SpeedTest.php
 *
 * PHP version 5.5
 *
 * @author   Dave Hulbert <dave@wearebase.com>
 * @license  Proprietary http://wearebase.com
 * @link     http://wearebase.com
 * @date     17/07/14
 * @project  nct-app
 */

namespace Base\Geospatial;

/**
 * @coversDefaultClass Base\Geospatial\Speed
 */
class SpeedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Base\Geospatial\Speed
     */
    public function testGetter()
    {
        $distance = new Speed(1.1);
        $this->assertEquals(1.1, $distance->getMetersPerSecond());
    }
}

