<?php

namespace App\Controller\Modules\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function getSideMenu(): array
    {
        return [
            [
                "text" => "Users",
                "link" => "/admin/users",
            ],
            [
                "text" => "Add User",
                "link" => "/admin/users/add",
            ],
        ];
    }
}
