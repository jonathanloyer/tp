<?php

namespace App\Repository;

use App\Entity\TodoList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodoListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, TodoList::class);
    }

    public function save(TodoList $newTodo, ?bool $flush = false)
    {
        $this->getEntityManager()->persist($newTodo);

        if ($flush){
            $this->getEntityManager()->flush();
        }
        return $newTodo;
    }

    function delete(TodoList $tododel)
    {
        $this->getEntityManager()->remove($tododel);
        $this->getEntityManager()->flush();

    }



}
