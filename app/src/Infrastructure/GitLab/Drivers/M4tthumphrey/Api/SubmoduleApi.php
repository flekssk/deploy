<?php

namespace App\Infrastructure\GitLab\Drivers\GitLab\M4tthumphrey\Api;

use App\Infrastructure\GitLab\Api\SubmoduleApiInterface;
use App\Infrastructure\GitLab\Dto\BranchDto;
use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;
use Gitlab\Api\AbstractApi;

/**
 * Class Submodule
 *
 * @package App\Infrastructure\Git\Drivers\GitLab\M4tthumphrey\Api
 *
 * @todo: Этого модуля api нет в библиотеке M4tthumphrey, но можно сделать MR в github и она появится
 */
class SubmoduleApi extends AbstractApi implements SubmoduleApiInterface
{
    public function pushSubmoduleState(
        BranchDto $branchDto,
        SubmoduleStateDto $submoduleStateDto,
        string $commitMessage
    )
    {
        return $this->put(
            'projects/' . $this->encodePath($branchDto->getRepository()) . '/repository/submodules/' . $this->encodePath($submoduleStateDto->getSubmoduleName()),
            [
                'branch' => $branchDto->getName(),
                'commit_sha' => $submoduleStateDto->getSubmoduleSha(),
                'commit_message' => $commitMessage,
            ]
        );
    }
}
