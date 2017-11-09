<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 23/06/2016
 * Time: 09:37
 */

namespace App\Lib;

use Gitlab\Api\AbstractApi;
use Vinkla\GitLab\GitLabManager;

/**
 * Class GitLabHelper *
 *
 * This is the GitLab manager class.
 *
 * @property \Gitlab\Api\Groups $groups
 * @property \Gitlab\Api\Issues $issues
 * @property \Gitlab\Api\MergeRequests $merge_requests
 * @property \Gitlab\Api\MergeRequests $mr
 * @property \Gitlab\Api\Milestones $milestones
 * @property \Gitlab\Api\Milestones $ms
 * @property \Gitlab\Api\ProjectNamespaces $namespaces
 * @property \Gitlab\Api\ProjectNamespaces $ns
 * @property \Gitlab\Api\Projects $projects
 * @property \Gitlab\Api\Repositories $repositories
 * @property \Gitlab\Api\Repositories $repo
 * @property \Gitlab\Api\Snippets $snippets
 * @property \Gitlab\Api\SystemHooks $hooks
 * @property \Gitlab\Api\SystemHooks $system_hooks
 * @property \Gitlab\Api\Users $users
 *
 */
class GitLabHelper
{
    public function __construct(GitLabManager $labManager)
    {
        $this->gitlab = $labManager;
    }

    public function my_merge_requests() {
        return new MyMergeRequests($this->gitlab->connection());
    }

    /**
     * @param string $api
     * @return AbstractApi
     */
    public function __get($api)
    {
        return $this->gitlab->api($api);
    }
}