<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 27/11/17
 * Time: 16:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("mayor/")
 */
class MayorController extends Controller
{

    /**
     * @Route("", name="mayor_index")
     */
    public function mayorIndexAction()
    {
        return $this->render('private/maires/maireIndex.html.twig');
    }

    /**
     * @Route("profil", name="mayor_profil")
     */
    public function mayorProfilAction(Request $request)
    {
        $mayor = new Mayor();
        $form = $this->createForm('AppBundle\Form\MayorType', $mayor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mayor);
            $em->flush();

            return $this->redirectToRoute('admin_mayor_show', array('id' => $mayor->getId()));
        }

        return $this->render('private/maires/maireProfil.html.twig', array(
            'mayor' => $mayor,
            'form' => $form->createView(),
        ));
    }



    /**
     * @Route("project", name="mayor_project")
     */
    public function mayorProjectAction()
    {
        return $this->render('private/maires/maireProjet.html.twig');
    }

    /**
     * @Route("project/new", name="mayor_project_new")
     */
    public function mayorProjectNewAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $theme = $project->getTheme();
            $dbthema = [];
            foreach ($theme as $key => $value) {

                $dbthema[] = $value->getValue();
            }
            $themes = serialize($dbthema);
            $project->setTheme($themes);

            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('mayor_index', array('id' => $project->getId()));
        }

        return $this->render('private/maires/maireFormProjet.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("favorite", name="mayor_favorite")
     */
    public function mayorFavoriteAction()
    {
        return $this->render('private/favoris.html.twig');
    }

}