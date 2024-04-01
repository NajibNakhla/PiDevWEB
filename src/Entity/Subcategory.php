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

    /**
     * @var float
     *
     * @ORM\Column(name="mtAssigné", type="float", precision=10, scale=0, nullable=false)
     */
    private $mtassigné;

    /**
     * @var float
     *
     * @ORM\Column(name="mtDépensé", type="float", precision=10, scale=0, nullable=false)
     */
    private $mtdépensé;

    /**
     * @var \int
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategory", referencedColumnName="idCategory")
     * })
     */
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

    public function getIdcategory(): ?int
    {
        return $this->idcategory;
    }

    public function setIdcategory(?Category $idcategory): static
    {
        $this->idcategory = $idcategory;

        return $this;
    }


}
