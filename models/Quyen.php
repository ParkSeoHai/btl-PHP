<?php

namespace models;

require_once('connection.php');

class Quyen
{
    protected static $conn = NULL;

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

    public function __construct(int $id = 0, string $tenQuyen = "")
    {
        $this->id = $id;
        $this->tenQuyen = $tenQuyen;
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM quyen";
        $result = connection::getConnection()->query($sql);
        $listQuyen = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quyen = new Quyen($row['id'], $row['tenquyen']);
                array_push($listQuyen, $quyen);
            }
        }
        return $listQuyen;
    }
}