<?php
/**
 * Reading and writing the configuration from and to an xml file
 *
 * @category   DMS
 * @package    SeedDMS
 * @license    GPL 2
 * @version    @version@
 * @author     Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2011 Uwe Steinmann
 * @version    Release: @package_version@
 */

/**
 * Class for reading and writing the configuration file
 *
 * @category   DMS
 * @package    SeedDMS
 * @author     Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2011 Uwe Steinmann
 * @version    Release: @package_version@
 */
class Settings { /* {{{ */
	// Config File Path
	var $_configFilePath = null;

	// Name of site
	var $_siteName = "SeedDMS";
	// Message to display at the bottom of every page.
	var $_footNote = "SeedDMS free document management \"system - www.seeddms.org";
	// if true the disclaimer message the lang.inc files will be print on the bottom of the page
	var $_printDisclaimer = true;
	// Default page on login
	var $_siteDefaultPage = "";
	// ID of guest-user used when logged in as guest
	var $_guestID = 2;
	// ID of root-folder
	var $_rootFolderID = 1;
	// If you want anybody to login as guest, set the following line to true
	var $_enableGuestLogin = false;
	// If you even want guest to be logged in automatically, set the following to true
	var $_enableGuestAutoLogin = false;
	// Set to true for 2-factor Authentication
	var $_enable2FactorAuthentication = false;
	// Allow users to reset their password
	var $_enablePasswordForgotten = false;
	// Minimum password strength (0 - x, 0 means no check)
	var $_passwordStrength = 0;
	// Password strength algorithm (simple, advanced)
	var $_passwordStrengthAlgorithm = 'advanced';
	// Number of days when a password expires and must be reset
	var $_passwordExpiration = 10;
	// Number of different passwords before a password can be reused
	var $_passwordHistory = 10;
	// Number of failed logins before account is disabled
	var $_loginFailure = 0;
	// User id that is automatically logged if nobody is logged in
	var $_autoLoginUser = 0;
	// maximum amount of bytes a user may consume, 0 = unlimited
	var $_quota = 0;
	// comma separated list of undeleteable user ids
	var $_undelUserIds = 0;
	// Restricted access: only allow users to log in if they have an entry in
	// the local database (irrespective of successful authentication with LDAP).
	var $_restricted = true;
	// abitray string used for creation of unique identifiers (e.g. the form
	// key created by createFormKey())
	var $_encryptionKey = '';
	// lifetime of cookie in seconds or 0 for end of session
	var $_cookieLifetime = '';
	// default access mode for documents
	var $_defaultAccessDocs = '';
	// api key for restapi
	var $_apiKey = '';
	// api user id for restapi
	var $_apiUserId = 0;
	// api allowed origins for restapi
	var $_apiOrigin = '';
	// Strict form checking
	var $_strictFormCheck = false;
	// list of form fields which are visible by default but can be explixitly
	// turn off (comment, keywords, categories, sequence, expiration, owner
	var $_noDocumentFormFields = array();
	// Path to where SeedDMS is located
	var $_rootDir = null;
	// Path to SeedDMS_Core
	var $_coreDir = null;
	// Path to SeedDMS_Lucene
	var $_luceneClassDir = null;
	// The relative path in the URL, after the domain part.
	var $_httpRoot = "/seeddms/";
	// Where the uploaded files are stored (best to choose a directory that
	// is not accessible through your web-server)
	var $_contentDir = null;
	// Where the preview files are saved
	var $_cacheDir = null;
	// Where the partitions of an uploaded file by the jumploader is saved
	var $_stagingDir = null;
	// Where the lucene fulltext index is saved
	var $_luceneDir = null;
	// Where the drop folders are located
	var $_dropFolderDir = null;
	// Where the backup directory is located
	var $_backupDir = null;
	// Where the library folder is located
	var $_libraryFolder = 1;
	// Where the checked out files are located
	var $_checkOutDir = null;
	// Create checkout dir if it doesn't exists
	var $_createCheckOutDir = false;
	// Where the repository for extensions is located
	var $_repositoryUrl = null;
	// URL of proxy
	var $_proxyUrl = null;
	// User of proxy
	var $_proxyUser = null;
	// Password of proxy
	var $_proxyPassword = null;
	// enable removal of file from dropfolder after success import
	var $_removeFromDropFolder = false;
	// Where the stop word file is located
	var $_stopWordsFile = null;
	// enable/disable lucene fulltext search
	var $_enableFullSearch = true;
	// max size of documents for direct indexing
	var $_maxSizeForFullText = 0;
	// fulltext search engine
	var $_fullSearchEngine = 'lucene';
	// default search method
	var $_defaultSearchMethod = 'database'; // or 'fulltext'
	// jump straight to the document if it is the only hit of a search
	var $_showSingleSearchHit = true;
	// contentOffsetDirTo
	var $_contentOffsetDir = "1048576";
	// Maximum number of sub-directories per parent directory
	var $_maxDirID = 32700;
	// default available languages (list of languages shown in language selector)
	var $_availablelanguages = array();
	// default language (name of a subfolder in folder "languages")
	var $_language = "en_GB";
	// users are notified about document-changes that took place within the last $_updateNotifyTime seconds
	var $_updateNotifyTime = 86400;
	// files with one of the following endings can be viewed online
	var $_viewOnlineFileTypes = array();
	// files with one of the following endings can be edited online
	var $_editOnlineFileTypes = array();
	// enable/disable converting of files
	var $_enableConverting = false;
	// default style
	var $_theme = "bootstrap";
	// experimental one page mode for ViewFolder page
	var $_onePageMode = false;
	// Workaround for page titles that go over more than 2 lines.
	var $_titleDisplayHack = true;
	// enable/disable automatic email notification
	var $_enableEmail = true;
	// enable/disable group and user view for all users
	var $_enableUsersView = true;
	// enable/disable listing administrator as reviewer/approver
	var $_enableAdminRevApp = false;
	// enable/disable listing owner as reviewer/approver
	var $_enableOwnerRevApp = false;
	// enable/disable listing logged in user as reviewer/approver
	var $_enableSelfRevApp = false;
	// enable/disable update of a review/approval by the reviewer/approver
	var $_enableUpdateRevApp = false;
	// enable/disable listing logged in user as recipient
	var $_enableSelfReceipt = false;
	// enable/disable update of a receipt by the recipient
	var $_enableUpdateReceipt = false;
	// enable/disable listing administrator as recipient
	var $_enableAdminReceipt = false;
	// enable/disable listing owner as recipient
	var $_enableOwnerReceipt = false;
	// enable/disable filter for receipt by the recipient
	var $_enableFilterReceipt = false;
	// enable/disable default notification for owner
	var $_enableOwnerNotification = false;
	// enable/disable deleting of versions for regular users
	var $_enableVersionDeletion = false;
	// enable/disable to overwrite the status of a version for regular users
	var $_enableVersionModification = false;
	// enable/disable duplicate names of a document in a folder
	var $_enableDuplicateDocNames = true;
	// enable/disable duplicate names of a subfolder in a folder
	var $_enableDuplicateSubFolderNames = true;
	// override mimetype set by browser when uploading a file
	var $_overrideMimeType = false;
	// advanced access control lists
	var $_advancedAcl = false;
	// enable/disable notification when added as a reviewer/approver
	var $_enableNotificationAppRev = true;
	// enable/disable notification of users/group who need to take action for
	// next transition. This is not like enableNotificationAppRev where a
	// notification is added to the document. If this is turned on, the
	// notification will be send in any case.
	var $_enableNotificationWorkflow = false;
	// preset expiration date
	var $_presetExpirationDate = "";
	// initial document status
	var $_initialDocumentStatus = 2; //S_RELEASED;
	// the name of the versioning info file created by the backup tool
	var $_versioningFileName = "versioning_info.txt";
	// the mode of workflow
	var $_workflowMode = "traditional";
	// enable/disable acknowledge workflow
	var $_enableReceiptWorkflow = true;
	// enable/disable reject of reception
	var $_enableReceiptReject = false;
	// enable/disable revision workflow
	var $_enableRevisionWorkflow = true;
	// enable/disable revision on vote reject
	var $_enableRevisionOneVoteReject = true;
	// Allow to set just a reviewer in tradional workflow
	var $_allowReviewerOnly = true;
	// Allow to change reviewer/approver after review/approval has started
	var $_allowChangeRevAppInProcess = false;
	// enable/disable log system
	var $_logFileEnable = true;
	// the log file rotation
	var $_logFileRotation = "d";
	// Enable file upload by fine-uploader (was 'jumploader')
	var $_enableLargeFileUpload = false;
	// size of partitions for file uploaded by fine-loader
	var $_partitionSize = 2000000;
	// max size of files uploaded by fine-uploader, set to 0 for unlimited
	var $_maxUploadSize = 0;
	// enable/disables xsendfile
	var $_enableXsendfile = true;
	// enable/disable users images
	var $_enableUserImage = false;
	// enable/disable replacing documents by webdav
	var $_enableWebdavReplaceDoc = true;
	// enable/disable calendar
	var $_enableCalendar = true;
	// calendar default view ("w" for week,"m" for month,"y" for year)
	var $_calendarDefaultView = "y";
	// first day of the week (0=sunday, 1=monday, 6=saturday)
	var $_firstDayOfWeek = 0;
	// enable/disable display of the clipboard
	var $_enableClipboard = true;
	// enable/disable list of tasks in main menu
	var $_enableMenuTasks = true;
	// select which tasks show up in main menu
	var $_tasksInMenu = array();
	// enable/disable list of files in drop folder
	var $_enableDropFolderList = false;
	// enable/disable display of the session list
	var $_enableSessionList = false;
	// enable/disable display of the drop zone for file upload
	var $_enableDropUpload = true;
	// Enable multiple file upload
	var $_enableMultiUpload = false;
	// enable/disable display of the folder tree
	var $_enableFolderTree = true;
	// count documents and folders for folderview recursively
	var $_enableRecursiveCount = false;
	// maximum number of documents or folders when counted recursively
	var $_maxRecursiveCount = 10000;
	// enable/disable help
	var $_enableHelp = true;
	// enable/disable language selection menu
	var $_enableLanguageSelector = true;
	// enable/disable theme selector
	var $_enableThemeSelector = true;
	// expandFolderTree
	var $_expandFolderTree = 1;
	// enable/disable editing of users own profile
	var $_disableSelfEdit = false;
	// Sort order of users in lists('fullname' or '' (login))
	var $_sortUsersInList = '';
	// Sort method for forders and documents ('n' (name) or '')
	var $_sortFoldersDefault = '';
	// Where to insert new documents ('start' or 'end')
	var $_defaultDocPosition = 'end';
	// Set valid IP for admin logins
	// if enabled admin can login only by specified IP addres
	var $_adminIP = "";
	// Max Execution Time
	var $_maxExecutionTime = null;
	// command timeout
	var $_cmdTimeout = 5;
	// debug mode
	var $_enableDebugMode = false;
	// Preview image width in lists
	var $_previewWidthList = 40;
	// Preview image width in menu lists
	var $_previewWidthMenuList = 40;
	// Preview image width on document details page
	var $_previewWidthDetail = 100;
	// Preview image width in drop folder list
	var $_previewWidthDropFolderList = 100;
	// show full preview on document details page
	var $_showFullPreview = false;
	// convert to pdf for preview on document details page
	var $_convertToPdf = false;
	// maximum number of documents/folders on ViewFolder page
	var $_maxItemsPerPage = 0;
	// number of documents/folders fetched when scrolling to bottom of ViewFolder page
	var $_incItemsPerPage = 0;
	// Show form to submit missing translations at end of page
	var $_showMissingTranslations = false;
	// Extra Path to additional software, will be added to include path
	var $_extraPath = null;
	// do not check version of database
	var $_doNotCheckDBVersion = false;
	// DB-Driver used by adodb (see adodb-readme)
	var $_dbDriver = "mysql";
	// DB-Server
	var $_dbHostname = "localhost";
	// database where the tables for mydms are stored (optional - see adodb-readme)
	var $_dbDatabase = null;
	// username for database-access
	var $_dbUser = null;
	// password for database-access
	var $_dbPass = null;
	// SMTP : server
	var $_smtpServer = null;
	// SMTP : port
	var $_smtpPort = null;
	// SMTP : send from
	var $_smtpSendFrom = null;
	// SMTP : user
	var $_smtpUser = null;
	// SMTP : password
	var $_smtpPassword = null;
	// LDAP Host, URIs are supported, e.g.: ldaps://ldap.host.com
	var $_ldapHost = "";
	// Port of ldap server, optional.
	var $_ldapPort = 389;
	// Base dn for searching users, if set the user will be search below base dn
	var $_ldapBaseDN = "";
	// Use this dn for an initial bind for searching the user
	var $_ldapBindDN = "";
	// Use this password for an initial bind for searching the user
	var $_ldapBindPw = "";
	// Used only by AD <username>@_ldapAccountDomainName will be used for a bind
	// when the user is validated
	var $_ldapAccountDomainName = "";
	// Type of Ldap server: 0 = ldap; 1 = AD
	var $_ldapType = 1;
	// Additional filter when searching for the user. If not set, the user will be searched
	// below basedn and the search term 'uid=<username>' or 'sAMAccountName=<username>'
	// if set the search will be (&(cn=<username>)<filter>)
	var $_ldapFilter = "";
	var $_converters = array(); // list of commands used to convert files to text for Indexer
	var $_extensions = array(); // configuration for extensions

	/**
	 * Constructor
	 *
	 * @param string $configFilePath path to config file
	 */
	function __construct($configFilePath='') { /* {{{ */
		if($configFilePath=='') {
			$configFilePath = $this->searchConfigFilePath();

			// set $_configFilePath
			$this->_configFilePath = $configFilePath;
		} else {
			$this->_configFilePath = $configFilePath;
		}

		// Load config file
		if (!defined("SEEDDMS_INSTALL")) {
			if(!file_exists($configFilePath)) {
				echo "You do not seem to have a valid configuration. Run the <a href=\"install/install.php\">install tool</a> first.";
				exit;
			}
		}
		if(!$this->load($configFilePath)) {
				echo "Your configuration contains errors.";
				exit;
		}

		if (!is_null($this->_maxExecutionTime))
			ini_set("max_execution_time", $this->_maxExecutionTime);
	} /* }}} */

	/**
	 * Check if a variable has the string 'true', 'on', 'yes' or 'y'
	 * and returns true.
	 *
	 * @param string $var value
	 * @return true/false
	 */
	function boolVal($var) { /* {{{ */
		$var = strtolower(strval($var));
		switch ($var) {
			case 'true':
			case 'on':
			case 'yes':
			case 'y':
				$out = true;
				break;
			default:
				$out = false;
		}
		return $out;
	} /* }}} */

	/**
	 * Check if a variable is a string and returns an array
	 *
	 * @param array $var value
	 * @return true/false
	 */
	function arrayVal($var) { /* {{{ */
		if((string) $var)
			return explode(';', $var);
		return array();
	} /* }}} */

	/**
	 * Return ';' seperated string from array
	 *
	 * @param array $value
	 *
	 */
	function arrayToString($value) { /* {{{ */
    return implode(";", $value);
  } /* }}} */

	/**
	 * Return array from ';' seperated string
	 *
	 * @param string $value
	 *
	 */
	function stringToArray($value) { /* {{{ */
    return explode(";", $Value);
  } /* }}} */

	/**
	 * set $_viewOnlineFileTypes
	 *
	 * @param string $stringValue string value
	 *
	 */
  function setViewOnlineFileTypesFromString($stringValue) { /* {{{ */
    $this->_viewOnlineFileTypes = explode(";", $stringValue);
  } /* }}} */

	/**
	 * get $_viewOnlineFileTypes in a string value
	 *
	 * @return string value
	 *
	 */
  function getViewOnlineFileTypesToString() { /* {{{ */
    return implode(";", $this->_viewOnlineFileTypes);
  } /* }}} */

	/**
	 * set $_editOnlineFileTypes
	 *
	 * @param string $stringValue string value
	 *
	 */
  function setEditOnlineFileTypesFromString($stringValue) { /* {{{ */
    $this->_editOnlineFileTypes = explode(";", $stringValue);
  } /* }}} */

	/**
	 * get $_editOnlineFileTypes in a string value
	 *
	 * @return string value
	 *
	 */
  function getEditOnlineFileTypesToString() { /* {{{ */
    return implode(";", $this->_editOnlineFileTypes);
  } /* }}} */

	/**
	 * Load config file
	 *
	 * @param string $configFilePath config file path
	 *
	 * @return true/false
	 */
	public function load($configFilePath) { /* {{{ */
		$contents = file_get_contents($configFilePath);
		if(!$contents) {
			return false;
		}
		$xml = simplexml_load_string($contents);
		if(!$xml) {
			return false;
		}

		// XML Path: /configuration/site/display
		$node = $xml->xpath('/configuration/site/display');
		$tab = $node[0]->attributes();
		$this->_siteName = strval($tab["siteName"]);
		$this->_footNote = strval($tab["footNote"]);
		$this->_printDisclaimer = Settings::boolVal($tab["printDisclaimer"]);
		$this->_language = strval($tab["language"]);
		if(trim(strval($tab["availablelanguages"])))
			$this->_availablelanguages = explode(',',strval($tab["availablelanguages"]));
		$this->_theme = strval($tab["theme"]);
		$this->_onePageMode = Settings::boolVal($tab["onePageMode"]);
		if(isset($tab["previewWidthList"]))
			$this->_previewWidthList = intval($tab["previewWidthList"]);
		if(isset($tab["previewWidthMenuList"]))
			$this->_previewWidthMenuList = intval($tab["previewWidthMenuList"]);
		if(isset($tab["previewWidthDetail"]))
			$this->_previewWidthDetail = intval($tab["previewWidthDetail"]);
		if(isset($tab["previewWidthDropFolderList"]))
			$this->_previewWidthDropFolderList = intval($tab["previewWidthDropFolderList"]);
		$this->_showFullPreview = Settings::boolVal($tab["showFullPreview"]);
		$this->_convertToPdf = Settings::boolVal($tab["convertToPdf"]);
		if(isset($tab["maxItemsPerPage"]))
			$this->_maxItemsPerPage = intval($tab["maxItemsPerPage"]);
		if(isset($tab["incItemsPerPage"]))
			$this->_incItemsPerPage = intval($tab["incItemsPerPage"]);

		// XML Path: /configuration/site/edition
		$node = $xml->xpath('/configuration/site/edition');
		$tab = $node[0]->attributes();
		$this->_strictFormCheck = Settings::boolVal($tab["strictFormCheck"]);
		if(trim(strval($tab["noDocumentFormFields"])))
			$this->_noDocumentFormFields = explode(',',strval($tab["noDocumentFormFields"]));
		$this->setViewOnlineFileTypesFromString(strval($tab["viewOnlineFileTypes"]));
		$this->setEditOnlineFileTypesFromString(strval($tab["editOnlineFileTypes"]));
		$this->_enableConverting = Settings::boolVal($tab["enableConverting"]);
		$this->_enableEmail = Settings::boolVal($tab["enableEmail"]);
		$this->_enableUsersView = Settings::boolVal($tab["enableUsersView"]);
		$this->_enableSessionList = Settings::boolVal($tab["enableSessionList"]);
		$this->_enableClipboard = Settings::boolVal($tab["enableClipboard"]);
		$this->_enableMenuTasks = Settings::boolVal($tab["enableMenuTasks"]);
		$this->_tasksInMenu = Settings::arrayVal($tab["tasksInMenu"]);
		$this->_enableDropFolderList = Settings::boolVal($tab["enableDropFolderList"]);
		$this->_enableDropUpload = Settings::boolVal($tab["enableDropUpload"]);
		$this->_enableMultiUpload = Settings::boolVal($tab["enableMultiUpload"]);
		$this->_enableFolderTree = Settings::boolVal($tab["enableFolderTree"]);
		$this->_enableRecursiveCount = Settings::boolVal($tab["enableRecursiveCount"]);
		$this->_maxRecursiveCount = intval($tab["maxRecursiveCount"]);
		$this->_enableHelp = Settings::boolVal($tab["enableHelp"]);
		$this->_enableLanguageSelector = Settings::boolVal($tab["enableLanguageSelector"]);
		$this->_enableThemeSelector = Settings::boolVal($tab["enableThemeSelector"]);
		$this->_enableFullSearch = Settings::boolVal($tab["enableFullSearch"]);
		$this->_maxSizeForFullText = intval($tab["maxSizeForFullText"]);
		$this->_fullSearchEngine = strval($tab["fullSearchEngine"]);
		$this->_defaultSearchMethod = strval($tab["defaultSearchMethod"]);
		$this->_showSingleSearchHit = Settings::boolVal($tab["showSingleSearchHit"]);
		$this->_stopWordsFile = strval($tab["stopWordsFile"]);
		$this->_sortUsersInList = strval($tab["sortUsersInList"]);
		$this->_sortFoldersDefault = strval($tab["sortFoldersDefault"]);
		$this->_expandFolderTree = intval($tab["expandFolderTree"]);
		$this->_libraryFolder = intval($tab["libraryFolder"]);
		$this->_defaultDocPosition = strval($tab["defaultDocPosition"]);

		// XML Path: /configuration/site/calendar
		$node = $xml->xpath('/configuration/site/webdav');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_enableWebdavReplaceDoc = Settings::boolVal($tab["enableWebdavReplaceDoc"]);
		}

		// XML Path: /configuration/site/calendar
		$node = $xml->xpath('/configuration/site/calendar');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_enableCalendar = Settings::boolVal($tab["enableCalendar"]);
			$this->_calendarDefaultView = strval($tab["calendarDefaultView"]);
			$this->_firstDayOfWeek = intval($tab["firstDayOfWeek"]);
		}

		// XML Path: /configuration/system/server
		$node = $xml->xpath('/configuration/system/server');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_rootDir = strval($tab["rootDir"]);
			$this->_httpRoot = strval($tab["httpRoot"]);
			$this->_contentDir = strval($tab["contentDir"]);
			if($this->_contentDir && substr($this->_contentDir, -1, 1) != DIRECTORY_SEPARATOR)
				$this->_contentDir .= DIRECTORY_SEPARATOR;
			$this->_cacheDir = strval($tab["cacheDir"]);
			$this->_stagingDir = strval($tab["stagingDir"]);
			$this->_luceneDir = strval($tab["luceneDir"]);
			$this->_dropFolderDir = strval($tab["dropFolderDir"]);
			$this->_backupDir = strval($tab["backupDir"]);
			$this->_checkOutDir = strval($tab["checkOutDir"]);
			$this->_createCheckOutDir = Settings::boolVal($tab["createCheckOutDir"]);
			$this->_repositoryUrl = strval($tab["repositoryUrl"]);
			$this->_proxyUrl = strval($tab["proxyUrl"]);
			$this->_proxyUser = strval($tab["proxyUser"]);
			$this->_proxyPassword = strval($tab["proxyPassword"]);
			$this->_logFileEnable = Settings::boolVal($tab["logFileEnable"]);
			$this->_logFileRotation = strval($tab["logFileRotation"]);
			$this->_enableLargeFileUpload = Settings::boolVal($tab["enableLargeFileUpload"]);
			$this->_partitionSize = strval($tab["partitionSize"]);
			$this->_maxUploadSize = strval($tab["maxUploadSize"]);
			$this->_enableXsendfile = Settings::boolVal($tab["enableXsendfile"]);

			// XML Path: /configuration/system/authentication
			$node = $xml->xpath('/configuration/system/authentication');
			$tab = $node[0]->attributes();
			$this->_enableGuestLogin = Settings::boolVal($tab["enableGuestLogin"]);
			$this->_enableGuestAutoLogin = Settings::boolVal($tab["enableGuestAutoLogin"]);
			$this->_enable2FactorAuthentication = Settings::boolVal($tab["enable2FactorAuthentication"]);
			$this->_enablePasswordForgotten = Settings::boolVal($tab["enablePasswordForgotten"]);
			$this->_passwordStrength = intval($tab["passwordStrength"]);
			$this->_passwordStrengthAlgorithm = strval($tab["passwordStrengthAlgorithm"]);
			$this->_passwordExpiration = intval($tab["passwordExpiration"]);
			$this->_passwordHistory = intval($tab["passwordHistory"]);
			$this->_loginFailure = intval($tab["loginFailure"]);
			$this->_autoLoginUser = intval($tab["autoLoginUser"]);
			$this->_quota = intval($tab["quota"]);
			$this->_undelUserIds = strval($tab["undelUserIds"]);
			$this->_encryptionKey = strval($tab["encryptionKey"]);
			$this->_cookieLifetime = intval($tab["cookieLifetime"]);
			$this->_defaultAccessDocs = intval($tab["defaultAccessDocs"]);
			$this->_restricted = Settings::boolVal($tab["restricted"]);
			$this->_enableUserImage = Settings::boolVal($tab["enableUserImage"]);
			$this->_disableSelfEdit = Settings::boolVal($tab["disableSelfEdit"]);
		}

		// XML Path: /configuration/system/authentication/connectors/connector
		// attributs mandatories : type enable
		$node = $xml->xpath('/configuration/system/authentication/connectors/connector');
		$this->_usersConnectors = array();
		foreach($node as $connectorNode)
		{
			$typeConn = strval($connectorNode["type"]);
			$params = array();
			foreach($connectorNode->attributes() as $attKey => $attValue)
			{
				if ($attKey=="enable")
					$params[$attKey] = Settings::boolVal($attValue);
				else
					$params[$attKey] = strval($attValue);
			}

			$this->_usersConnectors[$typeConn] = $params;

			// manage old settings parameters
			if ($params['enable'] && ($typeConn == "ldap"))
			{
				$this->_ldapHost = strVal($connectorNode["host"]);
				$this->_ldapPort = intVal($connectorNode["port"]);
				$this->_ldapBaseDN = strVal($connectorNode["baseDN"]);
				$this->_ldapBindDN = strVal($connectorNode["bindDN"]);
				$this->_ldapBindPw = strVal($connectorNode["bindPw"]);
				$this->_ldapType = 0;
				$this->_ldapFilter = strVal($connectorNode["filter"]);
			}
			else if ($params['enable'] && ($typeConn == "AD"))
			{
				$this->_ldapHost = strVal($connectorNode["host"]);
				$this->_ldapPort = intVal($connectorNode["port"]);
				$this->_ldapBaseDN = strVal($connectorNode["baseDN"]);
				$this->_ldapBindDN = strVal($connectorNode["bindDN"]);
				$this->_ldapBindPw = strVal($connectorNode["bindPw"]);
				$this->_ldapType = 1;
				$this->_ldapFilter = strVal($connectorNode["filter"]);
				$this->_ldapAccountDomainName = strVal($connectorNode["accountDomainName"]);
			}
		}

		// XML Path: /configuration/system/database
		$node = $xml->xpath('/configuration/system/database');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_dbDriver = strval($tab["dbDriver"]);
			$this->_dbHostname = strval($tab["dbHostname"]);
			$this->_dbDatabase = strval($tab["dbDatabase"]);
			$this->_dbUser = strval($tab["dbUser"]);
			$this->_dbPass = strval($tab["dbPass"]);
			$this->_doNotCheckDBVersion = Settings::boolVal($tab["doNotCheckDBVersion"]);
		}

		// XML Path: /configuration/system/smtp
		$node = $xml->xpath('/configuration/system/smtp');
		if (!empty($node))
		{
			$tab = $node[0]->attributes();
			// smtpServer
			if (isset($tab["smtpServer"]))
				$this->_smtpServer = strval($tab["smtpServer"]);
			else
				$this->_smtpServer = ini_get("SMTP");
			// smtpPort
			if (isset($tab["smtpPort"]))
				$this->_smtpPort = strval($tab["smtpPort"]);
			else
				$this->_smtpPort = ini_get("smtp_port");
			// smtpSendFrom
			if (isset($tab["smtpSendFrom"]))
				$this->_smtpSendFrom = strval($tab["smtpSendFrom"]);
			else
				$this->_smtpSendFrom = ini_get("sendmail_from");
			// smtpUser
			$this->_smtpUser = strval($tab["smtpUser"]);
			$this->_smtpPassword = strval($tab["smtpPassword"]);
		}

		// XML Path: /configuration/advanced/display
		$node = $xml->xpath('/configuration/advanced/display');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_siteDefaultPage = strval($tab["siteDefaultPage"]);
			$this->_rootFolderID = intval($tab["rootFolderID"]);
			$this->_titleDisplayHack = Settings::boolval($tab["titleDisplayHack"]);
			$this->_showMissingTranslations = Settings::boolval($tab["showMissingTranslations"]);
		}

		// XML Path: /configuration/advanced/authentication
		$node = $xml->xpath('/configuration/advanced/authentication');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_guestID = intval($tab["guestID"]);
			$this->_adminIP = strval($tab["adminIP"]);
			$this->_apiKey = strval($tab["apiKey"]);
			$this->_apiUserId = intval($tab["apiUserId"]);
			$this->_apiOrigin = strval($tab["apiOrigin"]);
		}

		// XML Path: /configuration/advanced/edition
		$node = $xml->xpath('/configuration/advanced/edition');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_enableAdminRevApp = Settings::boolval($tab["enableAdminRevApp"]);
			$this->_enableOwnerRevApp = Settings::boolval($tab["enableOwnerRevApp"]);
			$this->_enableSelfRevApp = Settings::boolval($tab["enableSelfRevApp"]);
			$this->_enableUpdateRevApp = Settings::boolval($tab["enableUpdateRevApp"]);
			$this->_enableSelfReceipt = Settings::boolval($tab["enableSelfReceipt"]);
			$this->_enableAdminReceipt = Settings::boolval($tab["enableAdminReceipt"]);
			$this->_enableOwnerReceipt = Settings::boolval($tab["enableOwnerReceipt"]);
			$this->_enableUpdateReceipt = Settings::boolval($tab["enableUpdateReceipt"]);
			$this->_enableFilterReceipt = Settings::boolval($tab["enableFilterReceipt"]);
			$this->_presetExpirationDate = strval($tab["presetExpirationDate"]);
			$this->_initialDocumentStatus = intval($tab["initialDocumentStatus"]);
			$this->_versioningFileName = strval($tab["versioningFileName"]);
			$this->_workflowMode = strval($tab["workflowMode"]);
			$this->_enableReceiptWorkflow = Settings::boolval($tab["enableReceiptWorkflow"]);
			$this->_enableReceiptReject = Settings::boolval($tab["enableReceiptReject"]);
			$this->_enableRevisionWorkflow = Settings::boolval($tab["enableRevisionWorkflow"]);
			$this->_enableRevisionOneVoteReject = Settings::boolval($tab["enableRevisionOneVoteReject"]);
			$this->_allowReviewerOnly = Settings::boolval($tab["allowReviewerOnly"]);
			$this->_allowChangeRevAppInProcess = Settings::boolval($tab["allowChangeRevAppInProcess"]);
			$this->_enableVersionDeletion = Settings::boolval($tab["enableVersionDeletion"]);
			$this->_enableVersionModification = Settings::boolval($tab["enableVersionModification"]);
			$this->_enableDuplicateDocNames = Settings::boolval($tab["enableDuplicateDocNames"]);
			$this->_enableDuplicateSubFolderNames = Settings::boolval($tab["enableDuplicateSubFolderNames"]);
			$this->_overrideMimeType = Settings::boolval($tab["overrideMimeType"]);
			$this->_advancedAcl = Settings::boolval($tab["advancedAcl"]);
			$this->_removeFromDropFolder = Settings::boolval($tab["removeFromDropFolder"]);
		}

		// XML Path: /configuration/advanced/notification
		$node = $xml->xpath('/configuration/advanced/notification');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_enableNotificationAppRev = Settings::boolval($tab["enableNotificationAppRev"]);
			$this->_enableOwnerNotification = Settings::boolval($tab["enableOwnerNotification"]);
			$this->_enableNotificationWorkflow = Settings::boolval($tab["enableNotificationWorkflow"]);
		}

		// XML Path: /configuration/advanced/server
		$node = $xml->xpath('/configuration/advanced/server');
		if($node) {
			$tab = $node[0]->attributes();
			$this->_coreDir = strval($tab["coreDir"]);
			$this->_luceneClassDir = strval($tab["luceneClassDir"]);
			$this->_extraPath = strval($tab["extraPath"]);
			$this->_contentOffsetDir = strval($tab["contentOffsetDir"]);
			$this->_maxDirID = intval($tab["maxDirID"]);
			$this->_updateNotifyTime = intval($tab["updateNotifyTime"]);
			$this->_cmdTimeout = intval($tab["cmdTimeout"]);
			if (isset($tab["maxExecutionTime"]))
				$this->_maxExecutionTime = intval($tab["maxExecutionTime"]);
			else
				$this->_maxExecutionTime = ini_get("max_execution_time");
			$this->_enableDebugMode = Settings::boolval($tab["enableDebugMode"]);
		}

		// XML Path: /configuration/system/advanced/converters
		$convertergroups = $xml->xpath('/configuration/advanced/converters');
		$this->_converters = array();
		foreach($convertergroups as $convertergroup) {
			$tabgroup = $convertergroup->attributes();
			if(strval($tabgroup['target']))
				$target = strval($tabgroup['target']);
			else
				$target = 'fulltext';
			foreach($convertergroup as $converter) {
				$tab = $converter->attributes();
				$this->_converters[$target][trim(strval($tab['mimeType']))] = trim(strval($converter));
			}
		}

		// XML Path: /configuration/extensions
		$extensions = $xml->xpath('/configuration/extensions/extension');
		$this->_extensions = array();
		foreach($extensions as $extension) {
			$tmp = $extension->attributes();
			$extname = strval($tmp['name']);
			if(isset($tmp['disable']))
				$disabled = strval($tmp['disable']);
			else
				$disabled = 0;
			$this->_extensions[$extname]['__disable__'] = $disabled=='1' || $disabled == 'true' ? true : false;
			foreach($extension->children() as $parameter) {
				$tmp2 = $parameter->attributes();
				/* Do not read a parameter with the same name. Just a pre caution */
				if(strval($tmp2['name']) != '__disable__')
					$this->_extensions[$extname][strval($tmp2['name'])] = strval($parameter);
			}
		}

		return true;
	} /* }}} */

	 /**
	 * set value for one attribut.
	 * Create attribut if not exists.
	 *
	 * @param SimpleXMLElement $node node
	 * @param string $attributName attribut name
	 * @param string $attributValue attribut value
	 *
	 * @return true/false
	 */
  protected function setXMLAttributValue($node, $attributName, $attributValue) { /* {{{ */
    if (is_bool($attributValue)) {
      if ($attributValue)
        $attributValue = "true";
      else
        $attributValue = "false";
		} elseif(is_array($attributValue)) {
			$attributValue = implode(';', $attributValue);
		}

    if (isset($node[$attributName])) {
      $node[$attributName] = $attributValue;
    } else {
      $node->addAttribute($attributName, $attributValue);
    }
  } /* }}} */

	/**
	 * Get XML node, create it if not exists
	 *
	 * @param SimpleXMLElement $rootNode root node
	 * @param string $parentNodeName parent node name
	 * @param string $name name of node
	 *
	 * @return SimpleXMLElement
	 */
	protected function getXMLNode($rootNode, $parentNodeName, $name) { /* {{{ */
		$node = $rootNode->xpath($parentNodeName . '/' . $name);

		if (empty($node)) {
			$node = $rootNode->xpath($parentNodeName);
			$node = $node[0]->addChild($name);
		} else {
			$node = $node[0];
		}

		return $node;
	} /* }}} */

	/**
	 * Save config file
	 *
	 * @param string $configFilePath config file path
	 *
	 * @return true/false
	 */
	public function save($configFilePath=NULL) { /* {{{ */
    if (is_null($configFilePath))
      $configFilePath = $this->_configFilePath;

    // Load
    $xml = simplexml_load_string(file_get_contents($configFilePath));
    $this->getXMLNode($xml, '/', 'configuration');

    // XML Path: /configuration/site/display
    $this->getXMLNode($xml, '/configuration', 'site');
    $node = $this->getXMLNode($xml, '/configuration/site', 'display');
    $this->setXMLAttributValue($node, "siteName", $this->_siteName);
    $this->setXMLAttributValue($node, "footNote", $this->_footNote);
    $this->setXMLAttributValue($node, "printDisclaimer", $this->_printDisclaimer);
    $this->setXMLAttributValue($node, "language", $this->_language);
    $this->setXMLAttributValue($node, "availablelanguages", implode(',', $this->_availablelanguages));
    $this->setXMLAttributValue($node, "theme", $this->_theme);
    $this->setXMLAttributValue($node, "onePageMode", $this->_onePageMode);
    $this->setXMLAttributValue($node, "previewWidthList", $this->_previewWidthList);
    $this->setXMLAttributValue($node, "previewWidthMenuList", $this->_previewWidthMenuList);
    $this->setXMLAttributValue($node, "previewWidthDetail", $this->_previewWidthDetail);
    $this->setXMLAttributValue($node, "previewWidthDropFolderList", $this->_previewWidthDropFolderList);
    $this->setXMLAttributValue($node, "showFullPreview", $this->_showFullPreview);
    $this->setXMLAttributValue($node, "convertToPdf", $this->_convertToPdf);
    $this->setXMLAttributValue($node, "maxItemsPerPage", $this->_maxItemsPerPage);
    $this->setXMLAttributValue($node, "incItemsPerPage", $this->_incItemsPerPage);

    // XML Path: /configuration/site/edition
    $node = $this->getXMLNode($xml, '/configuration/site', 'edition');
    $this->setXMLAttributValue($node, "strictFormCheck", $this->_strictFormCheck);
    $this->setXMLAttributValue($node, "noDocumentFormFields", implode(',', $this->_noDocumentFormFields));
    $this->setXMLAttributValue($node, "viewOnlineFileTypes", $this->getViewOnlineFileTypesToString());
    $this->setXMLAttributValue($node, "editOnlineFileTypes", $this->getEditOnlineFileTypesToString());
    $this->setXMLAttributValue($node, "enableConverting", $this->_enableConverting);
    $this->setXMLAttributValue($node, "enableEmail", $this->_enableEmail);
    $this->setXMLAttributValue($node, "enableUsersView", $this->_enableUsersView);
		$this->setXMLAttributValue($node, "enableSessionList", $this->_enableSessionList);
		$this->setXMLAttributValue($node, "enableClipboard", $this->_enableClipboard);
		$this->setXMLAttributValue($node, "enableMenuTasks", $this->_enableMenuTasks);
		$this->setXMLAttributValue($node, "tasksInMenu", $this->_tasksInMenu);
		$this->setXMLAttributValue($node, "enableDropFolderList", $this->_enableDropFolderList);
		$this->setXMLAttributValue($node, "enableDropUpload", $this->_enableDropUpload);
		$this->setXMLAttributValue($node, "enableMultiUpload", $this->_enableMultiUpload);
    $this->setXMLAttributValue($node, "enableFolderTree", $this->_enableFolderTree);
    $this->setXMLAttributValue($node, "enableRecursiveCount", $this->_enableRecursiveCount);
    $this->setXMLAttributValue($node, "maxRecursiveCount", $this->_maxRecursiveCount);
    $this->setXMLAttributValue($node, "enableHelp", $this->_enableHelp);
    $this->setXMLAttributValue($node, "enableLanguageSelector", $this->_enableLanguageSelector);
    $this->setXMLAttributValue($node, "enableThemeSelector", $this->_enableThemeSelector);
    $this->setXMLAttributValue($node, "enableFullSearch", $this->_enableFullSearch);
    $this->setXMLAttributValue($node, "maxSizeForFullText", $this->_maxSizeForFullText);
    $this->setXMLAttributValue($node, "fullSearchEngine", $this->_fullSearchEngine);
    $this->setXMLAttributValue($node, "defaultSearchMethod", $this->_defaultSearchMethod);
    $this->setXMLAttributValue($node, "showSingleSearchHit", $this->_showSingleSearchHit);
    $this->setXMLAttributValue($node, "expandFolderTree", $this->_expandFolderTree);
    $this->setXMLAttributValue($node, "stopWordsFile", $this->_stopWordsFile);
    $this->setXMLAttributValue($node, "sortUsersInList", $this->_sortUsersInList);
    $this->setXMLAttributValue($node, "sortFoldersDefault", $this->_sortFoldersDefault);
    $this->setXMLAttributValue($node, "libraryFolder", $this->_libraryFolder);
    $this->setXMLAttributValue($node, "defaultDocPosition", $this->_defaultDocPosition);

    // XML Path: /configuration/site/calendar
    $node = $this->getXMLNode($xml, '/configuration/site', 'webdav');
		$this->setXMLAttributValue($node, "enableWebdavReplaceDoc", $this->_enableWebdavReplaceDoc);

    // XML Path: /configuration/site/calendar
    $node = $this->getXMLNode($xml, '/configuration/site', 'calendar');
    $this->setXMLAttributValue($node, "enableCalendar", $this->_enableCalendar);
    $this->setXMLAttributValue($node, "calendarDefaultView", $this->_calendarDefaultView);
    $this->setXMLAttributValue($node, "firstDayOfWeek", $this->_firstDayOfWeek);

    // XML Path: /configuration/system/server
    $this->getXMLNode($xml, '/configuration', 'system');
    $node = $this->getXMLNode($xml, '/configuration/system', 'server');
    $this->setXMLAttributValue($node, "rootDir", $this->_rootDir);
    $this->setXMLAttributValue($node, "httpRoot", $this->_httpRoot);
    $this->setXMLAttributValue($node, "contentDir", $this->_contentDir);
    $this->setXMLAttributValue($node, "cacheDir", $this->_cacheDir);
    $this->setXMLAttributValue($node, "stagingDir", $this->_stagingDir);
    $this->setXMLAttributValue($node, "luceneDir", $this->_luceneDir);
    $this->setXMLAttributValue($node, "dropFolderDir", $this->_dropFolderDir);
    $this->setXMLAttributValue($node, "backupDir", $this->_backupDir);
    $this->setXMLAttributValue($node, "checkOutDir", $this->_checkOutDir);
    $this->setXMLAttributValue($node, "createCheckOutDir", $this->_createCheckOutDir);
    $this->setXMLAttributValue($node, "repositoryUrl", $this->_repositoryUrl);
    $this->setXMLAttributValue($node, "proxyUrl", $this->_proxyUrl);
    $this->setXMLAttributValue($node, "proxyUser", $this->_proxyUser);
    $this->setXMLAttributValue($node, "proxyPassword", $this->_proxyPassword);
    $this->setXMLAttributValue($node, "logFileEnable", $this->_logFileEnable);
    $this->setXMLAttributValue($node, "logFileRotation", $this->_logFileRotation);
    $this->setXMLAttributValue($node, "enableLargeFileUpload", $this->_enableLargeFileUpload);
    $this->setXMLAttributValue($node, "partitionSize", $this->_partitionSize);
    $this->setXMLAttributValue($node, "maxUploadSize", $this->_maxUploadSize);
    $this->setXMLAttributValue($node, "enableXsendfile", $this->_enableXsendfile);

    // XML Path: /configuration/system/authentication
    $node = $this->getXMLNode($xml, '/configuration/system', 'authentication');
    $this->setXMLAttributValue($node, "enableGuestLogin", $this->_enableGuestLogin);
    $this->setXMLAttributValue($node, "enableGuestAutoLogin", $this->_enableGuestAutoLogin);
    $this->setXMLAttributValue($node, "enable2FactorAuthentication", $this->_enable2FactorAuthentication);
    $this->setXMLAttributValue($node, "enablePasswordForgotten", $this->_enablePasswordForgotten);
    $this->setXMLAttributValue($node, "passwordStrength", $this->_passwordStrength);
    $this->setXMLAttributValue($node, "passwordStrengthAlgorithm", $this->_passwordStrengthAlgorithm);
    $this->setXMLAttributValue($node, "passwordExpiration", $this->_passwordExpiration);
    $this->setXMLAttributValue($node, "passwordHistory", $this->_passwordHistory);
    $this->setXMLAttributValue($node, "loginFailure", $this->_loginFailure);
    $this->setXMLAttributValue($node, "autoLoginUser", $this->_autoLoginUser);
    $this->setXMLAttributValue($node, "quota", $this->_quota);
    $this->setXMLAttributValue($node, "undelUserIds", $this->_undelUserIds);
    $this->setXMLAttributValue($node, "encryptionKey", $this->_encryptionKey);
    $this->setXMLAttributValue($node, "cookieLifetime", $this->_cookieLifetime);
    $this->setXMLAttributValue($node, "defaultAccessDocs", $this->_defaultAccessDocs);
    $this->setXMLAttributValue($node, "restricted", $this->_restricted);
    $this->setXMLAttributValue($node, "enableUserImage", $this->_enableUserImage);
    $this->setXMLAttributValue($node, "disableSelfEdit", $this->_disableSelfEdit);

    // XML Path: /configuration/system/authentication/connectors
    foreach($this->_usersConnectors as $keyConn => $paramConn)
    {
      // search XML node
      $node = $xml->xpath('/configuration/system/authentication/connectors/connector[@type="'. $keyConn .'"]');

      // Just the first is configured
      if (isset($node))
      {
        if (count($node)>0)
        {
          $node = $node[0];
        }
        else
        {
          $nodeParent = $xml->xpath('/configuration/system/authentication/connectors');
          $node = $nodeParent[0]->addChild("connector");
        }

        foreach($paramConn as $key => $value)
        {
          $this->setXMLAttributValue($node, $key, $value);
        }

      } // isset($node)

    } // foreach

    // XML Path: /configuration/system/authentication/connectors
    // manage old settings parameters
    if (isset($this->_ldapHost) && (strlen($this->_ldapHost)>0))
    {
      if ($this->_ldapType == 1)
      {
        $node = $xml->xpath('/configuration/system/authentication/connectors/connector[@type="AD"]');
        $node = $node[0];
        $this->setXMLAttributValue($node, "accountDomainName", $this->_ldapAccountDomainName);
      }
      else
      {
        $node = $xml->xpath('/configuration/system/authentication/connectors/connector[@type="ldap"]');
        $node = $node[0];
      }

      $this->setXMLAttributValue($node, "host", $this->_ldapHost);
      $this->setXMLAttributValue($node, "port", $this->_ldapPort);
      $this->setXMLAttributValue($node, "baseDN", $this->_ldapBaseDN);
    }

    // XML Path: /configuration/system/database
    $node = $this->getXMLNode($xml, '/configuration/system', 'database');
    $this->setXMLAttributValue($node, "dbDriver", $this->_dbDriver);
    $this->setXMLAttributValue($node, "dbHostname", $this->_dbHostname);
    $this->setXMLAttributValue($node, "dbDatabase", $this->_dbDatabase);
    $this->setXMLAttributValue($node, "dbUser", $this->_dbUser);
    $this->setXMLAttributValue($node, "dbPass", $this->_dbPass);
    $this->setXMLAttributValue($node, "doNotCheckVersion", $this->_doNotCheckDBVersion);

    // XML Path: /configuration/system/smtp
    $node = $this->getXMLNode($xml, '/configuration/system', 'smtp');
    $this->setXMLAttributValue($node, "smtpServer", $this->_smtpServer);
    $this->setXMLAttributValue($node, "smtpPort", $this->_smtpPort);
    $this->setXMLAttributValue($node, "smtpSendFrom", $this->_smtpSendFrom);
    $this->setXMLAttributValue($node, "smtpUser", $this->_smtpUser);
    $this->setXMLAttributValue($node, "smtpPassword", $this->_smtpPassword);

    // XML Path: /configuration/advanced/display
    $advnode = $this->getXMLNode($xml, '/configuration', 'advanced');
    $node = $this->getXMLNode($xml, '/configuration/advanced', 'display');
    $this->setXMLAttributValue($node, "siteDefaultPage", $this->_siteDefaultPage);
    $this->setXMLAttributValue($node, "rootFolderID", $this->_rootFolderID);
    $this->setXMLAttributValue($node, "titleDisplayHack", $this->_titleDisplayHack);
    $this->setXMLAttributValue($node, "showMissingTranslations", $this->_showMissingTranslations);

    // XML Path: /configuration/advanced/authentication
    $node = $this->getXMLNode($xml, '/configuration/advanced', 'authentication');
    $this->setXMLAttributValue($node, "guestID", $this->_guestID);
    $this->setXMLAttributValue($node, "adminIP", $this->_adminIP);
    $this->setXMLAttributValue($node, "apiKey", $this->_apiKey);
    $this->setXMLAttributValue($node, "apiUserId", $this->_apiUserId);
    $this->setXMLAttributValue($node, "apiOrigin", $this->_apiOrigin);

    // XML Path: /configuration/advanced/edition
    $node = $this->getXMLNode($xml, '/configuration/advanced', 'edition');
    $this->setXMLAttributValue($node, "enableAdminRevApp", $this->_enableAdminRevApp);
    $this->setXMLAttributValue($node, "enableOwnerRevApp", $this->_enableOwnerRevApp);
    $this->setXMLAttributValue($node, "enableSelfRevApp", $this->_enableSelfRevApp);
    $this->setXMLAttributValue($node, "enableUpdateRevApp", $this->_enableUpdateRevApp);
    $this->setXMLAttributValue($node, "enableSelfReceipt", $this->_enableSelfReceipt);
    $this->setXMLAttributValue($node, "enableAdminReceipt", $this->_enableAdminReceipt);
    $this->setXMLAttributValue($node, "enableOwnerReceipt", $this->_enableOwnerReceipt);
    $this->setXMLAttributValue($node, "enableUpdateReceipt", $this->_enableUpdateReceipt);
    $this->setXMLAttributValue($node, "enableFilterReceipt", $this->_enableFilterReceipt);
    $this->setXMLAttributValue($node, "presetExpirationDate", $this->_presetExpirationDate);
    $this->setXMLAttributValue($node, "initialDocumentStatus", $this->_initialDocumentStatus);
    $this->setXMLAttributValue($node, "versioningFileName", $this->_versioningFileName);
    $this->setXMLAttributValue($node, "workflowMode", $this->_workflowMode);
    $this->setXMLAttributValue($node, "enableReceiptWorkflow", $this->_enableReceiptWorkflow);
    $this->setXMLAttributValue($node, "enableReceiptReject", $this->_enableReceiptReject);
    $this->setXMLAttributValue($node, "enableRevisionWorkflow", $this->_enableRevisionWorkflow);
    $this->setXMLAttributValue($node, "enableRevisionOneVoteReject", $this->_enableRevisionOneVoteReject);
    $this->setXMLAttributValue($node, "allowReviewerOnly", $this->_allowReviewerOnly);
    $this->setXMLAttributValue($node, "allowChangeRevAppInProcess", $this->_allowChangeRevAppInProcess);
    $this->setXMLAttributValue($node, "enableVersionDeletion", $this->_enableVersionDeletion);
    $this->setXMLAttributValue($node, "enableVersionModification", $this->_enableVersionModification);
    $this->setXMLAttributValue($node, "enableDuplicateDocNames", $this->_enableDuplicateDocNames);
    $this->setXMLAttributValue($node, "enableDuplicateSubFolderNames", $this->_enableDuplicateSubFolderNames);
    $this->setXMLAttributValue($node, "overrideMimeType", $this->_overrideMimeType);
    $this->setXMLAttributValue($node, "advancedAcl", $this->_advancedAcl);
    $this->setXMLAttributValue($node, "removeFromDropFolder", $this->_removeFromDropFolder);

    // XML Path: /configuration/advanced/notification
    $node = $this->getXMLNode($xml, '/configuration/advanced', 'notification');
    $this->setXMLAttributValue($node, "enableNotificationAppRev", $this->_enableNotificationAppRev);
    $this->setXMLAttributValue($node, "enableOwnerNotification", $this->_enableOwnerNotification);
    $this->setXMLAttributValue($node, "enableNotificationWorkflow", $this->_enableNotificationWorkflow);

    // XML Path: /configuration/advanced/server
    $node = $this->getXMLNode($xml, '/configuration/advanced', 'server');
    $this->setXMLAttributValue($node, "coreDir", $this->_coreDir);
    $this->setXMLAttributValue($node, "luceneClassDir", $this->_luceneClassDir);
    $this->setXMLAttributValue($node, "extraPath", $this->_extraPath);
    $this->setXMLAttributValue($node, "contentOffsetDir", $this->_contentOffsetDir);
    $this->setXMLAttributValue($node, "maxDirID", $this->_maxDirID);
    $this->setXMLAttributValue($node, "updateNotifyTime", $this->_updateNotifyTime);
    $this->setXMLAttributValue($node, "maxExecutionTime", $this->_maxExecutionTime);
    $this->setXMLAttributValue($node, "cmdTimeout", $this->_cmdTimeout);
    $this->setXMLAttributValue($node, "enableDebugMode", $this->_enableDebugMode);

		/* Check if there is still a converters list with a target attribute */
		$node = $xml->xpath('/configuration/advanced/converters[count(@*)=0]');
		if (count($node)>0) {
			$this->setXMLAttributValue($node[0], 'target', 'fulltext');
		}

		// XML Path: /configuration/advanced/converters
		foreach($this->_converters as $type=>$converters) {
			foreach($this->_converters[$type] as $mimeType => $cmd) {
				// search XML node
				$node = $xml->xpath('/configuration/advanced/converters[@target="'.$type.'"]/converter[@mimeType="'. $mimeType .'"]');

				if (count($node)>0) {
					if(trim($cmd)) {
						$node = $node[0];
						$node[0] = $cmd;
						$this->setXMLAttributValue($node, 'mimeType', $mimeType);
					} else {
						$node = $node[0];
						unset($node[0]);
					}
				} else {
					if(trim($cmd)) {
						$nodeParent = $xml->xpath('/configuration/advanced/converters[@target="'.$type.'"]');
						if(count($nodeParent) == 0) {
							$nodeParent = array($advnode->addChild("converters"));
							$this->setXMLAttributValue($nodeParent[0], 'target', $type);
						}
						$node = $nodeParent[0]->addChild("converter");
						$node[0] = $cmd;
						$this->setXMLAttributValue($node, 'mimeType', $mimeType);
					}
				}
			} // foreach
		} // foreach


    // XML Path: /configuration/extensions
    $extnodes = $xml->xpath('/configuration/extensions');
		if(!$extnodes) {
			$nodeParent = $xml->xpath('/configuration');
			$extnodes = $nodeParent[0]->addChild("extensions");
		} else {
			unset($xml->extensions);
			$extnodes = $xml->addChild("extensions");
		}
    foreach($this->_extensions as $name => $extension)
		{
      // search XML node
			$extnode = $extnodes->addChild('extension');
			$this->setXMLAttributValue($extnode, 'name', $name);
			$this->setXMLAttributValue($extnode, 'disable', $extension['__disable__'] ? 'true' : 'false');
			/* New code saves all parameters of the extension which have been set
			 * in configuration form.
			 */
			foreach($extension as $fieldname=>$confvalue) {
				if($fieldname != '___disable__' && $confvalue) {
				$parameter = $extnode->addChild('parameter');
				$parameter[0] = isset($extension[$fieldname]) ? (is_array($extension[$fieldname]) ? implode(',', $extension[$fieldname]) : $extension[$fieldname]) : '';
				$this->setXMLAttributValue($parameter, 'name', $fieldname);
				}
			}
			/* Old code saves those parameters listed in the configuration
			 * of the extension.
			 */
			/*
			foreach($GLOBALS['EXT_CONF'][$name]['config'] as $fieldname=>$conf) {
				$parameter = $extnode->addChild('parameter');
				$parameter[0] = isset($extension[$fieldname]) ? (is_array($extension[$fieldname]) ? implode(',', $extension[$fieldname]) : $extension[$fieldname]) : '';
				$this->setXMLAttributValue($parameter, 'name', $fieldname);
			}
			 */


    } // foreach

    // Save
    return $xml->asXML($configFilePath);
  } /* }}} */

	/**
	 * search and return Config File Path
	 * @return NULL|string Config File Path
	 */
	protected function searchConfigFilePath() { /* {{{ */
		$configFilePath = null;

		if($configDir = Settings::getConfigDir()) {
			if (file_exists($configDir."/settings.xml"))
				return $configDir."/settings.xml";
		}
		return $configFilePath;
	} /* }}} */

	/**
	 * Returns absolute path for configuration files respecting links
	 *
	 * This function checks all parent directories of the current script
	 * for a configuration directory named 'conf'. It doesn't check
	 * if that directory contains a configuration file.
	 * If none was found a final try will be made checking /etc/seeddms
	 * @return NULL|string config directory
	 */
	static function getConfigDir() { /* {{{ */
		$_tmp = dirname($_SERVER['SCRIPT_FILENAME']);
		$_arr = preg_split('/\//', rtrim(str_replace('\\', '/', $_tmp)));
		$configDir = null;
		/* new code starts here */
		while($_arr && !$configDir) {
			if(file_exists(implode('/', $_arr)."/conf/"))
				$configDir = implode('/', $_arr)."/conf/";
			else
				array_pop($_arr);
		}
		if(!$configDir) {
			if(file_exists('/etc/seeddms'))
				$configDir = '/etc/seeddms';
		}
		return $configDir;
		/* new code ends here */

		if(file_exists(implode('/', $_arr)."/conf/"))
			$configDir = implode('/', $_arr)."/conf/";
		else {
			array_pop($_arr);
			if(file_exists(implode('/', $_arr)."/conf/")) {
				$configDir = implode('/', $_arr)."/conf/";
			} else {
				if(file_exists('/etc/seeddms'))
					$configDir = '/etc/seeddms';
			}
		}

		return $configDir;
	} /* }}} */

	/**
	 * get URL from current page
	 *
	 * @return string
	 */
	protected function curPageURL() { /* {{{ */
	  $pageURL = 'http';

	  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
	    $pageURL .= "s";
	  }

	  $pageURL .= "://";

	  if ($_SERVER["SERVER_PORT"] != "80") {
	    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	  } else {
	    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	  }

	  return $pageURL;
	} /* }}} */


	/**
	 * Searches a file in the include_path
	 *
	 * @param string $file name of file to search
	 * @return string path where file was found
	 */
	protected function findInIncPath($file) { /* {{{ */
		$incarr = explode(PATH_SEPARATOR, ini_get('include_path'));
		$found = '';
		foreach($incarr as $path) {
			if(file_exists($path.DIRECTORY_SEPARATOR.$file)) {
				$found = $path;
			}
		}
		return $found;
	} /* }}} */

	/**
	 * Check parameters
	 *
	 *  @return array
	 */
	public function check($minversion) { /* {{{ */
		// suggestion rootdir
		if (file_exists("../inc/inc.Settings.php"))
			$rootDir = realpath ("../inc/inc.Settings.php");
		else if (file_exists("inc/inc.Settings.php"))
			$rootDir = realpath ("inc/inc.Settings.php");
		else {
			echo "Fatal error : inc/inc.Settings.php not found";
			exit;
		}
		$rootDir = str_replace ("\\", "/" , $rootDir);
		$rootDir = str_replace ("inc/inc.Settings.php", "" , $rootDir);

		// result
		$result = array();

		// $this->_rootDir
		if (!file_exists($this->_rootDir ."inc/inc.Settings.php")) {
			$result["rootDir"] = array(
				"status" => "notfound",
				"type" => "error",
				"currentvalue" => $this->_rootDir,
				"suggestionvalue" => $rootDir
				);
		}

		// TODO
		// $this->_coreDir
		if($this->_coreDir) {
			if (!file_exists($this->_coreDir ."Core.php")) {
				$result["coreDir"] = array(
					"status" => "notfound",
					"type" => "error",
					"currentvalue" => $this->_coreDir,
					"suggestionvalue" => $rootDir
					);
			}
		} else {
			$found = Settings::findInIncPath('SeedDMS/Core.php');
			if(!$found) {
				$result["coreDir"] = array(
					"status" => "notfound",
					"type" => "error",
					"currentvalue" => $this->_coreDir,
					"suggestionvalue" => $rootDir
					);
			}
		}

		// $this->_httpRoot
		$tmp = $this->curPageURL();
		$tmp = str_replace ("install.php", "" , $tmp);
#		if (strpos($tmp, $this->_httpRoot) === false) {
#			$result["httpRoot"] = array(
#				"status" => "notfound",
#				"type" => "error",
#				"currentvalue" => $this->_httpRoot,
#				"suggestionvalue" => $tmp
#				);
#		}

		// $this->_contentDir
		if (!file_exists($this->_contentDir)) {
			if (file_exists($rootDir.'data/')) {
					$result["contentDir"] = array(
						"status" => "notfound",
						"type" => "error",
						"currentvalue" => $this->_contentDir,
						"suggestionvalue" => $rootDir . 'data/'
					);
			} else {
					$result["contentDir"] = array(
						"status" => "notfound",
						"type" => "error",
						"currentvalue" => $this->_contentDir,
						"suggestion" => "createdirectory"
					);
			}
		} else {
			$errorMsgPerms = null;

			// perms
			if (!@mkdir($this->_contentDir.'/_CHECK_TEST_')) {
				$errorMsgPerms .= "Create folder - ";
			} else {
				if (is_bool(file_put_contents($this->_contentDir.'/_CHECK_TEST_/_CHECK_TEST_', ""))) {
					$errorMsgPerms .= "Create file - ";
				} else {
					if (!unlink ($this->_contentDir.'/_CHECK_TEST_/_CHECK_TEST_')) {
						$errorMsgPerms .= "Delete file - ";
					}
				}

				if (!rmdir($this->_contentDir.'/_CHECK_TEST_')) {
					$errorMsgPerms .= "Delete folder";
				}
			}

			if (!is_null($errorMsgPerms)) {
				$result["contentDir"] = array(
					"status" => "perms",
					"type" => "error",
					"currentvalue" => $this->_contentDir,
					"systemerror" => $errorMsgPerms
				);
			}
		}

		// $this->_stagingDir
		if (!file_exists($this->_stagingDir)) {
			$result["stagingDir"] = array(
				"status" => "notfound",
				"type" => "error",
				"currentvalue" => $this->_stagingDir,
				"suggestionvalue" => $this->_contentDir . 'staging/'
			);
		}

		// $this->_luceneDir
		if (!file_exists($this->_luceneDir)) {
			$result["luceneDir"] = array(
				"status" => "notfound",
				"type" => "error",
				"currentvalue" => $this->_luceneDir,
				"suggestionvalue" => $this->_contentDir . 'lucene/'
			);
		}

		$bCheckDB = true;
		// $this->_ADOdbPath
		/* not needed anymore after switch to PDO
		if($this->_ADOdbPath) {
			if (!file_exists($this->_ADOdbPath."/adodb/adodb.inc.php")) {
				$bCheckDB = false;
				if (file_exists($rootDir."adodb/adodb.inc.php")) {
					$result["ADOdbPath"] = array(
						"status" => "notfound",
						"type" => "error",
						"currentvalue" => $this->_ADOdbPath,
						"suggestionvalue" => $rootDir
						);
				} else {
					$result["ADOdbPath"] = array(
						"status" => "notfound",
						"type" => "error",
						"currentvalue" => $this->_ADOdbPath,
						"suggestion" => "installADOdb"
						);
				}
			}
		} else {
			$found = Settings::findInIncPath('adodb/adodb.inc.php');
			if(!$found) {
				$bCheckDB = false;
				$result["ADOdbPath"] = array(
					"status" => "notfound",
					"type" => "error",
					"currentvalue" => $this->_ADOdbPath,
					"suggestion" => "installADOdb"
					);
			}
		}
		*/

		// database
		if ($bCheckDB) {
			try {
				$dsn = "";
				switch($this->_dbDriver) {
					case 'mysql':
					case 'mysqli':
					case 'mysqlnd':
					case 'pgsql':
						$tmp = explode(":", $this->_dbHostname);
						$dsn = $this->_dbDriver.":dbname=".$this->_dbDatabase.";host=".$tmp[0];
						if(!empty($tmp[1]))
							$dsn .= ";port=".$tmp[1];
						break;
					case 'sqlite':
						$dsn = $this->_dbDriver.":".$this->_dbDatabase;
						break;
					default:
						$result["dbDriver"] = array(
							"status" => "notfound",
							"type" => "error",
							"currentvalue" => $this->_dbDriver,
							"suggestionvalue" => "mysql|sqlite|pgsql"
						);
				}
				if($dsn) {
					$connTmp = new PDO($dsn, $this->_dbUser, $this->_dbPass);
					/* Check if there wasn't a previous error while searching for
					 * SeedDMS_Core.
					 */
					if(!isset($result["coreDir"])) {
						/* Instanciate SeedDMS_Core to check version */
						if(!empty($this->_coreDir))
							require_once($this->_coreDir.'/Core.php');
						else
							require_once('SeedDMS/Core.php');
						$tmpcore = new SeedDMS_Core_DMS(null, $this->_contentDir);
						$db = new SeedDMS_Core_DatabaseAccess($this->_dbDriver, $this->_dbHostname, $this->_dbUser, $this->_dbPass, $this->_dbDatabase);
						if(!$db->connect()) {
							$result["dbDatabase"] = array(
								"status" => "error",
								"type" => "error",
								"currentvalue" => '[host, user, database] -> [' . $this->_dbHostname . ',' . $this->_dbUser . ',' . $this->_dbDatabase .']',
								"systemerror" => $connTmp->ErrorMsg()
								);
						} else {
						/*
							$dms = new SeedDMS_Core_DMS($db, $this->_contentDir.$this->_contentOffsetDir);

							if(!$dms->checkVersion()) {
								$result["dbVersion"] = array(
									"status" => "error",
									"type" => "error",
									"currentvalue" => $dms->version,
									"suggestion" => 'updateDatabase'
									);
							}
						*/
						}
						$connTmp = null;
					}
				}
			} catch(Exception $e) {
				$result["dbDatabase"] = array(
					"status" => "error",
					"type" => "error",
					"currentvalue" => '[host, user, database] -> [' . $this->_dbHostname . ',' . $this->_dbUser . ',' . $this->_dbDatabase .']',
					"systemerror" => $e->getMessage()
				);
			}
		}

		return $result;
	} /* }}} */

	/**
	 * Check system configuration
	 *
	 * @return array
	 *
	 */
	public function checkSystem() { /* {{{ */
		// result
		$result = array();

		// Check Apache configuration
		if (function_exists("apache_get_version")) {
			$loaded_extensions = apache_get_modules();
			if (!in_array("mod_rewrite", $loaded_extensions)) {
				$result["apache_mod_rewrite"] = array(
					"status" => "notfound",
					"type" => "error",
					"suggestion" => "activate_module"
				);
			}
		}

		// Check PHP version
		if (version_compare(PHP_VERSION, '5.6.38') < 0) {
			$result["php_version"] = array(
				"status" => "versiontolow",
				"type" => "error",
				"suggestion" => "upgrade_php"
			);
		}

		// Check PHP configuration
		$loaded_extensions = get_loaded_extensions();
		// gd2
		if (!in_array("gd", $loaded_extensions)) {
			$result["php_gd2"] = array(
				"status" => "notfound",
				"type" => "error",
				"suggestion" => "activate_php_extension"
			);
		}

		// mbstring
		if (!in_array("mbstring", $loaded_extensions)) {
			$result["php_mbstring"] = array(
				"status" => "notfound",
				"type" => "error",
				"suggestion" => "activate_php_extension"
			);
		}

		// database
		if (!in_array('pdo_'.$this->_dbDriver, $loaded_extensions)) {
			$result["php_dbDriver"] = array(
				"status" => "notfound",
				"type" => "error",
				"currentvalue" => 'pdo_'.$this->_dbDriver,
				"suggestion" => "activate_php_extension"
			);
		}

		// Check for Log.php
		// Do not check for Log anymore, because it is in the vendor directory
		/*
		if (!Settings::findInIncPath('Log.php')) {
			$result["pear_log"] = array(
				"status" => "notfound",
				"type" => "error",
				"suggestion" => "install_pear_package_log"
			);
		}
		 */

		// Check for HTTP/WebDAV/Server.php
		if (!Settings::findInIncPath('HTTP/WebDAV/Server.php')) {
			$result["pear_webdav"] = array(
				"status" => "notfound",
				"type" => "warning",
				"suggestion" => "install_pear_package_webdav"
			);
		}

		// Check for Zend/Search/Lucene.php
		if (!Settings::findInIncPath('Zend/Search/Lucene.php')) {
			$result["zendframework"] = array(
				"status" => "notfound",
				"type" => "warning",
				"suggestion" => "install_zendframework"
			);
		}
		return $result;
	} /* }}} */

	/**
	 * Check if extension is disabled
	 *
	 * @param string $extname name of extension
	 * @return true if extension is disabled
	 */
	public function extensionIsDisabled($extname) { /* {{{ */
		if(array_key_exists($extname, $this->_extensions))
			return $this->_extensions[$extname]['__disable__'];

		return false;
	} /* }}} */

	/**
	 * Set extension enabled
	 *
	 * @param string $extname name of extension
	 * @return 
	 */
	public function enableExtension($extname) { /* {{{ */
		if(!array_key_exists($extname, $this->_extensions))
			$this->_extensions[$extname] = array();
		$this->_extensions[$extname]['__disable__'] = false;
	} /* }}} */

	/**
	 * Set extension enabled
	 *
	 * @param string $extname name of extension
	 * @return 
	 */
	public function disableExtension($extname) { /* {{{ */
		if(!array_key_exists($extname, $this->_extensions))
			$this->_extensions[$extname] = array();
		$this->_extensions[$extname]['__disable__'] = true;
	} /* }}} */

} /* }}} */

