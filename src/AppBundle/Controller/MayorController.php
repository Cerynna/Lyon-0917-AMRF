<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 27/11/17
 * Time: 16:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePassword;
use AppBundle\Entity\Project;

use AppBundle\Entity\TitleProject;
use AppBundle\Entity\Uploader;
use AppBundle\Form\SubmitToAdmin;
use AppBundle\Service\EmailService;
use AppBundle\Service\SlugService;
use AppBundle\Service\TabProjectService;
use AppBundle\Service\UploadService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function mayorProfilAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService)
    {

        $user = $this->getUser();
        $mayor = $user->getMayor();
        $form = $this->createForm('AppBundle\Form\MayorType', $mayor);
        $form->handleRequest($request);

        $changePassword = new ChangePassword();
        $changePassword->setLogin($user->getLogin());
        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('mayor_profil', array('id' => $mayor->getId()));
        }
        if ($form_password->isSubmitted() && $form_password->isValid()) {
            $encoderService = $this->get('security.password_encoder');
            if ($encoderService->isPasswordValid($user, $changePassword->oldPassword)) {
               $user->setPassword($encoderService->encodePassword($user, $changePassword->newPassword));
               $em->persist($user);
               $em->flush();

                $messageconfirm = [
                    'to' => $user->getEmail(),
                    'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
                    'login' => $user->getLogin(),
                ];
                $emailService->sendEmail($messageconfirm);

                $this->addFlash(
                    'notice',
                    'Votre nouveau mot de passe a bien été enregistré. Merci de vous reconnecter'
                );
                return $this->redirectToRoute('logout');
            } else {
                $this->addFlash(
                    'notice',
                    'Le mot de passe saisi ne correspond pas. Veuillez saisir à nouveau votre mot de passe'
                );
            }
        }


        return $this->render('private/maires/maireProfil.html.twig', array(
            'mayor' => $mayor,
            'form' => $form->createView(),
            'form_password' => $form_password->createView(),
        ));
    }

    /**
     * @Route("project", name="mayor_project")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mayorProjectAction()
    {
        $user = $this->getUser();
        $mayorid = $user->getMayor()->getid();

        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository("AppBundle:Project")->getProjectByMayor($mayorid);


        return $this->render('private/maires/maireProjet.html.twig', array(
            'projects'=>$projects,
        ));
    }

    /**
     * @Route("project/new", name="mayor_project_new")
     * @Method({"GET", "POST"})

     * @param Request $request
     * @param SlugService $slugService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function mayorProjectNewAction(Request $request, SlugService $slugService)
    {
        $projectTitle = new TitleProject();
        $form = $this->createForm('AppBundle\Form\TitleProjectType', $projectTitle);
        $form->handleRequest($request);

        $user = $this->getUser();
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

     * @param Request $request
     * @param Project $project
     * @param SlugService $slugService
     * @param TabProjectService $tabProjectService
     * @param UploadService $uploadService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function mayorProjectEditAction(Request $request, Project $project, SlugService $slugService, TabProjectService $tabProjectService, UploadService $uploadService)
    {

        $user = $this->getUser();
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

            $uploaderFile = new Uploader();
            $uplodFileForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderFile);
            $uplodFileForm->handleRequest($request);


            $submitToAdmin = new SubmitToAdmin();
            $formSubmitToAdmin = $this->createForm('AppBundle\Form\SubmitToAdmin', $submitToAdmin);
            $formSubmitToAdmin->handleRequest($request);

            $uploaderImage = new Uploader();
            $uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage);
            $uplodImageForm->handleRequest($request);

            if ($formSubmitToAdmin->isSubmitted() && $formSubmitToAdmin->isValid()) {
                $project->setStatus(Project::STATUS_WAITING);
                $em->persist($project);
                $em->flush();
                return $this->redirectToRoute('mayor_project_edit', [
                    'slug' => $project->getSlug(),
                ]);
            }

            if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
                $files = $uploaderImage->getPath();
                $images = $project->getImages();
                $dbimg = $images;
                $dbimg[] = $uploadService->fileUpload($files, '/project/' . $project->getId() . '/photos', "img");
                $project->setImages($dbimg);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('mayor_project_edit', array(
                    'slug' => $project->getSlug(),
                ));
            }

            if ($uplodFileForm->isSubmitted() && $uplodFileForm->isValid()) {
                $file = $uploaderFile->getPath();
                $fileNewDB = $uploadService->fileUpload($file, '/project/' . $project->getId() . '/file', "file");
                $project->setFile($fileNewDB);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('mayor_project_edit', array(
                    'slug' => $project->getSlug(),
                ));
            }


            if ($form->isSubmitted() && $form->isValid()) {

                $project->setSlug($slugService->slug($project->getTitle()));
                $project->setStatus(Project::STATUS_DRAFT);
                $project->setMayor($idMayorConnect);
                $em->persist($project);
                $em->flush();

                if(!empty($_POST['page'])){
                    $pageSend = $tabProjectService->findUrl($_POST['page'], $page);
                }
                else{
                    $pageSend = $page;
                }


                return $this->redirectToRoute('mayor_project_edit', [
                    'slug' => $project->getSlug(),
                    'page' => $pageSend,

                ]);
            }

            return $this->render('private/maires/projectEdit.html.twig', array(
                'slug' => $project->getSlug(),
                'project' => $project,
                'form' => $form->createView(),
                'form_toAdmin' => $formSubmitToAdmin->createView(),
                'upload_image_form' => $uplodImageForm->createView(),
                'upload_file_form' => $uplodFileForm->createView(),
                'page' => $page,
            ));
        } else {
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