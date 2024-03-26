<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#use App\Repository\TaskRepository;

/**
 * Task
 *
 * @ORM\Table(name="task", indexes={@ORM\Index(name="idTodoList", columns={"idTodo"})})
 * @ORM\Entity(repositoryClass=App\Repository\TaskRepository::class)
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTask", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtask;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dueDate", type="date", nullable=false)
     */
    private $duedate;

    /**
     * @var float
     *
     * @ORM\Column(name="mtAPayer", type="float", precision=10, scale=0, nullable=false)
     */
    private $mtapayer;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=10, nullable=false)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionTask", type="string", length=50, nullable=false)
     */
    private $descriptiontask;

    /**
     * @var int
     *
     * @ORM\Column(name="idSubCategory", type="integer", nullable=false)
     */
    private $idsubcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="statusTask", type="string", length=11, nullable=false)
     */
    private $statustask;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="creationDate", type="date", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \Todolist
     *
     * @ORM\ManyToOne(targetEntity="Todolist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTodo", referencedColumnName="idTodo")
     * })
     */
    private $idtodo;

    public function getIdtask(): ?int
    {
        return $this->idtask;
    }

    public function getDuedate(): ?\DateTimeInterface
    {
        return $this->duedate;
    }

    public function setDuedate(\DateTimeInterface $duedate): static
    {
        $this->duedate = $duedate;

        return $this;
    }

    public function getMtapayer(): ?float
    {
        return $this->mtapayer;
    }

    public function setMtapayer(float $mtapayer): static
    {
        $this->mtapayer = $mtapayer;

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

    public function getDescriptiontask(): ?string
    {
        return $this->descriptiontask;
    }

    public function setDescriptiontask(string $descriptiontask): static
    {
        $this->descriptiontask = $descriptiontask;

        return $this;
    }

    public function getIdsubcategory(): ?int
    {
        return $this->idsubcategory;
    }

    public function setIdsubcategory(int $idsubcategory): static
    {
        $this->idsubcategory = $idsubcategory;

        return $this;
    }

    public function getStatustask(): ?string
    {
        return $this->statustask;
    }

    public function setStatustask(string $statustask): static
    {
        $this->statustask = $statustask;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(?\DateTimeInterface $creationdate): static
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getIdtodo(): ?Todolist
    {
        return $this->idtodo;
    }

    public function setIdtodo(?Todolist $idtodo): static
    {
        $this->idtodo = $idtodo;

        return $this;
    }


}
