<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#use App\Repository\SubCategoryRepository;

/**
 * Subcategory
 *
 * @ORM\Table(name="subcategory", indexes={@ORM\Index(name="idCategory", columns={"idCategory"})})
 * @ORM\Entity(repositoryClass=App\Repository\SubCategoryRepository::class)
 */
class Subcategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSubCategory", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsubcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, nullable=false)
     */
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
