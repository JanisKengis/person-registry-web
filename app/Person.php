<?php

namespace App;

class Person
{
    private string $name;
    private string $surname;
    private string $idNumber;
    private string $email;

    public function __construct(string $name, string $surname, int $idNumber, string $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->idNumber = $idNumber;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getIdNumber(): string
    {
        return $this->idNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}