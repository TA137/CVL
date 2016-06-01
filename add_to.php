<?php
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

$zip->addGlob("*.txt");
if (!$zip->status == ZIPARCHIVE::ER_OK)
    echo "Failed to write files to zip\n";
$zip->close();
?>