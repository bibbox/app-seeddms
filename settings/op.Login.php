<?php
//    MyDMS. Document Management System
//    Copyright (C) 2002-2005  Markus Westphal
//    Copyright (C) 2006-2008 Malcolm Cowe
//    Copyright (C) 2010-2016 Uwe Steinmann
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

include("../inc/inc.Settings.php");
include("../inc/inc.LogInit.php");
include("../inc/inc.Utils.php");
include("../inc/inc.Language.php");
include("../inc/inc.Init.php");
include("../inc/inc.Extension.php");
include("../inc/inc.ClassSession.php");
include("../inc/inc.DBInit.php");
include("../inc/inc.ClassUI.php");
include("../inc/inc.ClassController.php");

include $settings->_rootDir . "languages/" . $settings->_language . "/lang.inc";

function _printMessage($message) { /* {{{ */
	global $session, $dms, $theme;

	header("Location:../out/out.Login.php?msg=".urlencode($message));
	exit;
} /* }}} */

$tmp = explode('.', basename($_SERVER['SCRIPT_FILENAME']));
$controller = Controller::factory($tmp[1], array('dms'=>$dms));

$sesstheme = '';
if (isset($_REQUEST["sesstheme"]) && strlen($_REQUEST["sesstheme"])>0 && is_numeric(array_search($_REQUEST["sesstheme"],UI::getStyles())) ) {
	$theme = $_REQUEST["sesstheme"];
	$sesstheme = $_REQUEST["sesstheme"];
}

if (isset($_REQUEST["login"])) {
	$login = $_REQUEST["login"];
	$login = str_replace("*", "", $login);
}

if (!isset($login) || strlen($login)==0) {
	_printMessage(getMLText("login_not_given")."\n");
	exit;
}

$pwd = '';
if(isset($_POST['pwd'])) {
	$pwd = (string) $_POST["pwd"];
	if (get_magic_quotes_gpc()) {
		$pwd = stripslashes($pwd);
	}
}

$lang = '';
if(isset($_REQUEST["lang"]) && strlen($_REQUEST["lang"])>0 && is_numeric(array_search($_REQUEST["lang"],getLanguages())) ) {
	$lang = (string) $_REQUEST["lang"];
}

$session = new SeedDMS_Session($db);

// TODO: by the PHP manual: The superglobals $_GET and $_REQUEST are already decoded.
// Using urldecode() on an element in $_GET or $_REQUEST could have unexpected and dangerous results.

if (isset($_POST["referuri"]) && strlen($_POST["referuri"])>0) {
	$referuri = trim(urldecode($_POST["referuri"]));
}
else if (isset($_GET["referuri"]) && strlen($_GET["referuri"])>0) {
	$referuri = trim(urldecode($_GET["referuri"]));
}

add_log_line();

$controller->setParam('login', $login);
$controller->setParam('pwd', $pwd);
$controller->setParam('lang', $lang);
$controller->setParam('sesstheme', $sesstheme);
$controller->setParam('session', $session);
if(!$controller->run()) {
	add_log_line("login failed", PEAR_LOG_ERR);
	_printMessage(getMLText($controller->getErrorMsg()), getMLText($controller->getErrorMsg())."\n");
	exit;
}

$user = $controller->getUser();

if (isset($referuri) && strlen($referuri)>0) {
//	header("Location: http".((isset($_SERVER['HTTPS']) && (strcmp($_SERVER['HTTPS'],'off')!=0)) ? "s" : "")."://".$_SERVER['HTTP_HOST'] . $referuri);
	$suburl = "/seeddms777/";
	header("Location: ". $suburl . $referuri);
}
else {
	header("Location: ".$settings->_httpRoot.(isset($settings->_siteDefaultPage) && strlen($settings->_siteDefaultPage)>0 ? $settings->_siteDefaultPage : "out/out.ViewFolder.php?folderid=".($user->getHomeFolder() ? $user->getHomeFolder() : $settings->_rootFolderID)));
}

?>
