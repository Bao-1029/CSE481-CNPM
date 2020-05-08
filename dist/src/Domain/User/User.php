<?php
declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class User implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $level;

    /**
     * @var int
     */
    private $status;

    /**
     * @param int  $id
     * @param string    $username
     * @param string    $password
     * @param int       $level
     * @param int      $status
     */
    /* public function __construct(int $id, string $username, string $password, int $level, bool $status)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
        $this->status = $status;
    } */

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return (int) $this->level;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return (int) $this->status;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->userName,
            'password' => $this->password,
            'level' => $this->level,
            'status' => $this->status,
        ];
    }
}
