<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TemplatingEngine;
use App\Repository\ModuleRepository;


class Render
{
    public function __construct(private TemplatingEngine $twig, private ModuleRepository $moduleRepository) {}

    public function sidebarMenu(): Response
    {
        $menu = $this->getSideBarMenu();
        return $this->render('admin/partials/sidebar.html.twig', ['menu' => $menu]);
    }

    private function render(string $template, array $parameters = []): Response
    {
        return new Response($this->twig->render($template, $parameters));
    }

    private function getSideBarMenu(): array
    {
        $menu = [];
        // Get Modules from database and build menu
        $modules = $this->moduleRepository->findAllOrderedByMenuOrder(null);

        // First build root menu items
        foreach ($modules as $module) {
            if (!$module->getMenuid()) {
                $menu[$module->getName()] = [
                    'text' => $module->getName(),
                    'class' => $module->getClass(),
                    'items' => [],
                ];
            }
        }

        // Then add child menu items
        foreach ($menu as $key => $item) {
            $mod = $this->moduleRepository->findOneBy(['name' => $key]);
            $mods = $this->moduleRepository->findAllOrderedByMenuOrder($mod->getId());
            foreach ($mods as $m) {
                $menu[$key]['items'][] = [
                    'text' => $m->getName(),
                    'href' => '/admin/' . strtolower($m->getName()),
                    'class' => $m->getClass(),
                ];
            }
        }

        return $menu;
    }
}
