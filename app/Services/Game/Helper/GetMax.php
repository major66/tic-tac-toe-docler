<?php

namespace App\Services\Game\Helper;

class GetMax {
    
    /**
     * Allow me to determine the element with the max cost.
     * Take an array ['cost' => $int, 'depth' => $int, 'cells' => [[$x] [$y]]]
     *
     * @param $values
     * @return array
     */
    public function getMax($values) {
        $numbers = array_column($values, 'cost');
        $max = max($numbers);
        for ($iterator = 0; $iterator < count($values); $iterator++) {
            if($values[$iterator]['cost'] === $max) {
                return [
                    'cost' => $values[$iterator]['cost'],
                    'depth' => $values[$iterator]['depth'],
                    'cells' => $values[$iterator]['cells']
                ];
            }
        }
    }
}