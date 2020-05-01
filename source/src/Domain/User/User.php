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
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $level;

    /**
     * @var bool
     */
    private $status;

    /**
     * @param int  $id
     * @param string    $username
     * @param string    $password
     * @param int       $level
     * @param bool      $status
     */
    public function __construct(int $id, string $username, string $password, int $level, bool $status)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
        $this->status = $status;
    }

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
    public function getUsername(): string
    {
        return $this->username;
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
        return $this->level;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'level' => $this->level,
            'status' => $this->status,
        ];
    }
}
