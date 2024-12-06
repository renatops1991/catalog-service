<?php

namespace Core\Domain\Repository\Interfaces;

use stdClass;

interface Pagination
{
    /**
     * @return stdClass[]
     */
    public function items(): array;

    public function total(): int;

    public function totalPerPage(): int;

    public function currentPage(): int;

    public function firstPage(): int;

    public function lastPage(): int;

    public function to(): int;

    public function from(): int;
}