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
 * File: news.php - News
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

$nwsq = $db->query("
SELECT
	Content.idContent AS CID,
	MetaData.Created AS NewsDate,
	MetaData.Title AS NewsHeadline,
	Content.Contentcol AS NewsText
FROM
	Content, MetaData
WHERE
	MetaData.idMetaData = Content.Metadata_idMetaData AND
	Content.ContentGroups_idContentGroups = 2 ORDER BY NewsDate DESC");

$news = array();

$i = 0;
while ($nwsr = $db->fetch_array($nwsq))
{
	$d = date_parse($nwsr['NewsDate']);
	$news[$i]['timest'] = mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year']);
	$news[$i]['id'] = $nwsr['CID'];
	$news[$i]['date'] = $d['day'] . "." . $d['month'] . "." . $d['year'];
	$news[$i]['title'] = $nwsr['NewsHeadline'];
	$news[$i]['content'] = $nwsr['NewsText'];
	$i++;
}
$rkWeb->assign('news', $news);