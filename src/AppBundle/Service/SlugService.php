<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/12/17
 * Time: 18:20
 */

namespace AppBundle\Service;


class SlugService
{
	public function slug($slug)
	{
		$slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
        $slug = strtr($slug, 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
        $slug = strtr($slug, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');
		$slug = preg_replace('~[^-\w]+~', '', $slug);
		$slug = preg_replace('~([0-9])+~', '', $slug);
		$slug = trim($slug, '-');
		$slug = preg_replace('~-+~', '-', $slug);
		$slug = strtolower($slug);
		if (empty($slug)) {
			return 'n-a';
		}
		return $slug;
	}
}