<?php

namespace App\UI\Controller\Api\Deploy;

use App\Application\Deploy\DeployRCService;
use App\Application\ResponseFactory;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeployRCController extends AbstractController
{
    private $deployRCService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(DeployRCService $deployRCService, ProjectRepositoryInterface $projectRepository)
    {
        $this->deployRCService = $deployRCService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/v1/deploy_deploy_rc", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \App\Infrastructure\Pipeline\Exceptions\CommandFailedException
     */
    public function __invoke(Request $request): Response
    {
        $project = $this->projectRepository->get($request->get('projectId'));

        $this->deployRCService->deploy(
            $project,
            $request->get('releaseName'),
            $request->get('coreSha')
        );

        return ResponseFactory::createOkResponse($request);
    }
}
