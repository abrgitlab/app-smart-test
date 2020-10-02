<?php

declare(strict_types=1);

namespace Modules\Example\Services;

class Paginator
{
    public static function paginate(int $currentPage, int $perPage, int $count): array
    {
        $result = [];

        $totalPages = (int) ceil($count / $perPage);

        $firstBlock = [1];

        $window = [];
        if ($currentPage - 1 > 1) {
            $window[] = $currentPage - 1;
        }

        if ($currentPage !== 1 && $currentPage < $totalPages) {
            $window[] = $currentPage;
        }

        if ($currentPage + 1 < $totalPages) {
            $window[] = $currentPage + 1;
        }

        $lastBlock = [$totalPages];

        if (!empty($window) && $window[count($window) - 1] + 1 === $totalPages) {
            $window[] = array_shift($lastBlock);
        }

        if (!empty($window) && $window[0] - 1 === 1) {
            while (!empty($window)) {
                $firstBlock[] = array_shift($window);
            }
        }

        $result[] = $firstBlock;

        if (!empty($window)) {
            $result[] = $window;
        }

        if (!empty($lastBlock)) {
            $result[] = $lastBlock;
        }

        return $result;
    }
}
