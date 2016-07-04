<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\Produto;

class LoadProduto extends  AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $categoriaLivros = $this->getReference('categoria-livros');
        $categoriaComputadores = $this->getReference('categoria-computadores');

        $produto = new Produto();
        $produto->setNome("Livro A");
        $produto->persist($produto);

        $produto = new Produto();
        $produto->setNome("Livro B");
        $produto->persist($produto);

        $manager->flush();

    }

}