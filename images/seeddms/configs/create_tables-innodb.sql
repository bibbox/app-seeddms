--
-- Table structure for table `tblACLs`
--

CREATE TABLE `tblACLs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` int(11) NOT NULL DEFAULT '0',
  `targetType` tinyint(4) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '-1',
  `groupID` int(11) NOT NULL DEFAULT '-1',
  `mode` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblCategory`
--

CREATE TABLE `tblCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblAttributeDefinitions`
--

CREATE TABLE `tblAttributeDefinitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `objtype` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `multiple` tinyint(4) NOT NULL DEFAULT '0',
  `minvalues` int(11) NOT NULL DEFAULT '0',
  `maxvalues` int(11) NOT NULL DEFAULT '0',
  `valueset` text DEFAULT NULL,
  `regex` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers`
--

CREATE TABLE `tblUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `language` varchar(32) NOT NULL,
  `theme` varchar(32) NOT NULL,
  `comment` text NOT NULL,
  `role` smallint(1) NOT NULL DEFAULT '0',
  `hidden` smallint(1) NOT NULL DEFAULT '0',
  `pwdExpiration` datetime DEFAULT NULL,
  `loginfailures` tinyint(4) NOT NULL DEFAULT '0',
  `disabled` smallint(1) NOT NULL DEFAULT '0',
  `quota` bigint(20) DEFAULT NULL,
  `homefolder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUserPasswordRequest`
--

CREATE TABLE `tblUserPasswordRequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblUserPasswordRequest_user` (`userID`),
  CONSTRAINT `tblUserPasswordRequest_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUserPasswordHistory`
--

CREATE TABLE `tblUserPasswordHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `pwd` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblUserPasswordHistory_user` (`userID`),
  CONSTRAINT `tblUserPasswordHistory_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUserImages`
--

CREATE TABLE `tblUserImages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `image` blob NOT NULL,
  `mimeType` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `tblUserImages_user` (`userID`),
  CONSTRAINT `tblUserImages_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblFolders`
--

CREATE TABLE `tblFolders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `folderList` text NOT NULL,
  `comment` text,
  `date` int(12) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `inheritAccess` tinyint(1) NOT NULL DEFAULT '1',
  `defaultAccess` tinyint(4) NOT NULL DEFAULT '0',
  `sequence` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `tblFolders_owner` (`owner`),
  CONSTRAINT `tblFolders_owner` FOREIGN KEY (`owner`) REFERENCES `tblUsers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tblUsers` ADD CONSTRAINT `tblUsers_homefolder` FOREIGN KEY (`homefolder`) REFERENCES `tblFolders` (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `tblFolderAttributes`
--

CREATE TABLE `tblFolderAttributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder` int(11) DEFAULT NULL,
  `attrdef` int(11) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `folder` (`folder`,`attrdef`),
  KEY `tblFolderAttributes_attrdef` (`attrdef`),
  CONSTRAINT `tblFolderAttributes_attrdef` FOREIGN KEY (`attrdef`) REFERENCES `tblAttributeDefinitions` (`id`),
  CONSTRAINT `tblFolderAttributes_folder` FOREIGN KEY (`folder`) REFERENCES `tblFolders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocuments`
--

CREATE TABLE `tblDocuments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `comment` text,
  `date` int(12) DEFAULT NULL,
  `expires` int(12) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `folder` int(11) DEFAULT NULL,
  `folderList` text NOT NULL,
  `inheritAccess` tinyint(1) NOT NULL DEFAULT '1',
  `defaultAccess` tinyint(4) NOT NULL DEFAULT '0',
  `locked` int(11) NOT NULL DEFAULT '-1',
  `keywords` text NOT NULL,
  `sequence` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tblDocuments_folder` (`folder`),
  KEY `tblDocuments_owner` (`owner`),
  CONSTRAINT `tblDocuments_folder` FOREIGN KEY (`folder`) REFERENCES `tblFolders` (`id`),
  CONSTRAINT `tblDocuments_owner` FOREIGN KEY (`owner`) REFERENCES `tblUsers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentAttributes`
--

CREATE TABLE `tblDocumentAttributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) DEFAULT NULL,
  `attrdef` int(11) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document` (`document`,`attrdef`),
  KEY `tblDocumentAttributes_attrdef` (`attrdef`),
  CONSTRAINT `tblDocumentAttributes_attrdef` FOREIGN KEY (`attrdef`) REFERENCES `tblAttributeDefinitions` (`id`),
  CONSTRAINT `tblDocumentAttributes_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentApprovers`
--

CREATE TABLE `tblDocumentApprovers` (
  `approveID` int(11) NOT NULL AUTO_INCREMENT,
  `documentID` int(11) NOT NULL DEFAULT '0',
  `version` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `required` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`approveID`),
  UNIQUE KEY `documentID` (`documentID`,`version`,`type`,`required`),
  CONSTRAINT `tblDocumentApprovers_document` FOREIGN KEY (`documentID`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentApproveLog`
--

CREATE TABLE `tblDocumentApproveLog` (
  `approveLogID` int(11) NOT NULL AUTO_INCREMENT,
  `approveID` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`approveLogID`),
  KEY `tblDocumentApproveLog_approve` (`approveID`),
  KEY `tblDocumentApproveLog_user` (`userID`),
  CONSTRAINT `tblDocumentApproveLog_approve` FOREIGN KEY (`approveID`) REFERENCES `tblDocumentApprovers` (`approveID`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentApproveLog_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentContent`
--

CREATE TABLE `tblDocumentContent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL DEFAULT '0',
  `version` smallint(5) unsigned NOT NULL,
  `comment` text,
  `date` int(12) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `dir` varchar(255) NOT NULL DEFAULT '',
  `orgFileName` varchar(150) NOT NULL DEFAULT '',
  `fileType` varchar(10) NOT NULL DEFAULT '',
  `mimeType` varchar(100) NOT NULL DEFAULT '',
  `fileSize` bigint(20) DEFAULT NULL,
  `checksum` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document` (`document`,`version`),
  CONSTRAINT `tblDocumentContent_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentContentAttributes`
--

CREATE TABLE `tblDocumentContentAttributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` int(11) DEFAULT NULL,
  `attrdef` int(11) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content` (`content`,`attrdef`),
  KEY `tblDocumentContentAttributes_attrdef` (`attrdef`),
  CONSTRAINT `tblDocumentContentAttributes_attrdef` FOREIGN KEY (`attrdef`) REFERENCES `tblAttributeDefinitions` (`id`),
  CONSTRAINT `tblDocumentContentAttributes_document` FOREIGN KEY (`content`) REFERENCES `tblDocumentContent` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentLinks`
--

CREATE TABLE `tblDocumentLinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL DEFAULT '0',
  `target` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tblDocumentLinks_document` (`document`),
  KEY `tblDocumentLinks_target` (`target`),
  KEY `tblDocumentLinks_user` (`userID`),
  CONSTRAINT `tblDocumentLinks_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentLinks_target` FOREIGN KEY (`target`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentLinks_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentFiles`
--

CREATE TABLE `tblDocumentFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL DEFAULT '0',
  `version` smallint(5) unsigned NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `comment` text,
  `name` varchar(150) DEFAULT NULL,
  `date` int(12) DEFAULT NULL,
  `dir` varchar(255) NOT NULL DEFAULT '',
  `orgFileName` varchar(150) NOT NULL DEFAULT '',
  `fileType` varchar(10) NOT NULL DEFAULT '',
  `mimeType` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `tblDocumentFiles_document` (`document`),
  KEY `tblDocumentFiles_user` (`userID`),
  CONSTRAINT `tblDocumentFiles_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentFiles_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentLocks`
--

CREATE TABLE `tblDocumentLocks` (
  `document` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`document`),
  KEY `tblDocumentLocks_user` (`userID`),
  CONSTRAINT `tblDocumentLocks_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentLocks_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentReviewers`
--

CREATE TABLE `tblDocumentReviewers` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `documentID` int(11) NOT NULL DEFAULT '0',
  `version` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `required` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewID`),
  UNIQUE KEY `documentID` (`documentID`,`version`,`type`,`required`),
  CONSTRAINT `tblDocumentReviewers_document` FOREIGN KEY (`documentID`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentReviewLog`
--

CREATE TABLE `tblDocumentReviewLog` (
  `reviewLogID` int(11) NOT NULL AUTO_INCREMENT,
  `reviewID` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewLogID`),
  KEY `tblDocumentReviewLog_review` (`reviewID`),
  KEY `tblDocumentReviewLog_user` (`userID`),
  CONSTRAINT `tblDocumentReviewLog_review` FOREIGN KEY (`reviewID`) REFERENCES `tblDocumentReviewers` (`reviewID`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentReviewLog_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentStatus`
--

CREATE TABLE `tblDocumentStatus` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `documentID` int(11) NOT NULL DEFAULT '0',
  `version` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`statusID`),
  UNIQUE KEY `documentID` (`documentID`,`version`),
  CONSTRAINT `tblDocumentStatus_document` FOREIGN KEY (`documentID`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentStatusLog`
--

CREATE TABLE `tblDocumentStatusLog` (
  `statusLogID` int(11) NOT NULL AUTO_INCREMENT,
  `statusID` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statusLogID`),
  KEY `statusID` (`statusID`),
  KEY `tblDocumentStatusLog_user` (`userID`),
  CONSTRAINT `tblDocumentStatusLog_status` FOREIGN KEY (`statusID`) REFERENCES `tblDocumentStatus` (`statusID`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentStatusLog_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblGroups`
--

CREATE TABLE `tblGroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblGroupMembers`
--

CREATE TABLE `tblGroupMembers` (
  `groupID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `manager` smallint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `groupID` (`groupID`,`userID`),
  KEY `tblGroupMembers_user` (`userID`),
  CONSTRAINT `tblGroupMembers_group` FOREIGN KEY (`groupID`) REFERENCES `tblGroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblGroupMembers_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblKeywordCategories`
--

CREATE TABLE `tblKeywordCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `owner` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblKeywords`
--

CREATE TABLE `tblKeywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblKeywords_category` (`category`),
  CONSTRAINT `tblKeywords_category` FOREIGN KEY (`category`) REFERENCES `tblKeywordCategories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDocumentCategory`
--

CREATE TABLE `tblDocumentCategory` (
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `documentID` int(11) NOT NULL DEFAULT '0',
  KEY `tblDocumentCategory_category` (`categoryID`),
  KEY `tblDocumentCategory_document` (`documentID`),
  CONSTRAINT `tblDocumentCategory_category` FOREIGN KEY (`categoryID`) REFERENCES `tblCategory` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblDocumentCategory_document` FOREIGN KEY (`documentID`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblNotify`
--

CREATE TABLE `tblNotify` (
  `target` int(11) NOT NULL DEFAULT '0',
  `targetType` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '-1',
  `groupID` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`target`,`targetType`,`userID`,`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblSessions`
--

CREATE TABLE `tblSessions` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `lastAccess` int(11) NOT NULL DEFAULT '0',
  `theme` varchar(30) NOT NULL DEFAULT '',
  `language` varchar(30) NOT NULL DEFAULT '',
  `clipboard` text,
  `su` int(11) DEFAULT NULL,
  `splashmsg` text,
  PRIMARY KEY (`id`),
  KEY `tblSessions_user` (`userID`),
  CONSTRAINT `tblSessions_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblMandatoryReviewers`
--

CREATE TABLE `tblMandatoryReviewers` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `reviewerUserID` int(11) NOT NULL DEFAULT '0',
  `reviewerGroupID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`reviewerUserID`,`reviewerGroupID`),
  CONSTRAINT `tblMandatoryReviewers_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblMandatoryApprovers`
--

CREATE TABLE `tblMandatoryApprovers` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `approverUserID` int(11) NOT NULL DEFAULT '0',
  `approverGroupID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`approverUserID`,`approverGroupID`),
  CONSTRAINT `tblMandatoryApprovers_user` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblEvents`
--

CREATE TABLE `tblEvents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `comment` text,
  `start` int(12) DEFAULT NULL,
  `stop` int(12) DEFAULT NULL,
  `date` int(12) DEFAULT NULL,
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowStates`
--

CREATE TABLE `tblWorkflowStates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `visibility` smallint(5) DEFAULT '0',
  `maxtime` int(11) DEFAULT '0',
  `precondfunc` text,
  `documentstatus` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowActions`
--

CREATE TABLE `tblWorkflowActions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflows`
--

CREATE TABLE `tblWorkflows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `initstate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblWorkflow_initstate` (`initstate`),
  CONSTRAINT `tblWorkflow_initstate` FOREIGN KEY (`initstate`) REFERENCES `tblWorkflowStates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowTransitions`
--

CREATE TABLE `tblWorkflowTransitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workflow` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `nextstate` int(11) DEFAULT NULL,
  `maxtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tblWorkflowTransitions_workflow` (`workflow`),
  KEY `tblWorkflowTransitions_state` (`state`),
  KEY `tblWorkflowTransitions_action` (`action`),
  KEY `tblWorkflowTransitions_nextstate` (`nextstate`),
  CONSTRAINT `tblWorkflowTransitions_action` FOREIGN KEY (`action`) REFERENCES `tblWorkflowActions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowTransitions_nextstate` FOREIGN KEY (`nextstate`) REFERENCES `tblWorkflowStates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowTransitions_state` FOREIGN KEY (`state`) REFERENCES `tblWorkflowStates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowTransitions_workflow` FOREIGN KEY (`workflow`) REFERENCES `tblWorkflows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowTransitionUsers`
--

CREATE TABLE `tblWorkflowTransitionUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transition` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tblWorkflowTransitionUsers_transition` (`transition`),
  KEY `tblWorkflowTransitionUsers_userid` (`userid`),
  CONSTRAINT `tblWorkflowTransitionUsers_transition` FOREIGN KEY (`transition`) REFERENCES `tblWorkflowTransitions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowTransitionUsers_userid` FOREIGN KEY (`userid`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowTransitionGroups`
--

CREATE TABLE `tblWorkflowTransitionGroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transition` int(11) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `minusers` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tblWorkflowTransitionGroups_transition` (`transition`),
  KEY `tblWorkflowTransitionGroups_groupid` (`groupid`),
  CONSTRAINT `tblWorkflowTransitionGroups_groupid` FOREIGN KEY (`groupid`) REFERENCES `tblGroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowTransitionGroups_transition` FOREIGN KEY (`transition`) REFERENCES `tblWorkflowTransitions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowLog`
--

CREATE TABLE `tblWorkflowLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) DEFAULT NULL,
  `version` smallint(5) DEFAULT NULL,
  `workflow` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `transition` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `tblWorkflowLog_document` (`document`),
  KEY `tblWorkflowLog_workflow` (`workflow`),
  KEY `tblWorkflowLog_userid` (`userid`),
  KEY `tblWorkflowLog_transition` (`transition`),
  CONSTRAINT `tblWorkflowLog_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowLog_transition` FOREIGN KEY (`transition`) REFERENCES `tblWorkflowTransitions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowLog_userid` FOREIGN KEY (`userid`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowLog_workflow` FOREIGN KEY (`workflow`) REFERENCES `tblWorkflows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowDocumentContent`
--

CREATE TABLE `tblWorkflowDocumentContent` (
  `parentworkflow` int(11) DEFAULT '0',
  `workflow` int(11) DEFAULT NULL,
  `document` int(11) DEFAULT NULL,
  `version` smallint(5) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  KEY `tblWorkflowDocument_document` (`document`),
  KEY `tblWorkflowDocument_workflow` (`workflow`),
  KEY `tblWorkflowDocument_state` (`state`),
  CONSTRAINT `tblWorkflowDocument_document` FOREIGN KEY (`document`) REFERENCES `tblDocuments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowDocument_state` FOREIGN KEY (`state`) REFERENCES `tblWorkflowStates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowDocument_workflow` FOREIGN KEY (`workflow`) REFERENCES `tblWorkflows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkflowMandatoryWorkflow`
--

CREATE TABLE `tblWorkflowMandatoryWorkflow` (
  `userid` int(11) DEFAULT NULL,
  `workflow` int(11) DEFAULT NULL,
  UNIQUE KEY `userid` (`userid`,`workflow`),
  KEY `tblWorkflowMandatoryWorkflow_workflow` (`workflow`),
  CONSTRAINT `tblWorkflowMandatoryWorkflow_userid` FOREIGN KEY (`userid`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tblWorkflowMandatoryWorkflow_workflow` FOREIGN KEY (`workflow`) REFERENCES `tblWorkflows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblVersion`
--

CREATE TABLE `tblVersion` (
  `date` datetime NOT NULL,
  `major` smallint(6) DEFAULT NULL,
  `minor` smallint(6) DEFAULT NULL,
  `subminor` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Initial content for database
--

INSERT INTO tblUsers VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'address@server.com', '', '', '', 1, 0, NULL, 0, 0, 0, NULL);
INSERT INTO tblUsers VALUES (2, 'guest', NULL, 'Guest User', NULL, '', '', '', 2, 0, NULL, 0, 0, 0, NULL);
INSERT INTO tblFolders VALUES (1, 'DMS', 0, '', 'DMS root', UNIX_TIMESTAMP(), 1, 0, 2, 0);
INSERT INTO tblVersion VALUES (NOW(), 5, 1, 0);
