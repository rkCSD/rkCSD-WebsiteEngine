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
 * File: webadmin.php - WebAdmin
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

//Switch Operations
//echo $rkWeb->getUrl();
$rkWeb->assign('template', 'apps/WebAdmin/tpl/cms.tpl');
$rkWeb->assign('cms_msg', '');
$rkWeb->assign('cms_action', '');
//$rkWeb->setResponseCode(200);
if (isset($_GET['performOperation']))
{
	$rkWeb->setResponseCode(200);
	switch ($_GET['performOperation'])
	{
		case 'ADMIN_LOGIN':
			$rkWeb->setTitle('Einloggen');
			$rkWeb->assign('cms_action', 'LOGIN');
			break;
		case 'LOGOUT':
			session_destroy();
			$rkWeb->setTitle('Ausloggen');
			$rkWeb->assign('cms_msg', 'DM3');
			break;
		case 'NEW_CONTENT':
			if(isset($_GET['cgl']))
			{
				switch ($_GET['cgl'])
				{
					//Insert Data and Redirect to Editing Page
					case 'NEWS':
						$db->insert('MetaData', array(
							'Created' => date('Y-m-d H:i:s'),
							'Lang' => 'DE',
							'Title' => 'Neue Seite'));
						$mdid = $db->select_last_insert_id();
						$db->insert('Content', array(
							'MetaData_idMetaData' => $mdid,
							'ContentGroups_idContentGroups' => 2));
						header('Location: /WebAdmin/?performOperation=EDIT_CONTENT&idContent=' . $db->select_last_insert_id() . '&cgl=NEWS');
						exit;
					case 'SLIDES':
						$db->insert('MetaData', array(
							'Created' => date('Y-m-d H:i:s'),
							'Lang' => 'DE',
							'Title' => 'Neue Slide'));
						$mdid = $db->select_last_insert_id();
						$db->insert('Content', array(
							'MetaData_idMetaData' => $mdid,
							'ContentGroups_idContentGroups' => 4));
						$cid = $db->select_last_insert_id();
						$db->insert('Media', array(
							'MediaType' => 'WWWURL'
						));
						$meid = $db->select_last_insert_id();
						$db->insert('Content_has_Media', array(
							'Content_idContent' => $cid,
							'Media_idMedia' => $meid
						));
						$db->insert('Media', array(
							'MediaType' => 'image/jpeg'
						));
						$meid = $db->select_last_insert_id();
						$db->insert('Content_has_Media', array(
							'Content_idContent' => $cid,
							'Media_idMedia' => $meid
						));
						header('Location: /WebAdmin/?performOperation=EDIT_CONTENT&idContent=' . $cid . '&cgl=SLIDES');
						exit;
				}
			}
		case 'EDIT_CONTENT':
			$rkWeb->setTitle('Bearbeiten');
			$rkWeb->assign('cms_action', 'EDIT');
			$rkWeb->assign('tinymce_content_css', $rkWeb->config['templating']['tinymce_css']);
			$rkWeb->assign('submit', false);

			//If Submitted
			if (isset($_POST['editSubmit']))
			{
				$rkWeb->assign('submit', true);
				$msg = 0;

				//Update Submitted Data
				if ($c = $db->select_once('Content', 'idContent', (int)$_POST['idContent']))
				{
					if($db->update('Content', array('Contentcol' => $db->escape($_POST['ContentText'])), 'idContent', (int)$_POST['idContent']))
					{
						$msg = 1;
					}
					else
					{
						$msg = 2;
					}
				}

				//Update Metadata
				if ($c['ContentGroups_idContentGroups'] == 4)
				{
					$db->update('MetaData',
						array(
							'LastModified' => date('Y-m-d H:i:s'),
							'Title' => htmlspecialchars($db->escape($_POST['ContentTitle'])),
						), 'idMetaData', $c['MetaData_idMetaData']);

					$m1 = $db->fetch_array($db->query("SELECT * FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Media.MediaType='WWWURL' AND Content_has_Media.Content_idContent = " . $c['idContent']));
					$slide_link_mediaid = $m1['idMedia'];
					$m2 = $db->fetch_array($db->query("SELECT * FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Media.MediaType='image/jpeg' AND Content_has_Media.Content_idContent = " . $c['idContent']));
					$slide_image_mediaid = $m2['idMedia'];
					$db->update('Media', array('URL' => $db->escape($_POST['ContentKeywords'])), 'idMedia', $slide_image_mediaid);
					$db->update('Media', array('URL' => $db->escape($_POST['ContentDescription'])), 'idMedia', $slide_link_mediaid);
				}
				elseif($c['ContentGroups_idContentGroups'] == 2)
				{
					if($db->update('MetaData',
						array(
							'Created' => htmlspecialchars($db->escape($_POST['cdate_pub'])),
							'LastModified' => date('Y-m-d H:i:s'),
							'Title' => htmlspecialchars($db->escape($_POST['ContentTitle'])),
							'Keywords' => htmlspecialchars($db->escape($_POST['ContentKeywords'])),
							'Descr' => htmlspecialchars($db->escape($_POST['ContentDescription']))
						), 'idMetaData', $c['MetaData_idMetaData']))
					{
						$msg = 1;
					}
					else
					{
						$msg = 2;
					}
				}
				else
				{
					if($db->update('MetaData',
						array(
							'LastModified' => date('Y-m-d H:i:s'),
							'Title' => htmlspecialchars($db->escape($_POST['ContentTitle'])),
							'Keywords' => htmlspecialchars($db->escape($_POST['ContentKeywords'])),
							'Descr' => htmlspecialchars($db->escape($_POST['ContentDescription']))
						), 'idMetaData', $c['MetaData_idMetaData']))
					{
						$msg = 1;
					}
					else
					{
						$msg = 2;
					}
				}

				$rkWeb->assign('msg', $msg);
			}//Get data for editing
			else
			{
				$c = $db->select_once('Content', 'idContent', $_GET['idContent']);
				$m = $db->select_once('MetaData', 'idMetaData', $c['MetaData_idMetaData']);
				if ($c['ContentGroups_idContentGroups'] == 4)
				{
					$m1 = $db->fetch_array($db->query("SELECT * FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Media.MediaType='WWWURL' AND Content_has_Media.Content_idContent = " . $c['idContent']));
					$slide_link = $m1['URL'];
					$m2 = $db->fetch_array($db->query("SELECT * FROM Media, Content_has_Media WHERE Content_has_Media.Media_idMedia = Media.idMedia AND Media.MediaType='image/jpeg' AND Content_has_Media.Content_idContent = " . $c['idContent']));
					$slide_image = $m2['URL'];
				}

				$rkWeb->assign('cdate', substr($m['Created'], 0, 10));
				//News
				if ($c['ContentGroups_idContentGroups'] == 2)
				{
					$rkWeb->assign('is_news', true);
					$rkWeb->assign('cdate', $m['Created']);
				}

				$rkWeb->assign('cgid', $c['ContentGroups_idContentGroups']);
				$rkWeb->assign('cid', $c['idContent']);
				$rkWeb->assign('content', $c['Contentcol']);
				$rkWeb->assign('title', $m['Title']);
				$rkWeb->assign('keywords', ($c['ContentGroups_idContentGroups'] == 4) ? $slide_image : $m['Keywords']);
				$rkWeb->assign('descr', ($c['ContentGroups_idContentGroups'] == 4) ? $slide_link : $m['Descr']);
				$rkWeb->assign('ctime', strtotime($m['Created']));
			}
			break;
		case 'UNLINK_CONTENT':
			$rkWeb->setTitle('Löschen');
			if ($c = $db->select_once('Content', 'idContent', (int)$_GET['idContent']))
			{
				$r = $db->select('Content_has_Media', 'Content_idContent', $c['idContent']);
				foreach ($r as $i)
				{
					$db->delete('Media', 'idMedia', $i['Media_idMedia']);
				}
				$db->delete('Content_has_Media', 'Content_idContent', $c['idContent']);
				$db->delete('Content', 'idContent', (int)$_GET['idContent']);
				$db->delete('MetaData', 'idMetaData', $c['MetaData_idMetaData']);
				$rkWeb->assign('cms_msg', 'DM4');
			} else
			{
				//error!
			}
			break;
		case 'USER_MESSAGE':
			if (isset($_GET['msg']) && $_GET['msg'] < 5 && $_GET['msg'] > 0)
			{
				$rkWeb->assign('cms_msg', 'DM' . $_GET['msg']);
			}
			break;
	}
}
else
{
	if(!isset($_POST['Username']))
	{
		header('Location: /' . $rkWeb->getUrl() . '?performOperation=ADMIN_LOGIN');
		exit;
	}
}

//Login
if (isset($_POST['submit']))
{
	require_once './extensions/password.php';
	$rkWeb->setTitle('Einloggen');
	$rkWeb->setResponseCode(200);
	$u = $db->select_once('Users', 'LoginName', $_POST['Username']);
	if (!empty($u))
	{
		if (password_verify($_POST['Password'], $u['LoginPass']))
		{
			$_SESSION['rkLogin'] = true;
			$rkWeb->assign('cms_msg', 'DM1');
		} else
		{
			$rkWeb->assign('cms_msg', 'DM2');
		}
	} else
	{
		$rkWeb->assign('cms_msg', 'DM2');
	}
	$rkWeb->assign('cms_action', 'LOGIN');
}