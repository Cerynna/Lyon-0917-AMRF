<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/01/18
 * Time: 10:24
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class pdfController extends Controller
{

	/**
	 * Export to PDF
	 *
	 * @Route("/pdf", name="htmlTOpdf")
	 */
	public function indexAction(Request $request)
	{
		$snappy = $this->get('knp_snappy.pdf');

		$project = $this->getDoctrine()->getRepository('AppBundle:Project')
			->projectById(11);
		/*$appPath = $this->container->getParameter('kernel.project_dir');
		$webPath = realpath($appPath . '/../web/img/');*/

		$html = $this->renderView('components/pdf.html.twig', array(
			'project' => $project[0],
			'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $request->getBasePath()
		));

		$filename = 'myFirstSnappyPDF';

		return new Response(
			$snappy->getOutputFromHtml($html, array(
				'lowquality' => false,
				'print-media-type' => true,
				'images' => true,
				'dpi' => 1300,
				'image-dpi' => 1300,
				'encoding' => 'utf-8'
			)),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"',
			)
		);
	}
}