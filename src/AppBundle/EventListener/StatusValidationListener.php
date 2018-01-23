<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\AdminController;
use AppBundle\Controller\MayorController;

use AppBundle\Controller\PartnerController;
use AppBundle\Controller\PrivateController;

use AppBundle\Entity\User;
use Symfony\Component\Asset\Context\ContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Http\Firewall\ContextListener;

class StatusValidationListener
{

    /** @var Router */
    private $router;

    /** @var Session */
    private $session;

    /** @var User */
    private $user;

    /** @var Container */
    private $container;

    /**
     * StatusValidationListener constructor.
     * @param $router Router
     * @param $session Session
     * @param User $user
     * @param ContainerInterface $container
     */
    public function __construct(Router $router, Session $session, User $user, ContainerInterface $container)
    {
        $this->router = $router;
        $this->session = $session;
        $this->user = $user;
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof MayorController OR $controller[0] instanceof PartnerController OR $controller[0] instanceof PrivateController) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $passwordUrl = $this->router->generate("change_password");
            $urlAdmin = $this->router->generate("admin_index");
            $urlMayor = $this->router->generate("change_password");
            $urlPartner = $this->router->generate("change_password");


            if ($user->getStatus() === User::USER_STATUS_INACTIF) {
                $this->session->getFlashBag()->add(
                    "notice",
                    "Pour acceder a votre compte veuillez changer votre mot de passe."
                );
                $event->setController(function () use ($passwordUrl) {
                    return new RedirectResponse($passwordUrl);
                });
            }

            if($controller[0] instanceof MayorController AND $user->getRole() !== User::USER_ROLE_MAYOR){
                if ( $user->getRole() === User::USER_ROLE_PARTNER){
                    $event->setController(function () use ($urlPartner) {
                        return new RedirectResponse($urlPartner);
                    });
                }
                if ( $user->getRole() === User::USER_ROLE_ADMIN){
                    $event->setController(function () use ($urlAdmin) {
                        return new RedirectResponse($urlAdmin);
                    });
                }
            }
            if($controller[0] instanceof PartnerController AND $user->getRole() !== User::USER_ROLE_PARTNER){
                if ( $user->getRole() === User::USER_ROLE_MAYOR){
                    $event->setController(function () use ($urlMayor) {
                        return new RedirectResponse($urlMayor);
                    });
                }
                if ( $user->getRole() === User::USER_ROLE_ADMIN){
                    $event->setController(function () use ($urlAdmin) {
                        return new RedirectResponse($urlAdmin);
                    });
                }
            }
            if($controller[0] instanceof AdminController AND $user->getRole() !== User::USER_ROLE_ADMIN){
                if ( $user->getRole() === User::USER_ROLE_MAYOR){
                    $event->setController(function () use ($urlMayor) {
                        return new RedirectResponse($urlMayor);
                    });
                }
                if ( $user->getRole() === User::USER_ROLE_PARTNER){
                    $event->setController(function () use ($urlPartner) {
                        return new RedirectResponse($urlPartner);
                    });
                }
            }



        }
    }
}