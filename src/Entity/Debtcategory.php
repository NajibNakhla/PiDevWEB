<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#use App\Repository\DebtCategoryRepository;

/**
 * Debtcategory
 *
 * @ORM\Table(name="debtcategory")
 * @ORM\Entity(repositoryClass=App\Repository\DebtCategoryRepository::class)
 */
class Debtcategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="NameDebt", type="string", length=15, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $namedebt;

    public function getNamedebt(): ?string
    {
        return $this->namedebt;
    }


}
