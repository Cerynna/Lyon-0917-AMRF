<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\MayorController;

use AppBundle\Controller\PartnerController;
use AppBundle\Controller\PrivateController;
use AppBundle\Controller\StatusValidationController;
use AppBundle\Service\RevelationManager;

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
        /*
        * $controller passed can be either a class or a Closure.
        * This is not usual in Symfony but it may happen.
        * If it is a class, it comes in array format
        */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof MayorController OR $controller[0] instanceof PartnerController OR $controller[0] instanceof PrivateController) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();

            if ($user->getStatus() === User::USER_STATUS_INACTIF) {

                $passwordUrl = $this->router->generate("change_password");

                $this->session->getFlashBag()->add(
                    "notice",
                    "Pour acceder a votre compte veuillez changer votre mot de passe."
                );
                $event->setController(function () use ($passwordUrl) {
                    return new RedirectResponse($passwordUrl);
                });
            }

        }
    }
}