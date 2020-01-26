<?php

declare(strict_types=1);

namespace App\UI\Controller\Oauth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OauthController extends AbstractController
{
    /**
     * @Route("/oauth")
     */
    public function oauth()
    {
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/login")
     */
    public function login(Request $request)
    {
        $url = 'https://home.action-mcfr.ru/oauth/authorize/v2.php?client_id='
            . getenv('APP_CODE')
            . '&redirect_uri='
            . $request->getSchemeAndHttpHost()
            . '/oauth';

        return $this->render('login.html.twig', ['url' => $url]);
    }

    /**
     * @Route("/logout")
     */
    public function logout()
    {
    }
}