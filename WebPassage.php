<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\WebPassage;

use Nette;

class WebPassage extends Nette\Object
{

	const WEB_PASSAGE_MAX_URLS = 40;

	/**
	 * @var Nette\Http\Request
	 */
	private $request;

	/**
	 * @var Nette\Http\Session
	 */
	private $session;


	public function __construct(Nette\Http\Request $request, Nette\Http\Session $session)
	{
		$this->request = $request;
		$this->session = $session;
	}


	/**
	 * Save web passage uri to session
	 * @return void
	 */
	public function saveState()
	{
		$url = (string) $this->request->getUrl();

		if ($url) {
			$passage = $this->session->getSection('web_passage')->web_passage ?: [];

			if ($url === reset($passage)) {
				return;
			}

			if (strpos($url, '?do=') || strpos($url, '&do=')) {
				return;
			}

			if (sizeof($passage) > self::WEB_PASSAGE_MAX_URLS) {
				array_pop($passage);
			}

			array_unshift($passage, $url);

			$this->session->getSection('web_passage')->web_passage = $passage;
		}
	}


	/**
	 * Get web passage uri from session if any
	 * @return mixed
	 */
	public function getPassage($size = NULL, $include_host = TRUE)
	{
		$url = $this->request->url->scheme . '://' . $this->request->url->host;

		$passage = $this->session->getSection('web_passage')->web_passage ?: [];

		if ($size) {
			$passage = array_slice($passage, 0, $size);
		}

		if (!$include_host) {
			$passage = array_map(function($item) use ($url) {
				return str_replace($url, '', $item);
			}, $passage);
		}

		return $passage;
	}

}
