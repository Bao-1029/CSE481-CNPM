<?php
declare(strict_types=1);

namespace App\Domain\Hotline;

interface HotlineRepository
{
    /**
     * @return Hotline[]
     */
    public function findAll(): array;

    /**
     * @param String $username
     * @param String $password
     * @return bool
     * @throws HotlineNotFoundException
     */
    public function addHotline(String $name, String $phone_number): bool;

    /**
     * @param int    $id
     * @param String $username
     * @param String $password
     * @return bool
     * @throws HotlineNotFoundException
     */
    public function editHotline(int $id, String $name, String $phone_number): bool;

    /**
     * @param int $id
     * @return bool
     * @throws HotlineNotFoundException
     */
    public function removeHotline(int $id): bool;
}
