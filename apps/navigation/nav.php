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
 * File: nav.php - Navigation
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

$pagesTree = array();
$toplevelpages = $db->select("Root2Leaves", "isToplevel", "1");
if($toplevelpages !== false)
{
	foreach ($toplevelpages as $tlp)
	{
		$tlp['active'] = false;
		if($tlp['rURL'] == $rkWeb->getUrl()) $tlp['active'] = true;

		$subpages = $db->select("Root2Leaves", "Root2Leaves_idRoot2Leaves", $tlp['idRoot2Leaves']);
		$subs = array();
		$i = 0;
		if(!empty($subpages))
		{
			foreach ($subpages as $subpage)
			{
				$active = false;
				if ($subpage['rURL'] == $rkWeb->getUrl())
				{
					$active = true;
					$tlp['active'] = true;
				}

				$subs[$i] = $subpage;
				$subs[$i]['active'] = $active;
				$i++;
			}
		}
		$tlp['subpages'] = $subs;
		$pagesTree[] = $tlp;
	}
}

$rkWeb->assign('pageTree', $pagesTree);