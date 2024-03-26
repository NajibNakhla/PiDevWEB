<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\WalletRepository;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $idwallet;

    #[ORM\Column(type: "string", length: 50)]
    private $name;
    #[ORM\Column(type: "string", length: 3)]
    private $currency;

    #[ORM\Column(type: "float")]
    private $totalbalance;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "idUser", referencedColumnName: "id")]
    private $iduser;

    public function getIdwallet(): ?int
    {
        return $this->idwallet;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getTotalbalance(): ?float
    {
        return $this->totalbalance;
    }

    public function setTotalbalance(float $totalbalance): static
    {
        $this->totalbalance = $totalbalance;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }






}
