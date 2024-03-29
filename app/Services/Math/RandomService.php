<?php
declare(strict_types=1);

namespace App\Services\Math;

class RandomService
{

    /**
     * @param $a
     * @param $b
     * @return float|int
     * @throws \Exception
     */
    function cryptoRandFloatRange($a, $b): float|int
    {
        $range = $b - $a;
        $max = PHP_INT_MAX;
        return $a + (random_int(0, $max) / $max) * $range;
    }

}
