<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api;

use App\Infrastructure\GitLab\Api\MergeRequestApiInterface;
use App\Infrastructure\GitLab\Dto\MergeDto;
use Gitlab\Api\MergeRequests;

class MergeRequestApi implements MergeRequestApiInterface
{
    /**
     * @var MergeRequests
     */
    private $mergeRequestsApi;

    public function __construct(MergeRequests $mergeRequestsApi)
    {
        $this->mergeRequestsApi = $mergeRequestsApi;
    }

    public function merge(MergeDto $mergeDto)
    {
        $result = false;

        $mergeRequest = $this->mergeRequestsApi
            ->create(
                $mergeDto->getRepositoryDto()->getName(),
                $mergeDto->getBranchName(),
                $mergeDto->getTargetBranch(),
                'Merge request from deployer'
            );

        if(is_array($mergeRequest)) {
            $result = $this->mergeRequestsApi
                ->approve(
                    $mergeDto->getRepositoryDto()->getName(),
                    $mergeRequest['iid']
                );
        }

        return $result;
    }

    public function applyMergeRequest()
    {
        $this->mergeRequestsApi->approve();
    }
}
