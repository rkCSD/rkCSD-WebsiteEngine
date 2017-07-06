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
 * File: detail.php - Slides
 * Version: 3.0.0
 * Timestamp: 2016/12/02 15:02 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

if($_GET['cgl'] == 'NEWS') {
	$content = $db->fetch_array($db->query("
				SELECT
					Content.idContent				AS	ID,
					Content.Contentcol				AS	RawContent,
					MetaData.Created				AS	Created,
					MetaData.LastModified 			AS	LastModified,
					MetaData.Title					AS	Title,
					MetaData.Header					AS	Header,
					MetaData.Keywords				AS	Keywords,
					MetaData.Descr					AS	Description
				FROM
					Content,
					MetaData
				WHERE
					MetaData.idMetaData				=	Content.MetaData_idMetaData			AND
					Content.idContent				=	".(int) $_GET['idContent']));
}

if(!empty($content))
{
	//Set Content
	$rkWeb->setResponseCode(200);
	$rkWeb->setContent($content['RawContent']);
	$rkWeb->setTitle($content['Title']);
	$rkWeb->assign('cid', $content['ID']);
	$rkWeb->assign('meta_keywords', $content['Keywords']);
	$rkWeb->assign('meta_description', $content['Description']);
}