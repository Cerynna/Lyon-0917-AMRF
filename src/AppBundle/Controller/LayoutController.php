<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 21/12/17
 * Time: 11:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use AppBundle\Service\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LayoutController
 * @package AppBundle\Controller
 */
class LayoutController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function footerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["footer"];
        $footer = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array)['footer'];
        return $this->render(':components:footer.html.twig', array(
            'footer' => $footer,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchHeaderAction(Request $request, SearchService $searchService)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        return $this->render(':components:headerSearch.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}