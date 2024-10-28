<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $matiere = null;

    #[ORM\Column(length: 255)]
    private ?int $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     *
     * @return  self
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }


    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }


    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }
}
