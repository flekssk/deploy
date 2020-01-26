<?php

namespace App\UI\Controller\Api\Project;

use App\Application\Project\ProjectGetListService;
use App\Application\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetProjectListController extends AbstractController
{
    /**
     * @var ProjectGetListService
     */
    private $projectGetListService;

    public function __construct(ProjectGetListService $projectGetListService)
    {
        $this->projectGetListService = $projectGetListService;
    }

    /**
     * @Route("/api/v1/project_list", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $list = $this->projectGetListService->get();

        return ResponseFactory::createOkResponse($request, $list);
    }
}
