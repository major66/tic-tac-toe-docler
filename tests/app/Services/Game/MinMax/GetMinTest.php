<?php

namespace Test\App\Services\Game\Helper;

use App\Services\Game\Helper\GetMin;
use PHPUnit\Framework\TestCase;

class GetMinTest extends TestCase{

    public function testGetMin() {
        $arrayValues = $this->getMinTestDataProvider();
        $minArray = $this->getGetMin()->getMin($arrayValues);
        
        $this->assertContains(-8, $minArray);
        $this->assertContains(1, $minArray);
        $this->assertContains(1, $minArray['cells']);
        $this->assertContains(2, $minArray['cells']);
    }

    /**
     * @return GetMin
     */
    private function getGetMin() {
        $class = new GetMin();
        return $class;
    }

    /**
     * @return array
     */
    private function getMinTestDataProvider() {
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
            'depth' => 1,
            'cells' => [ 2, 1]
        ];
        $values[] = [
            'cost' => 0,
            'depth' => 0,
            'cells' => [ 0, 1]
        ];
        return $values;
    }
}