<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Writer
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: FileInterface.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * An interface for file writer classes.
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Writer
 * @license    https://www.setasign.com/ Commercial
 */
interface SetaPDF_Core_Writer_FileInterface
{
    /**
     * Get the path of the file.
     *
     * @return string
     */
    public function getPath();
}