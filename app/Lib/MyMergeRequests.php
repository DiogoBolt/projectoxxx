<?php
/**
 * Created by PhpStorm.
 * User: Diogo Araujo
 * Date: 7/5/2016
 * Time: 11:22 AM
 */

namespace App\Lib;


use Gitlab\Api\MergeRequests;

class MyMergeRequests extends MergeRequests
{
    /**
     * @param int $project_id
     * @param int $mr_id
     * @return mixed
     */
    public function commits($project_id, $mr_id)
    {
        return $this->get($this->getProjectPath($project_id, 'merge_request/'.$this->encodePath($mr_id).'/commits'));
    }
    public function approvals($project_id, $mr_id)
    {
        return $this->get($this->getProjectPath($project_id, 'merge_request/'.$this->encodePath($mr_id).'/approvals'));
    }
}