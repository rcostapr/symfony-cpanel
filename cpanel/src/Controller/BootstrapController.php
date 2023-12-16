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

    #[Route('/bootstrap/{slug}', name: 'app_bootstrap_default')]
    public function default(string $slug): Response
    {
        return $this->render('bootstrap/' . $slug . '.html.twig', [
            'controller_name' => 'BootstrapController::default',
        ]);
    }
}
