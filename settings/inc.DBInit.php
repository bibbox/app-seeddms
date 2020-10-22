<?php
//    MyDMS. Document Management System
//    Copyright (C) 2002-2005 Markus Westphal
//    Copyright (C) 2006-2008 Malcolm Cowe
//    Copyright (C) 2010-2013 Uwe Steinmann
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

if(isset($GLOBALS['SEEDDMS_HOOKS']['initDB'])) {
        foreach($GLOBALS['SEEDDMS_HOOKS']['initDB'] as $hookObj) {
                if (method_exists($hookObj, 'pretInitDB')) {
                        $hookObj->preInitDB(array('settings'=>$settings));
                }
        }
}

$db = new SeedDMS_Core_DatabaseAccess($settings->_dbDriver, $settings->_dbHostname, $settings->_dbUser, $settings->_dbPass, $settings->_dbDatabase);
$db->connect() or die ("Could not connect to db-server \"" . $settings->_dbHostname . "\"");

if(isset($GLOBALS['SEEDDMS_HOOKS']['initDB'])) {
        foreach($GLOBALS['SEEDDMS_HOOKS']['initDB'] as $hookObj) {
                if (method_exists($hookObj, 'postInitDB')) {
                        $hookObj->postInitDB(array('db'=>$db, 'settings'=>$settings));
                }
        }
}

if(isset($GLOBALS['SEEDDMS_HOOKS']['initDMS'])) {
        foreach($GLOBALS['SEEDDMS_HOOKS']['initDMS'] as $hookObj) {
                if (method_exists($hookObj, 'pretInitDMS')) {
                        $hookObj->preInitDMS(array('db'=>$db, 'settings'=>$settings));
                }
        }
}

$dms = new SeedDMS_Core_DMS($db, $settings->_contentDir.$settings->_contentOffsetDir);

if(!$settings->_doNotCheckDBVersion && !$dms->checkVersion()) {
        echo "Database update needed.";
        exit;
}

$dms->setRootFolderID($settings->_rootFolderID);
$dms->setMaxDirID($settings->_maxDirID);
$dms->setEnableConverting($settings->_enableConverting);
$dms->setViewOnlineFileTypes($settings->_viewOnlineFileTypes);
//$dms->noReadForStatus = array(S_DRAFT, S_DRAFT_REV/*, S_DRAFT_APP*/);

if(isset($GLOBALS['SEEDDMS_HOOKS']['initDMS'])) {
        foreach($GLOBALS['SEEDDMS_HOOKS']['initDMS'] as $hookObj) {
                if (method_exists($hookObj, 'postInitDMS')) {
                        $hookObj->postInitDMS(array('dms'=>$dms, 'settings'=>$settings));
                }
        }
}

require_once("inc.Tasks.php");

