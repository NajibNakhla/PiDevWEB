<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\TransactionRepository;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idTransaction", type: "integer")]
    private $idtransaction;

    #[ORM\Column(type: "date")]
    private $date;

    #[ORM\Column(type: "string", length: 15)]
    private $type;

    #[ORM\Column(type: "string", length: 50)]
    private $description;

    #[ORM\Column(type: "float")]
    private $amount;

    #[ORM\ManyToOne(targetEntity: Subcategory::class)]
    #[ORM\JoinColumn(name: "idCategory", referencedColumnName: "idSubCategory")]
    private $idcategory;

    #[ORM\ManyToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(name: "fromAccount", referencedColumnName: "idAccount")]
    private $fromaccount;

    #[ORM\ManyToOne(targetEntity: Payee::class)]
    #[ORM\JoinColumn(name: "idPayee", referencedColumnName: "idPayee")]
    private $idpayee;

    #[ORM\ManyToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(name: "toAccount", referencedColumnName: "idAccount")]
    private $toaccount;

    public function getIdtransaction(): ?int
    {
        return $this->idtransaction;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getIdcategory(): ?int
    {
        return $this->idcategory;
    }

    public function setIdcategory(?Subcategory $idcategory): static
    {
        $this->idcategory = $idcategory;

        return $this;
    }

    public function getFromaccount(): ?int
    {
        return $this->fromaccount;
    }

    public function setFromaccount(?int $fromaccount): static
    {
        $this->fromaccount = $fromaccount;

        return $this;
    }

    public function getIdpayee(): ?int
    {
        return $this->idpayee;
    }

    public function setIdpayee(?Payee $idpayee): static
    {
        $this->idpayee = $idpayee;

        return $this;
    }

    public function getToaccount(): ?int
    {
        return $this->toaccount;
    }

    public function setToaccount(?Account $toaccount): static
    {
        $this->toaccount = $toaccount;

        return $this;
    }


}
