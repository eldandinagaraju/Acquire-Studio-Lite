<?php
/**
 * Get files and folders from a PDF Portfolio.
 */
date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

// load and register the autoload function
require_once('../../../../library/SetaPDF/Autoload.php');

// create a document
$document = SetaPDF_Core_Document::loadByFilename('../../_files/pdfs/Logos-Portfolio.pdf');

// get the collection instance
$collection = new SetaPDF_Merger_Collection($document);

// extract the file
if (isset($_GET['f'])) {
    // get the file specification
    $file = $collection->getFile($_GET['f']);
    if ($file instanceof SetaPDF_Core_FileSpecification) {
        // resolve the filename
        $filename = $file->getFileSpecification();
        // resolve the file stream
        $embeddedFileStream = $file->getEmbeddedFileStream();

        // we force a content type
        $contentType = 'application/force-download';

        // pass the file to the client
        $stream = $embeddedFileStream->getStream();
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($stream));
        echo $stream;
        die();
    }
}

// function which is called recursively to print out all folders and files
function printFolder(SetaPDF_Merger_Collection_Folder $folder, $level = 0) {
    $files = $folder->getFiles();

    echo str_repeat('&nbsp', $level++ * 4);
    echo $folder->getName() . '/<br />';
    foreach ($files AS $name => $file) {
        $filename = $file->getFileSpecification();
        echo str_repeat('&nbsp', $level * 4);
        echo '<a href="?f=' . urlencode($name) . '">' . htmlspecialchars($filename) . '</a><br />';
    }

    // get sub folders and print them out, too
    foreach ($folder->getSubfolders() AS $subFolder) {
        printFolder($subFolder, $level);
    }
}

printFolder($collection->getRootFolder());
