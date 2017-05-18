<?php

namespace MyApp\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':layout:homepage.html.twig');
    }

    public function adminAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return $this->render('MyAppVideoBundle:admin:index.html.twig', array(
            'user' => $user,
            ));
    }
    public function loginAction()
    {
        return $this->render('MyAppVideoBundle:layout:login.html.twig');
    }
    public function serveurAction()
    {
        return $this->render('MyAppVideoBundle:layout:serveur.html.twig');
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
        return $this->render('MyAppVideoBundle:Security:login.html.twig', $data);
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {

        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }


public function profileAction()
    {
        return $this->render('MyAppVideoBundle:Profile:show.html.twig');
    }

    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }

    public function backAction()
    {
        return $this->render('MyAppVideoBundle::backOffice.html.twig');
    }

    public function backoAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('MyAppVideoBundle::backOffice.html.twig', array(
            'user' => $user,
        ));
    }

        public function registerAction(Request $request)
        {
            /** @var $formFactory FactoryInterface */
            $formFactory = $this->get('fos_user.registration.form.factory');
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            /** @var $dispatcher EventDispatcherInterface */
            $dispatcher = $this->get('event_dispatcher');

            $user = $userManager->createUser();
            $user->setEnabled(true);

            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

            if (null !== $event->getResponse()) {
                return $event->getResponse();
            }

            $form = $formFactory->createForm();
            $form->setData($user);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    $event = new FormEvent($form, $request);
                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                    $userManager->updateUser($user);

                    if (null === $response = $event->getResponse()) {
                        $url = $this->generateUrl('fos_user_registration_confirmed');
                        $response = new RedirectResponse($url);
                    }

                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                    return $response;
                }

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

                if (null !== $response = $event->getResponse()) {
                    return $response;
                }
            }

            return $this->render('@FOSUser/Registration/register.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        /**
         * Tell the user to check his email provider.
         */
        public
        function checkEmailAction()
        {
            $email = $this->get('session')->get('fos_user_send_confirmation_email/email');

            if (empty($email)) {
                return new RedirectResponse($this->get('router')->generate('fos_user_registration_register'));
            }

            $this->get('session')->remove('fos_user_send_confirmation_email/email');
            $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

            if (null === $user) {
                throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
            }

            return $this->render('@FOSUser/Registration/check_email.html.twig', array(
                'user' => $user,
            ));
        }

        /**
         * Receive the confirmation token from user email provider, login the user.
         *
         * @param Request $request
         * @param string $token
         *
         * @return Response
         */
        public
        function confirmAction(Request $request, $token)
        {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $user = $userManager->findUserByConfirmationToken($token);

            if (null === $user) {
                throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
            }

            /** @var $dispatcher EventDispatcherInterface */
            $dispatcher = $this->get('event_dispatcher');

            $user->setConfirmationToken(null);
            $user->setEnabled(true);

            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRM, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        /**
         * Tell the user his account is now confirmed.
         */
        public
        function confirmedAction()
        {
            $user = $this->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }

            return $this->render('@FOSUser/Registration/confirmed.html.twig', array(
                'user' => $user,
                'targetUrl' => $this->getTargetUrlFromSession(),
            ));
        }

        /**
         * @return mixed
         */
        private
        function getTargetUrlFromSession()
        {
            $key = sprintf('_security.%s.target_path', $this->get('security.token_storage')->getToken()->getProviderKey());

            if ($this->get('session')->has($key)) {
                return $this->get('session')->get($key);
            }
        }

    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}


