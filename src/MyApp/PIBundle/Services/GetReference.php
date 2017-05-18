<?php
namespace MyApp\PIBundle\Services;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GetReference 
{
    public function __construct($tokenStorage, $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
//        $em = $this->getDoctrine()->getManager();
    }
    
    public function reference()
    {
        $reference = $this->em->getRepository('MyAppPIBundle:Commandes')->findOneBy(array('valider' => 1), array('id' => 'DESC'),1,1);
        
        if (!$reference)
            return 1;
        else 
            return $reference->getReference() +1;
    }
}