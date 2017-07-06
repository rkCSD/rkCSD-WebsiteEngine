<?php

/*
 * ##################################################
 * #                                                #
 * # rkCSD-WebsiteEngine_3                          #
 * # A simple, modular and flexible CMS             #
 * #                                                #
 * # Copyright (C) by rkCSD Eu                      #
 * #                                                #
 * #	                           email@rkcsd.com  #
 * #              www.customsoftwaredevelopment.de  #
 * #                                                #
 * ##################################################
 *
 * File: rkCSD.php
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

class rkCSD extends Smarty
{
	public $config;
	public $apps;
	private $version = '3.1.0';
	private $url;
	private $content = '';
	private $baseUrl;
	private $responseCode;
	private $title;

	function init()
	{
		header("Content-Type: text/html; charset=UTF-8");
		$this->config = parse_ini_file('config/config.ini', true);

		//Set Urls/Etc
		if(isset($_GET['r']))
		{
			//Current Url
			if(substr($_GET['r'], 0, 1) == '/')
			{
				$this->url = substr($_GET['r'], 1);
			}
			else
			{
				$this->url = $_GET['r'];
			}

			//Current Subfolder
			$sub = explode('/', $this->url);
			$this->baseUrl = '/';
			if(count($sub)>1)
			{
				$this->baseUrl = $sub[0].'/';
			}

			//ResponseCode Standard
			$this->responseCode = 404;
		}

		//Get Apps
		$appdir = 'apps';
		if ($handle = opendir($appdir))
		{
			while (false !== ($app = readdir($handle)))
			{
				$rCONF = array();
				//$this->apps['']
				if ($app != "." && $app != "..")
				{
					if (file_exists($appdir . '/' . $app . '/config.php'))
					{
						require $appdir . '/' . $app . '/config.php';
						$this->apps[$rCONF['name']] = $rCONF;
						$this->apps[$rCONF['name']]['dir'] = $appdir . '/' . $app;
					}
				}
			}
			closedir($handle);
		}
	}

	//Debugging
	function debug($onoff)
	{
		if ($onoff)
		{
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
			//$this->debugging = true; //Smarty Debugging
		} else
		{
			error_reporting(0);
			ini_set("display_errors", 0);
			$this->debugging = false; //Smarty Debugging
		}
	}

	//url fkt
	public function getUrl()
	{
		return parse_url($this->url, PHP_URL_PATH);
	}

	//baseUrl
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}

	//content
	public function setContent($content)
	{
		$this->content .= $content;
	}

	public function getContent()
	{
		return $this->content;
	}

	//responseCode
	public function setResponseCode($responseCode)
	{
		$this->responseCode = $responseCode;
	}

	public function getResponseCode()
	{
		return $this->responseCode;
	}

	///title
	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	//Version
	public function version()
	{
		return $this->version;
	}
}

?>