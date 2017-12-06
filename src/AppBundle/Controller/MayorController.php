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

use AppBundle\Entity\TitleProject;
use AppBundle\Form\SubmitToAdmin;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

const MAX_TAB = 5;

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
     * @Method({"GET", "POST"})
     */
    public function mayorProjectNewAction (Request $request, SlugService $slugService)
    {
        $projectTitle = new TitleProject();
        $form = $this->createForm('AppBundle\Form\TitleProjectType', $projectTitle);
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $MayorConnect = $user->getMayor();


        if ($form->isSubmitted() && $form->isValid()) {

            $project = new Project();
            $project->setTitle($projectTitle->getTitle());
            $project->setMayor($MayorConnect);
            $project->setCreationDate(new \DateTime('now'));
            $project->setUpdateDate(new \DateTime('now'));
            $project->setProjectDate(new \DateTime('now'));
            $project->setSlug($slugService->slug($projectTitle->getTitle()));
            $project->setStatus(Project::STATUS_DRAFT);

            $em = $this->getDoctrine()->getManager();

            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('mayor_project_edit', array('slug' => $project->getSlug()));
        }


        return $this->render(':private/maires:projectNew.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("project/edit/{slug}/{page}", name="mayor_project_edit", defaults={"page": "1"},)
     * @Method({"GET", "POST"})
     */
    public function mayorProjectEditAction(Request $request, Project $project, SlugService $slugService)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $idMayorConnect = $user->getMayor();
        $idMayorProject = $project->getMayor();

        $uri = $request->getPathInfo();
        $uriExplode = explode('/', $uri);
        $page = array_pop($uriExplode);
        if (!is_numeric($page)) {
            $page = 1;
        }


        if ($idMayorConnect->getId() === $idMayorProject->getId()) {
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm('AppBundle\Form\ProjectType', $project);
            $form->remove('images');
            $form->remove('file');
            $form->remove('creationDate');
            $form->remove('updateDate');
            $form->handleRequest($request);


            $submitToAdmin = new SubmitToAdmin();
            $formSubmitToAdmin = $this->createForm('AppBundle\Form\SubmitToAdmin', $submitToAdmin);
            $formSubmitToAdmin->handleRequest($request);

            if ($formSubmitToAdmin->isSubmitted() && $formSubmitToAdmin->isValid()) {
                $project->setStatus(Project::STATUS_WAITING);
                $em->persist($project);
                $em->flush();
                return $this->redirectToRoute('mayor_project_edit', [
                    'slug' => $project->getSlug(),
                ]);
            }
            if ($form->isSubmitted() && $form->isValid()) {

                $project->setSlug($slugService->slug($project->getTitle()));
                $project->setStatus(Project::STATUS_DRAFT);
                $project->setMayor($idMayorConnect);
                $em->persist($project);
                $em->flush();

                if(isset($_POST['page'])){
                    switch ($_POST['page']){
                        case 'next':
                                $page = $page + 1;
                            break;
                        case 'back':
                                $page = $page - 1;
                            break;
                    }
                }
                if ($page > 5) {
                    $page = 5;
                }
                if ($page < 1 ){
                    $page =1;
                }

               /* return new Response("FORM SEND ". serialize($form->getData()) . " - " . $_POST['page'] . " - " . $page  );*/
                return $this->redirectToRoute('mayor_project_edit', [
                    'slug' => $project->getSlug(),
                    'page' => $page,

                ]);
            }

            return $this->render('private/maires/projectEdit.html.twig', array(
                'slug' => $project->getSlug(),
                'project' => $project,
                'form' => $form->createView(),
                'form_toAdmin' => $formSubmitToAdmin->createView(),
            ));
        }
        else {
            return $this->redirectToRoute('mayor_index');
        }
    }

    /**
     * @Route("favorite", name="mayor_favorite")
     */
    public function mayorFavoriteAction()
    {
        return $this->render('private/favoris.html.twig');
    }

}