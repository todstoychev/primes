<?php

namespace Todstoychev\PrimesBundle\Generator;

class PrimesGenerator
{
    /**
     * @param int $count
     *
     * @return array
     */
    public function generate(int $count = 10): array
    {
        $primes = [2,];
        $i = 2;

        while (count($primes) < $count) {
            $isPrime = true;

            foreach ($primes as $prime) {
                if ($i % $prime == 0) {
                    $isPrime = false;

                    break;
                }
            }

            if (!$isPrime) {
                $i++;

                continue;
            }

            $primes[] = $i;
            $i++;
        }

        return $primes;
    }
}