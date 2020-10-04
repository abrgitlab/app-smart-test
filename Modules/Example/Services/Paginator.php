<?php

declare(strict_types=1);

namespace Modules\Example\Services;

class Paginator
{
    public static function paginate(int $currentPage, int $perPage, int $count): array
    {
        $result = [];

        $totalPages = (int) ceil($count / $perPage);

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }

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

        if ($totalPages > 1) {
            $lastBlock = [$totalPages];
        }

        if (!empty($window) && !empty($lastBlock) && $window[count($window) - 1] + 1 === $lastBlock[0]) {
            $window[] = array_shift($lastBlock);
        } elseif (empty($window) && !empty($lastBlock) && $lastBlock[0] - 1 === 1) {
            $firstBlock[] = array_shift($lastBlock);
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
