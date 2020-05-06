<?php
declare(strict_types=1);

namespace App\Domain\Hotline;

use JsonSerializable;

class Hotline implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phone_number;

    /**
     * @param int       $id
     * @param string    $name
     * @param string    $phone_number
     */
    /* public function __construct(int $id, string $name, string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone_number = $phone_number;
    } */

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
        ];
    }
}