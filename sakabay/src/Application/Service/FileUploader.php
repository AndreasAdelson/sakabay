<?php

namespace App\Application\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Psr\Log\LoggerInterface;

class FileUploader
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function upload($uploadDir, $file, $filename)
    {
        try {
            $file->move($uploadDir, $filename);
        } catch (FileException $e) {
            $this->logger->error('failed to upload image: ' . $e->getMessage());
            throw new FileException('Failed to upload file');
        }
    }

    public function deleteOldFile($uploadDir, $filename)
    {
        try {
            unlink($uploadDir . '/' . $filename);
        } catch (FileException $e) {
            throw new FileException('Failed to delete file');
        }
    }
}