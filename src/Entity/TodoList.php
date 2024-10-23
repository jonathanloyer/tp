<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: TodoListRepository::class)]

class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?DateTime $date = null;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\Taches",
        mappedBy: "todo",
        cascade: ['persist']
    )]

    private $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

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
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate(?DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of taches
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

   
    public function addTaches(Taches $taches): Collection
    {
       $taches->setTodo($this);

       $this->taches->add($taches);

       return $this->taches;
    }
}
