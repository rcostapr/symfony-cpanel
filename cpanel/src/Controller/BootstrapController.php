<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BootstrapController extends AbstractController
{
    /**
     * Breadcrumb Items
     * @var
     */
    protected $breadcrumb;

    public function __construct()
    {
        $this->breadcrumb = [
            [
                "text" => "Home",
                "link" => "/"
            ],
            [
                "text" => "Boostrap",
                "link" => "/bootstrap"
            ],
        ];
    }
    #[Route('/bootstrap', name: 'app_bootstrap')]
    public function index(): Response
    {
        $items = $this->breadcrumb;
        return $this->render('bootstrap/index.html.twig', [
            'controller_name' => 'BootstrapController',
            'items' => $items,
        ]);
    }

    #[Route('/bootstrap/{slug}', name: 'app_bootstrap_default')]
    public function default(string $slug): Response
    {
        $items = $this->breadcrumb;

        $arr = explode("-", $slug);
        $text = ucwords(implode(" ", $arr));

        $items[] = [
            "text" => $text,
            "link" => "/bootstrap/$slug",
        ];
        return $this->render('bootstrap/' . $slug . '.html.twig', [
            'controller_name' => 'BootstrapController::default',
            'items' => $items,
        ]);
    }
}
