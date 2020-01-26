<?php

namespace App\UI\Controller\Api\Deploy;

use App\Application\Deploy\RunJobService;
use App\Application\ResponseFactory;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RunJobController extends AbstractController
{
    /**
     * @var RunJobService
     */
    private $jobService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository, RunJobService $jobService)
    {
        $this->projectRepository = $projectRepository;
        $this->jobService = $jobService;
    }

    /**
     * @Route("/api/v1/jobr_run", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $project = $this->projectRepository->get($request->get('projectId'));

        $this->jobService->deploy($project, 261335);

        return ResponseFactory::createOkResponse($request);
    }
}
