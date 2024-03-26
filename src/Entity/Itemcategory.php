<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#use App\Repository\ItemCategoryRepository;

/**
 * Itemcategory
 *
 * @ORM\Table(name="itemcategory", uniqueConstraints={@ORM\UniqueConstraint(name="unique_nameItemCategory", columns={"nameItemCategory"})})
 * @ORM\Entity(repositoryClass=App\Repository\ItemCategoryRepository::class)
 */
class Itemcategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="idItemCategory", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditemcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="nameItemCategory", type="string", length=50, nullable=false)
     */
    private $nameitemcategory;

    public function getIditemcategory(): ?int
    {
        return $this->iditemcategory;
    }

    public function getNameitemcategory(): ?string
    {
        return $this->nameitemcategory;
    }

    public function setNameitemcategory(string $nameitemcategory): static
    {
        $this->nameitemcategory = $nameitemcategory;

        return $this;
    }


}
