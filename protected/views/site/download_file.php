<?php

$file_path = '' . $file->filename;

if (!file_exists($file_path)) {
    // File doesn't exist, output error
    die('file not found');
} else {
    // Set headers
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-length: " . filesize($file_path));
    header("Content-Disposition: attachment; filename=\"" . basename($file_path) . "\"");
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");

    // Read the file from disk
    readfile($file_path);
}
?>