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
 * File: slides.php - Slides
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

$slideq = $db->query("
SELECT
	Content.idContent AS SlideCID,
	MetaData.Title AS SlideHeadline,
	Content.Contentcol AS SlideText,
	(SELECT Media.URL FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Content_has_Media.Content_idContent = Content.idContent AND Media.Mediatype = 'image/jpeg') AS SlideImageURL,
	(SELECT Media.URL FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Content_has_Media.Content_idContent = Content.idContent AND Media.Mediatype = 'WWWURL') AS SlideLinkURL
FROM
	Content, MetaData
WHERE
	MetaData.idMetaData = Content.Metadata_idMetaData AND
	Content.ContentGroups_idContentGroups = 4");
$i = 0;

while ($slider = $db->fetch_array($slideq))
{
	$slide[$i]['id'] = $slider['SlideCID'];
	if (isset($_GET['fromSlideCID']) && $slider['SlideCID'] == $_GET['fromSlideCID'])
	{
		$slide[$i]['stophere'] = 1;
	} else
	{
		$slide[$i]['stophere'] = 0;
	}
	$slide[$i]['title'] = $slider['SlideHeadline'];
	$slide[$i]['text'] = $slider['SlideText'];
	$slide[$i]['link'] = $slider['SlideLinkURL'];
	$slide[$i]['image'] = $slider['SlideImageURL'];
	$i++;
}
$rkWeb->assign("slides", $slide);