<?php

namespace App\Controller\Rent;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AppInfo;

class RentController extends AbstractController
{
    public function __construct(private AppInfo $appinfo) {}

    #[Route('/admin/rent', name: 'app_admin_rent')]
    public function index(): Response
    {
        $params = ['description' => 'Rent Management'];

        try {
            $upload_folder = $this->appinfo->getUploadFolder();
        } catch (\Throwable $th) {
            $params["errors"] = [$th->getMessage()];
            return $this->render('admin/rent/index.html.twig', $params);
        }

        // rent Folder
        $rent_folder = $upload_folder . '/rent/';

        if (!is_dir($rent_folder)) {
            mkdir($rent_folder);
        }

        $params = [
            "description" => "Rendas Contratos"
        ];

        return $this->render('admin/rent/index.html.twig', $params);
    }
}
