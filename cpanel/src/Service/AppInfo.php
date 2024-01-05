<?php

namespace App\Service;

use App\Error\FolderNotFound;

class AppInfo
{
    public function __construct(private string $projectdir) {}
    public function getUploadFolder()
    {
        $upload_folder = $this->projectdir . "/upload";
        if (!is_dir($upload_folder)) {
            $result = mkdir($upload_folder);
            if ($result === false) {
                throw new FolderNotFound($upload_folder, 2);
            }
        }
        return $upload_folder;
    }
}
