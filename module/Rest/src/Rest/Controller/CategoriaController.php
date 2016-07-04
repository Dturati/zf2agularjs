<?php
namespace Rest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;


class CategoriaController extends AbstractRestfulController
{

    //Get
    public function getList()
    {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Categoria')->findAll();
        return $data;

        /*
        $service = $this->getServiceLocator()->get('Rest\Service\ProcessJson');
        $service->setResponse($this->response);
        $service->setData($data);
        $this->response = $service->process();
           */


        /*
        $serializer = $this->getServiceLocator()->get('jms_serializer.serializer');
        $result = $serializer->serialize($data, 'json');
        $this->response->setContent($result);
        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('content-type','application/json');
        $this->response->setHeaders($headers);

        return $this->response;
        */
    }

    //Get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Categoria')->find($id);
        return $data;
    }

    //Post
    public function create($data)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');
        $nome = $data['nome'];

        $categoria = $serviceCategoria->insert($nome);
        if($categoria){
            return $categoria;
        }else{
            return array('success' => false);
        }
    }

    //put
    public function update($id, $data)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');

        $param['id'] = $id;
        $param['nome']  = $data['nome'];

        $categoria = $serviceCategoria->update($param);
        if($categoria){
            return $categoria;
        }else{
            return array('success' => false);
        }
    }

    //delete
    public function delete($id)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');
        $result = $serviceCategoria->delete($id);

        if($result){
            return $result;
        }else{
            return array('success' => false);
        }
    }

}