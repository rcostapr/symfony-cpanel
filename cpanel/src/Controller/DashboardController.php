<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_home')]
    public function index(): Response
    {
        $title = "Dashboard CPanel";
        $description = "Dashboard CPanel description";

        return $this->render('admin/home.html.twig', [
            'title' => $title,
            'description' => $description,
        ]);
    }
}
