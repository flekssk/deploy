<?php

namespace App\UI\Controller\Api\Project;

use App\Application\Project\ProjectGetService;
use App\Application\ResponseFactory;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use App\Infrastructure\GitLab\GitApiInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetProjectController extends AbstractController
{
    /**
     * @var ProjectGetService
     */
    private $projectGetService;
    /**
     * @var GitApiInterface
     */
    private $apiService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(ProjectGetService $projectGetService, GitApiInterface $apiService, ProjectRepositoryInterface $projectRepository)
    {
        $this->projectGetService = $projectGetService;
        $this->apiService = $apiService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/v1/project_get", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $project = $this->projectGetService->get($request->get('id'));
        $deployments = $this->apiService->deployment()->getDeployments($this->projectRepository->get($request->get('id')));
        dd($deployments);
        return ResponseFactory::createOkResponse($request, $project);
    }
}
