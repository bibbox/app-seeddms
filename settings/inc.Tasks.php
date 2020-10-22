<?php

require_once("inc.ClassSchedulerTaskBase.php");

/**
 * Class containing methods for running a scheduled task
 *
 * @author  Uwe Steinmann <uwe@steinmann.cx>
 * @package SeedDMS
 * @subpackage  trash
 */
class SeedDMS_ExpiredDocumentsTask extends SeedDMS_SchedulerTaskBase { /* {{{ */

        /**
         * Run the task
         *
         * @param $task task to be executed
         * @param $dms dms
         * @return boolean true if task was executed succesfully, otherwise false
         */
        public function execute($task) {
                $dms = $this->dms;
                $taskparams = $task->getParameter();
                $docs = $dms->getDocumentsExpired(intval($taskparams['days']));
                foreach($docs as $doc) {
                        echo $doc->getName()."\n";
                }
                return true;
        }

        public function getDescription() {
                return 'Check for expired documents and set the document status';
        }

        public function getAdditionalParams() {
                return array(
                        array(
                                'name'=>'days',
                                'type'=>'integer',
                                'description'=> 'Number of days to check for. Negative values will look into the past. 0 will just check for documents expiring the current day. Keep in mind that the document is$
                        )
                );
        }
} /* }}} */

$GLOBALS['SEEDDMS_SCHEDULER']['tasks']['core']['expireddocs'] = 'SeedDMS_ExpiredDocumentsTask';
