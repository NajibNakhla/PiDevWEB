<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\WishListRepository;

/**
 * Wishlist
 *
 * @ORM\Table(name="wishlist", uniqueConstraints={@ORM\UniqueConstraint(name="unique_wishlistName", columns={"nameWishlist"})}, indexes={@ORM\Index(name="idWallet", columns={"idWallet"})})
 * @ORM\Entity(repositoryClass=App\Repository\WishListRepository::class)
 */
class Wishlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="idWishlist", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idwishlist;

    /**
     * @var string
     *
     * @ORM\Column(name="nameWishlist", type="string", length=100, nullable=false)
     */
    private $namewishlist;

    /**
     * @var float
     *
     * @ORM\Column(name="MonthlyBudget", type="float", precision=10, scale=0, nullable=false)
     */
    private $monthlybudget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationdate = 'CURRENT_TIMESTAMP';

    /**
     * @var float
     *
     * @ORM\Column(name="savedBudget", type="float", precision=10, scale=0, nullable=false)
     */
    private $savedbudget = '0';

    /**
     * @var \Wallet
     *
     * @ORM\ManyToOne(targetEntity="Wallet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idWallet", referencedColumnName="idWallet")
     * })
     */
    private $idwallet;

    public function getIdwishlist(): ?int
    {
        return $this->idwishlist;
    }

    public function getNamewishlist(): ?string
    {
        return $this->namewishlist;
    }

    public function setNamewishlist(string $namewishlist): static
    {
        $this->namewishlist = $namewishlist;

        return $this;
    }

    public function getMonthlybudget(): ?float
    {
        return $this->monthlybudget;
    }

    public function setMonthlybudget(float $monthlybudget): static
    {
        $this->monthlybudget = $monthlybudget;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): static
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getSavedbudget(): ?float
    {
        return $this->savedbudget;
    }

    public function setSavedbudget(float $savedbudget): static
    {
        $this->savedbudget = $savedbudget;

        return $this;
    }

    public function getIdwallet(): ?Wallet
    {
        return $this->idwallet;
    }

    public function setIdwallet(?Wallet $idwallet): static
    {
        $this->idwallet = $idwallet;

        return $this;
    }


}
