<?php

/**
 * DistanceTest.php
 *
 * PHP version 5.5
 *
 * @author   Dave Hulbert <dave@wearebase.com>
 * @license  Proprietary http://wearebase.com
 * @link     http://wearebase.com
 * @date     24/06/14
 * @project  nct-app
 */

namespace Base\Geospatial;

class DistanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Base\Geospatial\Distance
     */
    public function testGetter()
    {
        $distance = new Distance(1);
        $this->assertEquals(1, $distance->getMeters());
    }

    public function testAdd()
    {
        $distance = new Distance(1);
        $distance = $distance->add(new Distance(2));

        $this->assertEquals(3, $distance->getMeters());
    }
}
