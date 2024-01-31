<?php
/**
 * This demo adds folders and files to a PDF Portfolio.
 */
date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

// load and register the autoload function
require_once('../../../../library/SetaPDF/Autoload.php');

// create a document as the cover sheet
$writer = new SetaPDF_Core_Writer_Http('portfolio-with-folders-and-files.pdf', true);
$document = new SetaPDF_Core_Document($writer);
$document->getCatalog()->getPages()->create(SetaPDF_Core_PageFormats::A4);
// we leave it empty for demonstration purpose...

// create a collection instance
$collection = new SetaPDF_Merger_Collection($document);

// thorugh the proxy method
$folderA = $collection->addFolder('tektown');
$folderA->addFile(
    '../../_files/pdfs/tektown/Laboratory-Report.pdf',
    'Laboratory-Report.pdf'
);
$folderA->addFile(
    '../../_files/pdfs/tektown/Terms-and-Conditions.pdf',
    'Terms-and-Conditions.pdf'
);

$folderB = $collection->addFolder('camtown');
$folderB->addFile(
    '../../_files/pdfs/camtown/Laboratory-Report.pdf',
    'Laboratory-Report.pdf'
);
$folderB->addFile(
    '../../_files/pdfs/camtown/Terms-and-Conditions.pdf',
    'Terms-and-Conditions.pdf'
);


// save and finish
$document->save()->finish();