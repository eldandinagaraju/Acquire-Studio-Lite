<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Document
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: Resource.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * Interface for PDF resources
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @license    https://www.setasign.com/ Commercial
 */
interface SetaPDF_Core_Resource
{
    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_FONT = 'Font';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_X_OBJECT = 'XObject';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_EXT_G_STATE = 'ExtGState';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_COLOR_SPACE = 'ColorSpace';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_PATTERN = 'Pattern';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_SHADING = 'Shading';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_PROPERTIES = 'Properties';

    /**
     * Type constant
     *
     * @var string
     */
    const TYPE_PROC_SET = 'ProcSet';

    /**
     * Get the indirect object of this resource.
     *
     * @param SetaPDF_Core_Document|null $document
     * @return SetaPDF_Core_Type_IndirectObject
     */
    public function getIndirectObject(SetaPDF_Core_Document $document = null);
    
    /**
     * Get the resource type of an implementation.
     * 
     * @return string
     */
    public function getResourceType();    
}