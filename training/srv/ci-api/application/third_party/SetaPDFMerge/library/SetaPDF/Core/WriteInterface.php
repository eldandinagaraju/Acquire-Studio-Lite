<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: WriteInterface.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * A simple write interface
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @license    https://www.setasign.com/ Commercial
 */
interface SetaPDF_Core_WriteInterface
{
    /**
     * Writes bytes to the output.
     *
     * @param string $bytes
     */
    public function write($bytes);
}