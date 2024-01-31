<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Font
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: ControlValueProgram.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * This class represents the "prep" table in a sub-setting context.
 *
 * See {@link https://www.microsoft.com/typography/otspec/prep.htm} for more details.
 *
 * @method SetaPDF_Core_Font_TrueType_Table_ControlValueProgram getOriginalTable()
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Font
 * @license    https://www.setasign.com/ Commercial
 */
class SetaPDF_Core_Font_TrueType_Subset_Table_ControlValueProgram extends  SetaPDF_Core_Font_TrueType_Subset_Table
{
    /**
     * The constructor.
     *
     * This table will be copied without changes.
     *
     * @param SetaPDF_Core_Font_TrueType_Table_ControlValueProgram $table
     */
    public function __construct(SetaPDF_Core_Font_TrueType_Table_ControlValueProgram $table)
    {
        parent::__construct($table);
    }
}