<?php
namespace MyApp\PIBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener
{
    /**
     * RedirectionListener constructor.
     * @param ContainerInterface $container
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->session = $session;
        $this->router = $container->get('router');
        $this->securityTokenStorage = $container->get('security.token_storage');
    }

    /**
     * @param GetResponseEvent $event
     * @throws \InvalidArgumentException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');

        if ($route == 'livraison' || $route == 'validation' || $route == 'factures' || $route == 'facturesPDF') {
            if ($this->session->has('panier')) {
                if (count($this->session->get('panier')) == 0)
                    $event->setResponse(new RedirectResponse($this->router->generate('panier')));
            }
            if($route !== 'fos_user_security_login' &&
                $route !== 'fos_user_resetting_reset' &&
                $route !== 'fos_user_resetting_request' &&
                $route !== 'fos_user_resetting_send_email' &&
                $route !== 'fos_user_resetting_check_email' &&
                $route !== 'fos_user_change_password' &&
                !is_object($this->securityTokenStorage->getToken()->getUser()))
            {
                $this->session->getFlashBag()->add('notification','Vous devez vous identifier');
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
            }
        }
    }
}