<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Taches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $isFinished = false;

    #[ORM\ManyToOne(targetEntity: ListTaches::class, inversedBy: "taches")]
    private $listTache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getIsFinished()
    {
        return $this->isFinished;
    }

    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;

        return $this;
    }


    public function getListTache()
    {
        return $this->listTache;
    }

    public function setListTache($listTache)
    {
        $this->listTache = $listTache;

        return $this;
    }
}