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
 * File: page.php - Pages
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

//Make ImageList from BBCode
function bbCodeImageList($input){
	$replace = <<<REPLACE
<div class="col four tablet-six mobile-six">
<div class="ratio"></div>
<a href="$1">
	<i style="background-image: url('$1');">$2</i>
</a>
</div>
REPLACE;

	$output = "";
	$regex_section = '#(\<p\>)?\s*(\$\$)(?:\2.*?//|.)*?//\s*(\</p\>)?#ism';
	$regex = '/<p>\s*<img src="([^\"]+)"[^\/]*\/>\s*<\/p>/ism';

	$output = preg_replace_callback($regex_section, function($matches_section) use ($regex, $replace) {
		$section = $matches_section[0];
		preg_match_all($regex, $section, $matches);

		$row = '<div class="section row gallery">';
		for($i=0; $i < count($matches[0]); $i++){
			$subject = $matches[0][$i];

			$new_subject = preg_replace($regex, $replace, $subject);
			$row .= $new_subject;
		}
		$row .= '</div>';

		return $row;
	}, $input);

	return $output;
}

//Redirect to Home
if($rkWeb->getUrl() == '')
{
	$root = $db->select_once('Root2Leaves', 'isRoot', 1);
	if($root['rURL'] != '')
	{
		header('Location: '.$root['rURL']);
		exit;
	}
}

//Get Data
$rkWeb->assign('template', 'content/tpl/display.tpl');

$rkWeb->assign('meta_keywords', '');
$rkWeb->assign('meta_description', '');

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
	MetaData,
	Root2Leaves
WHERE
	MetaData.idMetaData				=	Content.MetaData_idMetaData			AND
	Root2Leaves.Content_idContent	=	Content.idContent					AND
	Root2Leaves.rURL				=	'".$db->escape($rkWeb->getUrl())."'
				"));

if(!empty($content))
{

	//Set Content
	$rkWeb->setResponseCode(200);
	$rkWeb->setContent(bbCodeImageList($content['RawContent']));
	$rkWeb->setTitle($content['Title']);
	$rkWeb->assign('cid', $content['ID']);
	$rkWeb->assign('meta_keywords', $content['Keywords']);
	$rkWeb->assign('meta_description', $content['Description']);
}