<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\StatusValidationController;
use AppBundle\Entity\User;
use AppBundle\Service\RevelationManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Routing\Router;

class StatusValidationListener
{
    /** @var RevelationManager */
    private $userManager;

    /** @var Router */
    private $router;

    /** @var Session */
    private $session;

    /**
     * StatusValidationListener constructor.
     * @param $userManager RevelationManager
     * @param $router Router
     * @param $session Session
     */
    public function __construct(RevelationManager $userManager, Router $router, Session $session)
    {
        $this->userManager = $userManager;
        $this->router = $router;
        $this->session = $session;
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

        if ($controller[0] instanceof StatusValidationController) {
// unfiltered actions
            if ($controller[1] === "dashboardRevelationAction") {
                return;
            }
            $currentUser = $this->userManager->getUser();
// user not connected, pass to security controller
            if (is_null($currentUser)) {
                return;
            }
            switch ($currentUser->getStatus()) {
                case User::STATUS_BLOCKED:
                    $this->session->getFlashBag()->add(
                        "alert",
                        "Ton compte a été bloqué. Merci de contacter l'administrateur du site"
                    );
                    $loginURL = $this->router->generate("login");
                    $event->setController(function () use ($loginURL) {
                        return new RedirectResponse($loginURL);
                    });
                    break;
                case User::STATUS_DELETED:
                case User::STATUS_WAITING:
                    throw new LogicException("Internal Error : this code should be never run !");
                    break;
                case User::STATUS_VALIDATED:
                    if (false === $currentUser->getIsRevealer()) {
                        $this->session->getFlashBag()->add(
                            "success",
                            "Bienvenue dans ton espace Revealer. 
A ton tour ! Révèle un talent de ton réseau professionnel et tu pourras accéder à 
ton tableau de bord."
                        );
                        $revealURL = $this->router->generate("dashboard-revelation");
                        $event->setController(function () use ($revealURL) {
                            return new RedirectResponse($revealURL);
                        });
                    }
                    break;
                default:
                    throw new LogicException("Internal Error : Unknow user status");
            }
        }
    }
}