<?php

require 'config.php';

if($rkWeb->getUrl() == 'home_page.rkpx') $rkWeb->assign('news_bubble_show', true);

$content = $db->fetch_array($db->query('
						SELECT
							Content.Contentcol				AS	RawContent,
							MetaData.Title					AS	Title
						FROM
							Content,
							MetaData
						WHERE
							MetaData.idMetaData				=	Content.MetaData_idMetaData			AND
							Content.idContent				=	'.$content_id));
$news_bubble = array();
$news_bubble['title'] = $content['Title'];
$news_bubble['content'] = $content['RawContent'];

$rkWeb->assign("news_bubble", $news_bubble);
$rkWeb->assign('bubble_content_id', $content_id);
