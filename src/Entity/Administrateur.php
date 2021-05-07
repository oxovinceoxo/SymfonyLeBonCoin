<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdministrateurRepository::class)
 */
class Administrateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passwordAdmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->emailAdmin;
    }

    public function setEmailAdmin(string $emailAdmin): self
    {
        $this->emailAdmin = $emailAdmin;

        return $this;
    }

    public function getPasswordAdmin(): ?string
    {
        return $this->passwordAdmin;
    }

    public function setPasswordAdmin(string $passwordAdmin): self
    {
        $this->passwordAdmin = $passwordAdmin;

        return $this;
    }
}
