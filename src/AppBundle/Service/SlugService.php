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
	Public function slug($slug)
	{
		// replace non letter or digits by -
		$slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
// transliterate
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
// remove unwanted characters
		$slug = preg_replace('~[^-\w]+~', '', $slug);
// trim
		$slug = trim($slug, '-');
// remove duplicate -
		$slug = preg_replace('~-+~', '-', $slug);
// lowercase
		$slug = strtolower($slug);
		if (empty($slug)) {
			return 'n-a';
		}
		return $slug;
	}
}