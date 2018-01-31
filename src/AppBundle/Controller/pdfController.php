<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/01/18
 * Time: 10:24
 */

namespace AppBundle\Controller;

use AppBundle\Service\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class pdfController extends Controller
{

	/**
	 * Export to PDF
	 *
	 * @Route("/pdf/{idProject}", name="htmlTOpdf")
	 */
	public function indexAction(Request $request, SlugService $slugService, $idProject)
	{
		$snappy = $this->get('knp_snappy.pdf');

		$project = $this->getDoctrine()->getRepository('AppBundle:Project')
			->projectById($idProject);

		$html = $this->renderView('components/pdf.html.twig', array(
			'project' => $project[0]
		));

		$filename = sprintf('project-%s.pdf', date('Y-m-d'));

		return new Response(
			$snappy->getOutputFromHtml($html, array(
				'page-size' 		=> 'A4',
				'lowquality' 		=> false,
				'print-media-type'  => true,
				'images' 			=> true,
				'footer-center' 	=> 'Page [page] of [toPage]',
				'dpi' 				=> 500,
				'image-dpi' 		=> 500,
				'encoding' 			=> 'utf-8',
			)),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'	=> sprintf('attachment; filename="%s"', $filename),
			)
		);
	}
}