<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\WishListItemRepository;

/**
 * Wishlistitem
 *
 * @ORM\Table(name="wishlistitem", uniqueConstraints={@ORM\UniqueConstraint(name="unique_nameWishlistItem", columns={"nameWishlistItem"})}, indexes={@ORM\Index(name="idItemCategory", columns={"idItemCategory"}), @ORM\Index(name="idWishlist", columns={"idWishlist"})})
 * @ORM\Entity(repositoryClass=App\Repository\WishListItemRepository::class)
 */
class Wishlistitem
{
    /**
     * @var int
     *
     * @ORM\Column(name="idWishlistItem", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idwishlistitem;

    /**
     * @var string
     *
     * @ORM\Column(name="nameWishlistItem", type="string", length=255, nullable=false)
     */
    private $namewishlistitem;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationdate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=10, nullable=false)
     */
    private $priority;

    /**
     * @var float|null
     *
     * @ORM\Column(name="progress", type="float", precision=10, scale=0, nullable=true)
     */
    private $progress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="email_sent", type="boolean", nullable=false, options={"default"="b'0'"})
     */
    private $emailSent = 'b\'0\'';

    /**
     * @var \Itemcategory
     *
     * @ORM\ManyToOne(targetEntity="Itemcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idItemCategory", referencedColumnName="idItemCategory")
     * })
     */
    private $iditemcategory;

    /**
     * @var \Wishlist
     *
     * @ORM\ManyToOne(targetEntity="Wishlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idWishlist", referencedColumnName="idWishlist")
     * })
     */
    private $idwishlist;

    public function getIdwishlistitem(): ?int
    {
        return $this->idwishlistitem;
    }

    public function getNamewishlistitem(): ?string
    {
        return $this->namewishlistitem;
    }

    public function setNamewishlistitem(string $namewishlistitem): static
    {
        $this->namewishlistitem = $namewishlistitem;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

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

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getProgress(): ?float
    {
        return $this->progress;
    }

    public function setProgress(?float $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isEmailSent(): ?bool
    {
        return $this->emailSent;
    }

    public function setEmailSent(bool $emailSent): static
    {
        $this->emailSent = $emailSent;

        return $this;
    }

    public function getIditemcategory(): ?Itemcategory
    {
        return $this->iditemcategory;
    }

    public function setIditemcategory(?Itemcategory $iditemcategory): static
    {
        $this->iditemcategory = $iditemcategory;

        return $this;
    }

    public function getIdwishlist(): ?Wishlist
    {
        return $this->idwishlist;
    }

    public function setIdwishlist(?Wishlist $idwishlist): static
    {
        $this->idwishlist = $idwishlist;

        return $this;
    }


}
