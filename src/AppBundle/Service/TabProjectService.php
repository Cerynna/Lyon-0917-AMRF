<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 06/12/17
 * Time: 17:37
 */

namespace AppBundle\Service;


class TabProjectService
{
	public function findUrl($action, $page)
	{
		$pageSend = "";
		switch ($action) {
			case 'next':
				$pageSend = $page + 1;
				break;
			case 'back':
				$pageSend = $page - 1;
				break;
		}

		if ($pageSend > 5) {
			$pageSend = 5;
		}
		if ($pageSend < 1) {
			$pageSend = 1;
		}
		return $pageSend;
	}

}