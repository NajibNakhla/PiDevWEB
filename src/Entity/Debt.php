<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\DebtRepository;
/**
 * Debt
 *
 * @ORM\Table(name="debt", indexes={@ORM\Index(name="type", columns={"type"}), @ORM\Index(name="idWallet", columns={"idWallet"})})
 * @ORM\Entity(repositoryClass=App\Repository\DebtRepository::class)
 */
class Debt
{
    /**
     * @var int
     *
     * @ORM\Column(name="idDebt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddebt;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paymentDate", type="date", nullable=false)
     */
    private $paymentdate;

    /**
     * @var float
     *
     * @ORM\Column(name="amountToPay", type="float", precision=10, scale=0, nullable=false)
     */
    private $amounttopay;

    /**
     * @var float
     *
     * @ORM\Column(name="InterestRate", type="float", precision=10, scale=0, nullable=false)
     */
    private $interestrate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="date", nullable=false)
     */
    private $creationdate;

    /**
     * @var \Debtcategory
     *
     * @ORM\ManyToOne(targetEntity="Debtcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="NameDebt")
     * })
     */
    private $type;

    /**
     * @var \Wallet
     *
     * @ORM\ManyToOne(targetEntity="Wallet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idWallet", referencedColumnName="idWallet")
     * })
     */
    private $idwallet;

    public function getIddebt(): ?int
    {
        return $this->iddebt;
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

    public function getPaymentdate(): ?\DateTimeInterface
    {
        return $this->paymentdate;
    }

    public function setPaymentdate(\DateTimeInterface $paymentdate): static
    {
        $this->paymentdate = $paymentdate;

        return $this;
    }

    public function getAmounttopay(): ?float
    {
        return $this->amounttopay;
    }

    public function setAmounttopay(float $amounttopay): static
    {
        $this->amounttopay = $amounttopay;

        return $this;
    }

    public function getInterestrate(): ?float
    {
        return $this->interestrate;
    }

    public function setInterestrate(float $interestrate): static
    {
        $this->interestrate = $interestrate;

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

    public function getType(): ?Debtcategory
    {
        return $this->type;
    }

    public function setType(?Debtcategory $type): static
    {
        $this->type = $type;

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
