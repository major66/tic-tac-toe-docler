<?php

namespace App\Services\Game\Helper;

class GetMin {
    
    /**
     * Allow me to determine the element with the min cost.
     * Take an array ['cost' => $int, 'depth' => $int, 'cells' => [[$x] [$y]]]
     *
     * @param $values
     * @return array
     */
    public function getMin($values) {
        $numbers = array_column($values, 'cost');
        $min = min($numbers);
        for ($iterator = 0; $iterator < count($values); $iterator++) {
            if ($values[$iterator]['cost'] == $min) {
                return [
                    'cost' => $values[$iterator]['cost'],
                    'depth' => $values[$iterator]['depth'],
                    'cells' => $values[$iterator]['cells']
                ];
            }
        }
    }
}