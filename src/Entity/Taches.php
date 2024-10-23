<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TachesRepository;

#[ORM\Entity(repositoryClass: TachesRepository::class)]

class Taches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?bool $isFinished = false;

    #[ORM\ManyToOne(targetEntity: TodoList::class, inversedBy: 'taches')]

    private $todo;







    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of isFinished
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * Set the value of isFinished
     *
     * @return  self
     */
    public function setIsFinished(?bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    /**
     * Get the value of todo
     */
    public function getTodo()
    {
        return $this->todo;
    }

    /**
     * Set the value of todo
     *
     * @return  self
     */
    public function setTodo(?TodoList $todo): self
    {
        $this->todo = $todo;

        return $this;
    }
}
