<?php
/**
 * This demo creates a schema in a PDF Portfolio
 */
date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

// load and register the autoload function
require_once('../../../../library/SetaPDF/Autoload.php');

// create a document as the cover sheet
$writer = new SetaPDF_Core_Writer_Http('portfolio-with-schema.pdf', true);
$document = new SetaPDF_Core_Document($writer);
$document->getCatalog()->getPages()->create(SetaPDF_Core_PageFormats::A4);
// we leave it empty for demonstration purpose...

// create a collection instance
$collection = new SetaPDF_Merger_Collection($document);

// get the schema instance
$schema = $collection->getSchema();

// create a field instance manually
$filenameField = SetaPDF_Merger_Collection_Schema_Field::create(
    'Filename', // the visible field name
    SetaPDF_Merger_Collection_Schema::DATA_FILE_NAME // refer to the file name
);
$filenameField->setOrder(1);
// add it to the schema
$schema->addField('filename', $filenameField);

// let addField() do the field creation
$schema->addField(
    'description',
    'Description',
    SetaPDF_Merger_Collection_Schema::DATA_DESCRIPTION,
    2
);

// let's create an individual field
$schema->addField(
    'company', 'Company Name', SetaPDF_Merger_Collection_Schema::TYPE_STRING, 3
);

// let's create another individual field
$schema->addField(
    'order', 'Order', SetaPDF_Merger_Collection_Schema::TYPE_NUMBER, 4
);

// for demonstration purpose, we add some files now...
$collection->addFile(
    '../../_files/pdfs/tektown/Logo.pdf',
    'tektown-logo.pdf',
    'The logo of tektown',
    [],
    'application/pdf',
    [
        'company' => 'tektown',
        'order'   => 1
    ]
);

$collection->addFile(
    '../../_files/pdfs/etown/Logo.pdf',
    'etown-logo.pdf',
    'The logo of etown',
    [],
    'application/pdf',
    [
        'company' => 'etown',
        'order'   => 2
    ]
);

$collection->addFile(
    '../../_files/pdfs/lenstown/Logo.pdf',
    'lenstown-logo.pdf',
    'The logo of lenstown',
    [],
    'application/pdf',
    [
        'company' => 'lenstown',
        'order'   => 3
    ]
);

// save and finish
$document->save()->finish();