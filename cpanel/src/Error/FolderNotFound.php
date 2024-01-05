<?php

namespace App\Error;

use Exception;

class FolderNotFound extends Exception
{
    public function __construct(private string $folder)
    {
        parent::__construct($this, 1, null);
    }

    public function __toString(): string
    {
        return "Folder $this->folder not exist or fail on create folder. Check permissions.";
    }
}
