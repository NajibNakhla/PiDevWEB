<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=20, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=20, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=10, nullable=false, options={"default"="User"})
     */
    private $role = 'User';

    /**
     * @var string
     *
     * @ORM\Column(name="incomeType", type="string", length=10, nullable=false, options={"default"="Null"})
     */
    private $incometype = 'Null';

    /**
     * @var string
     *
     * @ORM\Column(name="budgetType", type="string", length=10, nullable=false, options={"default"="Null"})
     */
    private $budgettype = 'Null';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rent", type="boolean", nullable=true)
     */
    private $rent;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="debt", type="boolean", nullable=true)
     */
    private $debt;

    /**
     * @var string
     *
     * @ORM\Column(name="transport", type="string", length=10, nullable=false, options={"default"="Null"})
     */
    private $transport = 'Null';

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255, nullable=false)
     */
    private $hash;

    /**
     * @var binary
     *
     * @ORM\Column(name="salt", type="binary", nullable=false)
     */
    private $salt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlImage", type="string", length=255, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="resetCode", type="string", length=255, nullable=true)
     */
    private $resetcode;

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getIncometype(): ?string
    {
        return $this->incometype;
    }

    public function setIncometype(string $incometype): static
    {
        $this->incometype = $incometype;

        return $this;
    }

    public function getBudgettype(): ?string
    {
        return $this->budgettype;
    }

    public function setBudgettype(string $budgettype): static
    {
        $this->budgettype = $budgettype;

        return $this;
    }

    public function isRent(): ?bool
    {
        return $this->rent;
    }

    public function setRent(?bool $rent): static
    {
        $this->rent = $rent;

        return $this;
    }

    public function isDebt(): ?bool
    {
        return $this->debt;
    }

    public function setDebt(?bool $debt): static
    {
        $this->debt = $debt;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setTransport(string $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): static
    {
        $this->hash = $hash;

        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt): static
    {
        $this->salt = $salt;

        return $this;
    }

    public function getUrlimage(): ?string
    {
        return $this->urlimage;
    }

    public function setUrlimage(?string $urlimage): static
    {
        $this->urlimage = $urlimage;

        return $this;
    }

    public function getResetcode(): ?string
    {
        return $this->resetcode;
    }

    public function setResetcode(?string $resetcode): static
    {
        $this->resetcode = $resetcode;

        return $this;
    }


}
