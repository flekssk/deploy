<?php

namespace App\UI\Controller\Api\Deploy;

use App\Application\Deploy\DeployProdService;
use App\Application\ResponseFactory;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeployProdController
{
    private $deployProdService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(DeployProdService $deployProdService, ProjectRepositoryInterface $projectRepository)
    {
        $this->deployProdService = $deployProdService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/v1/deploy_deploy_prod", methods={"GET"})
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

        $this->deployProdService->deploy(
            $project,
            $request->get('releaseName'),
            $request->get('targetBranch')
        );

        return ResponseFactory::createOkResponse($request);
    }
}
