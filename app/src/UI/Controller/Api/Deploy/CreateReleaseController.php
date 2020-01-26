<?php

namespace App\UI\Controller\Api\Deploy;

use App\Application\Release\CreateReleaseService;
use App\Application\ResponseFactory;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use App\Domain\Repository\Release\ReleaseRepositoryInterface;
use App\Infrastructure\Pipeline\DeployService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * @Route("/api/v1/project_create_release", methods={"GET"})
 *
 * @param Request $request
 *
 * @return Response
 *
 * @throws \App\Infrastructure\Pipeline\Exceptions\CommandFailedException
 */
class CreateReleaseController extends AbstractController
{
    /**
     * @var DeployService
     */
    private $deployService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;
    /**
     * @var CreateReleaseService
     */
    private $createReleaseService;
    /**
     * @var ReleaseRepositoryInterface
     */
    private $releaseRepository;

    public function __construct(
        DeployService $deployService,
        CreateReleaseService $createReleaseService,
        ProjectRepositoryInterface $projectRepository,
        ReleaseRepositoryInterface $releaseRepository
    )
    {
        $this->deployService = $deployService;
        $this->createReleaseService = $createReleaseService;
        $this->projectRepository = $projectRepository;
        $this->releaseRepository = $releaseRepository;
    }

    /**
     * @SWG\Tag(name="Deploy", description="Create release"),
     * @SWG\Parameter(
     *     name="releaseName",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref=@Model(type=\App\UI\Controller\Api\Deploy\Model\ReleaseNameRequestModel::class)),
     * ),
     * @SWG\Parameter(
     *     name="projectId",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=\App\UI\Controller\Api\Deploy\Model\ProjectIdRequestModel::class)),
     * ),
     * @SWG\Parameter(
     *     name="coreSha",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref=@Model(type=\App\UI\Controller\Api\Deploy\Model\CoreShaRequestModel::class)),
     * ),
     * @SWG\Response(
     *     response=200,
     *     description="OK",
     * ),
     * @SWG\Response(response=400, description="Bad Request", @SWG\Schema(ref="#/definitions/JsonResponseError")),
     * @SWG\Response(response=500, description="Internal Server Error", @SWG\Schema(ref="#/definitions/JsonResponseException")),
     *
     * @Route("/api/v1/deploy_create_relese", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        var_dump($request->get('releaseName'));die;
        $releaseName = 'release/' . $request->get('releaseName');
        $release = $this->releaseRepository->getByNameOrCreate($releaseName);
        $project = $this->projectRepository->get($request->get('projectId'));

        $this->createReleaseService->deploy(
            $project,
            $release,
            'app/src/core',
            $request->get('coreSha')
        );

        return ResponseFactory::createOkResponse($request);
    }
}
