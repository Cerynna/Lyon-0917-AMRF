<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 21/12/17
 * Time: 11:42
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}