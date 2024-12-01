<?php

namespace App\Controller\Rent;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AppInfo;

class LandlordController extends AbstractController
{
    public function __construct(private AppInfo $appinfo) {}

    #[Route('/admin/rent/landlord', name: 'app_admin_rent_landlord')]
    public function index(): Response
    {
        $params = ['description' => 'Landlord Management'];


        return $this->render('admin/rent/landlord.html.twig', $params);
    }

    #[Route('/admin/rent/landlord/update', name: 'app_admin_rent_landlord_update', methods: ["POST"])]
    public function update(Request $request): Response
    {
        $post = $request->request->all();

        switch ($post["type"]) {
            case 'LandlordList':
                return $this->LandlordList($post, $request);
                break;

            default:
                $data["error"] = "NOT FOUND Type: " . $post["type"];
                return new Response(json_encode($data));
                break;
        }
    }

    /**
     * ==========================
     * POST REQUESTS FUNCTIONS
     * ==========================
     */
    protected function LandlordList($post, $request): Response
    {
        $items = [];

        $html = $this->renderView('admin/rent/partials/landlordtable.html.twig', [
            'items' => $items,
        ]);
        $data["items"] = $items;
        $data["html"] = $html;
        $data["success"] = true;
        return new Response(json_encode($data));
    }
}
