<?php

namespace models;

class Quyen
{
    private int $id;
    private string $tenQuyen;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTenQuyen(): string
    {
        return $this->tenQuyen;
    }

    public function setTenQuyen(string $tenQuyen): void
    {
        $this->tenQuyen = $tenQuyen;
    }

    public function __construct(int $id, string $tenQuyen)
    {
        $this->id = $id;
        $this->tenQuyen = $tenQuyen;
    }
}