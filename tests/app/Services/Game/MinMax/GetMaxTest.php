<?php

namespace Test\App\Services\Game\Helper;

use App\Services\Game\Helper\GetMax;
use PHPUnit\Framework\TestCase;

class GetMaxTest extends TestCase {

    public function testGetMax() {
        $arrayValues = $this->getMaxDataProvider();
        $maxArray = $this->getGetMax()->getMax($arrayValues);
        $this->assertContains(8, $maxArray);
        $this->assertContains(0, $maxArray);
        $this->assertContains(0, $maxArray['cells']);
        $this->assertContains(1, $maxArray['cells']);
    }

    /**
     * @return GetMax
     */
    private function getGetMax() {
        $class = new GetMax();
        return $class;
    }

    /**
     * @return array
     */
    private function getMaxDataProvider() {
        $values[] = [
            'cost' => 8,
            'depth' => 0,
            'cells' => [ 0, 1]
        ];
        $values[] = [
            'cost' => 2,
            'depth' => 0,
            'cells' => [ 0, 1]
        ];
        $values[] = [
            'cost' => -8,
            'depth' => 0,
            'cells' => [ 0, 1]
        ];
        $values[] = [
            'cost' => 0,
            'depth' => 0,
            'cells' => [ 0, 1]
        ];
        return $values;
    }
}