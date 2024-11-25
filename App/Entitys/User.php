<?php

namespace App\Entity;

use Doctrine\DBAL\Schema\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;


#[Entity]
#[Table('users')]
class User
{


    #[Id]
    #[Column,GeneratedValue]
    private int $id;

    #[Column]
    private string $name;
    #[Column]

    private int $phone;
    #[Column]

    private string $email;

    public function getId()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
