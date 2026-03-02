<?php

namespace App\Twig;

use App\Security\AfterLoginRedirection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function __construct(private AfterLoginRedirection $login) {}
    public function getFunctions()
    {
        return [
            new TwigFunction('dashboard_home_path', [$this, 'getAuthenticatedUserHomePath']),
        ];
    }

    public function getAuthenticatedUserHomePath()
    {
        $path = '/admin';
        // Custom logic goes here
        return $this->login->authenticatedUserHomePath();
    }
}
