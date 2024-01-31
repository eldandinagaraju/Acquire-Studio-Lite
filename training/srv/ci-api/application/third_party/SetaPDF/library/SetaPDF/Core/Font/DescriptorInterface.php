<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Font
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: DescriptorInterface.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * Interface for fonts with a font descriptor.
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Font
 * @license    https://www.setasign.com/ Commercial
 */
interface SetaPDF_Core_Font_DescriptorInterface
{
    /**
     * Get the font descriptor object of this font.
     *
     * @return SetaPDF_Core_Font_Descriptor
     */
    public function getFontDescriptor();
}