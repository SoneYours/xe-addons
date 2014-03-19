<?php
/**
 * @file
 * @brief Addon for extends board grant 
 * @author akasima (akasima@nate.com)
*/
if(!defined('__XE__'))
	exit();

$logged_info = Context::get('logged_info');

if($called_position=="before_module_proc" && $this->module=="board")
{
	// change board grant about comment
	$arrCheckAct = array(
		'dispBoardModifyComment',
		'dispBoardWrite',
	);
	if($logged_info->is_admin == 'Y' && in_array($this->act, $arrCheckAct)) 
	{
		$this->module_info->secret="Y";
	}
}

if($called_position=="after_module_proc" && $this->module=="board")
{
	// change board grant about comment
	$arrCheckAct = array(
		'dispBoardModifyComment',
		'dispBoardWrite',
	);
	if(in_array($this->act, $arrCheckAct)) 
	{
		if($logged_info->is_admin == 'Y')
		{
			$status_list = Context::get('status_list');
			if(!isset($status_list['SECRET']))
			{
				$oDocumentModel = getModel('document');
				$statusNameList = $oDocumentModel->getStatusNameList();
				$status_list['SECRET'] = $statusNameList['SECRET'];
				Context::set('status_list', $status_list);
			}
		}
	}
}
