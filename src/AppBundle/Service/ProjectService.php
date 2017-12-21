<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 20/12/17
 * Time: 16:05
 */

namespace AppBundle\Service;


class ProjectService
{
	/*public $sort = [
		'title' 	=> "",
		'status' 	=> "",
		'value' 	=> ""
	];*/


	public $title 	= "";
	public $status 	= "";
	public $theme	= "";


	public function __construct()
	{
		if (isset ($_GET['title'])) {
			$this->title = $_GET['title'];
		}

		if (isset ($_GET['status'])) {
			$this->status = $_GET['status'];
		}
		if (isset ($_GET['value'])) {
			$this->theme = $_GET['value'];
		}
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->theme;
	}

}