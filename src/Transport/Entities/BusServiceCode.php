<?php
/**
 * BusServiceCode.php
 *
 * PHP version 5.5
 *
 * @author   Alex Ross <alex@wearebase.com>
 * @license  Proprietary http://wearebase.com
 * @link     http://wearebase.com
 * @date     15/08/14
 * @project  nct
 */

namespace Base\Transport\Entities;

/**
 * Class BusServiceCode
 * @package Base\Transport\Entities
 */
class BusServiceCode
{
    protected $code;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->code;
    }
}
