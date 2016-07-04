<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Produto as ProdutoEntity;

class Produto extends EntityManager
{
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function insert($data)
    {
        $categoriaEntity = $this->em
            ->getReference('Application\Entity\Categoria',$data['categoriaId']);

        $produtoEntity = new ProdutoEntity();
        $produtoEntity->setNome($data['nome']);
        $produtoEntity->setDescricao($data['descricao']);
        $produtoEntity->setCategoria($categoriaEntity);
        
        $this->em->persist($produtoEntity);
        $this->em->flush();

        return $produtoEntity;
    }


    public function update(array $data)
    {
        $produtoEntity = $this->em
            ->getReference('Application\Entity\Produto',$data['id']);
        $produtoEntity->setNome($data['nome']);
        $this->em->persist($produtoEntity);
        $this->em->flush();

        return $produtoEntity;
    }


    public function delete($id)
    {
        $produtoEntity = $this->em
            ->getReference('Application\Entity\Produto',$id);
        $this->em->remove($produtoEntity);
        $this->em->flush();

        return $produtoEntity;

    }

  

}