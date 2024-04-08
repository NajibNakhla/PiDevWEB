<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
#use App\Repository\CategoryRepository;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $idcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="budgetLimit", type="float", precision=10, scale=0, nullable=false)
     */
    private $budgetlimit;

    #[ORM\ManyToOne(targetEntity: Wallet::class)]
    #[ORM\JoinColumn(name: "idWallet", referencedColumnName: "idwallet")]
    private $idwallet;

    public function getIdcategory(): ?int
    {
        return $this->idcategory;
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

    public function getBudgetlimit(): ?float
    {
        return $this->budgetlimit;
    }

    public function setBudgetlimit(float $budgetlimit): static
    {
        $this->budgetlimit = $budgetlimit;

        return $this;
    }

    public function getIdwallet(): ?int
    {
        return $this->idwallet;
    }

    public function setIdwallet(?Wallet $idwallet): static
    {
        $this->idwallet = $idwallet;

        return $this;
    }


}
