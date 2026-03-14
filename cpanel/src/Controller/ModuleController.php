<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleFormType;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    #[Route('/admin/modules', name: 'app_module', methods: ['GET'])]
    public function index(ModuleRepository $moduleRepository): Response
    {

        // All Modules
        $modules = $moduleRepository->findAll();

        // Add Module Form
        $module = new Module();
        $form = $this->createForm(ModuleFormType::class, $module, [
            'action' => $this->generateUrl('app_module_post'),
            'method' => 'POST',
        ]);
        return $this->render('admin/module/index.html.twig', [
            'description' => 'Manage your application modules here. You can add, edit, or delete modules as needed.',
            'title' => 'App Modules',
            'form' => $form,
            'dbmodules' => $modules,
        ]);
    }

    #[Route('/admin/modules', name: 'app_module_post', methods: ['POST'])]
    public function post(Request $request, ModuleRepository $moduleRepository): Response
    {
        $module = new Module();
        $form = $this->createForm(ModuleFormType::class, $module);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Handle form submission
            $moduleRepository->save($module, true);

            $data = [
                'success' => true,
                'message' => 'Module created successfully',
            ];

            return new JsonResponse($data, Response::HTTP_OK);
        }

        $data = [
            'success' => false,
            'message' => 'Failed to create module',
            'errors' => (string) $form->getErrors(true, false),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/admin/modules/get/{id}', name: 'app_module_get', methods: ['POST'])]
    public function get(ModuleRepository $moduleRepository, int $id): Response
    {
        $module = $moduleRepository->find($id);
        if (!$module) {
            return new JsonResponse(['success' => false, 'message' => 'Module not found'], Response::HTTP_OK);
        }

        $form = $this->createForm(ModuleFormType::class, $module, [
            'action' => $this->generateUrl('app_module_edit', ['id' => $module->getId()]),
            'method' => 'POST',
        ]);
        $html = $this->render('admin/partials/form.html.twig', [
            'title' => 'Module #' . $module->getId(),
            'form' => $form,
        ])->getContent();

        return new JsonResponse(['success' => true, 'html' => $html], Response::HTTP_OK);
    }

    #[Route('/admin/modules/edit/{id}', name: 'app_module_edit', methods: ['POST'])]
    public function edit(Request $request, ModuleRepository $moduleRepository, int $id): Response
    {
        $module = $moduleRepository->find($id);
        if (!$module) {
            return new JsonResponse(['success' => false, 'message' => 'Module not found'], Response::HTTP_OK);
        }

        $form = $this->createForm(ModuleFormType::class, $module);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Handle form submission
            $moduleRepository->save($module, true);

            $data = [
                'success' => true,
                'message' => 'Module updated successfully',
            ];

            return new JsonResponse($data, Response::HTTP_OK);
        }

        $data = [
            'success' => false,
            'message' => 'Failed to update module',
            'errors' => (string) $form->getErrors(true, false),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/admin/modules/get', name: 'app_module_get_all', methods: ['POST'])]
    public function getAll(ModuleRepository $moduleRepository): Response
    {
        $modules = $moduleRepository->findAll();

        $html = $this->render('admin/module/tableModule.html.twig', [
            'dbmodules' => $modules,
        ])->getContent();

        return new JsonResponse(['success' => true, 'html' => $html], Response::HTTP_OK);
    }
}
