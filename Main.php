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
 * File: Main.php
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

if (file_exists('config/config.ini'))
{
	//Init
	session_name('rkSession');
	session_start();
	require_once 'extensions/Smarty/Smarty.class.php';
	require_once 'extensions/mysql.php';
	require_once 'extensions/rkCSD.php';

	//Init WebEngine
	$rkWeb = new rkCSD();
	$rkWeb->init();
	$rkWeb->debug($rkWeb->config['system']['debug']);
	$rkWeb->setPluginsDir(['Smarty/plugins/']);

	//Timezone
	date_default_timezone_set($rkWeb->config['system']['timezone']);

	//Mysql
	$db = new mysql($rkWeb->config['mysql']['host'], $rkWeb->config['mysql']['user'], $rkWeb->config['mysql']['password'], $rkWeb->config['mysql']['dbname']);

	//Smarty
	$rkWeb->caching = false;
	$rkWeb->setCacheDir($rkWeb->config['templating']['cache']);

	//Login
	$login = false;
	if(isset($_SESSION['rkLogin']))
	{
		$login = true;
	}
	$rkWeb->assign('login', $login);

	//Find and execute Apps
	foreach ($rkWeb->apps as $app)
	{
		if (isset($app['type']))//typ vorhanden?
		{
			//Page
			if ($app['type'] == 'page' && isset($app['base_url']) && file_exists($app['dir'] . '/' . $app['base_file']) && $app['base_url'] == $rkWeb->getBaseUrl())
			{
				require $app['dir'] . '/' . $app['base_file'];
			}

			//Static
			if ($app['type'] == 'static' && isset($app['base_file']) && file_exists($app['dir'] . '/' . $app['base_file']))
			{
				require $app['dir'] . '/' . $app['base_file'];
			}

			//Param
			if ($app['type'] == 'param' && isset($app['base_file']) && file_exists($app['dir'] . '/' . $app['base_file']))
			{
				if(strpos($rkWeb->getUrl(), $app['param']) !== false)
				{
					require $app['dir'] . '/' . $app['base_file'];
				}
			}

			//Aliases
			if(isset($app['alias']))
			{
				foreach ($app['alias'] as $url => $page)
				{
					if ($rkWeb->getUrl() == $url)
					{
						require $app['dir'] . '/' . $page;
					}
				}
			}
		}
	}

	//Render Website
	$rkWeb->assign($rkWeb->config['templating']['title'], $rkWeb->getTitle());
	$rkWeb->assign($rkWeb->config['templating']['content'], $rkWeb->getContent());
	$rkWeb->assign('basepath', $rkWeb->config['templating']['basepath']);
	$rkWeb->assign('responseCode', $rkWeb->getResponseCode());

	//Set meta_generator
	$rkWeb->assign('meta_generator', 'rkCSD-WebsiteEngine v'.$rkWeb->version().' (www.rkcsd.com)');

	//Set Response Code, display 404-Errorpage if neccesary
	http_response_code($rkWeb->getResponseCode());
	if ($rkWeb->getResponseCode() == 404)
	{
		$rkWeb->assign($rkWeb->config['templating']['title'], 'Fehler 404');
		$rkWeb->assign($rkWeb->config['templating']['content'], file_get_contents('404.txt'));
	}

	$rkWeb->display($rkWeb->config['templating']['templates'] . $rkWeb->config['templating']['template']);
} else
{
	echo file_get_contents('not-installed.html');
}