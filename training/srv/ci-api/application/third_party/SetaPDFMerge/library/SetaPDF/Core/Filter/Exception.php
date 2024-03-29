<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Filter
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: Exception.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * Filter exception
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage Filter
 * @license    https://www.setasign.com/ Commercial
 */
class SetaPDF_Core_Filter_Exception extends SetaPDF_Core_Exception
{
  /** Constants prefix: 0x03 **/

  /** Flate */

    /**
     * @var integer
     */
    const NO_ZLIB = 0x0300;

    /**
     * @var integer
     */
    const DECOMPRESS_ERROR = 0x0301;

  /** Ascii85 */

    /**
     * @var integer
     */
    const ILLEGAL_CHAR_FOUND = 0x0310;

    /**
     * @var integer
     */
    const ILLEGAL_LENGTH = 0x0311;

  /** LZW */

    /**
     * @var integer
     */
    const LZW_FLAVOUR_NOT_SUPPORTED = 0x0320;

  /** Predictor */

    /**
     * @var integer
     */
    const DECOMPRESS_ROW_ERROR = 0x0330;

    /**
     * @var integer
     */
    const UNRECOGNIZED_PNG_PREDICTOR = 0x0331;

    /**
     * @var integer
     */
    const UNRECOGNIZED_PREDICTOR = 0x0332;
}