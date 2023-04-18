<?php

namespace managers;
use finfo;
use RuntimeException;

class PictureManager
{
    public function getExtensionFromMimeType(string $mimeType): ?string
    {
        switch ($mimeType) {
            case 'image/jpeg':
                return 'jpeg';
            case 'image/jpg':
                return 'jpg';
            case 'image/png':
                return 'png';
            case 'image/gif':
                return 'gif';
            default:
                throw new RuntimeException('Unsupported mime type');
        }
    }

    public function isUploadSuccessful(array $uploadedFile)
    {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $upload_dir = '../src/img/uploads/';
        $acceptedType = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (isset($uploadedFile['error']) && $uploadedFile['error'] === UPLOAD_ERR_OK) {
            if ($fileSize < 7000000) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mimeType = $finfo->file($uploadedFile['tmp_name']);
                if (in_array($mimeType, $acceptedType)) {
                    move_uploaded_file($fileTmpPath, $upload_dir . $_POST['pictureTitle'] . '.' .
                        $this->getExtensionFromMimeType($mimeType));
                }
            }
        }
    }

    /**
     * Function for AdminPage
     */
    public function getUploadedFiles()
    {
        $dir = './src/img/uploads/';
        return array_slice(scandir($dir), 2);
    }

    public function updateFile($oldName, $newName)
    {
        $dir = './src/img/uploads/';
        rename("./src/img/uploads/$oldName", "./src/img/uploads/$newName");
    }

    public function deleteFile($file): void
    {
        unlink("./src/img/uploads/$file");
    }

    /**
     * Functions for GuestView on carousel
     */
    public function getFirstPic()
    {
        $dir = './src/img/uploads/';
        return array_slice(scandir($dir), 2)[0];
    }

    public function getRestPic()
    {
        $dir = './src/img/uploads/';
        return array_slice(array_slice(scandir($dir), 2), 1);
    }
}
