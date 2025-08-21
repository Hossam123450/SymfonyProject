<?php
// src/Entity/Cv.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Cv
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:"integer")]
    private $id;

    #[ORM\Column(type:"string", length:20)]
    private $phone;

    #[ORM\Column(type:"date")]
    private $birthDate;

    #[ORM\Column(type:"string", length:10)]
    private $gender;

    #[ORM\Column(type:"string", length:255)]
    private $domain;

    #[ORM\Column(type:"string", length:255)]
    private $address;

    #[ORM\Column(type:"string", length:255)]
    private $city;

    #[ORM\Column(type:"string", length:255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
private ?string $cvFile = null;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(string $phone): self { $this->phone = $phone; return $this; }

    public function getBirthDate(): ?\DateTimeInterface { return $this->birthDate; }
    public function setBirthDate(\DateTimeInterface $birthDate): self { $this->birthDate = $birthDate; return $this; }

    public function getGender(): ?string { return $this->gender; }
    public function setGender(string $gender): self { $this->gender = $gender; return $this; }

    public function getDomain(): ?string { return $this->domain; }
    public function setDomain(string $domain): self { $this->domain = $domain; return $this; }

    public function getAddress(): ?string { return $this->address; }
    public function setAddress(string $address): self { $this->address = $address; return $this; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(string $city): self { $this->city = $city; return $this; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(string $country): self { $this->country = $country; return $this; }

    public function setCvFile(?string $cvFile): self
{
    $this->cvFile = $cvFile;
    return $this;
}

public function getCvFile(): ?string
{
    return $this->cvFile;
}
}
