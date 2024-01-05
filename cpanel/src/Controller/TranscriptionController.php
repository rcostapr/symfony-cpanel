<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AppInfo;

class TranscriptionController extends AbstractController
{
    public function __construct(private AppInfo $appinfo) {}

    #[Route('/admin/transcription', name: 'app_admin_transcription')]
    public function index(): Response
    {
        $params = ['description' => 'Do transcription'];

        try {
            $upload_folder = $this->appinfo->getUploadFolder();
        } catch (\Throwable $th) {
            $params["errors"] = [$th->getMessage()];
            return $this->render('admin/transcription/index.html.twig', $params);
        }

        // Transcription Folder
        $transcription_folder = $upload_folder . '/transcription/';

        // Process
        $process = '258_21.1PDVNG';

        if (!is_dir($transcription_folder . $process)) {
            $params["errors"] = ["Folder process not found: " . $transcription_folder . $process];
            return $this->render('admin/transcription/index.html.twig', $params);
        }

        // Process Folder
        $process_folder = $transcription_folder . $process;

        // Sessions
        $items = scandir($process_folder);
        $sessions = [];
        foreach ($items as $key => $item) {
            if (strpos($item, "session") !== false) {
                $sessions[] = $item;
            }
        }

        // Session Audio File to transcript
        $sessions_audios = [];
        foreach ($sessions as $session) {
            $session_folder = $process_folder . "/" . $session;
            $items = scandir($session_folder);
            foreach ($items as $item) {
                if (strpos($item, ".mp3") !== false) {
                    $sessions_audios[$session][] = $item;
                }
            }
        }

        $params["process"] = $process;
        $params["sessions_audios"] = $sessions_audios;
        return $this->render('admin/transcription/index.html.twig', $params);
    }
}
