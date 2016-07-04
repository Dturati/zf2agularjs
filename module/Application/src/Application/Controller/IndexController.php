<?php
namespace Application\Controller;

use Application\Entity\CategoriaRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Categoria;
use Application\Entity\Produto;
use Application\Service\Categoria as CategoriaService;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repo1 = $em->getRepository('Application\Entity\Categoria');
        $repo2 = $em->getRepository('Application\Entity\Produto');



        //$categoriaService = $this->getServiceLocator()->get('Application\Service\Categoria');
        //$categoriaService->insert("nginx");

        //$categoriaService->update(['id' => '1','nome' => 'José']);

        $categorias = $repo1->findAll();

        /*
        $produtos = $this->getServiceLocator()->get('Application\Service\Produto');
        $data = [
            'nome'          => 'crack',
            'descricao'     => 'bom',
            'categoriaId'   => 1,
        ];
        //$produtos->insert($data);

        $produtos = $repo->findAll();
        */

        return new ViewModel();
    }
}
