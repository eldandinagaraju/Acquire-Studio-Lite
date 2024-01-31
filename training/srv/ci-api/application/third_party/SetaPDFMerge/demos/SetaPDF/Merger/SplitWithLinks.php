<?php
/**
 * This demo splits a document into single pages while maintaining internal links.
 * This is done by changing the go-to actions into remote go-to actions.
 *
 * Note: You will have to use a reader that supports remote go-to actions such as e.g. Adobe Reader.
 */
date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

if (!class_exists('ZipArchive')) {
    echo 'Sorry, this demo requires the Zip extension -> http://www.php.net/zip';
    die();
}

// load and register the autoload function
require_once('../../../library/SetaPDF/Autoload.php');

$pdfPath = '../Core/_files/Example-PDF-1.pdf';

// Let's prepare a ZipArchive instance
$zip = new ZipArchive();
$zipName = tempnam(sys_get_temp_dir(), 'zip');
$zip->open($zipName, ZipArchive::CREATE);

// Load the document
$document = SetaPDF_Core_Document::loadByFilename($pdfPath);

// We want to work with the pages
$pages = $document->getCatalog()->getPages();

for ($pageNumber = 1, $pageCount = count($pages); $pageNumber <= $pageCount; $pageNumber++) {
    $page = $pages->getPage($pageNumber);
    // We create a new merger instance
    $merger = new SetaPDF_Merger();
    // Add the individual page of the "in"-document to the merger
    $merger->addDocument($document, $pageNumber);

    // ... and merge
    $merger->merge();

    // Get the resulting document instance
    $resultingDocument = $merger->getDocument();

    // Get the merged page
    $resultingPage = $resultingDocument->getCatalog()->getPages()->getPage(1);

    // Get all link-annotations from the merged page
    $resultingAnnotations = $resultingPage->getAnnotations()->getAll(SetaPDF_Core_Document_Page_Annotation::TYPE_LINK);

    // Get all link-annotations from the original page
    $annotations = $page->getAnnotations()->getAll(SetaPDF_Core_Document_Page_Annotation::TYPE_LINK);

    // Iterate through all annotations from the merged page
    foreach ($resultingAnnotations as $key => $annotation) {
        // Get the corresponding annotation fromn the original page
        $originalAnnotation = $annotations[$key];

        // Get the action from the original annotation
        $action = $originalAnnotation->getAction();

        // Check for action existence and the GoTo type
        if ($action && $action instanceof SetaPDF_Core_Document_Action_GoTo) {
            // Get the corresponding destination
            $pageDestination = $action->getDestination($document);

            // Get the filename that is used for the corresponding page
            $filename = sprintf('%0' . strlen($pageCount). 's', $pageDestination->getPageNo($document)) . '.pdf';

            // Clone the destination array and override the destination to the page number that shall be shown
            $newDestionation = clone $pageDestination->getDestinationArray();
            $newDestionation[0] = new SetaPDF_Core_Type_Numeric(1);

            //create a new action with the destination array and the corresponding filename
            $resultingAction = new SetaPDF_Core_Document_Action_GoToR($newDestionation, $filename);

            //define that the reader should open a new window when the annotation got clicked
            $resultingAction->setNewWindow(true);

            //ovveride the old action
            $annotation->setAction($resultingAction);
        }
    }

    // Create a writer which we can pass to the ZipArchive instance
    $writer = new SetaPDF_Core_Writer_String();

    $resultingDocument->setWriter($writer);
    // Save and finish the extracted page/document
    $resultingDocument->save()->finish();
    // Free some memory
    $resultingDocument->cleanUp();

    // let's create a sortable filename
    $pdfName = sprintf('%0' . strlen($pageCount). 's', $pageNumber) . '.pdf';
    // Add the file to the zip archive
    $zip->addFromString($pdfName, $writer);
}

// Close the zip file and send the zip-file to the client
$zip->close();

header('Content-Type: application/zip');
header('Content-Length: ' . filesize($zipName));
header('Content-Disposition: attachment; filename="' . basename($pdfPath, '.pdf') . '.zip"');
readfile($zipName);

unlink($zipName);