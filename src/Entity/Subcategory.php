<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\SubCategoryRepository;

#[ORM\Entity(repositoryClass: SubCategoryRepository::class)]
class Subcategory
{
   #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $idsubcategory;

    #[ORM\Column(type: "string", length: 15)]
    private $name;

    #[ORM\Column(type: "float")]
    private $mtassigné;

    #[ORM\Column(type: "float")]
    private $mtdépensé;


    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: "idCategory", referencedColumnName: "idcategory")]
    private $idcategory;

    public function getIdsubcategory(): ?int
    {
        return $this->idsubcategory;
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

    public function getMtassigné(): ?float
    {
        return $this->mtassigné;
    }

    public function setMtassigné(float $mtassigné): static
    {
        $this->mtassigné = $mtassigné;

        return $this;
    }

    public function getMtdépensé(): ?float
    {
        return $this->mtdépensé;
    }

    public function setMtdépensé(float $mtdépensé): static
    {
        $this->mtdépensé = $mtdépensé;

        return $this;
    }

    public function getIdcategory(): ?Category
    {
        return $this->idcategory;
    }

    public function setIdcategory(?Category $idcategory): static
    {
        $this->idcategory = $idcategory;

        return $this;
    }


}
