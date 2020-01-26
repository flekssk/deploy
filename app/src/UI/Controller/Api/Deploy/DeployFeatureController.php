<?php

namespace App\UI\Controller\Api\Deploy;

use App\Application\Deploy\DeployFeatureService;
use App\Application\ResponseFactory;
use App\Domain\Entity\Project\Project;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeployFeatureController extends AbstractController
{
    private $deployFeatureService;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(
        DeployFeatureService $deployFeatureService,
        ProjectRepositoryInterface $projectRepository
    )
    {
        $this->deployFeatureService = $deployFeatureService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/v1/deploy_deploy_feature", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $project = $this->projectRepository->get($request->get('projectId'));

        $this->deployFeatureService->deploy(
            $project,
            $request->get('featureName'),
            $request->get('coreSha')
        );

        return ResponseFactory::createOkResponse($request);
    }
}
