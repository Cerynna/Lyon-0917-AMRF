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
	public $title = "";
	public $status = [0 => "", 1 => "", 2 => ""];
	public $theme = "";

	public function __construct()
	{

	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return array
	 */
	public function getStatus(): array
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

	/**
	 * @param $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @param $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 * @param string $theme
	 */
	public function setTheme(string $theme)
	{
		$this->theme = $theme;
	}

	/**
	 * @return string
	 */
	public function getTheme(): string
	{
		return $this->theme;
	}
}