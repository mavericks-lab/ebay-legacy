<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 2/13/2016
     * Time: 2:50 PM
     */

    namespace Maverickslab\Ebay;


    class Report
    {
        use InjectAPIRequester;

        //schedule a report job
        public function scheduleJob($token, $uuid)
        {
            return $this->requester->lmsRequest([
                'token'          => $token,
                'operation_name' => 'startDownloadJob',
                'service_name'   => 'BulkDataExchangeService',
                'job_type'       => 'ActiveInventoryReport',
                'uuid'           => $uuid
            ]);
        }

        //check if the job has been completed
        public function checkJobStatus($token, $job_id)
        {
            return $this->requester->lmsRequest([
                'token'          => $token,
                'operation_name' => 'getJobStatus',
                'service_name'   => 'BulkDataExchangeService',
                'job_type'       => 'ActiveInventoryReport',
                'job_id'         => $job_id
            ]);
        }

        //download the file
        public function download($token, $job_id, $file_reference_id)
        {
            return $this->requester->lmsRequest([
                'token'             => $token,
                'operation_name'    => 'downloadFile',
                'service_name'      => 'FileTransferService',
                'job_type'          => 'ActiveInventoryReport',
                'task_reference_id' => $job_id,
                'file_reference_id' => $file_reference_id
            ]);

        }
    }