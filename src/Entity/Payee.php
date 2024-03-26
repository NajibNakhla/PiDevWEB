<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#use App\Repository\PayeeRepository;

/**
 * Payee
 *
 * @ORM\Table(name="payee")
 * @ORM\Entity(repositoryClass=App\Repository\PayeeRepository::class)
 */
class Payee
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPayee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpayee;

    /**
     * @var string
     *
     * @ORM\Column(name="namePayee", type="string", length=20, nullable=false)
     */
    private $namepayee;

    public function getIdpayee(): ?int
    {
        return $this->idpayee;
    }

    public function getNamepayee(): ?string
    {
        return $this->namepayee;
    }

    public function setNamepayee(string $namepayee): static
    {
        $this->namepayee = $namepayee;

        return $this;
    }


}
