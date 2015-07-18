<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/03/15
 * Time: 18:48
 */
namespace EnderecoApi\Controller\Factory;

use EnderecoApi\Controller\BuscaEnderecoController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BuscaEnderecoControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $service = $serviceLocator->get('api.endereco.service');
        return new BuscaEnderecoController($service);
    }
} 