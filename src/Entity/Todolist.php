<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#use App\Repository\TODOLISTRepository;
/**
 * Todolist
 *
 * @ORM\Table(name="todolist")
 * @ORM\Entity(repositoryClass=App\Repository\TODOLISTRepository::class)
 */
class Todolist
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTodo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtodo;

    /**
     * @var string
     *
     * @ORM\Column(name="statusTodo", type="string", length=11, nullable=false)
     */
    private $statustodo;

    /**
     * @var float|null
     *
     * @ORM\Column(name="progress", type="float", precision=10, scale=0, nullable=true)
     */
    private $progress;

    /**
     * @var string
     *
     * @ORM\Column(name="titleTodo", type="string", length=50, nullable=false)
     */
    private $titletodo;

    public function getIdtodo(): ?int
    {
        return $this->idtodo;
    }

    public function getStatustodo(): ?string
    {
        return $this->statustodo;
    }

    public function setStatustodo(string $statustodo): static
    {
        $this->statustodo = $statustodo;

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

    public function getTitletodo(): ?string
    {
        return $this->titletodo;
    }

    public function setTitletodo(string $titletodo): static
    {
        $this->titletodo = $titletodo;

        return $this;
    }


}
