<?php
/**
 * Created by PhpStorm.
 * User: lilp08
 * Date: 2018/11/6
 * Time: 10:39
 */

namespace AliYunSls;

use Aliyun_Log_Client;
use Aliyun_log_Models_ListLogstoresRequest;
use Aliyun_Log_Models_LogItem;
use Aliyun_Log_Models_PutLogsRequest;
use Aliyun_Log_Models_ListTopicsRequest;
use Aliyun_Log_Models_GetHistogramsRequest;
use Aliyun_Log_Models_GetLogsRequest;

class AliYunSls {

    protected $client;

    protected $project;

    protected $logStore;

    public function __construct(string $endpoint = '', string $accessKeyId = '', string $accessKey = '', string $project, string $logStore = '')
    {

        $this->client = new Aliyun_Log_Client($endpoint, $accessKeyId, $accessKey);
        $this->project = $project;
        $this->logstore = $logStore;
    }


    /**
     * 列出Project下的所有Logstore名称。
     * @param string $project
     * @return \Aliyun_Log_Models_ListLogstoresResponse
     * @throws \Aliyun_Log_Exception
     */
    public function listLogstores($project = '')
    {
        $project = $project ?  : $this->project;
        $request = new Aliyun_log_Models_ListLogstoresRequest($project);
        $response = $this->client->listLogstores($request);
        return $response;
    }

    /**
     * 向指定的Logstore写入日志。
     * @param $topic
     * @param $contents
     * @param string $project
     * @param string $logstore
     * @return bool
     * @throws \Aliyun_Log_Exception
     */
    public function putLogs($topic, $contents, $project = '', $logstore = '')
    {
        $project = $project ?  : $this->project;
        $logstore = $logstore ?  : $this->logstore;
        $log_item = new Aliyun_Log_Models_LogItem();
        $log_item->setTime(time());
        $log_item->setContents($contents);
        $logitems = [
            $log_item
        ];
        $request = new Aliyun_Log_Models_PutLogsRequest($project, $logstore, $topic, null, $logitems);
        $response = $this->client->putLogs($request);
        return array_get($response->getAllHeaders(), '_info.http_code') === 200;
    }

    /**
     * 列出Logstore中的日志主题。
     * @param string $project
     * @param string $logstore
     * @return \Aliyun_Log_Models_ListTopicsResponse
     * @throws \Aliyun_Log_Exception
     */
    public function listTopics($project = '', $logstore = '')
    {
        $project = $project ?  : $this->project;
        $logstore = $logstore ?  : $this->logstore;
        $request = new Aliyun_Log_Models_ListTopicsRequest($project, $logstore);
        $response = $this->client->listTopics($request);
        return $response;
    }

    /**
     * 查询Logstore中的日志在时间轴上的分布。
     * @param null $from
     * @param null $to
     * @param null $topic
     * @param null $query
     * @param null $project
     * @param null $logstore
     * @return \Aliyun_Log_Models_GetHistogramsResponse
     * @throws \Aliyun_Log_Exception
     */
    public function getHistograms($from = null, $to = null, $topic = null, $query = null, $project = null, $logstore = null)
    {
        $project = $project ?  : $this->project;
        $logstore = $logstore ?  : $this->logstore;
        $request = new Aliyun_Log_Models_GetHistogramsRequest($project, $logstore, $from, $to, $topic, $query);
        $response = $this->client->getHistograms($request);
        return $response;
    }

    /**
     * 查询Logstore中的日志数据。
     * @param null $from
     * @param null $to
     * @param null $topic
     * @param null $query
     * @param int $line
     * @param null $offset
     * @param null $reverse
     * @param null $project
     * @param null $logstore
     * @return \Aliyun_Log_Models_GetLogsResponse
     * @throws \Aliyun_Log_Exception
     */
    public function getLogs($from = null, $to = null, $topic = null, $query = null, $line = 100, $offset = null, $reverse = null, $project = null, $logstore = null)
    {
        $project = $project ?  : $this->project;
        $logstore = $logstore ?  : $this->logstore;
        $request = new Aliyun_Log_Models_GetLogsRequest($project, $logstore, $from, $to, $topic, $query, $line, $offset, $reverse);
        $response = $this->client->getLogs($request);
        return $response;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($value)
    {
        $this->project = $value;
        return $this;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function setLogstore($value)
    {
        $this->logstore = $value;
        return $this;
    }

}