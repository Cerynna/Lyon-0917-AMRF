<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 23/01/18
 * Time: 10:39
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationListener
{

    protected $em;
    protected $container;


    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    public function onAuthenticationSuccess(InteractiveLoginEvent $event)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $user->setLastLogin(new \DateTime('now'));
        $this->em->persist($user);
        $this->em->flush();
        return true;
    }
}