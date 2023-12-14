<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BootstrapController extends AbstractController
{
    #[Route('/bootstrap', name: 'app_bootstrap')]
    public function index(): Response
    {
        return $this->render('bootstrap/index.html.twig', [
            'controller_name' => 'BootstrapController',
        ]);
    }

    #[Route('/bootstrap/buttons', name: 'app_bootstrap_buttons')]
    public function buttons(): Response
    {
        return $this->render('bootstrap/buttons.html.twig', [
            'controller_name' => 'BootstrapController',
        ]);
    }

    #[Route('/bootstrap/popovers', name: 'app_bootstrap_popovers')]
    public function popovers(): Response
    {
        return $this->render('bootstrap/popovers.html.twig', [
            'controller_name' => 'BootstrapController',
        ]);
    }

    #[Route('/bootstrap/fontawesome', name: 'app_bootstrap_fontawesome')]
    public function fontawesome(): Response
    {
        return $this->render('bootstrap/fontawesome.html.twig', [
            'controller_name' => 'BootstrapController',
        ]);
    }

    #[Route('/bootstrap/badges', name: 'app_bootstrap_badges')]
    public function badges(): Response
    {
        return $this->render('bootstrap/badges.html.twig', [
            'controller_name' => 'BootstrapController',
        ]);
    }
}
