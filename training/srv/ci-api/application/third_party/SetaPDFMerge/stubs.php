<?php
// @codingStandardsIgnoreFile

namespace
{

    /**
     * A class representing a text graphic state.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_GraphicState_Text
    {
        /**
         * Data name constant
         *
         * @var string
         */
        const TEXT_MATRIX = 'textMatrix';

        /**
         * Data name constant
         *
         * @var string
         */
        const LINE_MATRIX = 'lineMatrix';

        /**
         * Data name constant
         *
         * @var string
         */
        const CHARACTER_SPACING = 'characterSpacing';

        /**
         * Data name constant
         *
         * @var string
         */
        const WORD_SPACING = 'wordSpacing';

        /**
         * Data name constant
         *
         * @var string
         */
        const SCALING = 'scaling';

        /**
         * Data name constant
         *
         * @var string
         */
        const LEADING = 'leading';

        /**
         * Data name constant
         *
         * @var string
         */
        const FONT = 'font';

        /**
         * Data name constant
         *
         * @var string
         */
        const FONT_SIZE = 'fontSize';

        /**
         * Data name constant
         *
         * @var string
         */
        const RENDERING_MODE = 'renderingMode';

        /**
         * Data name constant
         *
         * @var string
         */
        const RISE = 'rise';

        /**
         * The main graphic state from which this text graphic state is inherited/created from.
         *
         * @var SetaPDF_Core_Canvas_GraphicState
         */
        protected $_graphicState;

        /**
         * The graphic state instance of this text state.
         *
         * @var array
         */
        protected $_stack;

        /**
         * The data of the text graphic state.
         *
         * @var array
         */
        protected $_data = [/** value is missing */];

        /**
         * Callbacks which should be executed when a specific value is set.
         *
         * @var callback[]
         */
        protected $_callbacks = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Canvas_GraphicState $graphicState
         * @param array $stack A reference to the graphic state stack array.
         */
        public function __construct(\SetaPDF_Core_Canvas_GraphicState $graphicState, &$stack) {}

        /**
         * Release cycled references.
         */
        public function cleanUp() {}

        /**
         * Registers a callback that should be executed if a specifc value is set.
         *
         * @param string $valueName
         * @param callback $callback
         */
        public function registerCallback($valueName, $callback) {}

        /**
         * Un-registers a callback.
         *
         * @see registerCallback()
         * @param string $valueName
         */
        public function unregisterCallback($valueName) {}

        /**
         * Get the current state of the stack.
         *
         * @return mixed
         */
        protected function _getCurrent() {}

        /**
         * Get a value by walking through the graphic stack.
         *
         * @param string $name
         * @param $default
         * @return mixed
         */
        protected function _getValue($name, $default) {}

        /**
         * Sets a value in the current graphic stack.
         *
         * @param string $name
         * @param mixed $value
         */
        protected function _setValue($name, $value) {}

        /**
         * Begins a text object in the graphic state.
         *
         * @return $this
         */
        public function begin() {}

        /**
         * Ends a text object in the graphic state.
         *
         * @return $this
         */
        public function end() {}

        /**
         * Gets the current text transformation matrix.
         *
         * @throws BadMethodCallException
         * @return null|SetaPDF_Core_Geometry_Matrix
         */
        public function getTextMatrix() {}

        /**
         * Gets the current line transformation matrix.
         *
         * @throws BadMethodCallException
         * @return null|SetaPDF_Core_Geometry_Matrix
         */
        public function getLineMatrix() {}

        /**
         * Sets the current character spacing value.
         *
         * @param float $characterSpacing
         * @return $this
         */
        public function setCharacterSpacing($characterSpacing) {}

        /**
         * Gets the current character spacing value.
         *
         * @return integer|float
         */
        public function getCharacterSpacing() {}

        /**
         * Sets the current word spacing value.
         *
         * @param float $wordSpacing
         * @return $this
         */
        public function setWordSpacing($wordSpacing) {}

        /**
         * Gets the current word spacing value.
         *
         * @return integer|float
         */
        public function getWordSpacing() {}

        /**
         * Sets the current scaling value.
         *
         * @param float $scaleing
         * @return $this
         */
        public function setScaling($scaleing) {}

        /**
         * Gets the current scaling value.
         *
         * @return mixed
         */
        public function getScaling() {}

        /**
         * Sets the current leading value.
         *
         * @param float $leading
         * @return $this
         */
        public function setLeading($leading) {}

        /**
         * Gets the current leading value.
         *
         * @return mixed
         */
        public function getLeading() {}

        /**
         * Sets the current font and size.
         *
         * @param SetaPDF_Core_Font $font
         * @param float $size
         * @return $this
         */
        public function setFont(\SetaPDF_Core_Font $font, $size) {}

        /**
         * Gets the current font instance.
         *
         * @return SetaPDF_Core_Font|boolean
         */
        public function getFont() {}

        /**
         * Gets the current font size.
         *
         * @return float|boolean
         */
        public function getFontSize() {}

        /**
         * Sets the current rendering mode.
         *
         * @param integer $renderingMode
         * @return $this
         */
        public function setRenderingMode($renderingMode) {}

        /**
         * Get the current rendering mode value.
         *
         * @return integer
         */
        public function getRenderingMode() {}

        /**
         * Sets the text rise value.
         *
         * @param float $rise
         * @return $this
         */
        public function setRise($rise) {}

        /**
         * Gets the current text rise value.
         *
         * @return float|integer
         */
        public function getRise() {}

        /**
         * Move to the next line.
         *
         * The "'" operator.
         *
         * @param float $x
         * @param float $y
         * @param bool $setLeading
         * @return $this
         */
        public function moveToNextLine($x, $y, $setLeading = false) {}

        /**
         * Move to the start of the next line.
         *
         * The "T*" operator.
         *
         * @return SetaPDF_Core_Canvas_GraphicState_Text
         */
        public function moveToStartOfNextLine() {}

        /**
         * Sets the current text matrix.
         *
         * @param float|SetaPDF_Core_Geometry_Matrix $aOrMatrix
         * @param float|null $b
         * @param float|null $c
         * @param float|null $d
         * @param float|null $e
         * @param float|null $f
         *
         * @return $this
         */
        public function setTextMatrix($aOrMatrix, $b = null, $c = null, $d = null, $e = null, $f = null) {}

        /**
         * Sets the current line matrix.
         *
         * @param float|SetaPDF_Core_Geometry_Matrix $aOrMatrix
         * @param float|null $b
         * @param float|null $c
         * @param float|null $d
         * @param float|null $e
         * @param float|null $f
         *
         * @return $this
         */
        public function setLineMatrix($aOrMatrix, $b = null, $c = null, $d = null, $e = null, $f = null) {}

        /**
         * Method that is invoked when a text should be shown.
         *
         * @param string $text
         * @return $this
         */
        protected function _showText($text) {}

        /**
         * Shows a text string.
         *
         * @param string $text
         * @return SetaPDF_Core_Canvas_GraphicState_Text
         */
        public function showText($text) {}

        /**
         * Moves to the start of the next line and shows a text string.
         *
         * @param string $text
         * @param float|null $wordSpacing
         * @param float|null $charSpacing
         * @return $this
         */
        public function moveToNextLineAndShowText($text, $wordSpacing = null, $charSpacing = null) {}

        /**
         * Shows text strings.
         *
         * @param string|string[] $textStrings
         */
        public function showTextStrings($textStrings) {}

        /**
         * Converts a vectors values to the user space coordinate system.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function toUserSpace(?\SetaPDF_Core_Geometry_Vector $vector = null) {}

        /**
         * Get a font bounding box vector.
         *
         * @param $index
         * @return SetaPDF_Core_Geometry_Vector
         * @throws SetaPDF_Core_Exception
         */
        private function _getFontBBoxVector($index) {}

        /**
         * Get the bottom bearing line value in user space coordinate system.
         *
         * @return SetaPDF_Core_Geometry_Vector
         * @throws SetaPDF_Core_Exception
         */
        public function getBottomUserSpace() {}

        /**
         * Get the top bearing line value in user space coordinate system.
         *
         * @return SetaPDF_Core_Geometry_Vector
         * @throws SetaPDF_Core_Exception
         */
        public function getTopUserSpace() {}

        /**
         * Converts a vectors values to the text space coordinate system.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function toTextSpace(?\SetaPDF_Core_Geometry_Vector $vector = null) {}

    }
}

namespace
{

    /**
     * An interface for objects which contains a canvas object.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Canvas_ContainerInterface
    {
        /**
         * Get the indirect object of the container.
         *
         * This could be an object holding a dictionary or a stream.
         *
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getObject();

        /**
         * Get the stream proxy object.
         *
         * @return SetaPDF_Core_Canvas_StreamProxyInterface
         */
        public function getStreamProxy();

        /**
         * Get the width for the canvas.
         *
         * @return float
         */
        public function getWidth();

        /**
         * Get the height for the canvas.
         *
         * @return float
         */
        public function getHeight();

    }
}

namespace
{

    /**
     * A canvas helper class for draw operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_Draw extends \SetaPDF_Core_Canvas_StandardOperators
    {
        /**
         * Only fill style
         *
         * @var int
         */
        const STYLE_FILL = 1;

        /**
         * Only draw style
         *
         * @var int
         */
        const STYLE_DRAW = 2;

        /**
         * Draw and fill style
         *
         * @var int
         */
        const STYLE_DRAW_AND_FILL = 3;

        /**
         * Draws a line on the canvas.
         *
         * @param float $x1
         * @param float $y1
         * @param float $x2
         * @param float $y2
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function line($x1, $y1, $x2, $y2) {}

        /**
         * Draws a rectangle on the canvas.
         *
         * @param float $x1
         * @param float $y1
         * @param float $width
         * @param float $height
         * @param int $style
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function rect($x1, $y1, $width, $height, $style = self::STYLE_DRAW) {}

        /**
         * Draws a circle on the canvas.
         *
         * @param float $x
         * @param float $y
         * @param float $r
         * @param int $style
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function circle($x, $y, $r, $style = self::STYLE_DRAW) {}

        /**
         * Draws an ellipse on the canvas.
         *
         * @param float $x
         * @param float $y
         * @param float $rx
         * @param float $ry
         * @param int $style
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function ellipse($x, $y, $rx, $ry, $style = self::STYLE_DRAW) {}

        /**
         * Call the specific path function depending on the used style.
         *
         * @param int $style
         */
        protected function _drawStyle($style) {}

    }
}

namespace
{

    /**
     * A canvas helper class for graphicState operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_GraphicState
    {
        /**
         * The maximum nesting level of the graphic states (default = 28).
         *
         * @var integer
         * @see PDF 32000-1:2008 - C.2 Architectural limits
         */
        protected static $_maxGraphicStateNestingLevel = 28;

        /**
         * Stack of all opened or closed graphic states.
         *
         * @var array
         */
        protected $_stack = [/** value is missing */];

        /**
         * Text state helper
         *
         * @var SetaPDF_Core_Canvas_GraphicState_Text
         */
        protected $_text;

        /**
         * Set the maximum nesting level of graphic states.
         *
         * @param integer $maxGraphicStateNestingLevel
         */
        public static function setMaxGraphicStateNestingLevel($maxGraphicStateNestingLevel) {}

        /**
         * Get the maximum nesting level of graphic states.
         *
         * @return integer
         */
        public static function getMaxGraphicStateNestingLevel() {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Geometry_Matrix $matrix
         */
        public function __construct(?\SetaPDF_Core_Geometry_Matrix $matrix = null) {}

        /**
         * Get the current state of the stack.
         *
         * @return mixed
         */
        protected function _getCurrent() {}

        /**
         * Add a transformation matrix to the stack of the current graphic state.
         *
         * @see PDF-Reference PDF 32000-1:2008 8.3.4 Transformation Matrices
         * @param int|float $a
         * @param int|float $b
         * @param int|float $c
         * @param int|float $d
         * @param int|float $e
         * @param int|float $f
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function addCurrentTransformationMatrix($a, $b, $c, $d, $e, $f) {}

        /**
         * Get the current transformation matrix.
         *
         * @return SetaPDF_Core_Geometry_Matrix
         */
        public function getCurrentTransformationMatrix() {}

        /**
         * Open a new graphic state and copy the entire graphic state onto the stack of the new graphic state.
         *
         * @throws BadMethodCallException
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function save() {}

        /**
         * Restore the last graphic state and pop all matrices of the current graphic state out of the matrix stack.
         *
         * @throws BadMethodCallException
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function restore() {}

        /**
         * Rotate the graphic state by $angle degrees at the origin defined by $x and $y.
         *
         * @param int|float $x X-coordinate of rotation point
         * @param int|float $y Y-coordinate of rotation point
         * @param float $angle Angle to rotate in degrees
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function rotate($x, $y, $angle) {}

        /**
         * Scale the graphic state by the factor $scaleX and $scaleY.
         *
         * @param int|float $scaleX Scale factor on X
         * @param int|float $scaleY Scale factor on Y
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function scale($scaleX, $scaleY) {}

        /**
         * Move the graphic state by $shiftX and $shiftY on x-axis and y-axis.
         *
         * @param int|float $shiftX Points to move on x-axis
         * @param int|float $shiftY Points to move on y-axis
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function translate($shiftX, $shiftY) {}

        /**
         * Skew the graphic state.
         *
         * @param float $angleX Angle to x-axis in degrees
         * @param float $angleY Angle to y-axis in degrees
         * @param int $x Points to stretch on x-axis
         * @param int $y Point to stretch on y-axis
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function skew($angleX, $angleY, $x = 0, $y = 0) {}

        /**
         * Returns the user space coordinates.
         *
         * @param int|float $x
         * @param int|float $y
         * @return array array with ('x' => $x, 'y' => $y)
         */
        public function getUserSpaceXY($x, $y) {}

        /**
         * Returns the user space coordinates vector.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function toUserSpace(\SetaPDF_Core_Geometry_Vector $vector) {}

        /**
         * Returns the text state helper.
         *
         * @return SetaPDF_Core_Canvas_GraphicState_Text
         */
        public function text() {}

    }
}

namespace
{

    /**
     * A canvas helper class for marked content operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_MarkedContent extends \SetaPDF_Core_Canvas_Operators
    {
        /**
         * Begin a marked content sequence.
         * 
         * @param string $tag
         * @param SetaPDF_Core_Resource $properties
         * @return SetaPDF_Core_Canvas_MarkedContent
         */
        public function begin($tag, ?\SetaPDF_Core_Resource $properties = null) {}

        /**
         * End a marked content stream.
         * 
         * @return SetaPDF_Core_Canvas_MarkedContent
         */
        public function end() {}

    }
}

namespace
{

    /**
     * Abstract class for accessing canvas helper objects
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Canvas_Operators
    {
        /**
         * The origin canvas object
         *
         * @var SetaPDF_Core_Canvas
         */
        protected $_canvas;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Canvas $canvas
         */
        public function __construct(\SetaPDF_Core_Canvas $canvas) {}

        /**
         * Release objects to free memory and cycled references.
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

        /**
         * Get the draw helper.
         *
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function draw() {}

        /**
         * Get the path helper.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function path() {}

        /**
         * Get the text helper.
         *
         * @return SetaPDF_Core_Canvas_Text
         */
        public function text() {}

    }
}

namespace
{

    /**
     * A canvas helper class for path operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_Path extends \SetaPDF_Core_Canvas_StandardOperators
    {
        /**
         * Line cap style
         *
         * @var integer
         */
        const LINE_CAP_BUTT = 0;

        /**
         * Line cap style
         *
         * @var integer
         */
        const LINE_CAP_ROUND = 1;

        /**
         * Line cap style
         *
         * @var integer
         */
        const LINE_CAP_PROJECTING_SQUARE = 2;

        /**
         * Line join type
         *
         * @var integer
         */
        const LINE_JOIN_MITER = 0;

        /**
         * Line join type
         *
         * @var integer
         */
        const LINE_JOIN_ROUND = 1;

        /**
         * Line join type
         *
         * @var integer
         */
        const LINE_JOIN_BEVEL = 2;

        /**
         * Set the miter limit.
         *
         * @param float $miterLimit
         * @return SetaPDF_Core_Canvas_Path
         */
        public function setMiterLimit($miterLimit = 10) {}

        /**
         * Set the dash pattern.
         *
         * @param array $dashesAndGaps
         * @param integer $phase
         * @return SetaPDF_Core_Canvas_Path
         */
        public function setDashPattern(array $dashesAndGaps = [/** value is missing */], $phase = 0) {}

        /**
         * Set the line join type.
         *
         * @param integer $lineJoin
         * @return SetaPDF_Core_Canvas_Path
         */
        public function setLineJoin($lineJoin = self::LINE_JOIN_MITER) {}

        /**
         * Set the line width.
         *
         * @param float $lineWidth
         * @return SetaPDF_Core_Canvas_Path
         */
        public function setLineWidth($lineWidth = 1) {}

        /**
         * Set the line cap style.
         *
         * @param integer $lineCap
         * @return SetaPDF_Core_Canvas_Path
         */
        public function setLineCap($lineCap = self::LINE_CAP_BUTT) {}

        /**
         * Begin a new subpath at a specific position.
         *
         * @param float $x
         * @param float $y
         * @return SetaPDF_Core_Canvas_Path
         */
        public function moveTo($x, $y) {}

        /**
         * Append a straight line segment.
         *
         * @param float $x
         * @param float $y
         * @return SetaPDF_Core_Canvas_Path
         */
        public function lineTo($x, $y) {}

        /**
         * Append a rectangle to the current path as a complete subpath.
         *
         * @param float $x
         * @param float $y
         * @param float $width
         * @param float $height
         * @return SetaPDF_Core_Canvas_Path
         */
        public function rect($x, $y, $width, $height) {}

        /**
         * Append a cubic Bézier curve to the current path.
         *
         * @param float $x1
         * @param float $y1
         * @param float $x2
         * @param float $y2
         * @param float|string|null $x3 Also used as control parameter to define the coincide point
         * @param float|null $y3
         * @return SetaPDF_Core_Canvas_Path
         */
        public function curveTo($x1, $y1, $x2, $y2, $x3 = null, $y3 = null) {}

        /**
         * Stroke the path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function stroke() {}

        /**
         * Close and stroke the path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function closeAndStroke() {}

        /**
         * Close the current subpath by appending a straight line segment from the current point to the starting point of the subpath.
         *
         * @return $this
         */
        public function close() {}

        /**
         * Close, fill and stroke the path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function closeFillAndStroke() {}

        /**
         * Close, fill and stroke the path using even-odd rule.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function closeFillAndStrokeEvenOdd() {}

        /**
         * Fill and stroke the path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function fillAndStroke() {}

        /**
         * Fill and stroke the path using even-odd rule.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function fillAndStrokeEvenOdd() {}

        /**
         * Fill the path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function fill() {}

        /**
         * Fill the path using even-odd rule.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function fillEvenOdd() {}

        /**
         * End the path object without filling or stroking it.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function endPath() {}

        /**
         * Clip the current path.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function clip() {}

        /**
         * Clip the current path using even-odd rule.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function clipEvenOdd() {}

    }
}

namespace
{

    /**
     * A class representing minimum functions to access a Canvas.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_Simple
    {
        /**
         * The main dictionary of the canvas
         *
         * @var SetaPDF_Core_Canvas_ContainerInterface
         */
        protected $_canvasContainer;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Canvas_ContainerInterface $canvasContainer
         */
        public function __construct(\SetaPDF_Core_Canvas_ContainerInterface $canvasContainer) {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the whole byte stream of the canvas.
         *
         * @see SetaPDF_Core_Canvas_StreamProxyInterface::getStream()
         * @return string
         */
        public function getStream() {}

        /**
         * Get the container of the canvas (origin object).
         *
         * @return SetaPDF_Core_Canvas_ContainerInterface
         */
        public function getContainer() {}

        /**
         * Returns the resources dictionary or an entry of it.
         *
         * If no resource dictionary exists it is possible to automatically
         * create it and/or the desired entry.
         *
         * @param boolean $inherited Check for a resources dictionary in parent nodes
         * @param boolean $create Create dictionary/ies if they do not exists
         * @param string $entryKey The entries key (Font, XObject,...)
         * @return bool|SetaPDF_Core_Type_AbstractType Returns the resources object or dictionary or false if none was found.
         */
        public function getResources($inherited = true, $create = false, $entryKey = null) {}

    }
}

namespace
{

    /**
     * Abstract canvas helper class for standard operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Canvas_StandardOperators extends \SetaPDF_Core_Canvas_Operators
    {
        /**
         * Proxy method for setting the color on the canvas.
         *
         * @see SetaPDF_Core_Canvas::setColor()
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color
         * @param boolean $stroking
         * @return $this
         */
        public function setColor($color, $stroking = true) {}

        /**
         * Proxy method for setting the stroking color on the canvas.
         *
         * @see SetaPDF_Core_Canvas::setColor()
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color
         * @return $this
         */
        public function setStrokingColor($color) {}

        /**
         * Proxy method for setting the non-stroking color on the canvas.
         *
         * @see SetaPDF_Core_Canvas::setColor()
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color
         * @return $this
         */
        public function setNonStrokingColor($color) {}

        /**
         * Proxy method for setting a graphic state on the canvas.
         *
         * @see SetaPDF_Core_Canvas::setGraphicState()
         * @param SetaPDF_Core_Resource_ExtGState $graphicState
         * @return $this
         */
        public function setGraphicState(\SetaPDF_Core_Resource_ExtGState $graphicState) {}

        /**
         * Proxy method for saving the graphic state on the canvas.
         *
         * @see SetaPDF_Core_Canvas::saveGraphicState()
         * @return $this
         */
        public function saveGraphicState() {}

        /**
         * Proxy method for restoring the graphic state on the canvas.
         *
         * @see SetaPDF_Core_Canvas::restoreGraphicState()
         * @return $this
         */
        public function restoreGraphicState() {}

        /**
         * Proxy method for adding a transformation matrix on the canvas.
         *
         * @see SetaPDF_Core_Canvas::addCurrentTransformationMatrix()
         * @param float|int $a
         * @param float|int $b
         * @param float|int $c
         * @param float|int $d
         * @param float|int $e
         * @param float|int $f
         * @return $this
         */
        public function addCurrentTransformationMatrix($a, $b, $c, $d, $e, $f) {}

        /**
         * Proxy method for rotating the transformation matrix on the canvas.
         *
         * @see SetaPDF_Core_Canvas::rotate()
         * @param int|float $x X-coordinate of rotation point
         * @param int|float $y Y-coordinate of rotation point
         * @param int|float $angle Angle to rotate in degrees
         * @return $this
         */
        public function rotate($x, $y, $angle) {}

        /**
         * Proxy method for scaling the transformation matrix on the canvas.
         *
         * @see SetaPDF_Core_Canvas::scale()
         * @param int|float $scaleX Scale factor on X
         * @param int|float $scaleY Scale factor on Y
         * @return $this
         */
        public function scale($scaleX, $scaleY) {}

        /**
         * Proxy method for moving the transformation matrix on the canvas.
         *
         * @see SetaPDF_Core_Canvas::translate()
         * @param int|float $shiftX Points to move on x-axis
         * @param int|float $shiftY Points to move on y-axis
         * @return $this
         */
        public function translate($shiftX, $shiftY) {}

        /**
         * Proxy method for skewing the transformation matrix on the canvas.
         *
         * @see SetaPDF_Core_Canvas::skew()
         * @param int|float $angleX Angle to x-axis in degrees
         * @param int|float $angleY Angle to y-axis in degrees
         * @param int|float $x Points to stretch on x-axis
         * @param int|float $y Point to stretch on y-axis
         * @return $this
         */
        public function skew($angleX, $angleY, $x = 0, $y = 0) {}

    }
}

namespace
{

    /**
     * Interface of a StreamProxy
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Canvas_StreamProxyInterface extends \SetaPDF_Core_WriteInterface
    {
        /**
         * Clears the complete canvas content.
         */
        public function clear();

        /**
         * Get the whole byte stream of the canvas.
         *
         * @return string
         */
        public function getStream();

    }
}

namespace
{

    /**
     * A canvas helper class for text operators
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas_Text extends \SetaPDF_Core_Canvas_StandardOperators
    {
        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_FILL = 0;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_STROKE = 1;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_FILL_AND_STROKE = 2;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_INVISIBLE = 3;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_FILL_AND_CLIP = 4;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_STROKE_AND_CLIP = 5;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_FILL_STROKE_AND_CLIP = 6;

        /**
         * Rendering mode
         *
         * @var integer
         */
        const RENDERING_MODE_CLIP = 7;

        /**
         * Set the char spacing.
         *
         * @param float $charSpacing
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setCharacterSpacing($charSpacing = 0) {}

        /**
         * Alias for setCharacterSpacing()
         *
         * @see setCharacterSpacing()
         * @param float $charSpacing
         * @deprecated
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setCharSpacing($charSpacing = 0) {}

        /**
         * Set the word spacing.
         *
         * @param float $wordSpacing
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setWordSpacing($wordSpacing = 0) {}

        /**
         * Set the horizontal scaling.
         *
         * @param float $scaling
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setScaling($scaling = 100) {}

        /**
         * Set the leading.
         *
         * @param float $leading
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setLeading($leading = 0) {}

        /**
         * Set the font.
         *
         * @param string $name
         * @param float $size
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setFont($name, $size = 12) {}

        /**
         * Set the rendering mode.
         *
         * The available rendering modes are also available through class constants such as
         * SetaPDF_Core_Canvas_Text::RENDERING_MODE_CLIP.
         *
         * @see PDF reference 32000-1:2008 9.3.6 Text Rendering Mode
         * @param integer $renderingMode
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setRenderingMode($renderingMode = 0) {}

        /**
         * Set text rise.
         *
         * @param float $rise
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setRise($rise = 0) {}

        /**
         * Alias for setRise()
         *
         * @param float $textRise
         * @return SetaPDF_Core_Canvas_Text
         * @see setRise()
         * @deprecated
         */
        public function setTextRise($textRise = 0) {}

        /**
         * Begin a text object.
         *
         * @return SetaPDF_Core_Canvas_Text
         */
        public function begin() {}

        /**
         * Alias for begin()
         *
         * @return SetaPDF_Core_Canvas_Text
         * @see begin()
         * @deprecated
         */
        public function beginText() {}

        /**
         * End a text object.
         *
         * @return SetaPDF_Core_Canvas_Text
         */
        public function end() {}

        /**
         * Alias for end()
         *
         * @return SetaPDF_Core_Canvas_Text
         * @see end()
         * @deprecated
         */
        public function endText() {}

        /**
         * Move to the next line.
         *
         * @param float $x
         * @param float $y
         * @param boolean $setLeading
         * @return SetaPDF_Core_Canvas_Text
         */
        public function moveToNextLine($x, $y, $setLeading = false) {}

        /**
         * Move to the start of the next line.
         *
         * @return SetaPDF_Core_Canvas_Text
         */
        public function moveToStartOfNextLine() {}

        /**
         * Set the text matrix.
         *
         * @param float $a
         * @param float $b
         * @param float $c
         * @param float $d
         * @param float $e
         * @param float $f
         * @return SetaPDF_Core_Canvas_Text
         */
        public function setTextMatrix($a, $b, $c, $d, $e, $f) {}

        /**
         * Show text.
         *
         * @param string|string[] $text
         * @return SetaPDF_Core_Canvas_Text
         */
        public function showText($text) {}

        /**
         * Move to the next line and show text.
         *
         * @param string|string[] $text
         * @param float $wordSpacing
         * @param float $charSpacing
         * @return SetaPDF_Core_Canvas_Text
         */
        public function moveToNextLineAndShowText($text, $wordSpacing = null, $charSpacing = null) {}

        /**
         * Shows text strings.
         *
         * @param array|string $textStrings
         * @return SetaPDF_Core_Canvas_Text
         */
        public function showTextStrings($textStrings) {}

    }
}

namespace
{

    /**
     * DeviceCMYK Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_DeviceCmyk extends \SetaPDF_Core_ColorSpace
    {
        /**
         * Creates an instance of this color space.
         *
         * @return SetaPDF_Core_ColorSpace_DeviceCmyk
         */
        public static function create() {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $name
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $name) {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

    }
}

namespace
{

    /**
     * DeviceGray Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_DeviceGray extends \SetaPDF_Core_ColorSpace
    {
        /**
         * Creates an instance of this color space.
         *
         * @return SetaPDF_Core_ColorSpace_DeviceGray
         */
        public static function create() {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $name
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $name) {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

    }
}

namespace
{

    /**
     * DeviceN Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_DeviceN extends \SetaPDF_Core_ColorSpace implements \SetaPDF_Core_Resource
    {
        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $definition
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $definition) {}

        /**
         * Get the names specifying the individual color components.
         *
         * @return array
         */
        public function getNames() {}

        /**
         * Set the names specifying the individual color components.
         *
         * @param SetaPDF_Core_Type_Name|array $names
         */
        public function setNames($names) {}

        /**
         * Get the alternate color space.
         *
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         */
        public function getAlternateColorSpace() {}

        /**
         * Alias for getAlternateColorSpace()
         *
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         * @deprecated
         */
        public function getAlternateSpace() {}

        /**
         * Set the alternate color space.
         *
         * @param SetaPDF_Core_ColorSpace $colorSpace
         */
        public function setAlternateColorSpace(\SetaPDF_Core_ColorSpace $colorSpace) {}

        /**
         * Set the tint transformation function.
         *
         * @param SetaPDF_Core_Type_AbstractType $tintTransform
         * @throws InvalidArgumentException
         */
        public function setTintTransform(\SetaPDF_Core_Type_AbstractType $tintTransform) {}

        /**
         * Get the tint transformation function.
         *
         * @return SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_Stream
         */
        public function getTintTransform() {}

        /**
         * Gets an indirect object for this color space dictionary.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type of an implementation.
         *
         * @return string
         */
        public function getResourceType() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

    }
}

namespace
{

    /**
     * DeviceRGB Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_DeviceRgb extends \SetaPDF_Core_ColorSpace
    {
        /**
         * Creates an instance of this color space.
         *
         * @return SetaPDF_Core_ColorSpace_DeviceRgb
         */
        public static function create() {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $name
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $name) {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

    }
}

namespace
{

    /**
     * ICCBased Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_IccBased extends \SetaPDF_Core_ColorSpace implements \SetaPDF_Core_Resource
    {
        /**
         * An array caching profile stream objects.
         *
         * @var array
         */
        public static $_profileStreams = [/** value is missing */];

        /**
         * Creates an instance of this color space.
         *
         * @param SetaPDF_Core_IccProfile_Stream $iccStream
         * @return SetaPDF_Core_ColorSpace_IccBased
         */
        public static function create(\SetaPDF_Core_IccProfile_Stream $iccStream) {}

        /**
         * Release profile stream instances by a document instance.
         *
         * @param SetaPDF_Core_Document $document
         */
        public static function freeCache(\SetaPDF_Core_Document $document) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $definition
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $definition) {}

        /**
         * Get an instance of the ICC Profile stream.
         *
         * @return SetaPDF_Core_IccProfile_Stream
         */
        public function getIccProfileStream() {}

        /**
         * Gets an indirect object for this color space dictionary.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type of an implementation.
         *
         * @return string
         */
        public function getResourceType() {}

        /**
         * Get the alternate color space.
         *
         * @return null|SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation|string
         */
        public function getAlternateColorSpace() {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

    }
}

namespace
{

    /**
     * Indexed Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_Indexed extends \SetaPDF_Core_ColorSpace implements \SetaPDF_Core_Resource
    {
        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $definition
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $definition) {}

        /**
         * Get the base color space.
         *
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         */
        public function getBase() {}

        /**
         * Get the maximum valid index value (hival).
         *
         * @return integer
         */
        public function getHival() {}

        /**
         * Get the lookup table.
         *
         * @return array
         */
        public function getLookupTable() {}

        /**
         * Gets an indirect object for this color space dictionary.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type of an implementation.
         *
         * @return string
         */
        public function getResourceType() {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the default decode array of this color space.
         *
         * @param int $bitsPerComponent
         * @return array
         */
        public function getDefaultDecodeArray($bitsPerComponent = null) {}

    }
}

namespace
{

    /**
     * Separation Color Space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace_Separation extends \SetaPDF_Core_ColorSpace implements \SetaPDF_Core_Resource
    {
        /**
         * Creates a spot color color space.
         *
         * @param SetaPDF_Core_Document $document
         * @param string $name
         * @param int|float|array $c If is array $m, $y, $k will be ignored. The array need 4 entries.
         * @param int|float $m
         * @param int|float $y
         * @param int|float $k
         * @return SetaPDF_Core_ColorSpace_Separation
         */
        public static function createSpotColor(\SetaPDF_Core_Document $document, $name, $c, $m = null, $y = null, $k = null) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $definition
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $definition) {}

        /**
         * Get the name of the colorant that this Separation color space is intended to represent.
         *
         * @return string
         */
        public function getName() {}

        /**
         * Set the name of the colorant that this Separation color space is intended to represent.
         *
         * @param string $name
         */
        public function setName($name) {}

        /**
         * Get the alternate color space.
         *
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         */
        public function getAlternateColorSpace() {}

        /**
         * Get the alternate color space.
         *
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         * @deprecated
         */
        public function getAlternateSpace() {}

        /**
         * Set the alternate color space.
         *
         * @param SetaPDF_Core_ColorSpace $colorSpace
         */
        public function setAlternateColorSpace(\SetaPDF_Core_ColorSpace $colorSpace) {}

        /**
         * Set the tint transformation function.
         *
         * @param SetaPDF_Core_Type_AbstractType $tintTransform
         * @throws InvalidArgumentException
         */
        public function setTintTransform(\SetaPDF_Core_Type_AbstractType $tintTransform) {}

        /**
         * Get the tint transformation function.
         *
         * @return SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_Stream
         */
        public function getTintTransform() {}

        /**
         * Gets an indirect object for this color space dictionary.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type of an implementation.
         *
         * @return string
         */
        public function getResourceType() {}

    }
}

namespace
{

    /**
     * CMYK Color
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Color_Cmyk extends \SetaPDF_Core_DataStructure_Color implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Writes a color definition directly to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array|float $componentsOrC An array of 4 components or the value for the cyan component
         * @param boolean|float $strokingOrM Stroking flag or the value for the magenta component
         * @param float $y The value for the yellow component
         * @param float $k The value for the black component
         * @param boolean $stroking Stroking flag
         * @throws InvalidArgumentException
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $componentsOrC, $strokingOrM = 0, $y = 0, $k = 0, $stroking = true) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Array|array|float $componentsOrC
         * @param float $m
         * @param float $y
         * @param float $k
         * @throws InvalidArgumentException
         */
        public function __construct($componentsOrC, $m = 0, $y = 0, $k = 0) {}

        /**
         * Draw the color on a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $stroking
         * @see writePdfString()
         */
        public function draw(\SetaPDF_Core_WriteInterface $writer, $stroking = true) {}

    }
}

namespace
{

    /**
     * Gray Color
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Color_Gray extends \SetaPDF_Core_DataStructure_Color implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Writes a color definition directly to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array|float $components An array of 1 component or the value for the gray color
         * @param boolean $stroking Stroking flag
         * @throws InvalidArgumentException
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $components, $stroking = true) {}

        /**
         * The constructor.
         *
         * @param float|SetaPDF_Core_Type_Array $components
         * @throws InvalidArgumentException
         */
        public function __construct($components) {}

        /**
         * Draw the color on a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $stroking
         * @see writePdfString()
         */
        public function draw(\SetaPDF_Core_WriteInterface $writer, $stroking = true) {}

    }
}

namespace
{

    /**
     * RGB Color
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Color_Rgb extends \SetaPDF_Core_DataStructure_Color implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Writes a color definition directly to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array|float $componentsOrR An array of 3 components or the value for the red component
         * @param boolean|float $strokingOrG Stroking flag or the value for the green component
         * @param float $b The value for the blue component
         * @param boolean $stroking Stroking flag
         * @throws InvalidArgumentException
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $componentsOrR, $strokingOrG = 0, $b = 0, $stroking = true) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Array|array|float $componentsOrR
         * @param float $g
         * @param float $b
         * @throws InvalidArgumentException
         */
        public function __construct($componentsOrR, $g = 0, $b = 0) {}

        /**
         * Draw the color on a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $stroking
         * @see writePdfString()
         */
        public function draw(\SetaPDF_Core_WriteInterface $writer, $stroking = true) {}

    }
}

namespace
{

    /**
     * Special Color
     *
     * Special colors are used in Pattern, Separation, DeviceN and ICCBased colour spaces.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Color_Special extends \SetaPDF_Core_DataStructure_Color implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Writes a color definition directly to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array|float $components
         * @param boolean $stroking Stroking flag
         * @throws InvalidArgumentException
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $components, $stroking = true) {}

        /**
         * The constructor.
         *
         * @param float|SetaPDF_Core_Type_Array $components
         * @throws InvalidArgumentException
         */
        public function __construct($components) {}

        /**
         * Draw the color on a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $stroking
         * @see writePdfString()
         */
        public function draw(\SetaPDF_Core_WriteInterface $writer, $stroking = true) {}

    }
}

namespace
{

    /**
     * Exception class which is thrown if a key that should be set already exists in a tree
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Tree_KeyAlreadyExistsException extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Abstract class for color structures
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Color
    {
        /**
         * The array of color components
         *
         * @var SetaPDF_Core_Type_Array
         */
        protected $_components;

        /**
         * Writes the colors components to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array $components
         * @param boolean|null $stroking
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $components, $stroking = true) {}

        /**
         * Writes a color definition directly to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array|int|float|string $components
         * @param bool $stroking
         * @throws InvalidArgumentException
         */
        public static function writePdfStringByComponents(\SetaPDF_Core_WriteInterface $writer, $components, $stroking = true) {}

        /**
         * Create an instance by a PDF array object, PHP array or a hexadecimal string of an RGB value.
         *
         * @param bool|int|float|string|array|SetaPDF_Core_Type_Array $components
         *          The count of $components define the color space (1 - gray, 3 - RGB, 4 - CMYK). The color values must be between 0 and 1.<br/>
         *          It is also possible to pass a hexadecimal string of an RGB value. The string need to be prefixed by a sharp (#).<br/>
         * @return SetaPDF_Core_DataStructure_Color
         * @throws InvalidArgumentException
         */
        public static function createByComponents($components) {}

        /**
         * Converts a hex encoded string into a component array of red, green and blue values.
         *
         * @param string $hex
         * @return array
         */
        public static function hexToRgb($hex) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Array|array|float $components
         */
        public function __construct($components) {}

        /**
         * Implementation of __clone().
         */
        public function __clone() {}

        /**
         * Adjust all color components by a specific value.
         *
         * @param int|float $by
         */
        public function adjustAllComponents($by) {}

        /**
         * Get the components of the color.
         *
         * @return SetaPDF_Core_Type_Array
         */
        public function getValue() {}

        /**
         * Get the data as a PHP value.
         *
         * @return array
         */
        public function toPhp() {}

        /**
         * Write the color as a PDF string to a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $stroking
         */
        public function draw(\SetaPDF_Core_WriteInterface $writer, $stroking = true) {}

    }
}

namespace
{

    /**
     * Interface for data structure classes
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Get the PDF value object.
         *
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function getValue();

        /**
         * Get the data as a PHP value.
         *
         * @return mixed
         */
        public function toPhp();

    }
}

namespace
{

    /**
     * Data structure class for date objects
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_Date implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * The string object representing the date
         *
         * Format: (D:YYYYMMDDHHmmSSOHH'mm)
         *
         * @var SetaPDF_Core_Type_String
         */
        protected $_string;

        /**
         * Converts an PDF date time string into a DateTime object.
         *
         * @param string $string
         * @return DateTime
         * @throws OutOfRangeException
         */
        public static function stringToDateTime($string) {}

        /**
         * The constructor.
         *
         * The $string parameter can be of various types:<br/>
         * <ul>
         * <li>If a {@link SetaPDF_Core_Type_String} object is passed, it will be used as the date value.</li>
         * <li>If a DateTime instance is passed, it will be forwarded to the {@link setByDateTime()} method.</li>
         * <li>If a simple string is passed, it will be passed to create a new DateTime instance which is forward to the
         *   {@link setByDateTime()} method then.</li>
         * </ul>
         * @param string|DateTime|SetaPDF_Core_Type_String $string
         */
        public function __construct($string = null) {}

        /**
         * Get the PDF date as a DateTime object.
         *
         * @return DateTime
         */
        public function getAsDateTime() {}

        /**
         * Set the date by a DateTime object.
         *
         * @param DateTime $dateTime
         */
        public function setByDateTime(\DateTime $dateTime) {}

        /**
         * Get the PDF string object.
         *
         * @see SetaPDF_Core_DataStructure_DataStructureInterface::getValue()
         * @return SetaPDF_Core_Type_String
         */
        public function getValue() {}

        /**
         * Get the date as a PHP string.
         *
         * @see SetaPDF_Core_DataStructure_DataStructureInterface::toPhp()
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Data structure class for Name Trees
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_NameTree extends \SetaPDF_Core_DataStructure_Tree
    {
        /**
         * Callback function to build unique names.
         *
         * @param string $name
         * @param integer $i Attempt count
         * @return string
         */
        public static function adjustNameCallback($name, $i) {}

        /**
         * Get the entries key name for this implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getEntriesKeyName()
         * @return string
         */
        protected function _getEntriesKeyName() {}

        /**
         * Get the key class name used by this tree implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getKeyClassName()
         * @return string
         */
        protected function _getKeyClassName() {}

        /**
         * Get the key instance name by tree implementation.
         *
         * @return string
         */
        protected function _getKeyInstanceName() {}

        /**
         * Get the sort type for this tree implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getSortType()
         * @return integer
         */
        protected function _getSortType() {}

    }
}

namespace
{

    /**
     * Data structure class for Number Trees
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_DataStructure_NumberTree extends \SetaPDF_Core_DataStructure_Tree
    {
        /**
         * Get the entries key name for this implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getEntriesKeyName()
         * @return string
         */
        protected function _getEntriesKeyName() {}

        /**
         * Get the key class name used by this tree implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getKeyClassName()
         * @return string
         */
        protected function _getKeyClassName() {}

        /**
         * Get the sort type for this tree implementation.
         *
         * @see SetaPDF_Core_DataStructure_Tree::_getSortType()
         * @return integer
         */
        protected function _getSortType() {}

    }
}

namespace
{

    /**
     * Data structure class for rect objects
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     * @property float $llx
     * @property float $lly
     * @property float $urx
     * @property float $ury
     */
    class SetaPDF_Core_DataStructure_Rectangle implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * An array representing a rectangle [llx lly urx ury]
         *
         * @var SetaPDF_Core_Type_Array
         */
        protected $_array;

        /**
         * Create a rectangle by a specific argument.
         *
         * @param array|SetaPDF_Core_Geometry_Rectangle|SetaPDF_Core_DataStructure_Rectangle $rectangle
         * @return SetaPDF_Core_DataStructure_Rectangle
         * @throws InvalidArgumentException
         */
        public static function create($rectangle) {}

        /**
         * Create a rect object or array from a php array.
         *
         * @param array $phpArray
         * @param boolean $getValue
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle
         */
        public static function byArray(array $phpArray, $getValue = false) {}

        /**
         * Create an instance by another rectangle instance.
         *
         * @param SetaPDF_Core_Geometry_Rectangle|SetaPDF_Core_DataStructure_Rectangle $rectangle
         * @return SetaPDF_Core_DataStructure_Rectangle
         */
        public static function byRectangle($rectangle) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Array $array
         * @throws InvalidArgumentException
         */
        public function __construct(?\SetaPDF_Core_Type_Array $array = null) {}

        /**
         * Implementation of clone.
         */
        public function __clone() {}

        /**
         * Get handler.
         *
         * @param string $name
         * @return float|integer
         * @throws InvalidArgumentException
         */
        public function __get($name) {}

        /**
         * Set handler.
         *
         * @param string $name
         * @param float|integer $value
         * @throws InvalidArgumentException
         */
        public function __set($name, $value) {}

        /**
         * Set the lower left x-coordinate.
         *
         * @param integer|float $llx
         */
        public function setLlx($llx) {}

        /**
         * Get the lower left x-coordinate.
         *
         * @return integer|float
         */
        public function getLlx() {}

        /**
         * Set the lower left y-coordinate.
         *
         * @param integer|float $lly
         */
        public function setLly($lly) {}

        /**
         * Get the lower left y-coordinate.
         *
         * @return integer|float
         */
        public function getLly() {}

        /**
         * Set the upper right x-coordinate.
         *
         * @param integer|float $urx
         */
        public function setUrx($urx) {}

        /**
         * Get the upper right x-coordinate.
         *
         * @return integer|float
         */
        public function getUrx() {}

        /**
         * Set the upper right y-coordinate.
         *
         * @param integer|float $ury
         */
        public function setUry($ury) {}

        /**
         * Get the upper right y-coordinate.
         *
         * @return integer|float
         */
        public function getUry() {}

        /**
         * Set all coordinates.
         *
         * @param float|integer $llx Lower left x value
         * @param float|integer $lly Lower left y value
         * @param float|integer $urx Upper right x value
         * @param float|integer $ury Upper right y value
         */
        public function setAll($llx, $lly, $urx, $ury) {}

        /**
         * Get the width of the rect.
         *
         * @return integer|float
         */
        public function getWidth() {}

        /**
         * Get the height of the rect.
         *
         * @return integer|float
         */
        public function getHeight() {}

        /**
         * Get the PDF value object.
         *
         * @return SetaPDF_Core_Type_Array
         * @see SetaPDF_Core_DataStructure_DataStructureInterface::getValue()
         */
        public function getValue() {}

        /**
         * Get the data as a PHP value.
         *
         * @return array
         */
        public function toPhp() {}

        /**
         * Return this rectangle as SetaPDF_Core_Geometry_Rectangle.
         *
         * @return SetaPDF_Core_Geometry_Rectangle
         */
        public function getRectangle() {}

        /**
         * Checks whether this rectangle contains another rectangle.
         *
         * @param SetaPDF_Core_Geometry_Rectangle|SetaPDF_Core_DataStructure_Rectangle $otherRect
         * @return boolean
         * @throws InvalidArgumentException
         */
        public function contains($otherRect) {}

        /**
         * Checks whether this rectangle intersects another rectangle.
         *
         * @param SetaPDF_Core_Geometry_Rectangle|SetaPDF_Core_DataStructure_Rectangle $otherRect
         * @return boolean
         * @throws InvalidArgumentException
         */
        public function intersect($otherRect) {}

    }
}

namespace
{

    /**
     * Abstract data structure class for trees
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage DataStructure
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_DataStructure_Tree implements \SetaPDF_Core_DataStructure_DataStructureInterface
    {
        /**
         * Leaf nodes per node
         *
         * @var integer
         */
        public static $leafNodesPerNode = 64;

        /**
         * The document to which the tree depends to
         *
         * @var SetaPDF_Core_Document
         */
        protected $_document;

        /**
         * The dictionary entry in the dictionary of the root object
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_rootDictionary;

        /**
         * Is this a new tree or should we update an existing one
         *
         * @var boolean
         */
        protected $_isNew = false;

        /**
         * A cache for resolved entries
         *
         * The index is the key while the value is an array of both
         * key and value object.
         *
         * @var array
         */
        protected $_values = [/** value is missing */];

        /**
         * Get the entries key name by tree implementation.
         *
         * @return string
         */
        abstract protected function _getEntriesKeyName();

        /**
         * Get the key class name by tree implementation.
         *
         * @return string
         */
        abstract protected function _getKeyClassName();

        /**
         * Get the key instance name by tree implementation.
         *
         * @return string
         */
        protected function _getKeyInstanceName() {}

        /**
         * Get the sort type for the specific tree implementation.
         *
         * @return integer
         * @see http://www.php.net/sort
         */
        abstract protected function _getSortType();

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary $rootDictionary
         * @param SetaPDF_Core_Document $document
         */
        public function __construct(\SetaPDF_Core_Type_Dictionary $rootDictionary, \SetaPDF_Core_Document $document) {}

        /**
         * Get an object by a key.
         *
         * @param string $key
         * @param string $className
         * @return SetaPDF_Core_Type_AbstractType|false|mixed
         */
        public function get($key, $className = null) {}

        /**
         * Gets a key value pair by a root node and a key.
         *
         * @param SetaPDF_Core_Type_Dictionary $node
         * @param string $key
         * @return array|false
         */
        protected function _get(\SetaPDF_Core_Type_Dictionary $node, $key) {}

        /**
         * Find a appropriate leaf node by a key.
         *
         * If $lowest is set to false the method will search for a leaf node
         * where the key fits between its limit values.
         * If $lowest is set to true the method will return the first leaf node
         * it finds which left limit is bigger than the key.
         *
         * @param SetaPDF_Core_Type_Dictionary $node
         * @param int $key
         * @param bool $exactMatch
         * @param array $intermediateNodes
         * @return bool|SetaPDF_Core_Type_Dictionary
         */
        protected function _findLeaveNodeByKey(\SetaPDF_Core_Type_Dictionary $node, $key, $exactMatch = true, &$intermediateNodes = [/** value is missing */]) {}

        /**
         * Finds the last leaf node.
         *
         * @param SetaPDF_Core_Type_Dictionary $node
         * @param array $intermediateNodes
         * @return bool|SetaPDF_Core_Type_Dictionary
         */
        protected function _findLastLeafNode(\SetaPDF_Core_Type_Dictionary $node, array &$intermediateNodes) {}

        /**
         * Get all keyed objects.
         *
         * @param bool $keysOnly
         * @param null|string $className
         * @return array
         */
        public function getAll($keysOnly = false, $className = null) {}

        /**
         * Merges another tree into this tree.
         *
         * As all items have to be unique this method will call a callback function
         * given in $alreadyExistsCallback if an item already exists.
         *
         * @param SetaPDF_Core_DataStructure_Tree $tree
         * @param null|callback $alreadyExistsCallback Will be called if a item already exists.<br/>
         *          This method can take control over the renaming of the item.
         *          The method will be called as long as it will not throw an exception of
         *          {@link SetaPDF_Core_DataStructure_Tree_KeyAlreadyExistsException}.<br/>
         *          The parameter of the callback function are: The key value and an incremental
         *          number of renaming attempts.
         * @return array An array of renamed items
         * @throws SetaPDF_Core_DataStructure_Tree_KeyAlreadyExistsException
         */
        public function merge(\SetaPDF_Core_DataStructure_Tree $tree, $alreadyExistsCallback = null) {}

        /**
         * Add a keyed value to the tree.
         *
         * For name trees: Make sure you pass the name in PDFDocEncoding or UTF-16BE including BOM.
         *
         * @see _getKeyClassName()
         * @param int|string $key Depends on the implementation
         * @param SetaPDF_Core_Type_AbstractType $value
         * @throws SetaPDF_Core_DataStructure_Tree_KeyAlreadyExistsException
         */
        public function add($key, \SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Remove a key from the tree
         *
         * @param string $key
         * @return boolean
         */
        public function remove($key) {}

        /**
         * Recreates and finalizes the tree
         *
         * This method will create a balanced tree structure and will create
         * new objects in the document.
         * This method could be used recreate the balanced tree or it is automatically
         * used if the initial tree was empty.
         *
         * @internal
         */
        public function arrange() {}

        /**
         * Helper method to create a blank leaf node
         *
         * @param boolean $intermediate
         * @return SetaPDF_Core_Type_IndirectObject
         */
        private function _getBlankLeafNodeObject($intermediate = false) {}

        /**
         * Get the root dictionary entry
         *
         * @see SetaPDF_Core_DataStructure_DataStructureInterface::getValue()
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getValue() {}

        /**
         * Returns an array with named keys and name values
         *
         * @see SetaPDF_Core_DataStructure_DataStructureInterface::toPhp()
         * @return array
         */
        public function toPhp() {}

        /**
         * Release objects to free memory and cycled references
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Class representing a Go-To action
     *
     * Go to a destination in the current document.
     * See PDF 32000-1:2008 - 12.6.4.2
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_GoTo extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create a Go-To Action dictionary.
         *
         * @param string|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_String|SetaPDF_Core_Document_Destination $destination
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($destination) {}

        /**
         * The constructor.
         *
         * @param bool|int|float|string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Document_Destination $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the destination object.
         *
         * @param SetaPDF_Core_Document $document
         * @throws BadMethodCallException
         * @return boolean|SetaPDF_Core_Document_Destination
         */
        public function getDestination(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set the destination.
         *
         * @param string|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_String|SetaPDF_Core_Document_Destination $destination
         * @throws InvalidArgumentException
         */
        public function setDestination($destination) {}

    }
}

namespace
{

    /**
     * Class representing a remote go-to action.
     *
     * Go to a destination in another PDF file instead of the current file.
     * See PDF 32000-1:2008 - 12.6.4.3
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_GoToR extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create a remote go-to Action dictionary.
         *
         * @param string|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_String $destination
         * @param string|SetaPDF_Core_FileSpecification|SetaPDF_Core_Type_Dictionary $file The path to the file, a file
         *                                                                                 specification or a dictionary
         *                                                                                 representing a file specification.
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($destination, $file) {}

        /**
         * The constructor.
         *
         * @param bool|int|float|string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the destination object.
         *
         * @param SetaPDF_Core_Document $document
         * @throws BadMethodCallException
         * @return boolean|SetaPDF_Core_Document_Destination
         */
        public function getDestination(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set the destination.
         *
         * @param string|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_String|SetaPDF_Core_Document_Destination $destination
         * @throws InvalidArgumentException
         */
        public function setDestination($destination) {}

        /**
         * Set the flag specifying whether to open the destination document in a new window.
         *
         * @param boolean|null $newWindow Wether to open the destination in a new window or not. To use the reader
         *                                preferences remove this flag by passing "null".
         */
        public function setNewWindow($newWindow) {}

        /**
         * Get the flag specifying whether to open the destination document in a new window.
         *
         * @return boolean|null A boolean value if specified. Otherwise "null".
         */
        public function getNewWindow() {}

        /**
         * Set the file in which the destination shall be located.
         *
         * @param SetaPDF_Core_FileSpecification|string $file
         */
        public function setFile($file) {}

        /**
         * Get the file in which the destination shall be located.
         *
         * @return bool|SetaPDF_Core_FileSpecification
         */
        public function getFile() {}

    }
}

namespace
{

    /**
     * Class representing a import-data action
     *
     * Import field values from a file.
     * See PDF 32000-1:2008 - 12.7.5.4 Import-Data Action
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_ImportData extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create a Named Action dictionary.
         *
         * @param string| $fileSpecification
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($fileSpecification) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the file specification object.
         *
         * @return SetaPDF_Core_FileSpecification
         */
        public function getFileSpecification() {}

        /**
         * Seta a file specification object.
         *
         * @param string|SetaPDF_Core_FileSpecification $fileSpecification
         */
        public function setFileSpecification($fileSpecification) {}

    }
}

namespace
{

    /**
     * Class representing a JavaScript action
     *
     * Execute a JavaScript script.
     * See PDF 32000-1:2008 - 12.6.4.16
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_JavaScript extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create a JavaScript Action dictionary.
         *
         * @param string|SetaPDF_Core_Type_String|SetaPDF_Core_Type_HexString|SetaPDF_Core_Type_Stream $javaScript
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($javaScript) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the JavaScript code.
         *
         * @return string
         */
        public function getJavaScript() {}

        /**
         * Set the JavaScript code.
         *
         * @param string $javaScript
         */
        public function setJavaScript($javaScript) {}

    }
}

namespace
{

    /**
     * Class representing a Launch action
     *
     * Launch an application, usually to open a file.
     * See PDF 32000-1:2008 - 12.6.4.5
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_Launch extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create a Launch Action dictionary.
         *
         * @param string $fileSpecification
         * @param null|boolean $newWindow
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($fileSpecification, $newWindow = null) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the file specification.
         *
         * @return string
         */
        public function getFileSpecification() {}

        /**
         * Set the file specification.
         *
         * @param string $fileSpecification
         */
        public function setFileSpecification($fileSpecification) {}

        /**
         * Get the NewWindow flag specifying whether to open the destination document in a new window.
         *
         * @return null|boolean
         */
        public function getNewWindow() {}

        /**
         * Set the NewWindow flag specifying whether to open the destination document in a new window.
         *
         * @param boolean $newWindow
         */
        public function setNewWindow($newWindow) {}

    }
}

namespace
{

    /**
     * Class representing a Named action
     *
     * Execute an action predefined by the conforming reader.
     * See PDF 32000-1:2008 - 12.6.4.11
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_Named extends \SetaPDF_Core_Document_Action
    {
        /**
         * Name defined in PDF 32000-1:2008
         *
         * @var string
         */
        const NEXT_PAGE = 'NextPage';

        /**
         * Name defined in PDF 32000-1:2008
         *
         * @var string
         */
        const PREV_PAGE = 'PrevPage';

        /**
         * Name defined in PDF 32000-1:2008
         *
         * @var string
         */
        const FIRST_PAGE = 'FirstPage';

        /**
         * Name defined in PDF 32000-1:2008
         *
         * @var string
         */
        const LAST_PAGE = 'LastPage';

        /**
         * Additional names used by Adobe Acrobat: Print
         *
         * @var string
         */
        const PRINT_DOCUMENT = 'Print';

        /**
         * Additional names used by Adobe Acrobat
         *
         * @var string
         */
        const GO_TO_PAGE = 'GoToPage';

        /**
         * Additional names used by Adobe Acrobat: Previous View
         *
         * @var string
         */
        const GO_BACK = 'GoBack';

        /**
         * Create a named action dictionary.
         *
         * @param string $name
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($name) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the name.
         *
         * @return string
         */
        public function getName() {}

        /**
         * Set the name.
         *
         * @param string $name
         */
        public function setName($name) {}

    }
}

namespace
{

    /**
     * Class representing a reset-form action
     *
     * Set fields to their default values.
     * See PDF 32000-1:2008 - 12.7.5.3 Reset-Form Action
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_ResetForm extends \SetaPDF_Core_Document_Action
    {
        /**
         * Action flag
         */
        const FLAG_EXCLUDE = 1;

        /**
         * Create a Named Action dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary() {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary = null) {}

        /**
         * Set which fields to reset or which to exclude from resetting, depending on the setting of the Include/Exclude flag.
         *
         * @see setFlags()
         * @param array $fields An array of fully qualified names or an indirect object to a field dictionary
         * @param string $encoding The input encoding
         */
        public function setFields(?array $fields = null, $encoding = 'UTF-8') {}

        /**
         * Get the fields to include or exclude in the submission.
         *
         * @param string $encoding The output encoding
         * @return array|null An array of field names in the specific encoding
         */
        public function getFields($encoding = 'UTF-8') {}

        /**
         * Sets a flag or flags.
         *
         * @param integer $flags
         * @param boolean|null $add Add = true, remove = false, set = null
         */
        public function setFlags($flags, $add = true) {}

        /**
         * Removes a flag or flags.
         *
         * @param integer $flags
         */
        public function unsetFlags($flags) {}

        /**
         * Returns the current flags.
         *
         * @return integer
         */
        public function getFlags() {}

        /**
         * Checks if a specific flag is set.
         *
         * @param integer $flag
         * @return boolean
         */
        public function isFlagSet($flag) {}

    }
}

namespace
{

    /**
     * Class representing a submit-form action
     *
     * Send data to a uniform resource locator.
     * See PDF 32000-1:2008 - 12.7.5.2 Submit-Form Action
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_SubmitForm extends \SetaPDF_Core_Document_Action
    {
        /**
         * Action flag
         */
        const FLAG_EXCLUDE = 1;

        /**
         * Action flag
         */
        const FLAG_INCLUDE_NO_VALUE_FIELDS = 2;

        /**
         * Action flag
         */
        const FLAG_EXPORT_FORMAT = 4;

        /**
         * Action flag
         */
        const FLAG_GET_METHOD = 8;

        /**
         * Action flag
         */
        const FLAG_SUBMIT_COORDINATES = 16;

        /**
         * Action flag
         */
        const FLAG_XFDF = 32;

        /**
         * Action flag
         */
        const FLAG_INCLUDE_APPEND_SAVES = 64;

        /**
         * Action flag
         */
        const FLAG_INCLUDE_ANNOTATIONS = 128;

        /**
         * Action flag
         */
        const FLAG_SUBMIT_PDF = 256;

        /**
         * Action flag
         */
        const FLAG_CANONICAL_FORMAT = 1024;

        /**
         * Action flag
         */
        const FLAG_EXCL_NON_USER_ANNOTS = 2048;

        /**
         * Action flag
         */
        const FLAG_EXCL_FKEY = 4096;

        /**
         * Action flag
         */
        const FLAG_EMBED_FORM = 16384;

        /**
         * Create a Named Action dictionary.
         *
         * @param string| $fileSpecification
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($fileSpecification) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the file specification object.
         *
         * @return SetaPDF_Core_FileSpecification
         */
        public function getFileSpecification() {}

        /**
         * Seta a file specification object.
         *
         * @param string|SetaPDF_Core_FileSpecification $fileSpecification
         */
        public function setFileSpecification($fileSpecification) {}

        /**
         * Set which fields to include in the submission or which to exclude, depending on the setting of the Include/Exclude flag.
         *
         * @see setFlags()
         * @param array $fields An array of fully qualified names or an indirect object to a field dictionary
         * @param string $encoding The input encoding
         */
        public function setFields(?array $fields = null, $encoding = 'UTF-8') {}

        /**
         * Get the fields to include or exclude in the submission.
         *
         * @param string $encoding The input encoding
         * @return array|null An array of field names in the specific encoding
         */
        public function getFields($encoding = 'UTF-8') {}

        /**
         * Sets a flag or flags.
         *
         * @param integer $flags
         * @param boolean|null $add Add = true, remove = false, set = null
         */
        public function setFlags($flags, $add = true) {}

        /**
         * Removes a flag or flags.
         *
         * @param integer $flags
         */
        public function unsetFlags($flags) {}

        /**
         * Returns the current flags.
         *
         * @return integer
         */
        public function getFlags() {}

        /**
         * Checks if a specific flag is set.
         *
         * @param integer $flag
         * @return boolean
         */
        public function isFlagSet($flag) {}

        /**
         * Set the char set in which the data should be transfered (PDF 2.0)
         *
         * Possible values include: utf-8, utf-16, Shift-JIS, BigFive, GBK, or UHC.
         *
         * @param $charSet
         */
        public function setCharSet($charSet) {}

        /**
         * Get the char set in which the data should be transfered (PDF 2.0)
         *
         * @return mixed|null
         */
        public function getCharSet() {}

    }
}

namespace
{

    /**
     * Class representing an URI action
     *
     * Resolve a uniform resource identifier.
     * See PDF 32000-1:2008 - 12.6.4.7
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action_Uri extends \SetaPDF_Core_Document_Action
    {
        /**
         * Create an URI Action dictionary.
         *
         * @param string|SetaPDF_Core_Type_String $uri
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createActionDictionary($uri) {}

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the URI.
         *
         * @return string
         */
        public function getUri() {}

        /**
         * Set the URI.
         *
         * @param string $uri
         */
        public function setUri($uri) {}

    }
}

namespace
{

    /**
     * Class allowing access to embedded files.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Names_EmbeddedFiles
    {
        /**
         * The names instance
         *
         * @var SetaPDF_Core_Document_Catalog_Names
         */
        protected $_names;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog_Names $names
         */
        public function __construct(\SetaPDF_Core_Document_Catalog_Names $names) {}

        /**
         * Release cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the tree instance.
         *
         * @param boolean $create
         * @return null|SetaPDF_Core_DataStructure_NameTree
         */
        private function _getTree($create = false) {}

        /**
         * Get all embedded files.
         *
         * @return SetaPDF_Core_FileSpecification[]
         */
        public function getAll() {}

        /**
         * Get an embedded file by its name.
         *
         * @param string $name
         * @return false|SetaPDF_Core_FileSpecification
         */
        public function get($name) {}

        /**
         * Adds an embedded file by its file specification.
         *
         * @param string $name The unique name in the name tree for embedded files. This string shall be a PDF string in
         *                     PDFDoc encoding oder UTF-16BE.
         * @param SetaPDF_Core_FileSpecification $fileSpecification
         */
        public function add($name, \SetaPDF_Core_FileSpecification $fileSpecification) {}

        /**
         * Remove an embedded file.
         *
         * @param string $name No encoding is used. The name needs to be passed as it is registered in the name tree.
         * @param bool $removeObjects If this is set to false only the registration in the name tree is removed. By default
         *                            also the embedded streams will be deleted.
         * @return bool
         */
        public function remove($name, $removeObjects = true) {}

    }
}

namespace
{

    /**
     * Class representing a basic AcroForm
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_AcroForm
    {
        /**
         * The documents catalog instance
         *
         * @var SetaPDF_Core_Document
         */
        protected $_catalog;

        /**
         * The AcroForm dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * Resolves the qualified name of a form field.
         *
         * @param SetaPDF_Core_Type_Dictionary $terminalFieldDictionary The terminal field of the form field
         * @param boolean $asArray
         * @return string
         */
        public static function resolveFieldName(\SetaPDF_Core_Type_Dictionary $terminalFieldDictionary, $asArray = false) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release cycled references.
         */
        public function cleanUp() {}

        /**
         * Get and creates the AcroForm dictionary.
         *
         * @param boolean $create
         * @return boolean|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get and creates the fields array.
         *
         * @param boolean $create
         * @return SetaPDF_Core_Type_Array|false
         */
        public function getFieldsArray($create = false) {}

        /**
         * Get and creates the calculation order array.
         *
         * @param boolean $create
         * @return SetaPDF_Core_Type_Array|false
         */
        public function getCalculationOrderArray($create = false) {}

        /**
         * Checks if the NeedAppearances flag is set or not.
         *
         * @return boolean
         */
        public function isNeedAppearancesSet() {}

        /**
         * Set the NeedAppearances flag.
         *
         * This flag indicates the viewer to rerender the form field appearances.
         *
         * @param boolean $needAppearances
         * @return void
         */
        public function setNeedAppearances($needAppearances = true) {}

        /**
         * Add default values and resources to the AcroForm dictionary.
         *
         * This is needed to avoid undefined behavior in adobe reader.
         * If for example base fonts are missing, the file is digital signed and
         * include links, the signature panel will never be displayed.
         */
        public function addDefaultEntriesAndValues() {}

        /**
         * Get the default resources of the AcroForm.
         *
         * @param bool $create
         * @param null $entryKey
         * @return array|bool|SetaPDF_Core_Type_Dictionary
         */
        public function getDefaultResources($create = false, $entryKey = null) {}

        /**
         * Adds a resource.
         *
         * @param string|SetaPDF_Core_Resource $type
         * @param null|SetaPDF_Core_Resource|SetaPDF_Core_Type_IndirectObjectInterface $object
         * @return string
         * @throws InvalidArgumentException
         */
        public function addResource($type, $object = null) {}

        /**
         * Get the terminal fields objects of a document.
         *
         * @return array
         */
        public function getTerminalFieldsObjects() {}

        /**
         * Checks if a XFA key is present.
         *
         * @return boolean
         */
        public function isXfaForm() {}

        /**
         * Removes the XFA entry if present.
         *
         * @return bool
         */
        public function removeXfaInformation() {}

        /**
         * Read all terminal fields objects.
         *
         * @param array|null $fields
         * @param array $objects
         */
        private function _readTerminalFieldsObjects(?array $fields = null, array &$objects) {}

    }
}

namespace
{

    /**
     * Class representing the document catalog’s additional-actions dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_AdditionalActions
    {
        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the additional actions dictionary.
         *
         * @param bool $create Pass true to automatically create the dictionary
         * @return null|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the JavaScript action that shall be performed before closing the document.
         *
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        public function getWillClose() {}

        /**
         * Set the JavaScript action that shall be performed before closing the document.
         *
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions Returns the
         *                                                         SetaPDF_Core_Document_Catalog_AdditionalActions
         *                                                         object for method chaining.
         */
        public function setWillClose($javaScriptAction) {}

        /**
         * Get the JavaScript action that shall be performed before saving the document.
         *
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        public function getWillSave() {}

        /**
         * Set the JavaScript action that shall be performed before saving the document.
         *
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions Returns the
         *                                                         SetaPDF_Core_Document_Catalog_AdditionalActions
         *                                                         object for method chaining.
         */
        public function setWillSave($javaScriptAction) {}

        /**
         * Get the JavaScript action that shall be performed after saving the document.
         *
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        public function getDidSave() {}

        /**
         * Set the JavaScript action that shall be performed after saving the document.
         *
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions Returns the
         *                                                         SetaPDF_Core_Document_Catalog_AdditionalActions
         *                                                         object for method chaining.
         */
        public function setDidSave($javaScriptAction) {}

        /**
         * Get the JavaScript action that shall be performed before printing the document.
         *
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        public function getWillPrint() {}

        /**
         * Set the JavaScript action that shall be performed before printing the document.
         *
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions Returns the
         *                                                         SetaPDF_Core_Document_Catalog_AdditionalActions
         *                                                         object for method chaining.
         */
        public function setWillPrint($javaScriptAction) {}

        /**
         * Get the JavaScript action that shall be performed after printing the document.
         *
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        public function getDidPrint() {}

        /**
         * Set the JavaScript action that shall be performed after printing the document.
         *
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions Returns the
         *                                                         SetaPDF_Core_Document_Catalog_AdditionalActions
         *                                                         object for method chaining.
         */
        public function setDidPrint($javaScriptAction) {}

        /**
         * Get the action.
         *
         * @param string $name
         * @param boolean $instance
         * @return null|SetaPDF_Core_Document_Action_JavaScript
         */
        protected function _getAction($name, $instance = true) {}

        /**
         * Set the action.
         *
         * @param string $name
         * @param string|SetaPDF_Core_Document_Action_JavaScript|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $javaScriptAction
         */
        protected function _setAction($name, $javaScriptAction) {}

    }
}

namespace
{

    /**
     * Class for handling the catalogs extensions dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Extensions
    {
        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the extensions dictionary.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get all defined developer extensions.
         *
         * The method will return an array of the following structure:
         * [$name => [baseVersion => "...", extensionLevel => "..."], ...]
         *
         * @return array
         */
        public function getExtensions() {}

        /**
         * Get a developer extension by its name.
         *
         * This method will return an array with the "baseVersion" and "extensionLevel" keys or false
         * if no extension was found.
         *
         * @param string $name
         * @return array|bool
         */
        public function getExtension($name) {}

        /**
         * Set the data of a developer extension.
         *
         * @param string $name
         * @param string $baseVersion
         * @param integer $extensionLevel
         */
        public function setExtension($name, $baseVersion, $extensionLevel) {}

        /**
         * Removes a developer extension from the dictionary.
         *
         * @param string $name
         * @return bool
         */
        public function removeExtension($name) {}

    }
}

namespace
{

    /**
     * Class for handling Names in a PDF document
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Names
    {
        /**
         * Name/Category key
         *
         * @var string
         */
        const DESTS = 'Dests';

        /**
         * Name/Category key
         *
         * @var string
         */
        const AP = 'AP';

        /**
         * Name/Category key
         *
         * @var string
         */
        const JAVA_SCRIPT = 'JavaScript';

        /**
         * Name/Category key
         *
         * @var string
         */
        const PAGES = 'Pages';

        /**
         * Name/Category key
         *
         * @var string
         */
        const TEMPLATES = 'Templates';

        /**
         * Name/Category key
         *
         * @var string
         */
        const IDS = 'IDS';

        /**
         * Name/Category key
         *
         * @var string
         */
        const URLS = 'URLS';

        /**
         * Name/Category key
         *
         * @var string
         */
        const EMBEDDED_FILES = 'EmbeddedFiles';

        /**
         * Name/Category key
         *
         * @var string
         */
        const ALTERNATE_PRESENTATIONS = 'AlternatePresentations';

        /**
         * Name/Category key
         *
         * @var string
         */
        const RENDITIONS = 'Renditions';

        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The Names dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_namesDictionary;

        /**
         * @var array
         */
        protected $_nameTrees = [/** value is missing */];

        /**
         * @var SetaPDF_Core_Document_Catalog_Names_EmbeddedFiles
         */
        protected $_embeddedFiles;

        /**
         * Returns all available category keys of possible name trees.
         *
         * @return array
         */
        public static function getAvailableCategoryKeys() {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Get a name tree by its name.
         *
         * @param string $name
         * @param boolean $create
         * @return SetaPDF_Core_DataStructure_NameTree|null
         */
        public function getTree($name, $create = false) {}

        /**
         * Get all available name trees.
         *
         * @return array Array of SetaPDF_Core_DataStructure_NameTree objects
         * @see getAvailableCategoryKeys()
         */
        public function getTrees() {}

        /**
         * Returns the Names dictionary in the document's catalog.
         *
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getNamesDictionary($create = false) {}

        /**
         * Release objects to free memory and cycled references.
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

        /**
         * Get the embedded files helper.
         *
         * @return SetaPDF_Core_Document_Catalog_Names_EmbeddedFiles
         */
        public function getEmbeddedFiles() {}

    }
}

namespace
{

    /**
     * Class for handling optional content
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_OptionalContent
    {
        /**
         * State constant
         * 
         * @var string
         */
        const STATE_ON = 'ON';

        /**
         * State constant
         * 
         * @var string
         */
        const STATE_OFF = 'OFF';

        /**
         * State constant
         * 
         * @var string
         */
        const STATE_UNCHANGED = 'Unchanged';

        /**
         * The documents catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The optional contents properties dictionary
         *  
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_propertiesDictionary;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Release resources / cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Get and creates the optional content properties dictionary.
         *
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getOptionalContentPropertiesDictionary($create = false) {}

        /**
         * Get the default viewing dictionary.
         * 
         * @see PDF 32000-1:2008 - 8.11.4.2 Optional Content Properties Dictionary
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDefaultViewingDictionary($create = false) {}

        /**
         * Get and/or create an array entry in the default viewing dictionary.
         * 
         * @param string $name
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Array
         */
        protected function _getArrayFromDefaultViewing($name, $create = false) {}

        /**
         * Get and/or create the Order array in the default viewing dictionary.
         * 
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Array
         */
        public function getOrderArray($create = false) {}

        /**
         * Get and/or create the ON array in the default viewing dictionary.
         *
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Array
         */
        public function getOnArray($create = false) {}

        /**
         * Get and/or create the OFF array in the default viewing dictionary.
         *
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Array
         */
        public function getOffArray($create = false) {}

        /**
         * Get and/or create the AS array in the default viewing dictionary.
         *
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Array
         */
        public function getAsArray($create = false) {}

        /**
         * Get the base state from the default viewing dictionary.
         *
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @return string
         */
        public function getBaseState() {}

        /**
         * Set the base state in the default viewing dictionary.
         *
         * @see PDF 32000-1:2008 - 8.11.4.3 Optional Content Configuration Dictionaries
         * @param string $baseState
         */
        public function setBaseState($baseState) {}

        /**
         * Set the default state of the optional content group to on.
         *  
         * @param SetaPDF_Core_Document_OptionalContent_Group $group
         */
        public function setOn(\SetaPDF_Core_Document_OptionalContent_Group $group) {}

        /**
         * Set the default state of the optional content group to off.
         *
         * @param SetaPDF_Core_Document_OptionalContent_Group $group
         */
        public function setOff(\SetaPDF_Core_Document_OptionalContent_Group $group) {}

        /**
         * Create and add usage application dictionaries for the given optional content group.
         * 
         * The usage definition in an optional content group will only apply to automatically
         * adjustment if the group is referenced by a usage application dictionary.
         * 
         * <code>
         * $triangle = $optionalContent->appendGroup('Triangle');
         * // Define the usage
         * $triangle->usage()->setPrintState(SetaPDF_Core_Document_Catalog_OptionalContent::STATE_OFF);
         * // Now add it to an usage application dictionary
         * $optionalContent->addUsageApplication($triangle);
         * </code>
         *
         * @see SetaPDF_Core_Document_OptionalContent_Group_Usage
         * @param SetaPDF_Core_Document_OptionalContent_Group $group
         */
        public function addUsageApplication(\SetaPDF_Core_Document_OptionalContent_Group $group) {}

        /**
         * Get all available content groups.
         * 
         * @return SetaPDF_Core_Document_OptionalContent_Group[]
         */
        public function getGroups() {}

        /**
         * Get a group by its name.
         * 
         * @param string $name The group name
         * @param string $encoding The input encoding
         * @return false|SetaPDF_Core_Document_OptionalContent_Group
         */
        public function getGroup($name, $encoding = 'UTF-8') {}

        /**
         * This method adds a method to the OCGs array.
         * 
         * By adding a group with this method the group will not be added to the user
         * interface.
         *  
         * @param SetaPDF_Core_Document_OptionalContent_Group|string $group
         * @return SetaPDF_Core_Document_OptionalContent_Group
         */
        public function addGroup($group) {}

        /**
         * Append an optional content group to the outline structure.
         * 
         * @param string|SetaPDF_Core_Document_OptionalContent_Group $group
         * @param SetaPDF_Core_Document_OptionalContent_Group $parent
         * @param integer|null $afterIndex
         * @param string|SetaPDF_Core_Document_OptionalContent_Group $nextToOrLabel
         * @param string $label
         * @return SetaPDF_Core_Document_OptionalContent_Group
         */
        public function appendGroup($group, ?\SetaPDF_Core_Document_OptionalContent_Group $parent = null, $afterIndex = null, $nextToOrLabel = null, $label = '') {}

        /**
         * Prepends an optional content group to the outline structure.
         *
         * If the $beforeIndex parameter is out of range the group will be appended.
         *
         * @param string|SetaPDF_Core_Document_OptionalContent_Group $group
         * @param SetaPDF_Core_Document_OptionalContent_Group $parent
         * @param integer|null $beforeIndex
         * @param string|SetaPDF_Core_Document_OptionalContent_Group $nextToOrLabel
         * @param string $label
         * @return SetaPDF_Core_Document_OptionalContent_Group
         */
        public function prependGroup($group, ?\SetaPDF_Core_Document_OptionalContent_Group $parent = null, $beforeIndex = 0, $nextToOrLabel = null, $label = '') {}

        /**
         * Finds the correct order array entry by an optional content group object.
         * 
         * @param SetaPDF_Core_Type_Array $currentArray
         * @param SetaPDF_Core_Document_OptionalContent_Group $group
         * @param integer $key
         * @return Iterator|SetaPDF_Core_Type_Array
         * @internal
         */
        protected function _findOrderArrayByGroup(\SetaPDF_Core_Type_Array $currentArray, \SetaPDF_Core_Document_OptionalContent_Group $group, &$key = null) {}

        /**
         * Finds and prepares an order array.
         * 
         * @param SetaPDF_Core_Type_Array $currentArray
         * @param SetaPDF_Core_Document_OptionalContent_Group $parent
         * @return SetaPDF_Core_Type_Array
         * @internal
         */
        protected function _findAndPrepareOrderEntry(\SetaPDF_Core_Type_Array $currentArray, \SetaPDF_Core_Document_OptionalContent_Group $parent) {}

        /**
         * Implementation of IteratorAggregate.
         * 
         * A separate iterator is needed to receive SetaPDF_Core_Document_OptionalContent_Group objects while iterating.
         * 
         * @see IteratorAggregate::getIterator()
         * @return SetaPDF_Core_Document_OptionalContent_Iterator|EmptyIterator
         */
        public function getIterator() {}

    }
}

namespace
{

    /**
     * Class for handling a documents outline
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Outlines
    {
        /**
         * The documents catalog instance.
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The root outlines dictionary.
         * 
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_outlinesDictionary;

        /**
         * The iterator instance.
         * 
         * @var RecursiveIteratorIterator
         */
        protected $_iterator;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release memory / Cycled references.
         */
        public function cleanUp() {}

        /**
         * Get and creates the Outlines dictionary.
         * 
         * @param boolean $create
         * @return NULL|SetaPDF_Core_Type_Dictionary
         * @internal
         */
        public function getOutlinesDictionary($create = false) {}

        /**
         * Get an item instance of the item referenced in the 'First' key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem The first item of the outlines root dictionary or false if no
         *                                                    item is set.
         */
        public function getFirstItem() {}

        /**
         * Get an item instance of the item referenced in the 'Last' key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem The last item of the outlines root dictionary or false if no
         *                                                    item is set.
         */
        public function getLastItem() {}

        /**
         * Get the iterator reference for the outlines.
         * 
         * @see IteratorAggregate::getIterator()
         * @param boolean $recreate Specify to recreate the iterator instance
         * @return EmptyIterator|RecursiveIteratorIterator A reference to the iterator
         */
        public function getIterator($recreate = false) {}

        /**
         * Append an item to the outline.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $item The outline item that should be append
         * @return SetaPDF_Core_Document_Catalog_Outlines
         */
        public function appendChild(\SetaPDF_Core_Document_OutlinesItem $item) {}

        /**
         * Append a copy of an item or outline to this outline.
         *
         * @param SetaPDF_Core_Document_OutlinesItem|SetaPDF_Core_Document_Catalog_Outlines $item The item or root outlines dictionary
         */
        public function appendChildCopy($item) {}

        /**
         * Checks if an item exists at a specific position.
         *
         * @see ArrayAccess::offsetExists()
         * @param string $offset
         * @return boolean
         */
        public function offsetExists($offset) {}

        /**
         * Set an item at a specific position.
         *
         * @see ArrayAccess::offsetSet()
         * @see append()
         * @see appendChild()
         * @see remove()
         * @param null|string $offset
         * @param SetaPDF_Core_Document_OutlinesItem $value
         */
        public function offsetSet($offset, $value) {}

        /**
         * Get an item by a specific position.
         *
         * @see ArrayAccess::offsetGet()
         * @param string $offset
         * @return SetaPDF_Core_Document_OutlinesItem
         * @throws InvalidArgumentException
         */
        public function offsetGet($offset) {}

        /**
         * Removes an item at a specific position.
         *
         * @see ArrayAccess::offsetUnset()
         * @param string $offset
         * @return SetaPDF_Core_Document_OutlinesItem
         */
        public function offsetUnset($offset) {}

    }
}

namespace
{

    /**
     * Class representing the output intents entry
     *
     * @see PDF 32000-1:2008 - 14.11.5 Output Intents
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_OutputIntents
    {
        /**
         * The documents catalog instance
         *
         * @var SetaPDF_Core_Document
         */
        protected $_catalog;

        /**
         * The output intents array
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_array;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release cycled references.
         */
        public function cleanUp() {}

        /**
         * Get and creates the AcroForm dictionary.
         *
         * @param boolean $create
         * @return boolean|SetaPDF_Core_Type_Array
         */
        public function getArray($create = false) {}

        /**
         * Get an array of available output intents.
         *
         * @return SetaPDF_Core_OutputIntent[]
         */
        public function getOutputIntents() {}

        /**
         * Add an output intent.
         *
         * @param SetaPDF_Core_OutputIntent $outputIntent
         */
        public function addOutputIntent(\SetaPDF_Core_OutputIntent $outputIntent) {}

    }
}

namespace
{

    /**
     * Class for handling page labels
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_PageLabels
    {
        /**
         * Style constant
         * 
         * Decimal arabic numerals
         * 
         * @var string
         */
        const STYLE_DECIMAL_NUMERALS = 'D';

        /**
         * Style constant
         *
         * Uppercase roman numerals
         *
         * @var string
         */
        const STYLE_UPPERCASE_ROMAN_NUMERALS = 'R';

        /**
         * Style constant
         *
         * Lowercase roman numerals
         *
         * @var string
         */
        const STYLE_LOWERCASE_ROMAN_NUMERALS = 'r';

        /**
         * Style constant
         *
         * Uppercase letters (A to Z for the first 26 pages, AA to ZZ for the next 26, and so on)
         *
         * @var string
         */
        const STYLE_UPPERCASE_LETTERS = 'A';

        /**
         * Style constant
         *
         * Lowercase letters (a to z for the first 26 pages, aa to zz for the next 26, and so on)
         *
         * @var string
         */
        const STYLE_LOWERCASE_LETTERS = 'a';

        /**
         * The documents catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The number tree
         * 
         * @var SetaPDF_Core_DataStructure_NumberTree
         */
        protected $_tree;

        /**
         * Label ranges
         *  
         * @var array
         */
        protected $_ranges = [/** value is missing */];

        /**
         * Converts an integer to roman numerals.
         * 
         * @param integer $integer
         * @param boolean $uppercase
         * @return string
         */
        public static function integerToRoman($integer, $uppercase = true) {}

        /**
         * Converts an integer to a letter.
         * 
         * @param integer $integer
         * @param boolean $uppercase
         * @return string
         */
        public static function integerToLetters($integer, $uppercase = true) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release memory / cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the page label by a page number/index.
         * 
         * @param integer $pageNo The page number/index to get the page label for
         * @param string $encoding The output encoding
         * @return string Returns the page label for the specific page number/index
         */
        public function getPageLabelByPageNo($pageNo, $encoding = 'UTF-8') {}

        /**
         * Get the tree page labels number tree object.
         *  
         * @param boolean $create
         * @return null|SetaPDF_Core_DataStructure_NumberTree
         */
        protected function _getTree($create = false) {}

        /**
         * Get the page label ranges.
         * 
         * @return array
         */
        protected function _getRanges() {}

        /**
         * Ger all ranges.
         * 
         * @param string $encoding
         * @return array
         */
        public function getRanges($encoding = 'UTF-8') {}

        /**
         * Get a range by starting page number.
         * 
         * @param integer $startPage
         * @param string $encoding
         * @return array|null
         */
        public function getRange($startPage, $encoding = 'UTF-8') {}

        /**
         * Removes a range by the starting page number.
         * 
         * @param integer $startPage
         * @throws InvalidArgumentException
         * @return null|boolean
         */
        public function removeRange($startPage) {}

        /**
         * Add a page label range.
         * 
         * @param integer $startPage The page index to start the page label range
         * @param string $style The page label style. See {@link SetaPDF_Core_Document_Catalog_PageLabels}::STYLE_XXX constants
         * @param string $prefix A page label prefix
         * @param integer $firstPageValue The value of the numeric portion for the first page in the range
         * @param string $encoding The input encoding
         * @throws InvalidArgumentException
         */
        public function addRange($startPage, $style = null, $prefix = '', $firstPageValue = 1, $encoding = 'UTF-8') {}

    }
}

namespace
{

    /**
     * Class for handling PDF pages
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Pages
    {
        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The pages root object
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_pagesRootObject;

        /**
         * The page count
         *
         * @var integer
         */
        protected $_pageCount = 0;

        /**
         * The current pages object while walking through the page tree
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_currentPagesObject;

        /**
         * An array holding the native indirect objects of pages
         *
         * @var array
         */
        protected $_pageObjects = [/** value is missing */];

        /**
         * A helper array matching objects to page numbers
         *
         * @var array
         */
        protected $_pageObjectsToPageNumbers = [/** value is missing */];

        /**
         * An array holding page instances
         *
         * @var SetaPDF_Core_Document_Page[]
         */
        protected $_pages = [/** value is missing */];

        /**
         * Caches annotation object identifiers to page numbers
         *
         * @var array
         */
        protected $_annotationCache = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release memory / cycled references.
         */
        public function cleanUp() {}

        /**
         * Returns the page count of the document.
         *
         * @see Countable::count()
         * @return int
         */
        public function count() {}

        /**
         * Deletes a page.
         *
         * @param integer $pageNumber
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function deletePage($pageNumber) {}

        /**
         * Get a pages indirect object.
         *
         * @param integer $pageNumber
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getPagesIndirectObject($pageNumber) {}

        /**
         * Get a page.
         *
         * @param integer $pageNumber
         * @return SetaPDF_Core_Document_Page
         */
        public function getPage($pageNumber) {}

        /**
         * Get the last page.
         *
         * @return SetaPDF_Core_Document_Page
         */
        public function getLastPage() {}

        /**
         * Extracts a page and prepares it for the usage in another document.
         *
         * This method is needed if a page should be extracted independently. For example the original
         * document should be modified after extraction and the page itself will be edited in the new
         * document (inherited attributes get flattened).
         *
         * @param integer $pageNumber
         * @param SetaPDF_Core_Document $document
         * @param boolean $returnPageInstance
         * @return SetaPDF_Core_Document_Page|SetaPDF_Core_Type_IndirectObject
         */
        public function extract($pageNumber, \SetaPDF_Core_Document $document, $returnPageInstance = true) {}

        /**
         * Find the page of an annotation object.
         *
         * @param SetaPDF_Core_Type_IndirectObject $annotationIndirectObject
         * @return boolean|SetaPDF_Core_Document_Page
         */
        public function getPageByAnnotation(\SetaPDF_Core_Type_IndirectObject $annotationIndirectObject) {}

        /**
         * Get the page number by a page indirect object.
         *
         * If the object is not found in the page tree, false is returned.
         *
         * @param SetaPDF_Core_Type_IndirectObject|SetaPDF_Core_Type_IndirectReference $indirectObject
         * @return boolean|integer
         * @throws InvalidArgumentException
         */
        public function getPageNumberByIndirectObject($indirectObject) {}

        /**
         * Get a page by its indirect object.
         *
         * @param SetaPDF_Core_Type_IndirectObject|SetaPDF_Core_Type_IndirectReference $indirectObject
         * @return SetaPDF_Core_Document_Page|false
         */
        public function getPageByIndirectObject($indirectObject) {}

        /**
         * Get the page number by a page object.
         *
         * If the object is not found in the page tree, false is returned.
         *
         * @param SetaPDF_Core_Document_Page $page
         * @return boolean|integer
         */
        public function getPageNumberByPageObject(\SetaPDF_Core_Document_Page $page) {}

        /**
         * This method makes sure that all pages are read.
         *
         * It walks the complete page tree to cache/get all page objects in one iteration.
         * This method should be used if all pages of a document should be handled. It is
         * much faster than using the random access.
         *
         * @throws BadMethodCallException
         */
        public function ensureAllPageObjects() {}

        /**
         * Method to extract page objects recursively.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $node
         */
        protected function _ensureAllPageObjects(\SetaPDF_Core_Type_IndirectObjectInterface $node) {}

        /**
         * Ensures that a page object is read and available in the $_pageObjects property.
         *
         * @param integer $pageNumber
         * @return mixed
         * @throws InvalidArgumentException
         */
        protected function _ensurePageObject($pageNumber) {}

        /**
         * This method checks an entry in a Kids array for valid values and repairs it (if possible).
         *
         * @param SetaPDF_Core_Type_Array $kids
         * @param integer $offset
         * @return mixed
         * @throws SetaPDF_Core_Exception
         */
        private function _ensureIndirectObjectAndDictionaryAndType(\SetaPDF_Core_Type_Array $kids, $offset) {}

        /**
         * Resolves a page object by walking forwards through the page tree.
         *
         * This method is optimized, to take the fastest way through the page tree, beginning at
         * the pages root node. The page tree will be walked forward.
         *
         * @param integer $pageNumber The original page number - 1
         * @throws SetaPDF_Core_Exception
         */
        protected function _readPage($pageNumber) {}

        /**
         * Resolves a page object by walking backwards through the page tree.
         *
         * This method is optimized to take the fastest way through the page tree,
         * beginning at the pages root node. The page tree will be walked forward.
         *
         * @param integer $pageNumber
         * @throws SetaPDF_Core_Exception
         */
        protected function _readPageBackwards($pageNumber) {}

        /**
         * Resolves the root page tree node.
         *
         * @param boolean $create
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function resolvePagesRootObject($create = false) {}

        /**
         * Create a page.
         *
         * @param string|array $format The page format. See constants in SetaPDF_Core_PageFormats and the
         *                             {@link SetaPDF.Core.PageFormats::getFormat() getFormat()} method.
         * @param string $orientation The orientation. See constants in SetaPDF_Core_PageFormats.
         * @param boolean $append Whether the page should be appended to the page tree or not.
         * @return SetaPDF_Core_Document_Page
         */
        public function create($format, $orientation = \SetaPDF_Core_PageFormats::ORIENTATION_PORTRAIT, $append = true) {}

        /**
         * Append pages to the existing pages.
         *
         * @param SetaPDF_Core_Document_Page|SetaPDF_Core_Document_Catalog_Pages|array $pages
         * @throws SetaPDF_Core_SecHandler_Exception
         * @throws InvalidArgumentException
         */
        public function append($pages) {}

        /**
         * Prepend pages to the existing pages.
         *
         * @param SetaPDF_Core_Document_Catalog_Pages|SetaPDF_Core_Document_Page[]|SetaPDF_Core_Document_Page $pages
         * @throws SetaPDF_Core_SecHandler_Exception
         * @throws InvalidArgumentException
         */
        public function prepend($pages) {}

    }
}

namespace
{

    /**
     * Class representing a helper object for the Perms entry in the document catalog.
     *
     * @see PDF 32000-1:2008 - 12.8.4 Permissions
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_Permissions
    {
        /**
         * The documents catalog instance
         *
         * @var SetaPDF_Core_Document
         */
        protected $_catalog;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Release cycled references.
         */
        public function cleanUp() {}

        /**
         * Checks if usage rights are defined for this document.
         *
         * @return bool
         */
        public function hasUsageRights() {}

        /**
         * Removes the usage rights if they are defined for this document.
         *
         * @return bool
         */
        public function removeUsageRights() {}

    }
}

namespace
{

    /**
     * Class representing the access to the ViewerPreferences dictionary of a document
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog_ViewerPreferences
    {
        /**
         * Constant value specifying how to display the document on exiting full-screen mode.
         *
         * Neither document outline nor thumbnail images visible.
         *
         * @var string
         */
        const NON_FULL_SCREEN_PAGE_MODE_USE_NONE = 'UseNone';

        /**
         * Constant value specifying how to display the document on exiting full-screen mode.
         *
         * Document outline visible.
         *
         * @var string
         */
        const NON_FULL_SCREEN_PAGE_MODE_USE_OUTLINES = 'UseOutlines';

        /**
         * Constant value specifying how to display the document on exiting full-screen mode.
         *
         * Thumbnail images visible.
         *
         * @var string
         */
        const NON_FULL_SCREEN_PAGE_MODE_USE_THUMBS = 'UseThumbs';

        /**
         * Constant value specifying how to display the document on exiting full-screen mode.
         *
         * Optional content group panel visible.
         *
         * @var string
         */
        const NON_FULL_SCREEN_PAGE_MODE_USE_OC = 'UseOC';

        /**
         * Constant value for predominant reading order for text.
         *
         * Left to right.
         *
         * @var string
         */
        const DIRECTION_L2R = 'L2R';

        /**
         * Constant value for predominant reading order for text.
         *
         * Right to left.
         *
         * @var string
         */
        const DIRECTION_R2L = 'R2L';

        /**
         * Constant value of the the page scaling option that shall be selected when a print dialog is displayed for this document.
         *
         * No page scaling.
         *
         * @var string
         */
        const PRINT_SCALING_NONE = 'None';

        /**
         * Constant value of the the page scaling option that shall be selected when a print dialog is displayed for this document.
         *
         * Reader’s default print scaling.
         *
         * @var string
         */
        const PRINT_SCALING_APP_DEFAULT = 'AppDefault';

        /**
         * Constant value of the paper handling option that shall be used when printing the file from the print dialog.
         *
         * Print single-sided.
         *
         * @var string
         */
        const DUPLEX_SIMPLEX = 'Simplex';

        /**
         * Constant value of the paper handling option that shall be used when printing the file from the print dialog.
         *
         * Duplex and flip on the short edge of the sheet.
         *
         * @var string
         */
        const DUPLEX_FLIP_SHORT_EDGE = 'DuplexFlipShortEdge';

        /**
         * Constant value of the paper handling option that shall be used when printing the file from the print dialog.
         *
         * Duplex and flip on the long edge of the sheet.
         *
         * @var string
         */
        const DUPLEX_FLIP_LONG_EDGE = 'DuplexFlipLongEdge';

        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Catalog $catalog
         */
        public function __construct(\SetaPDF_Core_Document_Catalog $catalog) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

        /**
         * Set the flag specifying whether to hide the conforming reader’s tool bars when the document is active.
         *
         * @param boolean $value A boolean value defining whether to hide the tool bars or not.
         */
        public function setHideToolbar($value = true) {}

        /**
         * Get the flag specifying whether to hide the conforming reader’s tool bars when the document is active.
         *
         * @return boolean
         */
        public function getHideToolbar() {}

        /**
         * Set the flag specifying whether to hide the conforming reader’s menu bar when the document is active.
         *
         * Does not affect the display through a browser plugin.
         *
         * @param boolean $value A boolean value defining whether to hide the menu bar or not.
         */
        public function setHideMenubar($value = true) {}

        /**
         * Get the flag specifying whether to hide the conforming reader’s menu bar when the document is active.
         *
         * @return boolean
         */
        public function getHideMenubar() {}

        /**
         * Set flag specifying whether to hide user interface elements in the document’s window
         * (such as scroll bars and navigation controls), leaving only the document’s contents displayed.
         *
         * @param boolean $value A boolean value defining whether to hide user interface elements in the document's windows.
         */
        public function setHideWindowUI($value = true) {}

        /**
         * Get flag specifying whether to hide user interface elements in the document’s window
         * (such as scroll bars and navigation controls), leaving only the document’s contents displayed.
         *
         * @return boolean
         */
        public function getHideWindowUI() {}

        /**
         * Set the flag specifying whether to resize the document’s window to fit the size of the first displayed page.
         *
         * @param boolean $value A boolean value defining whether to resize the document’s window.
         */
        public function setFitWindow($value = true) {}

        /**
         * Get the flag specifying whether to resize the document’s window to fit the size of the first displayed page.
         *
         * @return boolean
         */
        public function getFitWindow() {}

        /**
         * Set the flag specifying whether to position the document’s window in the center of the screen.
         *
         * @param boolean $value A boolean value defining whether to position the document’s window in the center.
         */
        public function setCenterWindow($value = true) {}

        /**
         * Get the flag specifying whether to position the document’s window in the center of the screen.
         *
         * @return boolean
         */
        public function getCenterWindow() {}

        /**
         * Set the flag whether the title or the filename of the document should be displayed in the window’s title bar.
         *
         * @param boolean $value The value defining whether if the title of the document should be displayed in the
         *                       window’s title bar (true) or the filename (false).
         */
        public function setDisplayDocTitle($value = true) {}

        /**
         * Get the flag whether the title or the filename of the document should be displayed in the window’s title bar.
         *
         * @return boolean
         */
        public function getDisplayDocTitle() {}

        /**
         * Set the document's page mode, specifying how to display the document on exiting full-screen mode.
         *
         * @param string $name A constant value of
         *                     {@link SetaPDF_Core_Document_Catalog_ViewerPreferences::NON_FULL_SCREEN_PAGE_MODE_XXX}.
         */
        public function setNonFullScreenPageMode($name = self::NON_FULL_SCREEN_PAGE_MODE_USE_NONE) {}

        /**
         * Get the document's page mode, specifying how to display the document on exiting full-screen mode.
         *
         * @return string
         */
        public function getNonFullScreenPageMode() {}

        /**
         * Set the predominant reading order for text.
         *
         * @param string $name A constant value of {@link SetaPDF_Core_Document_Catalog_ViewerPreferences::DIRECTION_XXX}.
         */
        public function setDirection($name) {}

        /**
         * Get the predominant reading order for text.
         *
         * @return string
         */
        public function getDirection() {}

        /**
         * Set the page boundary representing the area of a page that shall be displayed when
         * viewing the document on the screen.
         *
         * @param string $boundaryName A boundary name as defined as a constant in {@link SetaPDF_Core_PageBoundaries}.
         * @throws InvalidArgumentException
         */
        public function setViewArea($boundaryName) {}

        /**
         * Get the page boundary representing the area of a page that shall be displayed when
         * viewing the document on the screen.
         *
         * @return string
         */
        public function getViewArea() {}

        /**
         * Set the name of the page boundary to which the contents of a page shall be clipped when
         * viewing the document on the screen.
         *
         * @param string $boundaryName A boundary name as defined as a constant in {@link SetaPDF_Core_PageBoundaries}.
         * @throws InvalidArgumentException
         */
        public function setViewClip($boundaryName) {}

        /**
         * Get the name of the page boundary to which the contents of a page shall be clipped when
         * viewing the document on the screen.
         *
         * @return string
         */
        public function getViewClip() {}

        /**
         * Set the name of the page boundary representing the area of a page that shall be rendered
         * when printing the document.
         *
         * @param string $boundaryName A boundary name as defined as a constant in {@link SetaPDF_Core_PageBoundaries}.
         * @throws InvalidArgumentException
         */
        public function setPrintArea($boundaryName) {}

        /**
         * Get the name of the page boundary representing the area of a page that shall be rendered
         * when printing the document.
         *
         * @return string
         */
        public function getPrintArea() {}

        /**
         * Set the name of the page boundary to which the contents of a page shall be clipped
         * when printing the document.
         *
         * @param string $boundaryName A boundary name as defined as a constant in {@link SetaPDF_Core_PageBoundaries}.
         * @throws InvalidArgumentException
         */
        public function setPrintClip($boundaryName) {}

        /**
         * Get the name of the page boundary to which the contents of a page shall be clipped
         * when printing the document.
         *
         * @return string
         */
        public function getPrintClip() {}

        /**
         * Set the page scaling option that shall be selected when a print dialog is displayed for this document.
         *
         * @param string $name A constant value of SetaPDF_Core_Document_Catalog_ViewerPreferences::PRINT_SCALING_XXX.
         */
        public function setPrintScaling($name) {}

        /**
         * Get the page scaling option that shall be selected when a print dialog is displayed for this document.
         *
         * @return string
         */
        public function getPrintScaling() {}

        /**
         * Set the paper handling option that shall be used when printing the file from the print dialog.
         *
         * @param string|false $name A constant value of SetaPDF_Core_Document_Catalog_ViewerPreferences::DUPLEX_XXX.
         *                           To remove this preference pass false.
         */
        public function setDuplex($name) {}

        /**
         * Get the paper handling option that shall be used when printing the file from the print dialog.
         *
         * @return string|null
         */
        public function getDuplex() {}

        /**
         * Set the flag specifying whether the PDF page size shall be used to select the input paper tray.
         *
         * @param boolean $value A boolean value
         */
        public function setPickTrayByPdfSize($value = true) {}

        /**
         * Get the flag specifying whether the PDF page size shall be used to select the input paper tray.
         *
         * @param null|boolean $defaultValue
         * @return bool|mixed
         */
        public function getPickTrayByPdfSize($defaultValue = null) {}

        /**
         * Set the page numbers used to initialize the print dialog box when the file is printed.
         *
         * @param array|null $pageRange An array of even number of integer values to be interpreted in pairs. Each pair
         *                              represents the first and last pages in a sub-range of pages.
         */
        public function setPrintPageRange(?array $pageRange = null) {}

        /**
         * Get the page numbers used to initialize the print dialog box when the file is printed.
         *
         * @param array $defaultValue A default value that will be returned if no preference is defined.
         * @return array
         */
        public function getPrintPageRange(array $defaultValue = [/** value is missing */]) {}

        /**
         * Set the number of copies that shall be printed when the print dialog is opened for this file.
         *
         * @param integer $numCopies The number of copies.
         */
        public function setNumCopies($numCopies) {}

        /**
         * Get the number of copies that shall be printed when the print dialog is opened.
         *
         * @param int $defaultValue A default value, to be used if no preference is defined.
         * @return bool|mixed
         */
        public function getNumCopies($defaultValue = 1) {}

        /**
         * Helper method to get a value of the ViewerPreferences dictionary.
         *
         * @param string $key
         * @param mixed $default
         * @param boolean $pdfObject
         * @return mixed
         */
        protected function _getValue($key, $default = false, $pdfObject = false) {}

        /**
         * Helper method for setting boolean values.
         *
         * @param string $key
         * @param boolean $value
         */
        protected function _setBooleanValue($key, $value) {}

        /**
         * Helper method for setting a name value.
         *
         * @param string $key
         * @param string $name
         */
        protected function _setNameValue($key, $name) {}

        /**
         * Helper method for setting a value.
         *
         * @param string $key
         * @param SetaPDF_Core_Type_AbstractType $value
         */
        protected function _setValue($key, \SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Helper method for removing a key from the ViewerPreferences dictionary.
         *
         * @param string $key
         */
        protected function _removeKey($key) {}

    }
}

namespace
{

    /**
     * A helper class for an optional content group object to manage the usage dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_OptionalContent_Group_Usage
    {
        /**
         * The optional content group object
         * 
         * @var SetaPDF_Core_Document_OptionalContent_Group
         */
        protected $_group;

        /**
         * The constructor .
         * 
         * @param SetaPDF_Core_Document_OptionalContent_Group $group
         */
        public function __construct(\SetaPDF_Core_Document_OptionalContent_Group $group) {}

        /**
         * Release resources / cycled references.
         */
        public function cleanUp() {}

        /**
         * Gets and/or creates the usage dictionary.
         *
         * Method is normally only used internally.
         *
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Set the print state.
         * 
         * @param string|false $state
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function setPrintState($state = \SetaPDF_Core_Document_Catalog_OptionalContent::STATE_ON) {}

        /**
         * Get the print state.
         *
         * @return string|null
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function getPrintState() {}

        /**
         * Set the view state.
         *
         * @param string|false $state
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function setViewState($state = \SetaPDF_Core_Document_Catalog_OptionalContent::STATE_ON) {}

        /**
         * Get the view state.
         *
         * @return string|null
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function getViewState() {}

        /**
         * Set the export state.
         *
         * @param string|false $state
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function setExportState($state = \SetaPDF_Core_Document_Catalog_OptionalContent::STATE_ON) {}

        /**
         * Get the export state.
         *
         * @return string|null
         * @see PDF 32000-1:2008 - 8.11.4.4 Usage and Usage Application Dictionaries
         */
        public function getExportState() {}

        /**
         * Set a state by name.
         * 
         * @param string $name
         * @param string $state
         */
        protected function _setState($name, $state) {}

        /**
         * Get a state by name.
         *
         * @param string $name
         * @return string
         */
        protected function _getState($name) {}

    }
}

namespace
{

    /**
     * An optional content group
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_OptionalContent_Group implements \SetaPDF_Core_Resource
    {
        /**
         * The optional content group dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The indirect object of this group
         * 
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectObject;

        /**
         * A usage helper class
         * 
         * @var SetaPDF_Core_Document_OptionalContent_Group_Usage
         */
        protected $_usage;

        /**
         * Creates an optional content group dictionary.
         * 
         * @param string $name
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function createOCGDictionary($name, $encoding = 'UTF-8') {}

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary|string $ocgDictionary
         * @throws InvalidArgumentException
         * @see createOCGDictionary()
         */
        public function __construct($ocgDictionary) {}

        /**
         * Release memory / cycled references.
         */
        public function cleanUp() {}

        /**
         * Gets the usage helper class.
         *
         * @return SetaPDF_Core_Document_OptionalContent_Group_Usage
         */
        public function usage() {}

        /**
         * Get the name of the optional content group.
         * 
         * @param string $encoding
         * @return string
         */
        public function getName($encoding = 'UTF-8') {}

        /**
         * Set the name of the optional content group.
         * 
         * @param string $name
         * @param string $encoding
         */
        public function setName($name, $encoding = 'UTF-8') {}

        /**
         * Get the dictionary of the optional content group.
         * 
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Get an indirect object for this optional content group.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type for optional content groups.
         *
         * @see SetaPDF_Core_Resource::getResourceType()
         * @return string
         */
        public function getResourceType() {}

    }
}

namespace
{

    /**
     * Optional content iterator
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_OptionalContent_Iterator extends \RecursiveIteratorIterator
    {
        /**
         * Return the current value as an SetaPDF_Core_Document_OptionalContent_Group object if possible.
         * 
         * @return SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Document_OptionalContent_Group
         * @see RecursiveIteratorIterator::current()
         */
        public function current() {}

    }
}

namespace
{

    /**
     * Class representing a widget annotations additional-actions dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Widget_AdditionalActions extends \SetaPDF_Core_Document_Page_Annotation_AdditionalActions
    {
        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Page_Annotation_Widget $annotation
         */
        public function __construct(\SetaPDF_Core_Document_Page_Annotation_Widget $annotation) {}

        /**
         * Get the action that shall be performed when the annotation receives the input focus.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getFocus() {}

        /**
         * Set the action that shall be performed when the annotation receives the input focus.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_Widget_AdditionalActions
         */
        public function setFocus(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the annotation loses the input focus.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getBlur() {}

        /**
         * Set the action that shall be performed when the annotation loses the input focus.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_Widget_AdditionalActions
         */
        public function setBlur(\SetaPDF_Core_Document_Action $action) {}

    }
}

namespace
{

    /**
     * Class representing an annotations additional-actions dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_AdditionalActions
    {
        /**
         * The annotation instance
         *
         * @var SetaPDF_Core_Document_Page_Annotation
         */
        protected $_annotation;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Page_Annotation $annotation
         */
        public function __construct(\SetaPDF_Core_Document_Page_Annotation $annotation) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the additional actions dictionary.
         *
         * @param bool $create Pass true to automatically create the dictionary
         * @return null|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the action that shall be performed when the cursor enters the annotation’s active area.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getCursorEnter() {}

        /**
         * Set the action that shall be performed when the cursor enters the annotation’s active area.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setCursorEnter(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the cursor exits the annotation’s active area.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getCursorExit() {}

        /**
         * Set the action that shall be performed when the cursor exits the annotation’s active area.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setCursorExit(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the mouse button is pressed inside the annotation’s active area.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getMouseDown() {}

        /**
         * Set the action that shall be performed when the mouse button is pressed inside the annotation’s active area.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setMouseDown(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the mouse button is released inside the annotation’s active area.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getMouseUp() {}

        /**
         * Set the action that shall be performed when the mouse button is released inside the annotation’s active area.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setMouseUp(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the page containing the annotation is opened.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getPageOpen() {}

        /**
         * Set the action that shall be performed when the page containing the annotation is opened.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setPageOpen(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the page containing the annotation is closed.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getPageClose() {}

        /**
         * Set the action that shall be performed when the page containing the annotation is closed.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setPageClose(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the page containing the annotation becomes visible.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getPageVisible() {}

        /**
         * Set the action that shall be performed when the page containing the annotation becomes visible.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setPageVisiable(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the page containing the annotation is no longer visible in the
         * conforming reader’s user interface.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getPageInvisible() {}

        /**
         * Set the action that shall be performed when the page containing the annotation is no longer visible in the
         * conforming reader’s user interface.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function setPageInvisiable(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action.
         *
         * @param string $name
         * @param boolean $instance
         * @return null|SetaPDF_Core_Document_Action
         */
        protected function _getAction($name, $instance = true) {}

        /**
         * Set the action.
         *
         * @param string $name
         * @param SetaPDF_Core_Document_Action $action
         */
        protected function _setAction($name, ?\SetaPDF_Core_Document_Action $action = null) {}

    }
}

namespace
{

    /**
     * Class representing annotations appearance characteristics
     *
     * See PDF 32000-1:2008 - 12.5.6.19 Widget Annotations
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_AppearanceCharacteristics
    {
        /**
         * The dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectReference;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $objectOrDictionary
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $objectOrDictionary) {}

        /**
         * Get the dictionary of it.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Get the rotation value.
         *
         * @return int|float
         */
        public function getRotation() {}

        /**
         * Set the rotation value.
         *
         * @param null|int|float $rotation
         * @return self
         */
        public function setRotation($rotation) {}

        /**
         * Get the border color.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getBorderColor() {}

        /**
         * Set the border color.
         *
         * @param null|array|int|float|SetaPDF_Core_DataStructure_Color $borderColor
         * @return self
         */
        public function setBorderColor($borderColor) {}

        /**
         * Get the background color.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getBackgroundColor() {}

        /**
         * Set the background color.
         *
         * @param null|array|int|float|SetaPDF_Core_DataStructure_Color $backgroundColor
         * @return self
         */
        public function setBackgroundColor($backgroundColor) {}

    }
}

namespace
{

    /**
     * Class representing annotations border effect dictionary
     *
     * See PDF 32000-1:2008 - 12.5.4 Border Styles
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_BorderEffect
    {
        /**
         * Border effect
         *
         * @var string
         */
        const NONE = 'S';

        /**
         * Border effect
         *
         * @var string
         */
        const CLOUDY = 'C';

        /**
         * The dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         */
        public function __construct(\SetaPDF_Core_Type_Dictionary $dictionary) {}

        /**
         * Get the dictionary of it.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Get the border effect name.
         *
         * @return string
         */
        public function getName() {}

        /**
         * Set the border effect name.
         *
         * @param null|string $name
         * @return self
         */
        public function setName($name) {}

        /**
         * Get the intensity of the effect.
         *
         * @return int|float
         */
        public function getIntensity() {}

        /**
         * Set the border width.
         *
         * @param null|int|float $intensity
         * @return self
         */
        public function setIntensity($intensity) {}

    }
}

namespace
{

    /**
     * Class representing annotations border style dictionary
     *
     * See PDF 32000-1:2008 - 12.5.4 Border Styles
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_BorderStyle
    {
        /**
         * Border style
         *
         * @var string
         */
        const SOLID = 'S';

        /**
         * Border style
         *
         * @var string
         */
        const DASHED = 'D';

        /**
         * Border style
         *
         * @var string
         */
        const BEVELED = 'B';

        /**
         * Border style
         *
         * @var string
         */
        const INSET = 'I';

        /**
         * Border style
         *
         * @var string
         */
        const UNDERLINE = 'U';

        /**
         * The dictionary
         *
         * @var SetaPDF_Core_Document_Page_Annotation
         */
        protected $_annotation;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Page_Annotation $annotation
         */
        public function __construct(\SetaPDF_Core_Document_Page_Annotation $annotation) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the dictionary of it.
         *
         * @param boolean $create Defines whether the dictionary should be created if it doesn't exists
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the border width.
         *
         * @return int|float
         */
        public function getWidth() {}

        /**
         * Set the border width.
         *
         * @param null|int|float $width
         * @return self
         */
        public function setWidth($width) {}

        /**
         * Get the border style.
         *
         * @return string
         */
        public function getStyle() {}

        /**
         * Set the border style.
         *
         * @param null|string $style
         * @return self
         */
        public function setStyle($style) {}

        /**
         * Get the dash pattern.
         *
         * @return array|null
         */
        public function getDashPattern() {}

        /**
         * Set the dash pattern.
         *
         * @param array|SetaPDF_Core_Type_Array $pattern
         * @return self
         */
        public function setDashPattern($pattern) {}

    }
}

namespace
{

    /**
     * Class representing a circle annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.8
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Circle extends \SetaPDF_Core_Document_Page_Annotation_Square
    {
        /**
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing a file attachment annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.15
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_FileAttachment extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.15 File attachment annotations
         *
         * @var string
         */
        const ICON_GRAPH = 'Graph';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.15 File attachment annotations
         *
         * @var string
         */
        const ICON_PUSH_PIN = 'PushPin';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.15 File attachment annotations
         *
         * @var string
         */
        const ICON_PAPERCLIP = 'Paperclip';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.15 File attachment annotations
         *
         * @var string
         */
        const ICON_TAG = 'Tag';

        /**
         * Ensures a valid file specification parameter.
         *
         * @param SetaPDF_Core_Type_Dictionary $dict
         * @param SetaPDF_Core_FileSpecification|SetaPDF_Core_Type_IndirectObject|SetaPDF_Core_Type_Dictionary $fileSpecification
         */
        private static function _setFileSpecification(\SetaPDF_Core_Type_Dictionary $dict, $fileSpecification) {}

        /**
         * Creates an annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect, $fileSpecification) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Set the file specification.
         *
         * @param SetaPDF_Core_FileSpecification|SetaPDF_Core_Type_IndirectObject|SetaPDF_Core_Type_Dictionary $fileSpecification
         */
        public function setFileSpecification($fileSpecification) {}

        /**
         * Get the file specification.
         *
         * @return SetaPDF_Core_FileSpecification
         */
        public function getFileSpecification() {}

        /**
         * Get the icon name of the annotation.
         *
         * @return string
         */
        public function getIconName() {}

        /**
         * Set the name of the icon that shall be used in displaying the annotation.
         *
         * @param null|string $iconName
         */
        public function setIconName($iconName) {}

    }
}

namespace
{

    /**
     * A class representing named annotation flags
     *
     * See PDF 32000-1:2008 - 12.5.3, Table 165
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Flags
    {
        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const INVISIBLE = 1;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const HIDDEN = 2;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const PRINTS = 4;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const NO_ZOOM = 8;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const NO_ROTATE = 16;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const NO_VIEW = 32;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const READ_ONLY = 64;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const LOCKED = 128;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const TOGGLE_NO_VIEW = 256;

        /**
         * Annotation flag defined in PDF 32000-1:2008 - 12.5.3 / Table 165
         *
         * @var integer
         */
        const LOCKED_CONTENTS = 512;

        /**
         * Prohibit object initiation by defining the constructor to be private.
         *
         * @internal
         */
        private function __construct() {}

    }
}

namespace
{

    /**
     * Class representing a highlight annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.10
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Highlight extends \SetaPDF_Core_Document_Page_Annotation_TextMarkup
    {
        /**
         * Creates a highlight annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing an ink annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.13
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Ink extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * @var SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        protected $_borderStyle;

        /**
         * Creates an ink annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Add an ink list.
         *
         * @param float[] $inkList
         */
        public function addInkList(array $inkList) {}

        /**
         * Get an ink list at a specific index.
         *
         * @param $index
         * @return null|float[]
         */
        public function getInkList($index) {}

        /**
         * Set ink lists.
         *
         * @param array[] $inkLists
         */
        public function setInkLists(array $inkLists) {}

        /**
         * Get all ink lists.
         *
         * @return array[]
         */
        public function getInkLists() {}

        /**
         * Get the border style object.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        public function getBorderStyle() {}

    }
}

namespace
{

    /**
     * Constants class for line ends.
     *
     * See PDF 32000-1:2008 - Table 176
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_LineEndingStyle
    {
        /**
         * A square filled with the annotation’s interior color, if any
         *
         * @var string
         */
        const SQUARE = 'Square';

        /**
         * A circle filled with the annotation’s interior color, if any
         *
         * @var string
         */
        const CIRCLE = 'Circle';

        /**
         * A diamond shape filled with the annotation’s interior color, if any
         *
         * @var string
         */
        const DIAMOND = 'Diamond';

        /**
         * Two short lines meeting in an acute angle to form an open arrowhead
         *
         * @var string
         */
        const OPEN_ARROW = 'OpenArrow';

        /**
         * Two short lines meeting in an acute angle as in the OpenArrow style and connected by a third line to
         * form a triangular closed arrowhead filled with the annotation’s interior color, if any
         *
         * @var string
         */
        const CLOSED_ARROW = 'ClosedArrow';

        /**
         * No line ending
         *
         * @var string
         */
        const NONE = 'None';

        /**
         * A short line at the endpoint perpendicular to the line itself
         *
         * @var string
         */
        const BUTT = 'Butt';

        /**
         * Two short lines in the reverse direction from OpenArrow
         *
         * @var string
         */
        const REVERSED_OPEN_ARROW = 'ROpenArrow';

        /**
         * A triangular closed arrowhead in the reverse direction from ClosedArrow
         *
         * @var string
         */
        const REVERSED_CLOSED_ARROW = 'RClosedArrow';

        /**
         * A short line at the endpoint approximately 30 degrees clockwise from perpendicular to the line itself
         *
         * @var string
         */
        const SLASH = 'Slash';

        /**
         * @internal
         */
        private function __construct() {}

    }
}

namespace
{

    /**
     * Class representing a Link annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.5
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Link extends \SetaPDF_Core_Document_Page_Annotation
    {
        /**
         * @var SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        protected $_borderStyle;

        /**
         * Creates an link annotation dictionary.
         *
         * If the $actionOrDestination parameter is a scalar value it will become an
         * {@link SetaPDF_Core_Document_Action_Uri Uri action}.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @param SetaPDF_Core_Type_Dictionary $actionOrDestination
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect, $actionOrDestination) {}

        /**
         * The constructor.
         *
         * A link annotation instance can be created by an existing dictionary, indirect object/reference or by passing
         * the same parameter as for {@link createAnnotationDictionary()}.
         *
         * @param bool|int|float|string|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the destination of the item.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Document_Destination|false
         * @throws BadMethodCallException
         */
        public function getDestination(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set the destination of the item.
         *
         * @param SetaPDF_Core_Document_Destination|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_String $destination
         * @throws InvalidArgumentException
         */
        public function setDestination($destination) {}

        /**
         * Get the action of the item.
         *
         * @return bool|SetaPDF_Core_Document_Action
         */
        public function getAction() {}

        /**
         * Set the action of the annotation.
         *
         * The action could be an instance of {@link SetaPDF_Core_Document_Action} or a plain dictionary representing
         * the action.
         *
         * @throws InvalidArgumentException
         * @param SetaPDF_Core_Document_Action|SetaPDF_Core_Type_Dictionary $action
         */
        public function setAction($action) {}

        /**
         * Set the Quadpoints.
         *
         * @param int|float|array $x1OrArray
         * @param int|float $y1
         * @param int|float $x2
         * @param int|float $y2
         * @param int|float $x3
         * @param int|float $y3
         * @param int|float $x4
         * @param int|float $y4
         */
        public function setQuadPoints($x1OrArray, $y1 = null, $x2 = null, $y2 = null, $x3 = null, $y3 = null, $x4 = null, $y4 = null) {}

        /**
         * Get the Quadpoints.
         *
         * @return array
         */
        public function getQuadPoints() {}

        /**
         * Get the border style object.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        public function getBorderStyle() {}

    }
}

namespace
{

    /**
     * Class representing a markup annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.2
     *
     * Markup annotations are:
     * - Text
     * - Free text annotations (no Popup)
     * - Line
     * - Square
     * - Circle
     * - Polygon
     * - PolyLine
     * - Highlight
     * - Underline
     * - Squiggly
     * - StrikeOut
     * - Stamp
     * - Caret
     * - Ink
     * - FileAttachment
     * - Sound (no Popup)
     * - Redact
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Markup extends \SetaPDF_Core_Document_Page_Annotation
    {
        /**
         * Get the associated popup object if available.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_Popup
         */
        public function getPopup() {}

        /**
         * Set the pop-up annotation object.
         *
         * @todo This method should be deactivated in "Free text annotations" and "Sound annotations"
         * @param SetaPDF_Core_Document_Page_Annotation_Popup $annotation
         * @throws InvalidArgumentException
         */
        public function setPopup(\SetaPDF_Core_Document_Page_Annotation_Popup $annotation) {}

        /**
         * Create a popup annotation object for this annotation.
         *
         * If the x-offset value is less than zero the popup will be created at the left side of
         * the main annotation. Otherwise on the right side.
         * If the y-offset value is less than zero the popup will be create down below the main
         * annotation. Otherwise above.
         *
         * You need to re-add this new popup annotation to its origin annotation by passing it to
         * the {@link SetaPDF_Core_Document_Page_Annotation_Markup::addPopup() addPopup()} method after
         * assigning it to the page object.
         *
         * @param int|float $offsetX
         * @param int|float $offsetY
         * @param int|float $width
         * @param int|float $height
         *
         * @return SetaPDF_Core_Document_Page_Annotation_Popup
         */
        public function createPopup($offsetX = 30, $offsetY = 20, $width = 150, $height = 100) {}

        /**
         * Get the creation date.
         *
         * <quote>
         * The date and time when the annotation was created.
         * </quote>
         *
         * @see setCreationDate()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         *
         * @param bool $asString Whether receive the value as a string (PDF date string) or as a
         *                       SetaPDF_Core_DataStructure_Date instance.
         * @return null|mixed|SetaPDF_Core_DataStructure_Date
         */
        public function getCreationDate($asString = true) {}

        /**
         * Set the creation date.
         *
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @see getCreationDate()
         * @param null|bool|string|DateTime|SetaPDF_Core_Type_String|SetaPDF_Core_DataStructure_Date $date
         */
        public function setCreationDate($date = true) {}

        /**
         * Get the text label.
         *
         * <quote>
         * The text label that shall be displayed in the title bar of the annotation’s pop-up window when open and active.
         * This entry shall identify the user who added the annotation.
         * </quote>
         *
         * @see setTextLabel()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @param string $encoding
         * @return null|string
         */
        public function getTextLabel($encoding = 'UTF-8') {}

        /**
         * Set the text label.
         *
         * @see getTextLabel()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @param string|null $textLabel
         * @param string $encoding
         */
        public function setTextLabel($textLabel, $encoding = 'UTF-8') {}

        /**
         * Get the subject.
         *
         * <quote>
         * Text representing a short description of the subject being addressed by the annotation.
         * </quote>
         *
         * @see setSubject()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @param string $encoding
         * @return null|string
         */
        public function getSubject($encoding = 'UTF-8') {}

        /**
         * Get the subject.
         *
         * @see getSubject()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @param string|null $subject
         * @param string $encoding
         */
        public function setSubject($subject, $encoding = 'UTF-8') {}

        /**
         * Set the in reply to annotation object.
         *
         * @see getInReplyTo()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @param SetaPDF_Core_Document_Page_Annotation_Markup $annotation
         * @throws InvalidArgumentException
         */
        public function setInReplyTo(\SetaPDF_Core_Document_Page_Annotation_Markup $annotation) {}

        /**
         * Get the in reply to annotation (if available).
         *
         * @see setInReplyTo()
         * @see PDF 32000-1:2008 - 12.5.6.2 - Table 170
         * @return null|SetaPDF_Core_Document_Page_Annotation
         */
        public function getInReplyTo() {}

        /**
         * Checks if this annotation is a reply to another annotation.
         *
         * @return bool
         */
        public function isReplyTo() {}

        /**
         * Get all replies or checks for their existance.
         *
         * @param SetaPDF_Core_Document_Page_Annotations $annotations
         * @param $onlyCheckForExistance
         * @return array|bool
         */
        private function _getReplies(\SetaPDF_Core_Document_Page_Annotations $annotations, $onlyCheckForExistance) {}

        /**
         * Check whether this annotation has a reply or not.
         *
         * @param SetaPDF_Core_Document_Page_Annotations $annotations
         * @return bool
         */
        public function hasReplies(\SetaPDF_Core_Document_Page_Annotations $annotations) {}

        /**
         * Get all annotations which refer this annotation as an reply.
         *
         * @param SetaPDF_Core_Document_Page_Annotations $annotations
         * @return array
         */
        public function getReplies(\SetaPDF_Core_Document_Page_Annotations $annotations) {}

        /**
         * Adds a reply to this annotation.
         *
         * @param SetaPDF_Core_Document_Page_Annotation_Markup $annotation
         */
        public function addReply(\SetaPDF_Core_Document_Page_Annotation_Markup $annotation) {}

        /**
         * Get the constant opacity value.
         *
         * @return float|mixed
         */
        public function getOpacity() {}

        /**
         * Set the constant opacity value.
         *
         * @param float $opacity
         */
        public function setOpacity($opacity) {}

    }
}

namespace
{

    /**
     * Class representing a poly line annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.13
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_PolyLine extends \SetaPDF_Core_Document_Page_Annotation_Polygon
    {
        /**
         * Creates a poly line annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Set the line ending styles.
         *
         * @see SetaPDF_Core_Document_Page_Annotation_LineEndingStyle
         * @param string $first
         * @param string $last
         */
        public function setLineEndingStyles($first, $last) {}

        /**
         * Get the line ending styles.
         *
         * @return array
         */
        public function getLineEndingStyles() {}

    }
}

namespace
{

    /**
     * Class representing a polygon annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.13
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Polygon extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * @var SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        protected $_borderStyle;

        /**
         * Creates a polygon annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Set the vertices.
         *
         * @param float[] $vertices
         */
        public function setVertices(array $vertices) {}

        /**
         * Get the vertices.
         *
         * @return array
         */
        public function getVertices() {}

        /**
         * Set the interior color.
         *
         * @param null|array|SetaPDF_Core_DataStructure_Color $color
         */
        public function setInteriorColor($color) {}

        /**
         * Get the interior color.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getInteriorColor() {}

        /**
         * Get the border effect object.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderEffect
         */
        public function getBorderEffect($create = false) {}

        /**
         * Get the border style object.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        public function getBorderStyle() {}

    }
}

namespace
{

    /**
     * Class representing a Pop-up annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.14
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Popup extends \SetaPDF_Core_Document_Page_Annotation
    {
        /**
         * Creates an annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Checks if the popup is open.
         *
         * @return boolean
         */
        public function isOpen() {}

        /**
         * Set the open flag of the popup.
         *
         * @param boolean $open
         */
        public function setOpen($open) {}

        /**
         * Get the parent annotation.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation
         */
        public function getParent() {}

        /**
         * Set the parent annotation.
         *
         * @param SetaPDF_Core_Document_Page_Annotation $annotation
         * @throws InvalidArgumentException
         */
        public function setParent(\SetaPDF_Core_Document_Page_Annotation $annotation) {}

    }
}

namespace
{

    /**
     * Class representing a square annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.8
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Square extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * @var SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        protected $_borderStyle;

        /**
         * Creates a square annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Set the interior color.
         *
         * @param null|array|SetaPDF_Core_DataStructure_Color $color
         */
        public function setInteriorColor($color) {}

        /**
         * Get the interior color.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getInteriorColor() {}

        /**
         * Get the border effect object.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderEffect
         */
        public function getBorderEffect($create = false) {}

        /**
         * Get the border style object.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        public function getBorderStyle() {}

    }
}

namespace
{

    /**
     * Class representing a squiggly-underline annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.10
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Squiggly extends \SetaPDF_Core_Document_Page_Annotation_TextMarkup
    {
        /**
         * Creates a underline annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing a rubber stamp annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.12
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Stamp extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_APPROVED = 'Approved';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_EXPERIMENTAL = 'Experimental';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_NOT_APPROVED = 'NotApproved';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_AS_IS = 'AsIs';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_EXPIRED = 'Expired';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_NOT_FOR_PUBLIC_RELEASE = 'NotForPublicRelease';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_CONFIDENTIAL = 'Confidential';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_FINAL = 'Final';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_SOLD = 'Sold';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_DEPARTMENTAL = 'Departmental';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_FOR_COMMENT = 'ForComment';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_TOP_SECRET = 'TopSecret';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_DRAFT = 'Draft';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.12 Rubber Stamp Annotations
         *
         * @var string
         */
        const ICON_FOR_PUBLIC_RELEASE = 'ForPublicRelease';

        /**
         * Creates a rubber stamp annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @param string $icon
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect, $icon = null) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary The annotation dictionary or a rect value
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Get the icon name of the annotation.
         *
         * @return string
         */
        public function getIconName() {}

        /**
         * Set the name of the icon that shall be used in displaying the annotation.
         *
         * @param null|string $iconName
         */
        public function setIconName($iconName) {}

    }
}

namespace
{

    /**
     * Class representing a strikeout annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.10
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_StrikeOut extends \SetaPDF_Core_Document_Page_Annotation_TextMarkup
    {
        /**
         * Creates a underline annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing a Text annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.14
     *
     * A text annotations icon will display a static predefined icon which will not resize if the
     * document is zoomed. It will be aligned to the upper left corner of the Rect.
     *
     * By setting the no rotate flag ({@link SetaPDF_Core_Document_Page_Annotation::setNoRotateFlag})
     * and the no-zoom flag ({@link SetaPDF_Core_Document_Page_Annotation::setNoZoomFlag}) the fixed
     * size can be disabled and will allow you to define the size of the annotation your own. Anyhow
     * the annotation is still not zoomable.
     *
     * The aspect ratio of default icons are:
     * Comment: 20 x 18
     * Key: 18 x 17
     * Note: 18 x 20
     * Help: 20 x 20
     * NewParagraph: 13 x 20
     * Paragraph: 11 x 20
     * Insert: 20 x 17
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Text extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_COMMENT = 'Comment';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_KEY = 'Key';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_NOTE = 'Note';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_HELP = 'Help';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_NEW_PARAGRAPH = 'NewParagraph';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_PARAGRAPH = 'Paragraph';

        /**
         * Icon name defined in PDF 32000-1:2008 - 12.5.6.4 Text Annotations
         *
         * @var string
         */
        const ICON_INSERT = 'Insert';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_CIRCLE = 'Circle';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_CHECK = 'Check';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_CROSS = 'Cross';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_RIGHT_ARROW = 'RightArrow';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_RIGHT_POINTER = 'RightPointer';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_STAR = 'Star';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_UP_ARROW = 'UpArrow';

        /**
         * Icon name supported by Adobe Acrobat
         *
         * @var string
         */
        const ICON_UP_LEFT_ARROW = 'UpLeftArrow';

        /**
         * State model name
         *
         * @var string
         */
        const STATE_MODEL_MARKED = 'Marked';

        /**
         * State model name
         *
         * @var string
         */
        const STATE_MODEL_REVIEW = 'Review';

        /**
         * State model name
         *
         * @var string
         */
        const STATE_MODEL_MIGRATION_STATUS = 'MigrationStatus';

        /**
         * Creates an text annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary The annotation dictionary or a rect value
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Checks if the annotation shall initially be displayed open.
         *
         * @return bool
         */
        public function isOpen() {}

        /**
         * Sets whether the annotation shall initially be displayed open or not.
         *
         * @param bool $open
         */
        public function setOpen($open) {}

        /**
         * Get the icon name of the annotation.
         *
         * @return string
         */
        public function getIconName() {}

        /**
         * Set the name of the icon that shall be used in displaying the annotation.
         *
         * @param null|string $iconName
         */
        public function setIconName($iconName) {}

        /**
         * Get the state model.
         *
         * @see PDF 32000-1:2008 - 12.5.6.3 Annotation States
         * @return mixed|null
         */
        public function getStateModel() {}

        /**
         * Set the annotation model.
         *
         * @see PDF 32000-1:2008 - 12.5.6.3 Annotation States
         * @param string $stateModel
         */
        public function setStateModel($stateModel) {}

        /**
         * Get the annotation state.
         *
         * @see PDF 32000-1:2008 - 12.5.6.3 Annotation States
         * @return mixed|null
         */
        public function getState() {}

        /**
         * Set the annotation state.
         *
         * This annotation should be a reply to another one and following annotation flags has to be set:
         * <code>
         * $annotation->setAnnotationFlags(
         *     SetaPDF_Core_Document_Page_Annotation_Flags::HIDDEN |
         *     SetaPDF_Core_Document_Page_Annotation_Flags::NO_ROTATE |
         *     SetaPDF_Core_Document_Page_Annotation_Flags::NO_ZOOM |
         *     SetaPDF_Core_Document_Page_Annotation_Flags::PRINTS
         * );
         * </code>
         * Otherwise Acrobat/Reader will not display the state in the comments panel.
         *
         * @see PDF 32000-1:2008 - 12.5.6.3 Annotation States
         * @param string $state
         */
        public function setState($state) {}

    }
}

namespace
{

    /**
     * Abstract class representing a text markup annotation.
     *
     * See PDF 32000-1:2008 - 12.5.6.10
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Document_Page_Annotation_TextMarkup extends \SetaPDF_Core_Document_Page_Annotation_Markup
    {
        /**
         * Creates a highlight annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @param string $subtype
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        protected static function _createAnnotationDictionary($rect, $subtype) {}

        /**
         * Set the Quadpoints.
         *
         * @param int|float|array $x1OrArray
         * @param int|float $y1
         * @param int|float $x2
         * @param int|float $y2
         * @param int|float $x3
         * @param int|float $y3
         * @param int|float $x4
         * @param int|float $y4
         */
        public function setQuadPoints($x1OrArray, $y1 = null, $x2 = null, $y2 = null, $x3 = null, $y3 = null, $x4 = null, $y4 = null) {}

        /**
         * Get the Quadpoints.
         *
         * @return array
         */
        public function getQuadPoints() {}

    }
}

namespace
{

    /**
     * Class representing a underline annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.10
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Underline extends \SetaPDF_Core_Document_Page_Annotation_TextMarkup
    {
        /**
         * Creates a underline annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * @param array|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing a widget annotation
     *
     * See PDF 32000-1:2008 - 12.5.6.19
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation_Widget extends \SetaPDF_Core_Document_Page_Annotation
    {
        /**
         * @var SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        protected $_borderStyle;

        /**
         * Creates a widget annotation dictionary.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @return SetaPDF_Core_Type_Dictionary
         * @throws InvalidArgumentException
         */
        public static function createAnnotationDictionary($rect) {}

        /**
         * The constructor.
         *
         * A widget annotation instance can be created by an existing dictionary, indirect object/reference or by passing
         * the same parameter as for {@link createAnnotationDictionary()}.
         *
         * @param array|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the height of the annotation.
         *
         * If the annotation is rotated width and height will be changed accordingly. This can be affected by the
         * $ignoreRotation parameter.
         *
         * @param boolean $ignoreRotation
         * @return float|int
         */
        public function getHeight($ignoreRotation = false) {}

        /**
         * Get the width of the annotation.
         *
         * If the annotation is rotated width and height will be changed accordingly. This can be affected by the
         * $ignoreRotation parameter.
         *
         * @param boolean $ignoreRotation
         * @return float|int
         */
        public function getWidth($ignoreRotation = false) {}

        /**
         * Get the action of the annotation.
         *
         * If no action is defined false will be returned.
         *
         * @return bool|SetaPDF_Core_Document_Action
         */
        public function getAction() {}

        /**
         * Set the action of the annotation.
         *
         * The action could be an instance of {@link SetaPDF_Core_Document_Action} or a plain dictionary representing
         * the action.
         *
         * @throws InvalidArgumentException
         * @param SetaPDF_Core_Document_Action|SetaPDF_Core_Type_Dictionary $action
         */
        public function setAction($action) {}

        /**
         * Get the appearance characteristics object.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Document_Page_Annotation_AppearanceCharacteristics
         */
        public function getAppearanceCharacteristics($create = false) {}

        /**
         * Gets the additional actions object instance for this annotation.
         *
         * @return SetaPDF_Core_Document_Page_Annotation_Widget_AdditionalActions
         */
        public function getAdditionalActions() {}

        /**
         * Get the border style object.
         *
         * @return null|SetaPDF_Core_Document_Page_Annotation_BorderStyle
         */
        public function getBorderStyle() {}

    }
}

namespace
{

    /**
     * Class representing a pages additional-actions dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_AdditionalActions
    {
        /**
         * The catalog instance
         *
         * @var SetaPDF_Core_Document_Page
         */
        protected $_page;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document_Page $page
         */
        public function __construct(\SetaPDF_Core_Document_Page $page) {}

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the additional actions dictionary.
         *
         * @param bool $create Pass true to automatically create the dictionary
         * @return null|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the action that shall be performed when the page is opened.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getOpen() {}

        /**
         * Set the action that shall be performed when the page is opened.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_AdditionalActions Returns the SetaPDF_Core_Document_Page_AdditionalActions
         *                                                      object for method chaining.
         */
        public function setOpen(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action that shall be performed when the page is closed.
         *
         * @return null|SetaPDF_Core_Document_Action
         */
        public function getClose() {}

        /**
         * Set the action that shall be performed when the page is closed.
         *
         * @param SetaPDF_Core_Document_Action $action
         * @return SetaPDF_Core_Document_Page_AdditionalActions Returns the SetaPDF_Core_Document_Page_AdditionalActions
         *                                                      object for method chaining.
         */
        public function setClose(\SetaPDF_Core_Document_Action $action) {}

        /**
         * Get the action.
         *
         * @param string $name
         * @return null|SetaPDF_Core_Document_Action
         */
        protected function _getAction($name) {}

        /**
         * Set the action.
         *
         * @param string $name
         * @param SetaPDF_Core_Document_Action $action
         */
        protected function _setAction($name, \SetaPDF_Core_Document_Action $action) {}

    }
}

namespace
{

    /**
     * Class representing a PDF annotation
     *
     * See PDF 32000-1:2008 - 12.5
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotation
    {
        /**
         * Annotation type
         * 
         * @var string
         */
        const TYPE_TEXT = 'Text';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_LINK = 'Link';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_FREE_TEXT = 'FreeText';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_LINE = 'Line';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_SQUARE = 'Square';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_CIRCLE = 'Circle';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_POLYGON = 'Polygon';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_POLY_LINE = 'PolyLine';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_HIGHLIGHT = 'Highlight';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_UNDERLINE = 'Underline';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_SQUIGGLY = 'Squiggly';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_STRIKE_OUT = 'StrikeOut';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_STAMP = 'Stamp';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_CARET = 'Caret';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_INK = 'Ink';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_POPUP = 'Popup';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_FILE_ATTACHMENT = 'FileAttachment';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_SOUND = 'Sound';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_MOVIE = 'Movie';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_WIDGET = 'Widget';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_SCREEN = 'Screen';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_PRINTER_MARK = 'PrinterMark';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_TRAP_NET = 'TrapNet';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_WATERMARK = 'Watermark';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_3D = '3D';

        /**
         * Annotation type
         *
         * @var string
         */
        const TYPE_REDACT = 'Redact';

        /**
         * The annotation dictionary
         * 
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_annotationDictionary;

        /**
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectReference;

        /**
         * The rectangle
         *
         * @var SetaPDF_Core_DataStructure_Rectangle
         */
        protected $_rect;

        /**
         * @var SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        protected $_additionalActions;

        /**
         * Creates an annotation dictionary with default values.
         * 
         * @param SetaPDF_Core_DataStructure_Rectangle|array $rect
         * @param string $subtype
         * @return SetaPDF_Core_Type_Dictionary
         */
        protected static function _createAnnotationDictionary($rect, $subtype) {}

        /**
         * Creates an annotation object by an annotation dictionary or its parent object.
         * 
         * @param SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Document_Page_Annotation
         */
        public static function byObjectOrDictionary(\SetaPDF_Core_Type_AbstractType $objectOrDictionary) {}

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_IndirectObjectInterface $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $objectOrDictionary) {}

        /**
         * Release memory/cycled references
         */
        public function cleanUp() {}

        /**
         * Get the annotation dictionary.
         * 
         * @return SetaPDF_Core_Type_Dictionary
         * @deprecated
         */
        public function getAnnotationDictionary() {}

        /**
         * Get the annotation dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the indirect object of this annotation.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectReference
         */
        public function setIndirectObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectReference) {}

        /**
         * Get the indirect object of this annotation.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the action type specified in the S key.
         * 
         * @return string
         */
        public function getType() {}

        /**
         * Get the rectangle object of this annotation.
         * 
         * @return SetaPDF_Core_DataStructure_Rectangle
         */
        public function getRect() {}

        /**
         * Set the rectangle object.
         *
         * @param SetaPDF_Core_DataStructure_Rectangle $rect
         */
        public function setRect(\SetaPDF_Core_DataStructure_Rectangle $rect) {}

        /**
         * Get the height of the annotation.
         *
         * @return float|int
         */
        public function getHeight() {}

        /**
         * Get the width of the annotation.
         *
         * @return float|int
         */
        public function getWidth() {}

        /**
         * Get the name of the annotation.
         *
         * @param string $encoding
         * @return mixed|null
         */
        public function getName($encoding = 'UTF-8') {}

        /**
         * Set the name of the annotation.
         *
         * The annotation name, a text string uniquely identifying it among all the annotations on its page.
         *
         * @param string|null $name
         * @param string $encoding
         */
        public function setName($name, $encoding = 'UTF-8') {}

        /**
         * Get the contents of the annotation.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getContents($encoding = 'UTF-8') {}

        /**
         * Set the contents of the annotation.
         *
         * @param string|null $contents
         * @param string $encoding
         */
        public function setContents($contents, $encoding = 'UTF-8') {}

        /**
         * Get the modification date.
         *
         * @param bool $asString
         * @return mixed|null|SetaPDF_Core_DataStructure_Date
         */
        public function getModificationDate($asString = true) {}

        /**
         * Set the modification date.
         *
         * @param SetaPDF_Core_DataStructure_Date|DateTime|string|bool $date If true is passed, the current date and time
         *                                                                   will be used.
         */
        public function setModificationDate($date = true) {}

        /**
         * Sets an annotation flag.
         *
         * @param integer $flags
         * @param boolean $set Set or unset
         */
        public function setAnnotationFlags($flags, $set = true) {}

        /**
         * Removes a field flag.
         *
         * @param integer $flags
         */
        public function unsetAnnotationFlags($flags) {}

        /**
         * Checks if a specific annotation flag is set.
         *
         * @param integer $flag
         * @return boolean
         */
        public function isAnnotationFlagSet($flag) {}

        /**
         * Checks for the "Invisible" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not display the annotation if it does not belong to one of the
         * standard annotation types and no annotation handler is available. If clear,
         * display such an unknown annotation using an appearance stream specified by
         * its appearance dictionary, if any"
         * 
         * @return boolean
         */
        public function getInvisibleFlag() {}

        /**
         * Set the "Invisible" flag.
         * 
         * @param boolean $invisible
         * @see getInvisibleFlag()
         */
        public function setInvisibleFlag($invisible = true) {}

        /**
         * Checks for the "Hidden" flag.
         *
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not display or print the annotation or allow it to interact with
         * the user, regardless of its annotation type or whether an annotation handler
         * is available."
         * 
         * @return boolean
         */
        public function getHiddenFlag() {}

        /**
         * Set the "Hidden" flag.
         * 
         * @param boolean $hidden
         * @see getHiddenFlag()
         */
        public function setHiddenFlag($hidden = true) {}

        /**
         * Checks for the "Print" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, print the annotation when the page is printed. If clear, never print
         * the annotation, regardless of whether it is displayed on the screen."
         *
         * @return boolean
         */
        public function getPrintFlag() {}

        /**
         * Set the "Print" flag.
         * 
         * @param boolean $print
         * @see getPrintFlag()
         */
        public function setPrintFlag($print = true) {}

        /**
         * Checks fo the "NoZoom" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not scale the annotation’s appearance to match the magnification
         * of the page. The location of the annotation on the page (defined by the upper-
         * left corner of its annotation rectangle) shall remain fixed, regardless of the
         * page magnification."
         * 
         * @return boolean
         */
        public function getNoZoomFlag() {}

        /**
         * Set the "NoZoom" flag.
         * 
         * @param boolean $noZoom
         * @see getNoZoomFlag()
         */
        public function setNoZoomFlag($noZoom = true) {}

        /**
         * Checks fo the "NoRotate" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not rotate the annotation’s appearance to match the rotation of the
         * page. The upper-left corner of the annotation rectangle shall remain in a fixed
         * location on the page, regardless of the page rotation."
         * 
         * @return boolean
         */
        public function getNoRotateFlag() {}

        /**
         * Set the "NoRotate" flag.
         * 
         * @param boolean $noRotate
         * @see getNoRotateFlag()
         */
        public function setNoRotateFlag($noRotate = true) {}

        /**
         * Checks for the "NoView" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not display the annotation on the screen or allow it to interact
         * with the user. The annotation may be printed (depending on the setting of the
         * Print flag) but should be considered hidden for purposes of on-screen display
         * and user interaction."
         * 
         * @return boolean
         */
        public function getNoViewFlag() {}

        /**
         * Set the "NoView" flag.
         * 
         * @param boolean $noView
         * @see getNoViewFlag()
         */
        public function setNoViewFlag($noView = true) {}

        /**
         * Checks the "ReadOnly" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not allow the annotation to interact with the user. The annotation
         * may be displayed or printed (depending on the settings of the NoView and Print
         * flags) but should not respond to mouse clicks or change its appearance in
         * response to mouse motions.
         * 
         * This flag shall be ignored for widget annotations; its function is subsumed by
         * the ReadOnly flag of the associated form field"
         * 
         * @return boolean
         */
        public function getReadOnlyFlag() {}

        /**
         * Set the "ReadOnly" flag.
         * 
         * @param boolean $readOnly
         * @see getReadOnlyFlag()
         */
        public function setReadOnlyFlag($readOnly = true) {}

        /**
         * Checks the "Locked" flag.
         *
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not allow the annotation to be deleted or its properties (including
         * position and size) to be modified by the user. However, this flag does not
         * restrict changes to the annotation’s contents, such as the value of a form field."
         * 
         * @return boolean
         */
        public function getLockedFlag() {}

        /**
         * Set the "Locked" flag.
         * 
         * @param boolean $locked
         * @see getLockedFlag()
         */
        public function setLocked($locked = true) {}

        /**
         * Checks for the "ToggleNoView" flag.
         * 
         * PDF 32000-1:2008 - Table 165:
         * "If set, invert the interpretation of the NoView flag for certain events."
         * 
         * @return boolean
         */
        public function getToggleNoView() {}

        /**
         * Set the "ToggleNoView" flag.
         *
         * @param boolean $toggleNoView
         * @see getToggleNoView()
         */
        public function setToggleNoView($toggleNoView = true) {}

        /**
         * Checks for the "LockedContents" flag.
         *
         * PDF 32000-1:2008 - Table 165:
         * "If set, do not allow the contents of the annotation to be modified by the
         * user. This flag does not restrict deletion of the annotation or changes to
         * other annotation properties, such as position and size."
         *
         * @return boolean
         */
        public function getLockedContents() {}

        /**
         * Set the "LockedContents" flag.
         *
         * @param boolean $lockedContents
         * @see getLockedContents()
         */
        public function setLockedContents($lockedContents = true) {}

        /**
         * Set the color of the annotation.
         *
         * @param null|bool|int|float|string|array|SetaPDF_Core_DataStructure_Color $color
         */
        public function setColor($color) {}

        /**
         * Get the color of the annotation.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getColor() {}

        /**
         * Get the annotation appearance stream.
         *
         * @param string $type
         * @param null|string $subType
         * @throws InvalidArgumentException
         * @return null|SetaPDF_Core_XObject_Form
         */
        public function getAppearance($type = 'N', $subType = null) {}

        /**
         * Set the annotation appearance stream.
         *
         * @param SetaPDF_Core_XObject_Form $xObject
         * @param string $type
         * @param string|null $subState
         */
        public function setAppearance(\SetaPDF_Core_XObject_Form $xObject, $type = 'N', $subState = null) {}

        /**
         * Gets the additional actions object instance for this annotation.
         *
         * @return SetaPDF_Core_Document_Page_Annotation_AdditionalActions
         */
        public function getAdditionalActions() {}

    }
}

namespace
{

    /**
     * Helper class for handling annotations of a page
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Annotations
    {
        /**
         * Constant specifying the row tab order
         *
         * @var string
         */
        const TAB_ORDER_ROW = 'R';

        /**
         * Constant specifying the column tab order
         *
         * @var string
         */
        const TAB_ORDER_COLUMN = 'C';

        /**
         * Constant specifying the structure tab order
         *
         * @var string
         */
        const TAB_ORDER_STRUCTURE = 'S';

        /**
         * Constant specifying the annotations array tab order
         *
         * @var string
         */
        const TAB_ORDER_ANNOTATIONS_ARRAY = 'A';

        /**
         * Constant specifying the widget tab order
         *
         * @var string
         */
        const TAB_ORDER_WIDGET = 'W';

        /**
         * The page object
         * 
         * @var SetaPDF_Core_Document_Page
         */
        protected $_page;

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Document_Page $page
         */
        public function __construct(\SetaPDF_Core_Document_Page $page) {}

        /**
         * Release memory/resources.
         */
        public function cleanUp() {}

        /**
         * Get the page.
         *
         * @return SetaPDF_Core_Document_Page
         */
        public function getPage() {}

        /**
         * Returns the Annots array if available or creates a new one.
         *
         * @param boolean $create
         * @return false|SetaPDF_Core_Type_Array
         */
        public function getArray($create = false) {}

        /**
         * Get all annotations of this page.
         *
         * Optionally the results can be filtered by the subtype parameter.
         * 
         * @param string $subtype See SetaPDF_Core_Document_Page_Annotation::TYPE_* constants for possible values.
         * @return SetaPDF_Core_Document_Page_Annotation[]
         */
        public function getAll($subtype = null) {}

        /**
         * Get an annotation by its name (NM entry)
         *
         * @param string $name The name of the annotation.
         * @param string $encoding
         *
         * @return bool|SetaPDF_Core_Document_Page_Annotation
         */
        public function getByName($name, $encoding = 'UTF-8') {}

        /**
         * Adds an annotation to the page.
         *
         * @param SetaPDF_Core_Document_Page_Annotation $annotation
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function add(\SetaPDF_Core_Document_Page_Annotation $annotation) {}

        /**
         * Removes an annotation from the annotation array of the page.
         *
         * @param SetaPDF_Core_Document_Page_Annotation $annotation
         * @return bool
         */
        public function remove(\SetaPDF_Core_Document_Page_Annotation $annotation) {}

        /**
         * Get the tab order that shall be used for annotations on the page.
         *
         * @return string|null
         */
        public function getTabOrder() {}

        /**
         * Set the tab order that shall be used for annotations on the page.
         *
         * @param string|null $tabOrder
         */
        public function setTabOrder($tabOrder) {}

    }
}

namespace
{

    /**
     * A class representing a pages content
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page_Contents
    {
        /**
         * The page object to which this helper depends to
         * 
         * @var SetaPDF_Core_Document_Page
         */
        protected $_page;

        /**
         * The current content stream offset
         * 
         * @var integer
         */
        protected $_currentOffset;

        /**
         * The current active content stream
         * 
         * @var SetaPDF_Core_Type_Stream
         */
        protected $_currentStream;

        /**
         * Flag saying if the content is already encapsulated in a graphic state
         *  
         * @var boolean
         */
        protected $_encapsulatedInGraphicState = false;

        /**
         * An array holding encapsulate stream objects which are available to
         * encapsulate an existing content stream "q ... Q". Items are keyed by
         * the document id.
         * @var array
         */
        protected static $_encapsulatedCache = [/** value is missing */];

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Document_Page $page
         */
        public function __construct(\SetaPDF_Core_Document_Page $page) {}

        /**
         * Release memory/resources.
         */
        public function cleanUp() {}

        /**
         * Writes a string to the stream object.
         *
         * @param string $bytes
         */
        public function write($bytes) {}

        /**
         * Clears the stream object.
         */
        public function clear() {}

        /**
         * Gets the count of contents streams available for this page.
         * 
         * @return integer
         */
        public function count() {}

        /**
         * Get the stream object.
         *
         * @param bool $create
         * @return bool|SetaPDF_Core_Type_Stream
         */
        public function getStreamObject($create = false) {}

        /**
         * Get the stream content.
         *
         * @return string
         */
        public function getStream() {}

        /**
         * Get a stream by offset in the contents array.
         *
         * @param int $offset
         * @param bool $setActive
         * @return boolean|SetaPDF_Core_Type_Stream
         */
        public function getStreamObjectByOffset($offset = 0, $setActive = true) {}

        /**
         * Get and/or create the last stream.
         * 
         * @param boolean $create
         * @param boolean $setActive
         * @return boolean|SetaPDF_Core_Type_Stream
         */
        public function getLastStreamObject($create = false, $setActive = true) {}

        /**
         * Checks if the last content stream is active.
         * 
         * @return boolean
         */
        public function isLastStreamActive() {}

        /**
         * Method for adding streams to the Contents entry.
         * 
         * @param integer|null $beforeIndex
         * @param boolean $setActive
         * @param SetaPDF_Core_Type_IndirectObjectInterface $streamObject
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected function _addStream($beforeIndex, $setActive = true, ?\SetaPDF_Core_Type_IndirectObjectInterface $streamObject = null) {}

        /**
         * Append a stream to the end of the Contents array.
         * 
         * @param boolean $setActive
         * @param SetaPDF_Core_Type_IndirectObjectInterface $streamObject
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function pushStream($setActive = true, ?\SetaPDF_Core_Type_IndirectObjectInterface $streamObject = null) {}

        /**
         * Prepend a stream to the beginning of the Contents array.
         * 
         * @param boolean $setActive
         * @param SetaPDF_Core_Type_IndirectObjectInterface $streamObject
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function prependStream($setActive = true, ?\SetaPDF_Core_Type_IndirectObjectInterface $streamObject = null) {}

        /**
         * Encapsulate the existing content stream(s) in separate graphic state operators.
         * 
         * @param boolean $force
         */
        public function encapsulateExistingContentInGraphicState($force = false) {}

    }
}

namespace
{

    /**
     * Class representing a PDF action
     *
     * See PDF 32000-1:2008 - 12.6
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Action
    {
        /**
         * The action dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_actionDictionary;

        /**
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectReference;

        /**
         * Creates an action object by an action dictionary.
         *
         * @param SetaPDF_Core_Type_AbstractType $objectOrDictionary
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Document_Action
         */
        public static function byObjectOrDictionary(\SetaPDF_Core_Type_AbstractType $objectOrDictionary) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $objectOrDictionary
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $objectOrDictionary) {}

        /**
         * Set the indirect object of this annotation.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectReference
         */
        public function setIndirectObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectReference) {}

        /**
         * Get the indirect object of this annotation or creates it in the specific document context.
         *
         * @param SetaPDF_Core_Document $document The document instance
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Gets the PDF value of the next entry.
         *
         * @return false|SetaPDF_Core_Type_Dictionary
         */
        public function getNext() {}

        /**
         * Set the next action which should be executed after this one.
         *
         * @param SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Document_Action $next
         */
        public function setNext($next) {}

        /**
         * Add an additional action to the next value of this action.
         *
         * @param SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Document_Action $next
         */
        public function addNext($next) {}

        /**
         * Get the action dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getActionDictionary() {}

        /**
         * Get the PDF value of this action.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getPdfValue() {}

        /**
         * Get the action type specified in the S key.
         *
         * @return string
         */
        public function getType() {}

    }
}

namespace
{

    /**
     * A class representing the document catalog
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Catalog
    {
        /**
         * The document instance
         *
         * @var SetaPDF_Core_Document
         */
        protected $_document;

        /**
         * The viewer preferences object
         *
         * @var SetaPDF_Core_Document_Catalog_ViewerPreferences
         */
        protected $_viewerPreferences;

        /**
         * Pages instance
         *
         * @var SetaPDF_Core_Document_Catalog_Pages
         */
        protected $_pages;

        /**
         * Names instance
         *
         * @var SetaPDF_Core_Document_Catalog_Names
         */
        protected $_names;

        /**
         * The documents page labels object
         *
         * @var SetaPDF_Core_Document_Catalog_PageLabels
         */
        protected $_pageLabels;

        /**
         * The documents AcroForm object
         *
         * @var SetaPDF_Core_Document_Catalog_AcroForm
         */
        protected $_acroForm;

        /**
         * The documents outlines object
         *
         * @var SetaPDF_Core_Document_Catalog_Outlines
         */
        protected $_outlines;

        /**
         * The optional content object
         * 
         * @var SetaPDF_Core_Document_Catalog_OptionalContent
         */
        protected $_optionalContent;

        /**
         * The output intent object
         *
         * @var SetaPDF_Core_Document_Catalog_OutputIntents
         */
        protected $_outputIntents;

        /**
         * The additional actions object
         *
         * @var SetaPDF_Core_Document_Catalog_AdditionalActions
         */
        protected $_additionalActions;

        /**
         * The permissions object
         *
         * @var SetaPDF_Core_Document_Catalog_Permissions
         */
        protected $_permissions;

        /**
         * The extensions object
         *
         * @var SetaPDF_Core_Document_Catalog_Extensions
         */
        protected $_extensions;

        /**
         * Returns method names which should be available in a documents instance too.
         *
         * @return array
         */
        public static function getDocumentMagicMethods() {}

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Document $document
         */
        public function __construct(\SetaPDF_Core_Document $document) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Release cycled references / memory.
         */
        public function cleanUp() {}

        /**
         * Get the catalog dictionary.
         *
         * @param boolean $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the value of the Version entry of the catalog dictionary.
         *
         * This value defines the version of the PDF specification to which the document conforms if
         * later than the version specified in the file's header.
         *
         * @return string|null
         */
        public function getVersion() {}

        /**
         * Set the version of the PDF specification to which the document conforms.
         *
         * @param string $version
         */
        public function setVersion($version) {}

        /**
         * Get the extensions helper instance.
         *
         * @return SetaPDF_Core_Document_Catalog_Extensions
         */
        public function getExtensions() {}

        /**
         * Get the page layout.
         *
         * @see PDF 32000-1:2008 - 7.7.2 Document Catalog
         * @return string
         */
        public function getPageLayout() {}

        /**
         * Set the page layout.
         *
         * Possible values are declared as class constants in the {@link SetaPDF_Core_Document_PageLayout} class.
         *
         * @TODO Check for valid values
         * @see SetaPDF_Core_Document_PageLayout
         * @param string $pageLayout The name of the page layout
         */
        public function setPageLayout($pageLayout) {}

        /**
         * Get the page mode.
         *
         * @see PDF 32000-1:2008 - 7.7.2 Document Catalog
         * @return string
         */
        public function getPageMode() {}

        /**
         * Set the page mode.
         *
         * Possible values are declared as class constants in the {@link SetaPDF_Core_Document_PageMode} class.
         *
         * @todo Check for valid values
         * @see SetaPDF_Core_Document_PageMode
         * @param string $pageMode The name of the page mode
         */
        public function setPageMode($pageMode) {}

        /**
         * Get the metadata stream.
         *
         * This is a method for low level access to the XMP stream data. The {@link SetaPDF_Core_Document_Info} class
         * offers a {@link SetaPDF_Core_Document_Info::getMetadata() same named} method, that allows you to access the
         * XMP package via a DOMDocument instance.
         *
         * The class also allows you to automatically sync Info dictionary data with the XMP metadata.
         *
         * @return null|string Null if no document metadata are available.<br/>
         *                     A string if the desired structure is available.
         */
        public function getMetadata() {}

        /**
         * Set the metadata stream.
         *
         * To remove the metadata just pass null to this method.
         *
         * @TODO Automatically remove the XML declaration in the first line
         * @param string $metadata
         */
        public function setMetadata($metadata) {}

        /**
         * Get the base URI that shall be used in resolving relative URI references.
         *
         * URI actions within the document may specify URIs in partial form, to be
         * interpreted relative to this base address. If no base URI is specified,
         * such partial URIs shall be interpreted relative to the location of the
         * document itself.
         *
         * @return null|string
         */
        public function getBaseUri() {}

        /**
         * Set the base URI.
         *
         * @see SetaPDF_FormFiller::getBaseUri()
         * @param string $uri
         * @return void
         */
        public function setBaseUri($uri) {}

        /**
         * Get a viewer preferences object.
         *
         * @return SetaPDF_Core_Document_Catalog_ViewerPreferences
         */
        public function getViewerPreferences() {}

        /**
         * Get a pages object from the document.
         *
         * @return SetaPDF_Core_Document_Catalog_Pages
         */
        public function getPages() {}

        /**
         * Get a names object from the document.
         *
         * @return SetaPDF_Core_Document_Catalog_Names
         */
        public function getNames() {}

        /**
         * Get the documents page labels object.
         *
         * @return SetaPDF_Core_Document_Catalog_PageLabels
         */
        public function getPageLabels() {}

        /**
         * Get the documents AcroForm object.
         *
         * This method resolves or creates the AcroForm dictionary and returns it.
         *
         * @return SetaPDF_Core_Document_Catalog_AcroForm
         */
        public function getAcroForm() {}

        /**
         * Get the documents outline object.
         *
         * @return SetaPDF_Core_Document_Catalog_Outlines
         */
        public function getOutlines() {}

        /**
         * Get the documents optional content object.
         *
         * @return SetaPDF_Core_Document_Catalog_OptionalContent
         */
        public function getOptionalContent() {}

        /**
         * Get the output intents object.
         *
         * @return SetaPDF_Core_Document_Catalog_OutputIntents
         */
        public function getOutputIntents() {}

        /**
         * Get the additional actions object.
         *
         * @return SetaPDF_Core_Document_Catalog_AdditionalActions
         */
        public function getAdditionalActions() {}

        /**
         * Get the permission object.
         *
         * @return SetaPDF_Core_Document_Catalog_Permissions
         */
        public function getPermissions() {}

        /**
         * Get the open action.
         *
         * The open action entry specifies a destination that shall be displayed or an action that shall be executed when
         * the document is opened.
         *
         * Additional document related actions could be get or set in the
         * {@link SetaPDF_Core_Document_Catalog_AdditionalActions} class that could be get with the
         * {@link getAdditionalActions()} method.
         *
         * @return null|SetaPDF_Core_Document_Action|SetaPDF_Core_Document_Destination An action or destination instance or
         *                                                                             null if no open action is defined.
         * @throws SetaPDF_Core_Exception
         */
        public function getOpenAction() {}

        /**
         * Set the open action.
         *
         * The open action entry specifies a destination that shall be displayed or an action that shall be executed when
         * the document is opened.
         *
         * Additional document related actions could be get or set in the
         * {@link SetaPDF_Core_Document_Catalog_AdditionalActions} class that could be get with the
         * {@link getAdditionalActions()} method.
         *
         * @param SetaPDF_Core_Document_Destination|SetaPDF_Core_Document_Action $openAction
         *          An {@link SetaPDF_Core_Document_Action} or {@link SetaPDF_Core_Document_Destination} object
         * @throws InvalidArgumentException
         */
        public function setOpenAction($openAction) {}

    }
}

namespace
{

    /**
     * Class representing a cross reference table
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_CrossReferenceTable
    {
        /**
         * The pointer to the last written xref table
         *
         * @var integer
         */
        protected $_pointerToXref;

        /**
         * The cross reference content
         *
         * @var array
         */
        protected $_objectOffsets = [/** value is missing */];

        /**
         * Updated offsets
         *
         * @var array
         */
        protected $_updatedOffsets = [/** value is missing */];

        /**
         * The greatest used object id
         *
         * @var integer
         */
        protected $_maxObjId = 0;

        /**
         * Mark an object as deleted.
         *
         * @param integer $objectId
         */
        public function deleteObject($objectId) {}

        /**
         * Get all defined object ids.
         *
         * @return array
         */
        public function getDefinedObjectIds() {}

        /**
         * Alias for getDefinedObjectIds()
         *
         * @deprecated
         * @return array
         */
        public function getDefiniedObjectIds() {}

        /**
         * Get the generation number by an object id.
         *
         * @param integer $objectId
         * @return integer|boolean
         */
        public function getGenerationNumberByObjectId($objectId) {}

        /**
         * Get an offset for an object.
         *
         * @param integer $objectId
         * @param integer|null $generation
         * @return integer|array|boolean
         */
        public function getOffsetFor($objectId, $generation = 0) {}

        /**
         * Set an object offset.
         *
         * @param integer $objectId
         * @param integer $generation
         * @param integer|array $offset
         */
        public function setOffsetFor($objectId, $generation, $offset) {}

        /**
         * Updates the size value of this cross-reference table.
         *
         * @param integer $objectId
         */
        public function updateSize($objectId) {}

        /**
         * Checks if an objects offset is updated.
         *
         * @param integer $objectId
         * @return boolean
         */
        public function isOffsetUpdated($objectId) {}

        /**
         * Get the cross reference as a compressed stream object.
         *
         * @param SetaPDF_Core_Type_Dictionary $value
         * @param integer $newPointerToXref
         * @param boolean $onlyUpdated
         * @return boolean|SetaPDF_Core_Type_Stream
         */
        public function getCompressedStream(\SetaPDF_Core_Type_Dictionary $value, $newPointerToXref, $onlyUpdated = true) {}

        /**
         * Writes the cross reference to a writer.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer
         * @param boolean $onlyUpdated
         * @return integer
         */
        public function writeNormal(\SetaPDF_Core_Writer_WriterInterface $writer, $onlyUpdated = true) {}

        /**
         * Returns the offset of the last written xref table.
         *
         * @return integer
         */
        public function getPointerToXref() {}

        /**
         * Get the size of the cross reference table.
         *
         * @return integer
         */
        public function getSize() {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Class for handling Destinations in a PDF document
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Destination
    {
        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with the coordinates (left, top) positioned at the upper-left corner
         * of the window and the contents of the page magnified by the factor zoom. A null value for any of the parameters
         * left, top, or zoom specifies that the current value of that parameter shall be retained unchanged. A zoom value
         * of 0 has the same meaning as a null value.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_XYZ = 'XYZ';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with its contents magnified just enough to fit the entire page within
         * the window both horizontally and vertically. If the required horizontal and vertical magnification factors are
         * different, use the smaller of the two, centering the page within the window in the other dimension.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT = 'Fit';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with the vertical coordinate toppositioned at the top edge of the
         * window and the contents of the page magnified just enough to fit the entire width of the page within the window.
         * A null value for top specifies that the current value of that parameter shall be retained unchanged.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_H = 'FitH';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with the horizontal coordinate left positioned at the left edge of
         * the window and the contents of the page magnified just enough to fit the entire height of the page within the
         * window. A null value for left specifies that the current value of that parameter shall be retained unchanged.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_V = 'FitV';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with its contents magnified just enough to fit the rectangle
         * specified by the coordinates left, bottom, right, and top entirely within the window both horizontally and
         * vertically. If the required horizontal and vertical magnification factors are different, use the smaller of the
         * two, centering the rectangle within the window in the other dimension.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_R = 'FitR';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with its contents magnified just enough to fit its bounding box
         * entirely within the window both horizontally and vertically. If the required horizontal and vertical
         * magnification factors are different, use the smaller of the two, centering the bounding box within the window in
         * the other dimension.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_B = 'FitB';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with the vertical coordinate top positioned at the top edge of the
         * window and the contents of the page magnified just enough to fit the entire width of its bounding box within the
         * window. A null value for top specifies that the current value of that parameter shall be retained unchanged.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_BH = 'FitBH';

        /**
         * Fit mode constant.
         *
         * <quote>
         * Display the page designated by page, with the horizontal coordinate left positioned at the left edge of
         * the window and the contents of the page magnified just enough to fit the entire height of its bounding box within
         * the window. A null value for left specifies that the current value of that parameter shall be retained unchanged.
         * </quote>
         *
         * @see PDF 32000-1:2008 - Table 151
         */
        const FIT_MODE_FIT_BV = 'FitBV';

        /**
         * The destination array
         *
         * @var SetaPDF_Core_Type_Array
         */
        protected $_destination;

        /**
         * Find a destination by a name.
         *
         * @param SetaPDF_Core_Document $document
         * @param string $name
         * @return bool|SetaPDF_Core_Document_Destination The destination object or false if it was not found.
         */
        public static function findByName(\SetaPDF_Core_Document $document, $name) {}

        /**
         * Creates an explicit Destination array.
         *
         * This method allows you to pass a flexible argument count after the $fitMode parameter, depending on its value.
         * Following fit modes expect following arguments:
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_XYZ
         * <pre>
         * float|null $left, float|null $top, float|null $zoom
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_FIT
         * <pre>
         * - no parameter -
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_FIT_H
         * <pre>
         * float|null $top
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_FIT_V
         * <pre>
         * float|null $left
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_FIT_R
         * <pre>
         * float $left, float $bottom, float $right, float $top
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_B
         * <pre>
         * - no parameter -
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_BH
         * <pre>
         * float|null $top
         * </pre>
         *
         * SetaPDF_Core_Document_Destination::FIT_MODE_BV
         * <pre>
         * float|null $left
         * </pre>
         *
         * Example:
         * <code>
         * $destinationArray = SetaPDF_Core_Document_Destination::createDestinationArray(
         *     $indirectObject, SetaPDF_Core_Document_Destination::FIT_MODE_XYZ, 30, 50, 200
         * );
         * </code>
         *
         * @param SetaPDF_Core_Type_IndirectObject|SetaPDF_Core_Type_Numeric $pageObject The indirect object of a page of or
         *                                                                               the page number for the usage in
         *                                                                               remote go-to actions.
         * @param string $fitMode
         * @return SetaPDF_Core_Type_Array
         * @throws InvalidArgumentException
         */
        public static function createDestinationArray($pageObject, $fitMode = self::FIT_MODE_FIT) {}

        /**
         * Creates a destination by page number.
         *
         * All additional arguments are passed to the createDestinationArray() method.
         *
         * Example:
         * <code>
         * $destinationArray = SetaPDF_Core_Document_Destination::createByPageNo(
         *     $document, 123, SetaPDF_Core_Document_Destination::FIT_MODE_XYZ, 30, 50, 200
         * );
         * </code>
         *
         * @see createDestinationArray()
         * @param SetaPDF_Core_Document $document
         * @param int $pageNumber
         * @return SetaPDF_Core_Document_Destination
         */
        public static function createByPageNo(\SetaPDF_Core_Document $document, $pageNumber) {}

        /**
         * Creates a destination by a page object.
         *
         * All additional arguments are passed to the createDestinationArray() method.
         *
         * @param SetaPDF_Core_Document_Page $page
         * @see createDestinationArray()
         * @return SetaPDF_Core_Document_Destination
         */
        public static function createByPage(\SetaPDF_Core_Document_Page $page) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $destination
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $destination) {}

        /**
         * Get the target page number.
         *
         * @param SetaPDF_Core_Document $document
         * @return integer|false
         */
        public function getPageNo(\SetaPDF_Core_Document $document) {}

        /**
         * Get the target page object.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Document_Page|false
         */
        public function getPage(\SetaPDF_Core_Document $document) {}

        /**
         * Get the destination array.
         *
         * @return SetaPDF_Core_Type_Array
         */
        public function getDestinationArray() {}

        /**
         * Get the PDF value of this destination.
         *
         * @return SetaPDF_Core_Type_Array
         */
        public function getPdfValue() {}

    }
}

namespace
{

    /**
     * Class for handling the documents info dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Info
    {
        /**
         * Value for the Trapped property
         *
         * @see setTrapped()
         * @var string
         */
        const TRAPPED_TRUE = 'True';

        /**
         * Value for the Trapped property
         *
         * @see setTrapped()
         * @var string
         */
        const TRAPPED_FALSE = 'False';

        /**
         * Value for the Trapped property
         *
         * @see setTrapped()
         * @var string
         */
        const TRAPPED_UNKNOWN = 'Unknown';

        /**
         * The document instance
         *
         * @var SetaPDF_Core_Document
         */
        protected $_document;

        /**
         * Defines if the XMP metadata should be synced or not
         *
         * @var bool
         */
        protected $_syncMetadata = false;

        /**
         * The XMP metadata instance
         *
         * @var DOMDocument
         */
        protected $_metadata;

        public $xmlAliases = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document $document
         */
        public function __construct(\SetaPDF_Core_Document $document) {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         * @internal
         */
        public function getDocument() {}

        /**
         * Release memory.
         */
        public function cleanUp() {}

        /**
         * Get the document's title.
         *
         * @param string $encoding The output encoding
         * @return string|null
         */
        public function getTitle($encoding = 'UTF-8') {}

        /**
         * Set the document's title.
         *
         * @param string $title The document's title
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setTitle($title, $encoding = 'UTF-8') {}

        /**
         * Syncs title with XMP metadata package.
         */
        public function _syncTitle() {}

        /**
         * Get the name of the person who created the document.
         *
         * @param string $encoding The output encoding
         * @return string
         */
        public function getAuthor($encoding = 'UTF-8') {}

        /**
         * Set the name of the person who created the document.
         *
         * @param string $author The name of the person who created the document
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setAuthor($author, $encoding = 'UTF-8') {}

        /**
         * Syncs author with XMP metadata package.
         */
        protected function _syncAuthor() {}

        /**
         * Get the subject of the document.
         *
         * @param string $encoding The output encoding
         * @return string
         */
        public function getSubject($encoding = 'UTF-8') {}

        /**
         * Set the subject of the document.
         *
         * @param string $subject The subject of the document
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setSubject($subject, $encoding = 'UTF-8') {}

        /**
         * Syncs subject with XMP metadata package.
         */
        protected function _syncSubject() {}

        /**
         * Get keywords associated with the document.
         *
         * @param string $encoding The output encoding
         * @return string
         */
        public function getKeywords($encoding = 'UTF-8') {}

        /**
         * Set keywords associated with the document.
         *
         * @param string $keywords The keywords associated with the document.
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setKeywords($keywords, $encoding = 'UTF-8') {}

        /**
         * Syncs keywords with XMP metadata package.
         */
        protected function _syncKeywords() {}

        /**
         * Extracts single elements from a string and converts them into an array.
         *
         * @param $value
         * @return array|bool
         */
        private function _extractParts($value) {}

        /**
         * Get the name of the product that created the original document from which it was converted.
         *
         * @param string $encoding The output encoding
         * @return string
         */
        public function getCreator($encoding = 'UTF-8') {}

        /**
         * Set the name of the product that created the original document from which it was converted.
         *
         * @param string $creator The creator
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setCreator($creator, $encoding = 'UTF-8') {}

        /**
         * Syncs creator with XMP metadata package.
         */
        protected function _syncCreator() {}

        /**
         * Get the name of the product that converted the original document to PDF.
         *
         * @param string $encoding The output encoding.
         * @return string
         */
        public function getProducer($encoding = 'UTF-8') {}

        /**
         * Set the name of the product that converted the original document to PDF.
         *
         * @param string $producer The name of the producer
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setProducer($producer, $encoding = 'UTF-8') {}

        /**
         * Syncs producer with XMP metadata package.
         */
        protected function _syncProducer() {}

        /**
         * Get the date and time the document was created.
         *
         * @param boolean $asString
         * @return null|string|SetaPDF_Core_DataStructure_Date
         */
        public function getCreationDate($asString = true) {}

        /**
         * Set the date and time the document was created.
         *
         * @param string|DateTime|SetaPDF_Core_DataStructure_Date $date
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setCreationDate($date) {}

        /**
         * Syncs creation date with XMP metadata package.
         */
        protected function _syncCreationDate() {}

        /**
         * Get the date and time the document was most recently modified.
         *
         * @param bool $asString If set to true the string value will get returned. Otherwise a
         *                       {@link SetaPDF_Core_DataStructure_Date} object.
         * @return null|string|SetaPDF_Core_DataStructure_Date
         */
        public function getModDate($asString = true) {}

        /**
         * Set the date and time the document was most recently modified.
         *
         * @param string|DateTime|SetaPDF_Core_DataStructure_Date $date The modification date
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setModDate($date) {}

        /**
         * Syncs modification date with XMP metadata package.
         */
        protected function _syncModDate() {}

        /**
         * Get information whether the document has been modified to include trapping information.
         *
         * @param boolean $default If set to true and no entry is defined the default value is returned
         * @return string
         */
        public function getTrapped($default = true) {}

        /**
         * Set information whether the document has been modified to include trapping information.
         *
         * Pass null to remove this entry from the info dictionary.
         *
         * @param string $trapped The trapped value. See SetaPDF_Core_Document_Info::TRAPPED_XXX constants.
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setTrapped($trapped) {}

        /**
         * Syncs the XMP metadata package
         */
        protected function _syncTrapped() {}

        /**
         * Get a custom metadata value.
         *
         * @param string $name The name of the custom metadata value
         * @param string $encoding The output encoding
         * @return null|string
         */
        public function getCustomMetadata($name, $encoding = 'UTF-8') {}

        /**
         * Set custom metadata.
         *
         * Pass $value as null to remove this entry from the info dictionary.
         *
         * @param string $name The name of the custom metadata
         * @param string $value The string value of the custom metadata
         * @param string $encoding The input encoding
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setCustomMetadata($name, $value, $encoding = 'UTF-8') {}

        /**
         * Syncs custom metadata with the XMP metadata package.
         *
         * @param string $name The name of the custom metadata
         */
        public function _syncCustomMetadata($name) {}

        /**
         * Get all data from the info dictionary.
         *
         * @param string $encoding The output encoding
         * @return array An key/value array of all metadata.
         */
        public function getAll($encoding = 'UTF-8') {}

        /**
         * Set all data via an array parameter.
         *
         * This method decides if a value is a custom metadata or a standard value and
         * will forward it to the desired method.
         *
         * @param array $data An key/value array of metadata
         * @param string $encoding The input encoding
         */
        public function setAll(array $data, $encoding = 'UTF-8') {}

        /**
         * Get all custom metadata.
         *
         * @param string $encoding The output encoding
         * @return array
         */
        public function getAllCustomMetadata($encoding = 'UTF-8') {}

        /**
         * Get all custom metadata keys
         *
         * @return array
         */
        protected function _getAllCustomMetadataKeys() {}

        /**
         * Get and/or creates the info dictionary.
         *
         * @param boolean $create Defines if the dictionary should be created if it is not available
         * @return null|SetaPDF_Core_Type_Dictionary The dictionary for low level access or null if none is available.
         */
        public function getDictionary($create = false) {}

        /**
         * Alias for getDictionary().
         *
         * @param boolean $create Defines if the dictionary should be created if it is not available
         * @return null|SetaPDF_Core_Type_Dictionary The dictionary for low level access or null if none is available.
         * @deprecated
         */
        public function getInfoDictionary($create = false) {}

        /**
         * Get a string value from the info dictionary.
         *
         * @param string $name
         * @param string $encoding
         * @return null|string
         */
        protected function _getStringValue($name, $encoding) {}

        /**
         * Set a string value in the info dictionary.
         *
         * @param string $name
         * @param string $value
         * @param string $encoding
         */
        protected function _setStringValue($name, $value, $encoding) {}

        /**
         * Defines if the XMP metadata should be synced automatically.
         *
         * If this is set, the changes are made to a DOMDocument instance temporary.
         * A call of {@link syncMetadata()} is required to write the changes to the metadata entry in the documents
         * catalog dictionary.
         *
         * @param bool $syncMetadata The flag status
         * @return SetaPDF_Core_Document_Info Returns the SetaPDF_Core_Document_Info object for method chaining.
         */
        public function setSyncMetadata($syncMetadata = true) {}

        /**
         * Gets whether XMP metadata should be synced automatically.
         *
         * @return bool
         */
        public function getSyncMetadata() {}

        /**
         * Passes the changes to the XMP metadata package.
         */
        public function syncMetadata() {}

        /**
         * Get the metadata DOMDocument instance.
         *
         * @return DOMDocument Returns a DOMDocument instance of the XMP metadata package.
         */
        public function getMetadata() {}

        /**
         * Updates a single field in the XMP package.
         *
         * @param string $namespace The namespace of the element
         * @param string $tagName The tag name
         * @param bool|string $value The value
         */
        public function updateXmp($namespace, $tagName, $value) {}

        /**
         * Call back for _encodeTagName()
         *
         * @see _encodeTagName()
         * @param $matches
         * @return string
         */
        private function _escapeTagChar($matches) {}

        /**
         * Encodes a tag name as specified in the XMP Specification Part 3 - 3.2.1
         *
         * @param $tagName
         * @return string
         */
        protected function _encodeTagName($tagName) {}

        /**
         * Finds or creates a Description tag with the desired namespace.
         *
         * @param string $namespace
         * @return DOMElement
         */
        protected function _findDescription($namespace) {}

    }
}

namespace
{

    /**
     * Exception thrown if an object which is not defined should be accessed
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_ObjectNotDefinedException extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Exception thrown if an object which is not found should be accessed
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_ObjectNotFoundException extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Class representing an outline item
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_OutlinesItem
    {
        /**
         * Configuration key
         *
         * @var string
         */
        const DEST = 'destination';

        /**
         * Configuration key
         *
         * @var string
         */
        const ACTION = 'action';

        /**
         * Configuration key
         *
         * @var string
         */
        const COLOR = 'color';

        /**
         * Configuration key
         *
         * @var string
         */
        const BOLD = 'bold';

        /**
         * Configuration key
         *
         * @var string
         */
        const ITALIC = 'italic';

        /**
         * Configuration key
         *
         * @var string
         */
        const TITLE = 'title';

        /**
         * Append mode value
         *
         * @var string
         */
        const APPEND_MODE_COPY = 'copy';

        /**
         * Append mode value
         *
         * @var string
         */
        const APPEND_MODE_MOVE = 'move';

        /**
         * Append mode value
         *
         * @var null
         */
        const APPEND_MODE_NONE = null;

        /**
         * Move mode value
         *
         * @var string
         */
        const MOVE_MODE_APPEND = 'append';

        /**
         * Move mode value
         *
         * @var string
         */
        const MOVE_MODE_PREPEND = 'prepend';

        /**
         * Move mode value
         *
         * @var string
         */
        const MOVE_MODE_APPEND_CHILD = 'appendChild';

        /**
         * The item dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The indirect reference for this item (if available)
         *
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectReference;

        /**
         * The current iterator item
         *
         * @var SetaPDF_Core_Document_OutlinesItem
         */
        protected $_current;

        /**
         * Current iterator key
         *
         * @var integer
         */
        protected $_key = 0;

        /**
         * Creates an outline item.
         *
         * The configuration array could hold keyed values:
         * <code>
         * $config = array(
         *     SetaPDF_Core_Document_OutlinesItem::TITLE => string,
         *     SetaPDF_Core_Document_OutlinesItem::DEST => SetaPDF_Core_Document_Destination|SetaPDF_Core_Type_Array|string,
         *     SetaPDF_Core_Document_OutlinesItem::ACTION => SetaPDF_Core_Document_Action|SetaPDF_Core_Type_Dictionary,
         *     SetaPDF_Core_Document_OutlinesItem::COLOR => SetaPDF_Core_DataStructure_Color_Rgb|array
         *     SetaPDF_Core_Document_OutlinesItem::BOLD => boolean,
         *     SetaPDF_Core_Document_OutlinesItem::ITALIC => boolean,
         * );
         * </code>
         *
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @param string|array $titleOrConfig The title or a configuration array
         * @param array $config A configuration array
         * @return SetaPDF_Core_Document_OutlinesItem
         */
        public static function create(\SetaPDF_Core_Document $document, $titleOrConfig, $config = [/** value is missing */]) {}

        /**
         * Copies an item.
         *
         * This method internally removes all relations to its parents or neighboring items.
         *
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be copied
         * @param SetaPDF_Core_Document_OutlinesItem $item The item to copy
         * @return SetaPDF_Core_Document_OutlinesItem
         */
        public static function copyItem(\SetaPDF_Core_Document $document, self $item) {}

        /**
         * Copies an item including all sub-items to another item.
         *
         * @internal
         * @param SetaPDF_Core_Document $document
         * @param self $rootItem
         * @param SetaPDF_Core_Document_OutlinesItem|SetaPDF_Core_Document_Catalog_Outlines $targetItem
         * @param string $appendMethod
         * @param boolean $first
         * @return SetaPDF_Core_Document_OutlinesItem
         * @throws InvalidArgumentException
         */
        private static function _copy(\SetaPDF_Core_Document $document, self $rootItem, $targetItem, $appendMethod, $first = true) {}

        /**
         * Get a hash of an outline item.
         *
         * Used for checking cyclic references.
         *
         * @see SetaPDF_Core_Document_OutlinesItem::contains()
         * @param self $item
         * @return string
         */
        private static function _getHash(self $item) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $objectOrDictionary
         */
        public function __construct($objectOrDictionary) {}

        /**
         * Omit cloning.
         *
         * @throws BadMethodCallException
         */
        public function __clone() {}

        /**
         * Get the reference to this item.
         *
         * @return SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary
         */
        public function getReferenceTo() {}

        /**
         * Get the item title.
         *
         * @param string $encoding The output encoding
         * @return string
         */
        public function getTitle($encoding = 'UTF-8') {}

        /**
         * Set the item title.
         *
         * @param string $title The item title
         * @param string $encoding The input encoding
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function setTitle($title, $encoding = 'UTF-8') {}

        /**
         * Checks if the item should be displayed bold.
         *
         * @return boolean
         */
        public function isBold() {}

        /**
         * Sets whether the item should be displayed bold or not.
         *
         * @param boolean $bold True to display the item bold
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function setBold($bold = true) {}

        /**
         * Checks if the item should be displayed italic.
         *
         * @return boolean
         */
        public function isItalic() {}

        /**
         * Sets whether the item should be displayed italic or not.
         *
         * @param boolean $italic True to display the item italic
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function setItalic($italic = true) {}

        /**
         * Get the color of the item.
         *
         * @return false|SetaPDF_Core_DataStructure_Color A color object or false if no color is defined.
         */
        public function getColor() {}

        /**
         * Set the color of the item.
         *
         * @param array|SetaPDF_Core_DataStructure_Color_Rgb|float $colorOrR An array of 3 integer values representing the
         *                                                                   rgb components (between 0 and 1), an instance
         *                                                                   of {@link SetaPDF_Core_DataStructure_Color_Rgb}
         *                                                                   or the red component value (between 0 and 1).
         * @param float $g The green component value (between 0 and 1)
         * @param float $b The blue component value (between 0 and 1)
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function setColor($colorOrR, $g = null, $b = null) {}

        /**
         * Get the destination of the item.
         *
         * @param SetaPDF_Core_Document $document The main document is needed to automatically resolve the destination
         * @return SetaPDF_Core_Document_Destination|false A destination instance or false if none was defined.
         * @throws BadMethodCallException
         */
        public function getDestination(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set the destination of the item.
         *
         * @param SetaPDF_Core_Document_Destination|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_StringValue|SetaPDF_Core_Type_Name|string $destination The destination
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         * @throws InvalidArgumentException
         */
        public function setDestination($destination) {}

        /**
         * Get the action of the item.
         *
         * @return bool|SetaPDF_Core_Document_Action The action instance or false if no action is defined.
         */
        public function getAction() {}

        /**
         * Set the action of the item.
         *
         * The action could be an instance of {@link SetaPDF_Core_Document_Action} or a plain dictionary representing
         * the action.
         *
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         * @param SetaPDF_Core_Document_Action|SetaPDF_Core_Type_Dictionary $action The action to execute
         * @throws InvalidArgumentException
         */
        public function setAction($action) {}

        /**
         * Checks whether the item is open or not or if the item does not holds any descendants.
         *
         * @return null|boolean Returns true if the item is open, false if it is closed or null if the item does not holds
         *                      any descendants.
         */
        public function isOpen() {}

        /**
         * Open or close the item.
         *
         * @param boolean $open A boolean value specifying if the item is opened or not
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function setOpen($open = true) {}

        /**
         * Close the item.
         *
         * Alias for {@link SetaPDF_Core_Document_OutlinesItem::setOpen()} with false as its argument.
         *
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function close() {}

        /**
         * Open the item.
         *
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method chaining.
         */
        public function open() {}

        /**
         * Remove the item from the outline.
         *
         * @return SetaPDF_Core_Document_OutlinesItem The removed item
         */
        public function remove() {}

        /**
         * Prepend another item to this item.
         *
         * The $mode parameter can be used to specify the way the item will be
         * prepended: moved or copied.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $item The item to prepend
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @param string $mode The append mode. See SetaPDF_Core_Document_OutlinesItem::APPEND_MODE_XXX constants for
         *                     details.
         * @return SetaPDF_Core_Document_OutlinesItem Returns the passed item or the last node in the item structure.
         * @throws LogicException
         * @throws InvalidArgumentException
         */
        public function prepend(self $item, ?\SetaPDF_Core_Document $document = null, $mode = null) {}

        /**
         * Append another item to this item.
         *
         * The $mode parameter can be used to specify the way the item will be
         * appended: moved or copied.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $item The item to append
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @param string $mode The append mode. See SetaPDF_Core_Document_OutlinesItem::APPEND_MODE_XXX constants for
         *                     details.
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method
         *                                            chaining.
         * @throws LogicException
         * @throws InvalidArgumentException
         */
        public function append(self $item, ?\SetaPDF_Core_Document $document = null, $mode = null) {}

        /**
         * Append another item as a child of this item.
         *
         * The $mode parameter can be used to specify the way the item will be appended: moved or copied.
         *
         * @param self $item The item to append
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @param string $mode The append mode. See SetaPDF_Core_Document_OutlinesItem::APPEND_MODE_XXX constants for
         *                     details.
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method
         *                                            chaining.
         * @throws InvalidArgumentException
         */
        public function appendChild($item, ?\SetaPDF_Core_Document $document = null, $mode = null) {}

        /**
         * Move this item to another item or root outline.
         *
         * The $mode parameter can be used to specify how the item will be moved.
         *
         * @param SetaPDF_Core_Document_Catalog_Outlines|SetaPDF_Core_Document_OutlinesItem $target The target item
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @param string $mode The move mode. See SetaPDF_Core_Document_OutlinesItem::MOVE_MODE_XXX constants for details.
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method
         *                                            chaining.
         * @throws InvalidArgumentException
         */
        public function move($target, \SetaPDF_Core_Document $document, $mode = 'appendChild') {}

        /**
         * Appends a copy of another item to this item.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $originalItem The original item
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method
         *                                            chaining.
         */
        public function appendCopy(self $originalItem, \SetaPDF_Core_Document $document) {}

        /**
         * Prepends a copy of another item to this item.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $originalItem The original item
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @return SetaPDF_Core_Document_OutlinesItem Returns the SetaPDF_Core_Document_OutlinesItem object for method
         *                                            chaining.
         */
        public function prependCopy(self $originalItem, \SetaPDF_Core_Document $document) {}

        /**
         * Appends a copy of another item or outline as a child to this item.
         *
         * @param SetaPDF_Core_Document_Catalog_Outlines|SetaPDF_Core_Document_OutlinesItem $originalItem
         *              The original item or root outlines dictionary
         * @param SetaPDF_Core_Document $document The document instance in which context the item will be used
         * @return null|SetaPDF_Core_Document_OutlinesItem
         */
        public function appendChildCopy($originalItem, \SetaPDF_Core_Document $document) {}

        /**
         * Checks if an item is specified in any descendants of this item.
         *
         * @param SetaPDF_Core_Document_OutlinesItem $item The item to check for
         * @param boolean $checkAgainstThis True to check this instance against the item
         * @return boolean Whether the item is specified in any descendants of this item.
         */
        public function contains(self $item, $checkAgainstThis = true) {}

        /**
         * Get an item instance of the item referenced in the Prev key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem
         */
        public function getPrevious() {}

        /**
         * Get an item instance of the item referenced in the Next key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem
         */
        public function getNext() {}

        /**
         * Get an item instance of the item referenced in the Parent key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem
         */
        public function getParent() {}

        /**
         * Get an item instance of the item referenced in the First key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem
         */
        public function getFirstItem() {}

        /**
         * Checks if this item has a 'First' value set.
         *
         * The first item is the first item structured under this item.
         * With this method you can check if the item has child items.
         *
         * @return boolean True if a child item exists - false otherwise.
         */
        public function hasFirstItem() {}

        /**
         * Get an item instance of the item referenced in the 'Last' key.
         *
         * @return boolean|SetaPDF_Core_Document_OutlinesItem
         */
        public function getLastItem() {}

        /**
         * Get the number of visible outline items (value of the Count key).
         *
         * Total number of visible outline items at all levels of the outline.
         *
         * @return integer
         */
        public function getCount() {}

        /**
         * Get the dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Checks if this item has descendants.
         *
         * @see RecursiveIterator::hasChildren()
         */
        public function hasChildren() {}

        /**
         * Get the first descendant item.
         *
         * @see RecursiveIterator::getChildren()
         * @return SetaPDF_Core_Document_OutlinesItem|false
         */
        public function getChildren() {}

        /**
         * Get the current item.
         *
         * @see RecursiveIterator::current()
         * @return SetaPDF_Core_Document_OutlinesItem
         */
        public function current() {}

        /**
         * Get the next item.
         *
         * @see RecursiveIterator::next()
         */
        public function next() {}

        /**
         * Get the iterator key.
         *
         * @see RecursiveIterator::key()
         * @return integer
         */
        public function key() {}

        /**
         * Checks whether the pointer of the iterator is valid or not.
         *
         * @see RecursiveIterator::valid()
         * @return boolean
         */
        public function valid() {}

        /**
         * Reset the iterator.
         *
         * @see RecursiveIterator::rewind()
         */
        public function rewind() {}

        /**
         * Checks if an item exists at a specific position.
         *
         * @see ArrayAccess::offsetExists()
         * @param mixed $offset The index being checked
         * @return boolean
         */
        public function offsetExists($offset) {}

        /**
         * Set an item at a specific position.
         *
         * @see ArrayAccess::offsetSet()
         * @see append()
         * @see appendChild()
         * @see remove()
         * @param null|string $offset The index being set
         * @param mixed $value The new value for the index
         */
        public function offsetSet($offset, $value) {}

        /**
         * Get an item by a specific position.
         *
         * @see ArrayAccess::offsetGet()
         * @param mixed $offset The index with the value
         * @return SetaPDF_Core_Document_OutlinesItem The value at the specified index.
         * @throws InvalidArgumentException if no item is at the offset.
         */
        public function offsetGet($offset) {}

        /**
         * Removes an item at a specific position.
         *
         * @see ArrayAccess::offsetUnset()
         * @param mixed $offset The index being unset
         * @return SetaPDF_Core_Document_OutlinesItem
         */
        public function offsetUnset($offset) {}

    }
}

namespace
{

    /**
     * Class representing a PDF page
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document_Page implements \SetaPDF_Core_Canvas_ContainerInterface
    {
        /**
         * The page indirect object
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_pageObject;

        /**
         * Inherited attributes
         *
         * @var array An array of SetaPDF_Core_Type_Dictionary_Entry instances
         */
        protected $_inheritedAttributes = [/** value is missing */];

        /**
         * Flag for resolving of inherited attributes
         *
         * @var boolean
         */
        protected $_inheritedAttributesResolved = false;

        /**
         * Flag for observing the page object
         *
         * @var boolean
         */
        protected $_pageIsObserved = false;

        /**
         * The annotations object
         *
         * @var SetaPDF_Core_Document_Page_Annotations
         */
        protected $_annotations;

        /**
         * The contents object for this page
         *
         * @var SetaPDF_Core_Document_Page_Contents
         */
        protected $_contents;

        /**
         * The canvas object of this page
         *
         * @var SetaPDF_Core_Canvas
         */
        protected $_canvas;

        /**
         * The additional actions object of this page
         *
         * @var SetaPDF_Core_Document_Page_AdditionalActions
         */
        protected $_additionalActions;

        /**
         * Creates a new page for a specific document.
         *
         * @param SetaPDF_Core_Document $document
         * @param array $values
         * @return SetaPDF_Core_Document_Page
         */
        public static function create(\SetaPDF_Core_Document $document, $values = [/** value is missing */]) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObject $pageObject
         * @throws SetaPDF_Core_Exception
         */
        public function __construct(\SetaPDF_Core_Type_IndirectObject $pageObject) {}

        /**
         * Release memory/resources.
         */
        public function cleanUp() {}

        /**
         * Get the page indirect object.
         *
         * @param boolean $observe
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getPageObject($observe = false) {}

        /**
         * Get the page object.
         * 
         * @param bool $observe
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getObject($observe = false) {}

        /**
         * Get the pages stream proxy object.
         * 
         * @return SetaPDF_Core_Document_Page_Contents
         */
        public function getStreamProxy() {}

        /**
         * Ensures that all inherited properties are resolved.
         */
        protected function _ensureInheritedAttributes() {}

        /**
         * Get an attribute of the page object or from an inherited pages object.
         *
         * @param string $name
         * @param bool $inherited
         * @return SetaPDF_Core_Type_AbstractType|null
         */
        public function getAttribute($name, $inherited = true) {}

        /**
         * Make sure that the page object is observed.
         */
        protected function _ensureObservation() {}

        /**
         * Flattens the inherited attributes to the main page object.
         */
        public function flattenInheritedAttributes() {}

        /**
         * Get width and height of the page.
         *
         * @param string $box
         * @param boolean $fallback
         * @return array|boolean array(width, height)
         */
        public function getWidthAndHeight($box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $fallback = true) {}

        /**
         * Get the width of the page.
         *
         * @param string $box
         * @param boolean $fallback
         * @return float|integer|boolean
         */
        public function getWidth($box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $fallback = true) {}

        /**
         * Get the height of the page.
         *
         * @param string $box
         * @param boolean $fallback
         * @return float|integer|boolean
         */
        public function getHeight($box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $fallback = true) {}

        /**
         * Get a page boundary box of the page.
         *
         * To work with the boundary box it should be cloned and reset by the
         * {@link SetaPDF_Core_Document_Page::setBoundary()} method. This is
         * necessary because a box could be inherited by a parent page tree node.
         *
         * @param string $box See SetaPDF_Core_PageBoundaries::XXX_BOX constants
         * @param boolean $fallback Use the fallback box instead if box not exist
         * @param boolean $asRect Return boundary box as SetaPDF_Core_DataStructure_Rectangle
         * @return boolean|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getBoundary($box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $fallback = true, $asRect = true) {}

        /**
         * Checks a boundary for validity.
         * 
         * @param SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array $newBoundary
         * @param string $newBox
         * @throws OutOfBoundsException
         */
        private function _checkBoundary($newBoundary, $newBox) {}

        /**
         * Set a boundary box.
         *
         * A boundary consists of four numeric values: llx, lly, urx and ury. They can be passed in various ways:
         *
         * <ul>
         *  <li>By a simple PHP array.</li>
         *  <li>A {@link SetaPDF_Core_Type_Array PDF Array} with 4 {@link SetaPDF_Core_Type_Numeric numeric} values.</li>
         *  <li>An instance of {@link SetaPDF_Core_DataStructure_Rectangle}.</li>
         *  <li>
         *     An instance of {@link SetaPDF_Core_Type_Dictionary_Entry} where the key defines the box and the value the
         *     boundary itself.
         *  </li>
         * </ul>
         *
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         *          The data of the boundary.
         * @param string $box The page boundary name
         * @param boolean $checkBoundary Ensure that boundary values are valid or not
         * @throws InvalidArgumentException
         */
        public function setBoundary($boundary, $box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $checkBoundary = true) {}

        /**
         * Get the media box of this page.
         * 
         * @param bool $fallback
         * @param bool $asRect
         * @return bool|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getMediaBox($fallback = true, $asRect = true) {}

        /**
         * Set the media box.
         * 
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         * @param boolean $checkBoundary Ensure that boundary values are valid or not
         */
        public function setMediaBox($boundary, $checkBoundary = true) {}

        /**
         * Get the crop box of this page.
         * 
         * @param bool $fallback
         * @param bool $asRect
         * @return bool|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getCropBox($fallback = true, $asRect = true) {}

        /**
         * Set the crop box.
         * 
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         * @param boolean $checkBoundary Ensure that boundary values are valid or not
         */
        public function setCropBox($boundary, $checkBoundary = true) {}

        /**
         * Get the bleed box of this page.
         * 
         * @param bool $fallback
         * @param bool $asRect
         * @return bool|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getBleedBox($fallback = true, $asRect = true) {}

        /**
         * Set the bleed box.
         * 
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         * @param boolean $checkBoundary Ensure that boundary values are valid or not
         */
        public function setBleedBox($boundary, $checkBoundary = true) {}

        /**
         * Get the trim box of this page.
         * 
         * @param bool $fallback
         * @param bool $asRect
         * @return bool|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getTrimBox($fallback = true, $asRect = true) {}

        /**
         * Set the trim box.
         * 
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         * @param boolean $checkBoundary Ensure that boundary values are valid or not
         */
        public function setTrimBox($boundary, $checkBoundary = true) {}

        /**
         * Get the art box of this page.
         * 
         * @param bool $fallback
         * @param bool $asRect
         * @return bool|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getArtBox($fallback = true, $asRect = true) {}

        /**
         * Set the art box.
         * 
         * @param array|SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_Array|SetaPDF_Core_DataStructure_Rectangle $boundary
         */
        public function setArtBox($boundary) {}

        /**
         * Get the page rotation.
         *
         * @return integer
         */
        public function getRotation() {}

        /**
         * Set the page rotation.
         *
         * @param integer $rotation The rotation value
         * @return SetaPDF_Core_Document_Page Returns the SetaPDF_Core_Document_Page object for method chaining.
         * @throws InvalidArgumentException
         */
        public function setRotation($rotation) {}

        /**
         * Rotate a page by degrees.
         *
         * @param integer $rotation Degrees to rotate by
         * @return SetaPDF_Core_Document_Page Returns the SetaPDF_Core_Document_Page object for method chaining.
         */
        public function rotateBy($rotation) {}

        /**
         * Get the orientation of the page.
         *
         * @param string $box See SetaPDF_Core_PageBoundaries::XXX_BOX constants
         * @param bool $fallback Use the fallback box instead if box not exist
         * @return bool|string false or one of SetaPDF_Core_PageFormats::ORIENTATION_XXX constants
         */
        public function getOrientation($box = \SetaPDF_Core_PageBoundaries::CROP_BOX, $fallback = true) {}

        /**
         * Gets the annotation instance of this page.
         *
         * @return SetaPDF_Core_Document_Page_Annotations
         */
        public function getAnnotations() {}

        /**
         * Gets the contents instance of this page.
         *
         * @return SetaPDF_Core_Document_Page_Contents
         */
        public function getContents() {}

        /**
         * Gets the canvas instance for this page.
         *
         * @return SetaPDF_Core_Canvas
         */
        public function getCanvas() {}

        /**
         * Gets the additional actions object instance for this page.
         *
         * @return SetaPDF_Core_Document_Page_AdditionalActions
         */
        public function getAdditionalActions() {}

        /**
         * Get the date and time the page was edited.
         *
         * @param boolean $asString
         * @return null|string|SetaPDF_Core_DataStructure_Date
         */
        public function getLastModified($asString = true) {}

        /**
         * Set the date and time the page was edited.
         *
         * @param string|SetaPDF_Core_DataStructure_Date $date The last modification date. An instance of
         *          {@link SetaPDF_Core_DataStructure_Date}. Alternatively a string which is passed to its constructor.
         */
        public function setLastModified($date) {}

        /**
         * Get a group attributes object.
         *
         * @return null|SetaPDF_Core_TransparencyGroup
         */
        public function getGroup() {}

        /**
         * Set the group attributes object.
         *
         * @param false|SetaPDF_Core_TransparencyGroup $group
         * @throws InvalidArgumentException
         */
        public function setGroup($group) {}

        /**
         * Converts the page object into a form XObject.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $box The name of the bounding box
         * @return SetaPDF_Core_XObject_Form
         */
        public function toXObject(\SetaPDF_Core_Document $document, $box = \SetaPDF_Core_PageBoundaries::CROP_BOX) {}

    }
}

namespace
{

    /**
     * A class holding page layout properties
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     * @see SetaPDF_Core_Document::setPageLayout()
     */
    class SetaPDF_Core_Document_PageLayout
    {
        /**
         * Constant for page layout value
         *
         * Display one page at a time
         *
         * @var string
         */
        const SINGLE_PAGE = 'SinglePage';

        /**
         * Constant for page layout value
         *
         * Display the pages in one column
         *
         * @var string
         */
        const ONE_COLUMN = 'OneColumn';

        /**
         * Constant for page layout value
         *
         * Display the pages in two columns, with odd-numbered pages on the left
         *
         * @var string
         */
        const TWO_COLUMN_LEFT = 'TwoColumnLeft';

        /**
         * Constant for page layout value
         *
         * Display the pages in two columns, with odd-numbered pages on the right
         *
         * @var string
         */
        const TWO_COLUMN_RIGHT = 'TwoColumnRight';

        /**
         * Constant for page layout value
         *
         * (PDF 1.5) Display the pages two at a time, with odd-numbered pages on the left
         *
         * @var string
         */
        const TWO_PAGE_LEFT = 'TwoPageLeft';

        /**
         * Constant for page layout value
         *
         * (PDF 1.5) Display the pages two at a time, with odd-numbered pages on the right
         *
         * @var string
         */
        const TWO_PAGE_RIGHT = 'TwoPageRight';

    }
}

namespace
{

    /**
     * A class holding page mode properties
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     * @see SetaPDF_Core_Document::setPageLayout()
     */
    class SetaPDF_Core_Document_PageMode
    {
        /**
         * Constant for page mode value
         *
         * Neither document outline nor thumbnail images visible
         *
         * @var string
         */
        const USE_NONE = 'UseNone';

        /**
         * Constant for page mode value
         *
         * Document outline visible
         *
         * @var string
         */
        const USE_OUTLINES = 'UseOutlines';

        /**
         * Constant for page mode value
         *
         * Thumbnail images visible
         *
         * @var string
         */
        const USE_THUMBS = 'UseThumbs';

        /**
         * Constant for page mode value
         *
         * Full-screen mode, with no menu bar, window controls, or any other window visible
         *
         * @var string
         */
        const FULL_SCREEN = 'FullScreen';

        /**
         * Constant for page mode value
         *
         * (PDF 1.5) Optional content group panel visible
         *
         * @var string
         */
        const USE_OC = 'UseOC';

        /**
         * Constant for page mode value
         *
         * (PDF 1.6) Attachments panel visible
         *
         * @var string
         */
        const USE_ATTACHMENTS = 'UseAttachments';

    }
}

namespace
{

    /**
     * Interface for encoding tables
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Encoding_EncodingInterface
    {
        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code
         * points in the specific encoding.
         *
         * @return array
         */
        public static function getTable();

    }
}

namespace
{

    /**
     * Implementation of the MacExpertEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_MacExpert implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to MacExpertEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from MacExpertEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the MacRomanEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_MacRoman implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to MacRomanEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from MacRomanEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the PdfDocEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_PdfDoc implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to PDFDocEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from PDFDocEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the StandardEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_Standard implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to StandardEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from StandardEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the SymbolEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_Symbol implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to SymbolEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from SymbolEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the WinAnsiEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_WinAnsi implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to WinAnsiEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from WinAnsiEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Implementation of the ZapfDingbatsEncoding
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding_ZapfDingbats implements \SetaPDF_Core_Encoding_EncodingInterface
    {
        public static $table = [/** value is missing */];

        /**
         * Returns the encoding table array.
         *
         * Keys are the unicode values while the values are the code points in the specific encoding.
         *
         * @see SetaPDF_Core_Encoding_EncodingInterface::getTable()
         * @return array
         */
        public static function getTable() {}

        /**
         * Converts a string from UTF-16BE to ZapfDingbatsEncoding.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function fromUtf16Be($string, $ignore = false, $translit = false) {}

        /**
         * Converts a string from ZapfDingbatsEncoding to UTF-16BE.
         *
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($string, $ignore = false, $translit = false) {}

    }
}

namespace
{

    /**
     * Class for handling ASCII base-85 data
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_Ascii85 implements \SetaPDF_Core_Filter_FilterInterface
    {
        /**
         * Decode ASCII85 encoded string.
         *
         * @see SetaPDF_Core_Filter_FilterInterface::decode()
         * @param string $in The input string
         * @return string
         * @throws SetaPDF_Core_Filter_Exception
         */
        public function decode($in) {}

        /**
         * Encode a string to ASCII85.
         *
         * @see SetaPDF_Core_Filter_FilterInterface::encode()
         * @param string $data
         * @return string
         * @throws SetaPDF_Exception_NotImplemented
         * todo Implement
         * @internal
         */
        public function encode($data) {}

    }
}

namespace
{

    /**
     * Class for handling ASCII hexadecimal data
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_AsciiHex implements \SetaPDF_Core_Filter_FilterInterface
    {
        /**
         * Converts an ASCII hexadecimal encoded string into it's binary representation.
         *
         * @see SetaPDF_Core_Filter_FilterInterface::decode()
         * @param string $data The input string
         * @return string
         */
        public function decode($data) {}

        /**
         * Converts a string into ASCII hexadecimal representation.
         *
         * @see SetaPDF_Core_Filter_FilterInterface::encode()
         * @param string $data The input string
         * @param boolean $leaveEOD
         * @return string
         */
        public function encode($data, $leaveEOD = false) {}

    }
}

namespace
{

    /**
     * Filter exception
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_Exception extends \SetaPDF_Core_Exception
    {
        /**
         * @var integer
         */
        const NO_ZLIB = 768;

        /**
         * @var integer
         */
        const DECOMPRESS_ERROR = 769;

        /**
         * @var integer
         */
        const ILLEGAL_CHAR_FOUND = 784;

        /**
         * @var integer
         */
        const ILLEGAL_LENGTH = 785;

        /**
         * @var integer
         */
        const LZW_FLAVOUR_NOT_SUPPORTED = 800;

        /**
         * @var integer
         */
        const DECOMPRESS_ROW_ERROR = 816;

        /**
         * @var integer
         */
        const UNRECOGNIZED_PNG_PREDICTOR = 817;

        /**
         * @var integer
         */
        const UNRECOGNIZED_PREDICTOR = 818;

    }
}

namespace
{

    /**
     * A filter interface
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Filter_FilterInterface
    {
        /**
         * Decode a string.
         *
         * @param string $data The input string
         * @return string
         */
        public function decode($data);

        /**
         * Encodes a string.
         *
         * @param string $data The input string
         * @return string
         */
        public function encode($data);

    }
}

namespace
{

    /**
     * Class for handling zlib/deflate compression
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_Flate extends \SetaPDF_Core_Filter_Predictor
    {
        /**
         * Checks whether the zlib extension is loaded.
         *
         * Used for testing purpose.
         *
         * @return boolean
         * @internal
         */
        protected function _extensionLoaded() {}

        /**
         * Decodes a flate compressed string.
         *
         * @param string $data The input string
         * @return string
         * @throws SetaPDF_Core_Filter_Exception
         */
        public function decode($data) {}

        /**
         * Encodes a string with flate compression.
         *
         * @param string $data The input string
         * @return string
         * @throws SetaPDF_Core_Filter_Exception
         */
        public function encode($data) {}

    }
}

namespace
{

    /**
     * Class for handling LZW compression
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_Lzw extends \SetaPDF_Core_Filter_Predictor
    {
        /**
         * @var string
         */
        protected $_data;

        /**
         * @var array
         */
        protected $_sTable = [/** value is missing */];

        /**
         * @var int
         */
        protected $_dataLength = 0;

        /**
         * @var
         */
        protected $_tIdx;

        /**
         * @var int
         */
        protected $_bitsToGet = 9;

        /**
         * @var
         */
        protected $_bytePointer;

        /**
         * @var int
         */
        protected $_nextData = 0;

        /**
         * @var int
         */
        protected $_nextBits = 0;

        /**
         * @var array
         */
        protected $_andTable = [/** value is missing */];

        /**
         * Method to decode LZW compressed data.
         *
         * @param string $data The compressed data
         * @return string The uncompressed data
         * @throws SetaPDF_Core_Filter_Exception
         */
        public function decode($data) {}

        /**
         * Initialize the string table.
         */
        protected function _initsTable() {}

        /**
         * Add a new string to the string table.
         *
         * @param string $oldString
         * @param string $newString
         */
        protected function _addStringToTable($oldString, $newString = '') {}

        /**
         * Returns the next 9, 10, 11 or 12 bits.
         *
         * @return integer
         */
        protected function _getNextCode() {}

        /**
         * Encodes a string using LZW algorithm.
         *
         * @see SetaPDF_Core_Filter_Predictor::encode()
         * @param string $data
         * @return string
         * @throws SetaPDF_Exception_NotImplemented
         * todo Implement
         * @internal
         */
        public function encode($data) {}

    }
}

namespace
{

    /**
     * Class handling predictor functions
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_Predictor implements \SetaPDF_Core_Filter_FilterInterface
    {
        /**
         * Whether or not to only write algorithm byte if predictor value is 15.
         *
         * If set to <b>true</b>, the algorithm byte is written at the beginning
         * of every line for all PNG predictors.
         *
         * If set to <b>false</b>, this byte is only written for optimum png compression,
         * which can vary the compression algorithm for each row.
         *
         * @var bool
         */
        public $alwaysWritePredictorByte = true;

        /**
         * @var int
         */
        protected $_predictor = 1;

        /**
         * @var int
         */
        protected $_colors = 1;

        /**
         * @var int
         */
        protected $_bitsPerComponent = 8;

        /**
         * @var int
         */
        protected $_columns = 1;

        /**
         * The constructor.
         *
         * @param integer $predictor
         * @param integer $colors
         * @param integer $bitsPerComponent
         * @param integer $columns
         */
        public function __construct($predictor = null, $colors = null, $bitsPerComponent = null, $columns = null) {}

        /**
         * Value prediction using the Alan W. Paeth algorithm.
         *
         * @param int|float $left The value to the left of the processed data entry.
         * @param int|float $above The value above the processed data entry.
         * @param int|float $upperLeft The value to the upper left of the processed data entry.
         * @return int|float Returns the prediction value according to the Peath algorithm
         */
        protected function _paethPredictor($left, $above, $upperLeft) {}

        /**
         * Decodes a string using a predictor function.
         *
         * @param string $data The input string
         * @return string The decoded data
         * @throws SetaPDF_Core_Filter_Exception
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function decode($data) {}

        /**
         * Encodes a string using a predictor function.
         *
         * @param string $data The input string
         * @return string The encoded data
         * @throws SetaPDF_Core_Filter_Exception
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function encode($data) {}

    }
}

namespace
{

    /**
     * Class for handling run-length compression
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Filter
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Filter_RunLength implements \SetaPDF_Core_Filter_FilterInterface
    {
        /**
         * Decodes run-length compressed string.
         *
         * @param string $data
         * @return string
         * @throws SetaPDF_Core_Filter_Exception
         */
        public function decode($data) {}

        /**
         * Encodes a string with run-length compression.
         *
         * @param string $data
         * @return string
         */
        public function encode($data) {}

    }
}

namespace
{

    /**
     * Interface for CMAPs.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Font_Cmap_CmapInterface
    {
        /**
         * Do a reverse lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseLookup($dest);

        /**
         * Do a reverse CID lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseCidLoopkup($dest);

        /**
         * Lookup a unicode value.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookup($src);

        /**
         * Lookup for a CID.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookupCid($src);

    }
}

namespace
{

    /**
     * A class representing a Identity CMAP.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Cmap_Identity implements \SetaPDF_Core_Font_Cmap_CmapInterface
    {
        /**
         * Do a reverse lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseLookup($dest) {}

        /**
         * Do a reverse CID lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseCidLoopkup($dest) {}

        /**
         * Lookup a unicode value.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookup($src) {}

        /**
         * Lookup for a CID.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookupCid($src) {}

    }
}

namespace
{

    /**
     * An interface for glyph collections
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Font_Glyph_Collection_CollectionInterface
    {
        /**
         * Get the glyph width of a single character.
         *
         * @param string $char The character
         * @param string $encoding The encoding of the character
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE');

        /**
         * Get the glyphs width of a string.
         *
         * @param string $chars The string
         * @param string $encoding The encoding of the characters
         */
        public function getGlyphsWidth($chars, $encoding = 'UTF-16BE');

    }
}

namespace
{

    /**
     * Class for accessing adobes glyph lists
     *  
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Glyph_List
    {
        /**
         * Constant for the adobe glyph list
         * 
         * @var string
         */
        const LIST_AGL = 'glyphlist';

        /**
         * Constant for the zapfdingbats glyph list
         * 
         * @var string
         */
        const LIST_ZDGL = 'zapfdingbats';

        /**
         * Constant for the adobe glyph list for new fonts
         * 
         * @var string
         */
        const LIST_AGLFN = 'aglfn';

        /**
         * Constant for custom glyph names
         *
         * @var string
         */
        const LIST_CUSTOM = 'custom';

        /**
         * The glyph lists
         *
         * @var array
         */
        public static $lists = [/** value is missing */];

        /**
         * Get the UTF-16BE values by a glyph name.
         * 
         * @param string $name The glyph name
         * @param string $primaryList Use LIST_XXX constant
         * @return bool|string If glyph was found the UTF-16BE values will be returned as <b>string</b>.<br/>
         *                     Otherwise <b>false</b> will be returned.<br/>
         * @throws InvalidArgumentException if the glyph list is unknown.
         */
        public static function byName($name, $primaryList = self::LIST_AGL) {}

        /**
         * Get the UTF-16BE value from a glyph list.
         *
         * @param $name
         * @param string $primaryList
         * @return string
         */
        protected static function _byName($name, $primaryList = self::LIST_AGL) {}

        /**
         * Get the glyph name by the UTF-16BE value.
         * 
         * @param string $code The UTF-16BE value
         * @param string $primaryList Use LIST_XXX constant
         * @return string The glyph name will be returned as <b>string</b>.
         * @throws InvalidArgumentException if the glyph list is unknown.
         */
        public static function byUtf16Be($code, $primaryList = self::LIST_AGL) {}

        /**
         * Get a list of all glyphs used in the string.
         *
         * @param string $string The UTF-16BE value
         * @param string $primaryList Use LIST_XXX constant
         * @return array
         * @throws InvalidArgumentException if the glyph list is unknown.
         */
        public static function byUtf16BeString($string, $primaryList = self::LIST_AGL) {}

        /**
         * Get the glyph name by the value.
         *
         * @param string $code The value
         * @param string $encoding The encoding of the value
         * @param string $primaryList Use LIST_XXX constant
         * @return bool|string If glyph was found the name will be returned as <b>string</b>.<br/>
         *                     Otherwise <b>false</b> will be returned.<br/>
         * @throws InvalidArgumentException if the glyph list is unknown.
         */
        public static function byCode($code, $encoding = 'UTF-16BE', $primaryList = self::LIST_AGL) {}

        /**
         * Prohibit object initiation by defining the constructor to be private.
         *
         * @internal
         */
        private function __construct() {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Courier 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_Courier extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Courier-Bold 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_CourierBold extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Courier-BoldOblique 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_CourierBoldOblique extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Courier-Oblique 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_CourierOblique extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Helvetica 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_Helvetica extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Helvetica-Bold 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_HelveticaBold extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Helvetica-BoldOblique 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_HelveticaBoldOblique extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Helvetica-Oblique 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_HelveticaOblique extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Symbol 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_Symbol extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary() {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = null, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Get the base encoding table.
         *
         * @return array
         */
        public function getBaseEncodingTable() {}

        /**
         * Converts a char code from the font specific encoding to another encoding.
         *
         * @param string $charCode The char code in the font specific encoding.
         * @param string $encoding The resulting encoding
         * @param bool $normalize Specifies if unknown mappings (e.g. to points in the private unicode area) should be
         *                        mapped to meaningful values.
         * @return string
         */
        public function getCharByCharCode($charCode, $encoding = 'UTF-8', $normalize = false) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Times-Bold 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_TimesBold extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Times-BoldItalic 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_TimesBoldItalic extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Times-Italic 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_TimesItalic extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font Times-Roman 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_TimesRoman extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @param string $encoding
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary($encoding = 'WinAnsi') {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

    }
}

namespace
{

    /**
     * Class representing the PDF standard font ZapfDingbats 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Standard_ZapfDingbats extends \SetaPDF_Core_Font_Standard
    {
        /**
         * Gets a default dictionary for this font.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function getDefaultDictionary() {}

        /**
         * Creates a font object of this font.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $baseEncoding
         * @param array $diffEncoding
         * @return SetaPDF_Core_Font_Standard
         */
        public static function create(\SetaPDF_Core_Document $document, $baseEncoding = null, $diffEncoding = [/** value is missing */]) {}

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Get the base encoding table.
         *
         * @return array
         */
        public function getBaseEncodingTable() {}

    }
}

namespace
{

    /**
     * A class representing a subtable "Format 0: Byte encoding table".
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_ByteEncoding extends \SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable
    {
        /**
         * Flag specifying that the table data were read
         *
         * @var bool
         */
        protected $_tableRead = false;

        /**
         * Chars to glyph array
         *
         * @var array
         */
        protected $_charsToGlyphs = [/** value is missing */];

        /**
         * Release memory
         */
        public function cleanUp() {}

        /**
         * Get the glyph index by a character code.
         *
         * @param integer $charCode
         * @return integer
         */
        public function getGlyphIndex($charCode) {}

        /**
         * Read the subtable data.
         */
        protected function _readTable() {}

    }
}

namespace
{

    /**
     * A class representing a subtable "Format 4: Segment mapping to delta values".
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SegmentToDelta extends \SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable
    {
        /**
         * Flag specifying that the table data were read
         *
         * @var bool
         */
        protected $_tableRead = false;

        /**
         * The entries of this subtable
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * The segments
         *
         * @var array
         */
        protected $_segments = [/** value is missing */];

        /**
         * The end codes
         *
         * @var array
         */
        protected $_endCodes = [/** value is missing */];

        /**
         * The start codes
         *
         * @var array
         */
        protected $_startCodes = [/** value is missing */];

        /**
         * The id delta valuess
         *
         * @var array
         */
        protected $_idDeltas = [/** value is missing */];

        /**
         * The id range offsets
         *
         * @var array
         */
        protected $_idRangeOffsets = [/** value is missing */];

        /**
         * The range offset position
         *
         * @var integer
         */
        private $_rangeOffsetPosition;

        /**
         * The search range value
         *
         * @var integer
         */
        private $_searchRange;

        /**
         * The segment count
         *
         * @var integer
         */
        private $_segmentCount;

        /**
         * The search iteration count
         *
         * @var integer
         */
        private $_searchIterations;

        /**
         * Release memory.
         */
        public function cleanUp() {}

        /**
         * Get the doubled segmentation count.
         *
         * @return integer
         */
        public function getSegCountX2() {}

        /**
         * Get the search range value.
         *
         * @return integer
         */
        public function getSearchRange() {}

        /**
         * Get the entry selector value.
         *
         * @return integer
         */
        public function getEntrySelector() {}

        /**
         * Get the range shoft value.
         *
         * @return integer
         */
        public function getRangeShift() {}

        /**
         * Get the glyph index by a character code.
         *
         * @param integer $charCode
         * @return integer
         */
        public function getGlyphIndex($charCode) {}

        /**
         * Reads the table data.
         */
        protected function _readTable() {}

    }
}

namespace
{

    /**
     * A class representing a subtable "Format 12: Segmented coverage".
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SegmentedCoverage extends \SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable
    {
        /**
         * The entries of this subtable
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * The groups
         *
         * @var array
         */
        protected $_groups = [/** value is missing */];

        /**
         * Last groups accessed
         *
         * @var integer
         */
        protected $_lastGroup = 0;

        /**
         * Get the number of groups.
         *
         * @return integer
         */
        public function getNGroups() {}

        /**
         * Get the glyph index by a character code.
         *
         * @param integer $charCode
         * @return integer
         */
        public function getGlyphIndex($charCode) {}

    }
}

namespace
{

    /**
     * A class representing a subtable of a Character To Glyph Index Mapping Table.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The entries in this subtable
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the format of this subtable.
         *
         * @return integer
         */
        public function getFormat() {}

        /**
         * Get the length of this subtable.
         *
         * @return integer
         */
        public function getLength() {}

        /**
         * Get the language of this subtable.
         *
         * @return integer
         */
        public function getLanguage() {}

        /**
         * Get the glyph index by a character code.
         *
         * @param integer $charCode
         * @return integer
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function getGlyphIndex($charCode) {}

    }
}

namespace
{

    /**
     * A class representing a subtable "Format 6: Trimmed table mapping".
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_Trimmed extends \SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable
    {
        /**
         * The entries in this subtable
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the first character code of subrange.
         *
         * @return integer
         */
        public function getFirstCode() {}

        /**
         * Get the number of character codes in subrange.
         *
         * @return integer
         */
        public function getEntryCount() {}

        /**
         * Get the glyph index by a character code.
         *
         * @param integer $charCode
         * @return integer
         */
        public function getGlyphIndex($charCode) {}

    }
}

namespace
{

    /**
     * A class representing a composite glyph description.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_GlyphData_Description_Composite
    {
        /**
         * @var int
         */
        const FLAG_ARG_1_AND_2_ARE_WORDS = 1;

        /**
         * @var int
         */
        const FLAG_ARGS_ARE_XY_VALUES = 2;

        /**
         * @var int
         */
        const FLAG_ROUND_XY_TO_GRID = 4;

        /**
         * @var int
         */
        const FLAG_WE_HAVE_A_SCALE = 8;

        /**
         * @var int
         */
        const FLAG_MORE_COMPONENTS = 32;

        /**
         * @var int
         */
        const FLAG_WE_HAVE_AN_X_AND_Y_SCALE = 64;

        const FLAG_WE_HAVE_A_TWO_BY_TWO = 128;

        const FLAG_WE_HAVE_INSTRUCTIONS = 256;

        const FLAG_USE_MY_METRICS = 512;

        const FLAG_OVERLAP_COMPOUND = 1024;

        const FLAG_SCALED_COMPONENT_OFFSET = 2048;

        const FLAG_UNSCALED_COMPONENT_OFFSET = 4096;

        /**
         * The glyph data table
         *
         * @var SetaPDF_Core_Font_TrueType_Table_GlyphData
         */
        protected $_glyphData;

        /**
         * Offset of this description
         *
         * @var integer
         */
        protected $_offset;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData
         * @param integer $offset
         */
        public function __construct(\SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData, $offset) {}

        /**
         * Release memory.
         */
        public function cleanUp() {}

        /**
         * Read a value for this description.
         *
         * @param integer $offset
         * @param string $method
         * @return integer|mixed
         */
        private function _read($offset, $method = 'readInt16') {}

        /**
         * Returns all glyph ids from the composite.
         *
         * @return int[]
         */
        public function getGlyphIds() {}

    }
}

namespace
{

    /**
     * A class representing a simple glyph description.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_GlyphData_Description_Simple
    {
        /**
         * The glyph data table
         *
         * @var SetaPDF_Core_Font_TrueType_Table_GlyphData
         */
        protected $_glyphData;

        /**
         * Offset of this description
         *
         * @var integer
         */
        protected $_offset;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData
         * @param integer $offset
         */
        public function __construct(\SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData, $offset) {}

        /**
         * Release memory.
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * A class representing a glyph.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_GlyphData_Glyph
    {
        /**
         * The glyph data table
         *
         * @var SetaPDF_Core_Font_TrueType_Table_GlyphData
         */
        protected $_glyphData;

        /**
         * Offset of this glyph
         *
         * @var integer
         */
        protected $_offset;

        /**
         * Length of this glyph
         *
         * @var integer
         */
        protected $_length;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData
         * @param integer $offset The byte offset position for this glyph
         * @param integer $length The byte length of this glyph
         */
        public function __construct(\SetaPDF_Core_Font_TrueType_Table_GlyphData $glyphData, $offset, $length) {}

        /**
         * Release memory.
         */
        public function cleanUp() {}

        /**
         * Get the byte length of this glyph.
         *
         * @return int
         */
        public function getLength() {}

        /**
         * Read a value for this glyph.
         *
         * @param integer $offset
         * @param string $method
         * @return integer|mixed
         */
        private function _read($offset, $method = 'readInt16') {}

        /**
         * Get the number of contours of this glyph.
         *
         * @return integer
         */
        public function getNumberOfContours() {}

        /**
         * Get the minimum x for coordinate data.
         *
         * @return integer
         */
        public function getXMin() {}

        /**
         * Get the minimum y for coordinate data.
         *
         * @return integer
         */
        public function getYMin() {}

        /**
         * Get the maximum x for coordinate data.
         *
         * @return integer
         */
        public function getXMax() {}

        /**
         * Get the maximum y for coordinate data.
         *
         * @return integer
         */
        public function getYMax() {}

        /**
         * Check if the glyph is a composite glyph.
         *
         * @return bool
         */
        public function isComposite() {}

        /**
         * Get the glyph description.
         *
         * @return SetaPDF_Core_Font_TrueType_Table_GlyphData_Description_Simple|SetaPDF_Core_Font_TrueType_Table_GlyphData_Description_Composite
         */
        public function getDescription() {}

    }
}

namespace
{

    /**
     * A class representing the Character To Glyph Index Mapping Table (cmapt) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'cmap';

        /**
         * Windows Platform
         *
         * @var integer
         */
        const PLATFORM_WINDOWS = 3;

        /**
         * Macintosh Platform
         *
         * @var integer
         */
        const PLATFORM_MAC = 1;

        /**
         * Unicode Platform
         *
         * @var integer
         */
        const PLATFORM_UNICODE = 0;

        /**
         * Custom Platform
         *
         * @var integer
         */
        const PLATFORM_CUSTOM = 4;

        /**
         * The entries in that table
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Records for the sub tables
         *
         * @var array
         */
        private $_subTableRecords = [/** value is missing */];

        /**
         * Release cylced references / memory.
         */
        public function cleanUp() {}

        /**
         * Get the table version.
         *
         * @return integer
         */
        public function getVersion() {}

        /**
         * Get the number of sub tables.
         *
         * @return integer
         */
        public function getNumTables() {}

        /**
         * Get information about available tables.
         *
         * @return array
         */
        public function getTableInformation() {}

        /**
         * Read sub table data.
         */
        private function _readSubTableData() {}

        /**
         * Checks if a sub table exists in this font.
         *
         * @param integer $platformId
         * @param integer $encodingId
         * @return bool
         */
        public function hasSubTable($platformId, $encodingId) {}

        /**
         * Get a sub table.
         *
         * @param integer $platformId
         * @param integer $encodingId
         * @return bool|SetaPDF_Core_Font_TrueType_Table_CharacterToGlyphIndexMapping_SubTable
         */
        public function getSubTable($platformId, $encodingId) {}

    }
}

namespace
{

    /**
     * A class representing the Control Value Table (cvt ) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_ControlValue extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'cvt ';

        /**
         * Get the entry count in this table.
         *
         * @return int
         */
        public function getCount() {}

        /**
         * Get a value from this table.
         *
         * @param integer $index
         * @return integer
         */
        public function getValue($index) {}

    }
}

namespace
{

    /**
     * A class representing the  Control Value Program Table (prep) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_ControlValueProgram extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'prep';

    }
}

namespace
{

    /**
     * A class representing the Font Program Table (fpgn) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_FontProgram extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'fpgm';

    }
}

namespace
{

    /**
     * A class representing the Glyf Data Table (glyf) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_GlyphData extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'glyf';

        /**
         * Get a single glyph instance.
         *
         * @param $glyphId
         * @return bool|SetaPDF_Core_Font_TrueType_Table_GlyphData_Glyph
         */
        public function getGlyph($glyphId) {}

    }
}

namespace
{

    /**
     * A class representing the Font Header Table (head) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_Header extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'head';

        /**
         * Mac style ids.
         *
         * @integer
         */
        const MAC_STYLE_BOLD = 1;

        const MAC_STYLE_ITALIC = 2;

        const MAC_STYLE_UNDERLINE = 4;

        const MAC_STYLE_OUTLINE = 8;

        const MAC_STYLE_SHADOW = 16;

        const MAC_STYLE_CONDENSED = 32;

        const MAC_STYLE_EXTENDED = 64;

        /**
         * The entries of this table.
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the version (major.minor)
         *
         * @return float
         */
        public function getVersion() {}

        /**
         * Get the fint revision.
         *
         * @return float
         */
        public function getRevision() {}

        /**
         * Get the check sum adjustment.
         *
         * @return integer
         */
        public function getCheckSumAdjustment() {}

        /**
         * Get the magic number.
         *
         * @return integer
         */
        public function getMagicNumber() {}

        /**
         * Get the font flags.
         *
         * @return integer
         */
        public function getFlags() {}

        /**
         * Get the units per em value.
         *
         * @return integer
         */
        public function getUnitsPerEm() {}

        /**
         * Get the number of seconds since 12:00 midnight that started January 1st 1904 in GMT/UTC time zone when the font was created.
         *
         * @return string The raw data representing the LONGDATETIME data type.
         */
        public function getCreated() {}

        /**
         * Get the number of seconds since 12:00 midnight that started January 1st 1904 in GMT/UTC time zone when the font was modifed.
         *
         * @return string The raw data representing the LONGDATETIME data type.
         */
        public function getModified() {}

        /**
         * Get the x-min value for all glyph bounding boxes.
         *
         * @return integer
         */
        public function getXMin() {}

        /**
         * Get the y-min value for all glyph bounding boxes.
         *
         * @return integer
         */
        public function getYMin() {}

        /**
         * Get the x-max value for all glyph bounding boxes.
         *
         * @return integer
         */
        public function getXMax() {}

        /**
         * Get the y-max value for all glyph bounding boxes.
         *
         * @return integer
         */
        public function getYMax() {}

        /**
         * Get the bounding box.
         *
         * @param boolean $recalc
         * @return array
         */
        public function getBoundingBox($recalc = false) {}

        /**
         * Get the MacStyle
         *
         * Bit 0: Bold (if set to 1);
         * Bit 1: Italic (if set to 1)
         * Bit 2: Underline (if set to 1)
         * Bit 3: Outline (if set to 1)
         * Bit 4: Shadow (if set to 1)
         * Bit 5: Condensed (if set to 1)
         * Bit 6: Extended (if set to 1)
         * Bits 7-15: Reserved (set to 0).
         *
         * @return integer
         */
        public function getMacStyle() {}

        /**
         * Checks whether a mac style is set or not.
         *
         * @param integer $style
         * @return boolean
         */
        public function hasMacStyle($style) {}

        /**
         * Get the smallest readable size in pixels.
         *
         * @return integer
         */
        public function getLowestRecPPEM() {}

        /**
         * Get the font direction hint (deprecated).
         *
         * @return integer
         */
        public function getFontDirectionHint() {}

        /**
         * Get index to location format.
         *
         * @return integer 0 for short offsets, 1 for long.
         */
        public function getIndexToLocFormat() {}

        /**
         * Get glyph data format.
         *
         * @return integer
         */
        public function getGlyphDataFormat() {}

    }
}

namespace
{

    /**
     * A class representing the Horizontal Header Table (hhea) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_HorizontalHeader extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'hhea';

        /**
         * The entries of this table.
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the major version number of this table.
         *
         * @return integer
         */
        public function getMajorVersion() {}

        /**
         * Get the minor version number of this table.
         *
         * @return integer
         */
        public function getMinorVersion() {}

        /**
         * Get the typographic ascent.
         *
         * @return integer
         */
        public function getAscender() {}

        /**
         * Get the typographic descent.
         *
         * @return integer
         */
        public function getDescender() {}

        /**
         * Get the typographic line gap.
         *
         * @return integer
         */
        public function getLineGap() {}

        /**
         * Get the maximum advance width value in 'hmtx' table.
         *
         * @return integer
         */
        public function getAdvanceWidthMax() {}

        /**
         * Get the minimum left sidebearing value in 'hmtx' table.
         *
         * @return integer
         */
        public function getMinLeftSideBearing() {}

        /**
         * Get the minimum right sidebearing value.
         *
         * @return integer
         */
        public function getMinRightSideBearing() {}

        /**
         * Get the maximum right sidebearing value.
         *
         * @return integer
         */
        public function getXMaxExtent() {}

        /**
         * Get the caret slope rise value.
         *
         * @return integer
         */
        public function getCaretSlopeRise() {}

        /**
         * Get the caret slope run value.
         *
         * @return integer
         */
        public function getCaretSlopeRun() {}

        /**
         * Get the amount by which a slanted highlight on a glyph needs to be shifted to produce the best appearance.
         *
         * @return integer
         */
        public function getCaretOffset() {}

        /**
         * Get the metric format.
         *
         * @return integer
         */
        public function getMetricDataFormat() {}

        /**
         * Get the number of hMetric entries in 'hmtx' table.
         *
         * @return integer
         */
        public function getNumberOfHMetrics() {}

    }
}

namespace
{

    /**
     * A class representing the Horizontal Metrics Table (hmtx) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_HorizontalMetrics extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'hmtx';

        /**
         * Ensures the metrics of a specific glyph.
         *
         * @param integer $glyphId
         */
        protected function _ensureHMetrics($glyphId) {}

        /**
         * Get the advance width of a specific glyph.
         *
         * @param integer $glyphId
         * @return integer
         */
        public function getAdvanceWidth($glyphId) {}

        /**
         * Get the left side bearing of a specifc glyph.
         *
         * @param integer $glyphId
         * @return integer
         */
        public function getLeftSideBearing($glyphId) {}

        /**
         * Get the number of metrics.
         *
         * @return integer
         */
        private function _getNumberOfMetrics() {}

    }
}

namespace
{

    /**
     * A class representing the Index to Location (loca) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_IndexToLocation extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'loca';

        /**
         * Get the offset location of a single glyph.
         *
         * @param integer $glyphId
         * @return integer
         */
        public function getLocation($glyphId) {}

        /**
         * Get offset locations of glyphs.
         *
         * @param integer[] $glyphIds
         * @return integer[]
         */
        public function getLocations(array $glyphIds) {}

    }
}

namespace
{

    /**
     * A class representing the Maximum Profile (maxp) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_MaximumProfile extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'maxp';

        /**
         * The entries of this table.
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the version.
         *
         * @return float
         */
        public function getVersion() {}

        /**
         * Get the number of glyphs in the font.
         *
         * @return integer
         */
        public function getNumGlyphs() {}

        /**
         * Get the maximum points in a non-composite glyph.
         *
         * @return integer
         */
        public function getMaxPoints() {}

        /**
         * Get the maximum contours in a non-composite glyph.
         *
         * @return integer
         */
        public function getMaxContours() {}

        /**
         * Get the maximum points in a composite glyph.
         *
         * @return integer
         */
        public function getMaxCompositePoints() {}

        /**
         * Get the maximum contours in a composite glyph.
         *
         * @return integer
         */
        public function getMaxCompositeContours() {}

        /**
         * Get wheter to use the twilight zone (Z0) or not.
         *
         * @return integer
         */
        public function getMaxZones() {}

        /**
         * Get the maximum points used in Z0.
         *
         * @return integer
         */
        public function getMaxTwilightPoints() {}

        /**
         * Get the number of Storage Area locations.
         *
         * @return integer
         */
        public function getMaxStorage() {}

        /**
         * Get the number of FDEFs.
         *
         * @return integer
         */
        public function getMaxFunctionDefs() {}

        /**
         * Get the number of IDEFs.
         *
         * @return integer
         */
        public function getMaxInstructionDefs() {}

        /**
         * Get the maximum stack depth.
         *
         * @return integer
         */
        public function getMaxStackElements() {}

        /**
         * Get the maximum byte count for glyph instructions.
         *
         * @return integer
         */
        public function getMaxSizeOfInstructions() {}

        /**
         * Get the maximum number of components referenced at “top level” for any composite glyph.
         *
         * @return integer
         */
        public function getMaxComponentElements() {}

        /**
         * Get the maximum levels of recursion.
         *
         * @return integer
         */
        public function getMaxComponentDepth() {}

    }
}

namespace
{

    /**
     * A class representing the Naming Table (name) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_Name extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'name';

        /**
         * Name IDs
         *
         * @var integer
         */
        const COPYRIGHT = 0;

        const FAMILY_NAME = 1;

        const SUBFAMILY_NAME = 2;

        const UID = 3;

        const FULL_FONT_NAME = 4;

        const VERSION = 5;

        const POSTSCRIPT_NAME = 6;

        const TRADEMARK = 7;

        const MANUFACTURER_NAME = 8;

        const DESIGNER = 9;

        const DESCRIPTION = 10;

        const VENDOR_URL = 11;

        const DESIGNER_URL = 12;

        const LICENSE_DESCRIPTION = 13;

        const LICENSE_INFO_URL = 14;

        const TYPOGRAPHIC_FAMILY_NAME = 16;

        const TYPOGRAPHIC_SUBFAMILY_NAME = 17;

        const COMPATIBLE_FULL = 18;

        const SAMPLE_TEXT = 19;

        const POST_SCRIPT_CID_FINDFONT_NAME = 20;

        const WWS_FAMILY_NAME = 21;

        const WWS_SUBFAMILY_NAME = 22;

        const LIGHT_BACKGROUND_PALETTE = 23;

        const DARK_BACKGROUND_PALETTE = 24;

        const VARIATIONS_POST_SCRIPT_NAME_PREFIX = 25;

        /**
         * The table entries
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * The name records
         *
         * @var array
         */
        protected $_records = [/** value is missing */];

        /**
         * Flag specifying if the records are read or not.
         *
         * @var bool
         */
        protected $_recordsRead = false;

        /**
         * Get the format.
         *
         * @return integer
         */
        public function getFormat() {}

        /**
         * Get the number of name records.
         *
         * @return integer
         */
        public function getCount() {}

        /**
         * Get the offset to start of string storage (from start of table).
         *
         * @return integer
         */
        public function getStringOffset() {}

        /**
         * Checks wheter a name exists.
         *
         * @param integer $platformId
         * @param integer $encodingId
         * @param integer $languageId
         * @param integer $nameId
         * @return bool
         */
        public function hasName($platformId, $encodingId, $languageId, $nameId) {}

        /**
         * Get a name.
         *
         * @param integer $platformId
         * @param integer $encodingId
         * @param integer $languageId
         * @param integer $nameId
         * @return bool
         */
        public function getName($platformId, $encodingId, $languageId, $nameId) {}

        /**
         * Get all defined names.
         *
         * @return array A multi-dimensional array with the format $result[$platformId][$encodingId][$languageId][$nameId].
         */
        public function getAllNames() {}

        /**
         * Ensure that all records are read.
         */
        protected function _readRecords() {}

    }
}

namespace
{

    /**
     * A class representing the OS/2 and Windows Metrics Table (OS/2) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_Os2 extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'OS/2';

        /**
         * The entries in this table
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the OS/2 table version number.
         *
         * @return integer
         */
        public function getVersion() {}

        /**
         * Get the average weighted escapement.
         *
         * @return integer
         */
        public function getAvgCharWidth() {}

        /**
         * Get the weight class.
         *
         * @return integer
         */
        public function getWeightClass() {}

        /**
         * Get the width class.
         *
         * @return integer
         */
        public function getWidthClass() {}

        /**
         * Get the type flags.
         *
         * @return integer
         */
        public function getFsType() {}

        /**
         * Get the subscript horizontal font size.
         *
         * @return integer
         */
        public function getSubscriptXSize() {}

        /**
         * Get the subscript vertical font size.
         *
         * @return integer
         */
        public function getSubscriptYSize() {}

        /**
         * Get the subscript x offset.
         *
         * @return integer
         */
        public function getSubscriptXOffset() {}

        /**
         * Get the subscript y offset.
         *
         * @return integer
         */
        public function getSubscriptYOffset() {}

        /**
         * Get the superscript horizontal font size.
         *
         * @return integer
         */
        public function getSuperscriptXSize() {}

        /**
         * Get the superscript vertical font size.
         *
         * @return integer
         */
        public function getSuperscriptYSize() {}

        /**
         * Get the superscript x offset.
         *
         * @return integer
         */
        public function getSuperscriptXOffset() {}

        /**
         * Get the superscript y offset.
         *
         * @return integer
         */
        public function getSuperscriptYOffset() {}

        /**
         * Get the strikeout size.
         *
         * @return integer
         */
        public function getStrikeoutSize() {}

        /**
         * Get the strikeout position.
         *
         * @return integer
         */
        public function getStrikeoutPosition() {}

        /**
         * Get the font-family class and subclass.
         *
         * @return integer[]
         */
        public function getFamilyClass() {}

        /**
         * Get the PANOSE classification number.
         *
         * @return string
         */
        public function getPanose() {}

        /**
         * Get Unicode Character Range 1.
         *
         * @return integer
         */
        public function getUnicodeRange1() {}

        /**
         * Get Unicode Character Range 2.
         *
         * @return integer
         */
        public function getUnicodeRange2() {}

        /**
         * Get Unicode Character Range 3.
         *
         * @return integer
         */
        public function getUnicodeRange3() {}

        /**
         * Get Unicode Character Range 4.
         *
         * @return integer
         */
        public function getUnicodeRange4() {}

        /**
         * Get the Font Vendor Identification.
         *
         * @return string
         */
        public function getVendorId() {}

        /**
         * Get font selection flags.
         *
         * @return integer
         */
        public function getFsSelection() {}

        /**
         * Get the minimum Unicode index (character code) in this font.
         *
         * @return integer
         */
        public function getFirstCharIndex() {}

        /**
         * Get the maximum Unicode index (character code) in this font.
         *
         * @return integer
         */
        public function getLastCharIndex() {}

        /**
         * Get the typographic ascender for this font.
         *
         * @return integer
         */
        public function getTypoAscender() {}

        /**
         * Get the typographic descender for this font.
         *
         * @return integer
         */
        public function getTypoDescender() {}

        /**
         * Get the typographic line gap for this font.
         *
         * @return integer
         */
        public function getTypoLineGap() {}

        /**
         * Get the ascender metric for Windows.
         *
         * @return integer
         */
        public function getWinAscent() {}

        /**
         * Get the descender metric for Windows.
         *
         * @return integer
         */
        public function getWinDescent() {}

        /**
         * Get Code Page Character Range 1.
         *
         * @return integer
         */
        public function getCodePageRange1() {}

        /**
         * Get Code Page Character Range 2.
         *
         * @return integer
         */
        public function getCodePageRange2() {}

        /**
         * Get the distance between the baseline and the approximate height of non-ascending lowercase letters.
         *
         * @return integer
         */
        public function getXHeight() {}

        /**
         * Get the distance between the baseline and the approximate height of uppercase letters.
         *
         * @return integer
         */
        public function getCapHeight() {}

        /**
         * Get the default character code that should be used whenever a requested character is not in the font.
         *
         * @return integer
         */
        public function getDefaultChar() {}

        /**
         * Get the break character.
         *
         * @return integer
         */
        public function getBreakChar() {}

        /**
         * Get the maximum length of a target glyph context for any feature in this font.
         *
         * @return integer
         */
        public function getMaxContext() {}

        /**
         * Get the lower value of the size range for which this font has been designed.
         *
         * @return integer
         */
        public function getLowerOpticalPointSize() {}

        /**
         * Get the upper value of the size range for which this font has been designed.
         *
         * @return integer
         */
        public function getUpperOpticalPointSize() {}

    }
}

namespace
{

    /**
     * A class representing the PostScript Table (post) in a TrueType file.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_Post extends \SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The tag name of this class
         *
         * @var string
         */
        const TAG = 'post';

        /**
         * We only implement getters for default entries (for all versions, explicitly 1.0 and 3.0).
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get the version.
         *
         * @return float
         */
        public function getVersion() {}

        /**
         * Get the italic angle.
         *
         * Italic angle in counter-clockwise degrees from the vertical. Zero for upright text, negative for text that leans
         * to the right (forward).
         *
         * @return float|mixed|null
         */
        public function getItalicAngle() {}

        /**
         * Get the suggested distance of the top of the underline from the baseline.
         *
         * @return integer
         */
        public function getUnderlinePosition() {}

        /**
         * Get the suggested values for the underline thickness.
         *
         * @return integer
         */
        public function getUnderlineThickness() {}

        /**
         * Checks whether the font is proportionally or not proportionally spaced.
         *
         * @return integer 0 = proportionally, non-zeor = not proportionally
         */
        public function isFixedPitch() {}

        /**
         * Get the minimum memory usage when an OpenType font is downloaded.
         *
         * @return integer
         */
        public function getMinMemType42() {}

        /**
         * Get the maximum memory usage when an OpenType font is downloaded.
         *
         * @return integer
         */
        public function getMaxMemType42() {}

        /**
         * Get the minimum memory usage when an OpenType font is downloaded as a Type 1 font.
         *
         * @return integer
         */
        public function getMinMemType1() {}

        /**
         * Get the maximum memory usage when an OpenType font is downloaded as a Type 1 font.
         *
         * @return integer
         */
        public function getMaxMemType1() {}

    }
}

namespace
{

    /**
     * A record in a TrueType file
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_Table_Record
    {
        /**
         * The true type file
         *
         * @var SetaPDF_Core_Font_TrueType_File
         */
        protected $_file;

        /**
         * The offset of the table
         *
         * @var integer
         */
        protected $_offset;

        /**
         * The length of the table
         *
         * @var null|integer
         */
        protected $_length;

        /**
         * The class name representing this type of table
         *
         * @var null|string
         */
        protected $_className;

        /**
         * The table instance
         *
         * @var SetaPDF_Core_Font_TrueType_Table_TableInterface
         */
        protected $_table;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Font_TrueType_File $file
         * @param integer $offset
         * @param null|integer $length
         * @param null|string $className
         */
        public function __construct(\SetaPDF_Core_Font_TrueType_File $file, $offset, $length = null, $className = null) {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the TrueType file.
         *
         * @return SetaPDF_Core_Font_TrueType_File
         */
        public function getFile() {}

        /**
         * Get the table offset.
         *
         * @return int
         */
        public function getOffset() {}

        /**
         * Get the length of the table.
         *
         * @return int|null
         */
        public function getLength() {}

        /**
         * Get the class name for this type of table.
         *
         * @return null|string
         */
        public function getClassName() {}

        /**
         * Get the table instance for this record.
         *
         * @return SetaPDF_Core_Font_TrueType_Table_TableInterface
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function getTable() {}

    }
}

namespace
{

    /**
     * TrueType table interface
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Font_TrueType_Table_TableInterface
    {
    }
}

namespace
{

    /**
     * Abstract class representing TrueType table tags
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font_TrueType_Table_Tags
    {
        /**
         * Character to glyph mapping
         * @var string
         */
        const CMAP = 'cmap';

        /**
         * Font header
         * @var string
         */
        const HEADER = 'head';

        /**
         * Horizontal header
         * @var string
         */
        const HORIZONTAL_HEADER = 'hhea';

        /**
         * Horizontal metrics
         * @var string
         */
        const HORIZONTAL_METRICS = 'hmtx';

        /**
         * Maximum profile
         * @var string
         */
        const MAXIMUM_PROFILE = 'maxp';

        /**
         * Naming table
         * @var string
         */
        const NAME = 'name';

        /**
         * OS/2 and Windows specific metrics
         * @var string
         */
        const OS2 = 'OS/2';

        /**
         * PostScript information
         * @var string
         */
        const POST = 'post';

        /**
         * Control Value Table
         * @var string
         */
        const CVT = 'cvt ';

        /**
         * Font program
         * @var string
         */
        const FPGM = 'fpgm';

        /**
         * Glyph data
         * @var string
         */
        const GLYF = 'glyf';

        /**
         * Index to location
         * @var string
         */
        const LOCA = 'loca';

        /**
         * CVT Program
         * @var string
         */
        const PREP = 'prep';

        /**
         * Grid-fitting/Scan-conversion (optional table)
         * @var string
         */
        const GASP = 'gasp';

        /**
         * PostScript font program (compact font format)
         * @var string
         */
        const CFF = 'CFF ';

        /**
         * Vertical Origin (optional table)
         * @var string
         */
        const VORG = 'VORG';

        /**
         * The SVG (Scalable Vector Graphics) table
         * @var string
         */
        const SVG = 'SVG ';

        /**
         * Embedded bitmap data
         * @var string
         */
        const EBDT = 'EBDT';

        /**
         * Embedded bitmap location data
         * @var string
         */
        const EBLC = 'EBLC';

        /**
         * Embedded bitmap scaling data
         * @var string
         */
        const EBSC = 'EBSC';

        /**
         * Color bitmap data
         * @var string
         */
        const CBDT = 'CBDT';

        /**
         * Color bitmap location data
         * @var string
         */
        const CBLC = 'CBLC';

        /**
         * Baseline data
         * @var string
         */
        const BASE = 'BASE';

        /**
         * Glyph definition data
         * @var string
         */
        const GDEF = 'GDEF';

        /**
         * Glyph positioning data
         * @var string
         */
        const GPOS = 'GPOS';

        /**
         * Glyph substitution data
         * @var string
         */
        const GSUB = 'GSUB';

        /**
         * Justification data
         * @var string
         */
        const JSTF = 'JSTF';

        /**
         * Math layout data
         * @var string
         */
        const MATH = 'MATH';

        /**
         * Digital signature
         * @var string
         */
        const DSIG = 'DSIG';

        /**
         * Horizontal device metrics
         * @var string
         */
        const HDMX = 'hdmx';

        /**
         * Kerning
         * @var string
         */
        const KERN = 'kern';

        /**
         * Linear threshold data
         * @var string
         */
        const LTSH = 'LTSH';

        /**
         * PCL 5 data
         * @var string
         */
        const PCLT = 'PCLT';

        /**
         * Vertical device metrics
         * @var string
         */
        const VDMX = 'VDMX';

        /**
         * Vertical Metrics header
         * @var string
         */
        const VHEA = 'vhea';

        /**
         * Vertical Metrics
         * @var string
         */
        const VMTX = 'vmtx';

        /**
         * Color table
         * @var string
         */
        const COLR = 'COLR';

        /**
         * Color palette table
         * @var string
         */
        const CPAL = 'CPAL';

    }
}

namespace
{

    /**
     * Parser class for TTF/OTF files
     *
     * Based on the OpenType specification 1.6: {@link http://www.microsoft.com/typography/otspec/}
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType_File
    {
        /**
         * The reader instance
         *
         * @var SetaPDF_Core_Reader_Binary
         */
        protected $_reader;

        protected $_sfntVersion;

        protected $_numTables;

        protected $_searchRange;

        protected $_entrySelector;

        protected $_rangeShift;

        /**
         * Data of tables in the TTF file
         *
         * @var array
         */
        protected $_tableRecords = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Reader_Binary $reader
         * @throws SetaPDF_Core_Exception
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function __construct($reader) {}

        /**
         * Get the reader instance.
         *
         * @return SetaPDF_Core_Reader_Binary
         */
        public function getReader() {}

        /**
         * Release resources.
         */
        public function cleanUp() {}

        /**
         * Get the sfnt version.
         *
         * @return integer
         */
        public function getSfntVersion() {}

        /**
         * Get the number of tables.
         *
         * @return integer
         */
        public function getNumTables() {}

        /**
         * Get the search range value.
         *
         * @return integer
         */
        public function getSearchRange() {}

        /**
         * Get the entry selector value.
         *
         * @return integer
         */
        public function getEntrySelector() {}

        /**
         * Get the range shift value.
         *
         * @return integer
         */
        public function getRangeShift() {}

        /**
         * Check if a specific table exists.
         *
         * @param string $tag
         * @return boolean
         */
        public function tableExists($tag) {}

        /**
         * Get a tag specific table.
         *
         * @param string $tag
         * @return bool|SetaPDF_Core_Font_TrueType_Table_TableInterface
         */
        public function getTable($tag) {}

        /**
         * Get the units per em.
         *
         * @return float
         */
        protected function _getUnitsPerEm() {}

        /**
         * Get character/glyph width values.
         *
         * @param array $chars The chars in UTF-16BE encoding
         * @return array
         */
        public function getWidths(array $chars) {}

        /**
         * Get the width of a single character/glyph.
         *
         * @param string $char
         * @return float|boolean
         */
        public function getWidth($char) {}

        /**
         * Checks if characters are covered by this font.
         *
         * @param array $chars The chars in UTF-16BE encoding
         * @return boolean
         */
        public function areCharsCovered($chars) {}

        /**
         * Checks if a character is covered by this font.
         *
         * @param string $char The character in UTF-16BE encoding
         * @return boolean
         */
        public function isCharCovered($char) {}

        /**
         * Checks if a font is embeddable.
         *
         * @return boolean
         */
        public function isEmbeddable() {}

        /**
         * Set the file pointer to the start byte offset position of table.
         *
         * @param string $tag
         * @throws SetaPDF_Core_Exception
         */
        protected function _seekTable($tag) {}

    }
}

namespace
{

    /**
     * Abstract class for true type tables.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font_TrueType_Table
    {
        /**
         * The main table record.
         *
         * @var SetaPDF_Core_Font_TrueType_Table_Record
         */
        protected $_record;

        /**
         * Data of the table
         *
         * @var array
         */
        protected $_data = [/** value is missing */];

        /**
         * Raw binary data read from the file
         *
         * @var array
         */
        protected $_rawData = [/** value is missing */];

        /**
         * Configuration about table entries
         *
         * @var array
         */
        protected $_entries = [/** value is missing */];

        /**
         * Get a class name for a specific table by its tag name.
         *
         * @param $tag
         * @return string
         */
        public static function getClassName($tag) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Font_TrueType_Table_Record $record
         */
        public function __construct(\SetaPDF_Core_Font_TrueType_Table_Record $record) {}

        /**
         * Get the record object.
         *
         * @return SetaPDF_Core_Font_TrueType_Table_Record
         */
        public function getRecord() {}

        /**
         * Release memory.
         */
        public function cleanUp() {}

        /**
         * Get raw data from a specific table.
         *
         * The properties are defined in the $_entries property of an implemented table.
         *
         * @param $name
         * @return mixed|null
         */
        protected function _getRaw($name) {}

        /**
         * Get a value from the table.
         *
         * The properties are defined in the $_entries property of an implemented table.
         *
         * @param $name
         * @return integer|float|mixed|null
         */
        protected function _get($name) {}

    }
}

namespace
{

    /**
     * Abstract class representing a CID font
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font_Cid implements \SetaPDF_Core_Font_DescriptorInterface
    {
        /**
         * The indirect object of the CID font
         *
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectObject;

        /**
         * The dictionary of the CID font
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The font descriptor object
         *
         * @var SetaPDF_Core_Font_Descriptor
         */
        protected $_fontDescriptor;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Gets an indirect object for this font.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the font dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Get the Subtype entry of the font dictionary.
         *
         * @return mixed
         */
        public function getType() {}

        /**
         * Get the font name.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get an array with entries that define the character collection of the CIDFont.
         *
         * @return array
         */
        public function getCidSystemInfo() {}

        /**
         * Get the default width for glyphs in the CIDFont.
         *
         * @return string
         */
        public function getDefaultWidth() {}

        /**
         * Get the vertical metrics in the CIDFont.
         *
         * @return int[]
         */
        public function getVerticalMetrics() {}

        /**
         * Get the font descriptor object.
         *
         * @return SetaPDF_Core_Font_Descriptor
         */
        public function getFontDescriptor() {}

        /**
         * Get the width of a glyph/character.
         *
         * @param integer $cid
         * @return float|int
         */
        public function getGlyphWidth($cid) {}

    }
}

namespace
{

    /**
     * Class representing a Type 0 CID font
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_CidType0 extends \SetaPDF_Core_Font_Cid
    {
    }
}

namespace
{

    /**
     * Class representing a Type 2 CID font
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_CidType2 extends \SetaPDF_Core_Font_Cid
    {
        /**
         * Get the mapping from CIDs to glyph indices.
         *
         * @return string
         */
        public function getCidToGidMap() {}

    }
}

namespace
{

    /**
     * Class representing a CMAP.
     *
     * This class includes a very simple parser for CID data. The extracted data are limited
     * to unicode and cid mappings.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Cmap implements \SetaPDF_Core_Font_Cmap_CmapInterface
    {
        /**
         * Cache for named instances.
         *
         * @var array
         */
        public static $namedInstances = [/** value is missing */];

        /**
         * Code space ranges.
         *
         * @var array
         */
        protected $_codeSpaceRanges = [/** value is missing */];

        /**
         * CID and uncidoe mappings.
         *
         * @var array
         */
        protected $_mappings = [/** value is missing */];

        /**
         * The name resolved from the CMAP file.
         *
         * @var string
         */
        protected $_name;

        /**
         * A separate CMAP instance of only CID mappings.
         *
         * @var SetaPDF_Core_Font_Cmap
         */
        protected $_cidMap;

        /**
         * Resolved data for an optimization of a reverse lookup.
         *
         * @var array
         */
        protected $_lookUps = [/** value is missing */];

        /**
         * Creates an instance of an existing CMAP.
         *
         * Existing CMAPs can be found in /SetaPDF/Font/Cmap/_cmaps/.
         * A named instance will be cached. To remove it from memory you will need to call
         * SetaPDF_Core_Font_Cmap::cleanUpNamedInstanceCache().
         *
         * @param $name
         * @param bool $cache
         *
         * @return mixed|null|SetaPDF_Core_Font_Cmap
         */
        public static function createNamed($name, $cache = false) {}

        /**
         * Remove named cmap instances from the local cache.
         *
         * @param string|null $name The name or null for all cached instances
         */
        public static function cleanUpNamedInstanceCache($name = null) {}

        /**
         * Create an instance based on CMAP data through an reader instance.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         * @return null|SetaPDF_Core_Font_Cmap
         */
        public static function create(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Helper method that ensures an instance of self.
         * 
         * @param mixed $cmap
         * @throws SetaPDF_Core_Font_Exception
         */
        protected static function _ensureCMapInstance(&$cmap) {}

        /**
         * Read the next value via the tokenizer instance.
         *
         * @param SetaPDF_Core_Tokenizer $tokenizer
         * @return array|string
         */
        protected static function _readValue(\SetaPDF_Core_Tokenizer $tokenizer) {}

        /**
         * Add a codespace range.
         *
         * @param string $start
         * @param string $end
         */
        public function addCodeSpaceRange($start, $end) {}

        /**
         * Add a single mapping.
         *
         * @param string $src
         * @param string $dst
         */
        public function addSingleMapping($src, $dst) {}

        /**
         * Add a range mapping.
         *
         * @param integer $src1
         * @param integer $src2
         * @param string $dst
         * @param integer $size
         */
        public function addRangeMapping($src1, $src2, $dst, $size) {}

        /**
         * Add a single cid mapping.
         *
         * @param string $src
         * @param string $dst
         */
        public function addCidSingleMapping($src, $dst) {}

        /**
         * Add a cid range mapping.
         *
         * @param integer $src1
         * @param integer $src2
         * @param string $dst
         * @param integer $size
         */
        public function addCidRangeMapping($src1, $src2, $dst, $size) {}

        /**
         * Set the CID map instance.
         *
         * @param SetaPDF_Core_Font_Cmap $cidMap
         */
        public function setCidMap(\SetaPDF_Core_Font_Cmap $cidMap) {}

        /**
         * Get the separate CID Map.
         *
         * @return SetaPDF_Core_Font_Cmap
         */
        public function getCidMap() {}

        /**
         * Lookup by a type.
         *
         * @param string $type
         * @param string $src
         * @return bool|number|string
         */
        protected function _lookup($type, $src) {}

        /**
         * Do a reverse lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseLookup($dest) {}

        /**
         * Do a reverse CID lookup.
         *
         * @param string $dest
         * @return bool|mixed
         */
        public function reverseCidLoopkup($dest) {}

        /**
         * Do a reverse lookup by a specific type.
         *
         * @param string $dest
         * @param string $type
         * @return bool|number|string
         */
        protected function _reverseLookup($dest, $type) {}

        /**
         * Lookup a unicode value.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookup($src) {}

        /**
         * Lookup for a CID.
         *
         * @param string $src
         * @return bool|number|string
         */
        public function lookupCid($src) {}

        /**
         * Get the name of the CID map.
         *
         * @return string
         */
        public function getName() {}

    }
}

namespace
{

    /**
     * Class representing a font descriptor
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Descriptor
    {
        /**
         * The dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         * @throws InvalidArgumentException
         * @throws SetaPDF_Core_Font_Exception
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Get the font descriptor dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Helper method to get values from a font descriptor.
         *
         * @param string $key
         * @param null|mixed $default
         * @return mixed|null
         * @throws SetaPDF_Core_Font_Exception
         */
        private function _get($key, $default = null) {}

        /**
         * Get the PostScript name of the font.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get the preferred font family name.
         *
         * @return string|false
         */
        public function getFontFamily() {}

        /**
         * Get the font stretch value.
         *
         * @return string|false
         */
        public function getFontStretch() {}

        /**
         * Get the weight (thickness) component of the fully-qualified font name or font specifier.
         *
         * @return number|false
         */
        public function getFontWeight() {}

        /**
         * Get a collection of flags defining various characteristics of the font.
         *
         * @return int
         */
        public function getFlags() {}

        /**
         * Get a rectangle, expressed in the glyph coordinate system, that shall specify the font bounding box.
         *
         * @return array|false
         */
        public function getFontBBox() {}

        /**
         * Get the angle, expressed in degrees counterclockwise from the vertical, of the dominant vertical strokes of the font.
         *
         * @return number
         */
        public function getItalicAngle() {}

        /**
         * Get the maximum height above the baseline reached by glyphs in this font.
         *
         * @return number|false
         */
        public function getAscent() {}

        /**
         * Get the maximum depth below the baseline reached by glyphs in this font.
         *
         * @return number|false
         */
        public function getDescent() {}

        /**
         * Get the spacing between baselines of consecutive lines of text.
         *
         * @return number
         */
        public function getLeading() {}

        /**
         * Get the vertical coordinate of the top of flat capital letters, measured from the baseline.
         *
         * @return number|false
         */
        public function getCapHeight() {}

        /**
         * Get the font’s x height.
         *
         * The vertical coordinate of the top of flat nonascending lowercase letters (like the letter x), measured from the
         * baseline, in fonts that have Latin characters.
         *
         * @return number
         */
        public function getXHeight() {}

        /**
         * Get the thickness, measured horizontally, of the dominant vertical stems of glyphs in the font.
         *
         * @return number|false
         */
        public function getStemV() {}

        /**
         * Get the thickness, measured vertically, of the dominant horizontal stems of glyphs in the font.
         *
         * @return number
         */
        public function getStemH() {}

        /**
         * Get the average width of glyphs in the font.
         *
         * @return number
         */
        public function getAvgWidth() {}

        /**
         * Get the maximum width of glyphs in the font.
         *
         * @return number
         */
        public function getMaxWidth() {}

        /**
         * Get the  width to use for character codes whose widths are not specified in a font dictionary's Widths array.
         *
         * @return number
         */
        public function getMissingWidth() {}

        /**
         * Helper methid to get font file entries.
         *
         * @param string $key
         * @return false|SetaPDF_Core_Reader_Stream
         */
        private function _getFontFile($key) {}

        /**
         * Get a stream containing a Type 1 font program.
         *
         * @return false|SetaPDF_Core_Reader_Stream
         */
        public function getFontFile() {}

        /**
         * Get a stream containing a TrueType font program.
         *
         * @return false|SetaPDF_Core_Reader_Stream
         */
        public function getFontFile2() {}

        /**
         * Get a stream containing a font program whose format is specified by the Subtype entry in the stream dictionary.
         *
         * @return false|SetaPDF_Core_Reader_Stream
         */
        public function getFontFile3() {}

    }
}

namespace
{

    /**
     * Interface for fonts with a font descriptor.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
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
}

namespace
{

    /**
     * Font exception
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Class representing a MMType1 font.
     *
     * This class is only useable by existing MMType1 fonts.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_MMType1 extends \SetaPDF_Core_Font_Type1
    {
    }
}

namespace
{

    /**
     * Abstract class for simple fonts.
     *
     * 9.5 Introduction to Font Data Structures:
     * "[...]Type 0 fonts are called composite fonts; other types of fonts are called simple fonts.[...]"
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font_Simple extends \SetaPDF_Core_Font
    {
        /**
         * The encoding table
         *
         * @var array
         */
        protected $_encodingTable;

        /**
         * The map that maps character codes to uncidoe values
         *
         * @var array
         */
        protected $_toUnicodeTable;

        /**
         * The average width of glyphs in the font.
         *
         * @var integer|float
         */
        protected $_avgWidth;

        /**
         * Get the encoding table based on the Encoding dictionary and it's Differences entry (if available).
         *
         * @return array
         */
        protected function _getEncodingTable() {}

        /**
         * Sorts an array by shifting the array values to the top of the resulting array.
         *
         * @param $array
         * @return array
         */
        protected function _sortByArray($array) {}

        /**
         * Get the map that maps character codes to unicode values.
         *
         * @return SetaPDF_Core_Font_Cmap|array|false
         */
        protected function _getCharCodesTable() {}

        /**
         * Get the average glyph width.
         *
         * @param boolean $calculateIfUndefined
         * @return integer|float
         */
        public function getAvgWidth($calculateIfUndefined = false) {}

        /**
         * Resolves the width values from the font descriptor and fills the {@link $_width}-array.
         */
        abstract protected function _getWidths();

    }
}

namespace
{

    /**
     * Abstract class for standard PDF fonts
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font_Standard extends \SetaPDF_Core_Font_Simple
    {
        /**
         * The font name
         *
         * @var string
         */
        protected $_fontName;

        /**
         * The font family
         *
         * @var string
         */
        protected $_fontFamily;

        /**
         * The font bounding box
         *
         * @var array
         */
        protected $_fontBBox = [/** value is missing */];

        /**
         * The italic angle
         *
         * @var float
         */
        protected $_italicAngle = 0;

        /**
         * The distance from baseline of highest ascender (Typographic ascent)
         *
         * @return float
         */
        protected $_ascent = 0;

        /**
         * The distance from baseline of lowest descender (Typographic descent)
         *
         * @return float
         */
        protected $_descent = 0;

        /**
         * The vertical coordinate of the top of flat capital letters, measured from the baseline.
         *
         * @var float
         */
        protected $_capHeight = 0;

        /**
         * The vertical coordinate of the top of flat non-ascending lowercase letters (like the letter x), measured from the baseline
         *
         * @var float
         */
        protected $_xHeight = 0;

        /**
         * Flag indicating if this font is bold.
         *
         * @var boolean
         */
        protected $_isBold = false;

        /**
         * Flag indicating if this font is italic.
         *
         * @var boolean
         */
        protected $_isItalic = false;

        /**
         * Flag indicating if this font is monospace.
         *
         * @var boolean
         */
        protected $_isMonospace = false;

        /**
         * Glyph widths
         *
         * @var array
         */
        protected $_widths = [/** value is missing */];

        /**
         * Kerning pairs
         *
         * @var array
         */
        protected $_kerningPairs = [/** value is missing */];

        /**
         * The UTF-16BE unicode value for a substitute character
         *
         * @var null|string
         */
        protected $_substituteCharacter;

        /**
         * A cache of width values
         *
         * @var array
         */
        protected $_glyphsWidthCache = [/** value is missing */];

        /**
         * Helper method to get all available standard font names and their class mapping.
         *
         * @return array
         */
        public static function getStandardFontsToClasses() {}

        /**
         * Creates a difference array.
         *
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         * @param string $baseEncoding
         * @param array $diffEncoding
         */
        protected static function _createDifferenceArray(\SetaPDF_Core_Type_Dictionary $dictionary, $baseEncoding, array $diffEncoding) {}

        /**
         * Get the font name.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get the font family.
         *
         * @return string
         */
        public function getFontFamily() {}

        /**
         * Get the base encoding table.
         *
         * The base encoding of all Standard Fonts is StandardEncoding
         * but Symbol and ZapfDingbats. They use their own encoding.
         *
         * @see SetaPDF_Core_Encoding_Standard
         * @return array
         */
        public function getBaseEncodingTable() {}

        /**
         * Returns the font bounding box.
         *
         * @return array
         */
        public function getFontBBox() {}

        /**
         * Returns the distance from baseline of highest ascender (Typographic ascent).
         *
         * @return float
         */
        public function getAscent() {}

        /**
         * Returns the distance from baseline of lowest descender (Typographic descent).
         *
         * @return float
         */
        public function getDescent() {}

        /**
         * Get the vertical coordinate of the top of flat capital letters, measured from the baseline.
         *
         * @return float
         */
        public function getCapHeight() {}

        /**
         * Get the vertical coordinate of the top of flat non-ascending lowercase letters
         * (like the letter x), measured from the baseline.
         *
         * @return float
         */
        public function getXHeight() {}

        /**
         * Returns the italic angle.
         *
         * @return float
         */
        public function getItalicAngle() {}

        /**
         * Checks if the font is bold.
         *
         * @return boolean
         */
        public function isBold() {}

        /**
         * Checks if the font is italic.
         *
         * @return boolean
         */
        public function isItalic() {}

        /**
         * Checks if the font is monospace.
         *
         * @return boolean
         */
        public function isMonospace() {}

        /**
         * Get the width of a glpyh by its char code.
         *
         * @param string $charCode
         * @return float|int
         */
        public function getGlyphWidthByCharCode($charCode) {}

        /**
         * Resolves the width values from the font descriptor and fills the {@link $_width}-array.
         */
        protected function _getWidths() {}

    }
}

namespace
{

    /**
     * Class for TrueType fonts
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_TrueType extends \SetaPDF_Core_Font_Type1
    {
        /**
         * A cache for font descriptor objects.
         *
         * @var array
         */
        protected static $_fontDescriptors = [/** value is missing */];

        /**
         * The TTF/OTF parser
         *
         * @var SetaPDF_Core_Font_TrueType_File
         */
        protected $_ttfParser;

        /**
         * Flag for handling automatic encoding
         *
         * @var boolean
         */
        protected $_autoEncoding = false;

        /**
         * A temporary encoding table holding used character codes
         *
         * This array is only used if the _autoEncoding property is used.
         *
         * @var array
         */
        protected $_tmpEncodingTable = [/** value is missing */];

        /**
         * The Calcilated font bounding box.
         *
         * @var array
         */
        protected $_calcedFontBBox;

        /**
         * The TTF/OTF parser of the embedded font file.
         *
         * @var SetaPDF_Core_Font_TrueType_File
         */
        protected $_streamParser;

        /**
         * Creates a font object based on a TrueType font file.
         *
         * @param SetaPDF_Core_Document $document The document instance in which the font will be used
         * @param string $fontFile A path to the TTF font file
         * @param string $baseEncoding The base encoding
         * @param array|string $diffEncoding A translation table to adjust individual char codes to different glyphs or
         *                                   "auto" to build this table dynamically.
         * @param boolean $embedded Defines if the font program will be embedded in the document or not
         * @param bool $forceLicenseRestrictions Could be used to disable the font license check
         * @return SetaPDF_Core_Font_TrueType The SetaPDF_Core_Font_TrueType instance
         * @throws SetaPDF_Core_Font_Exception
         */
        public static function create(\SetaPDF_Core_Document $document, $fontFile, $baseEncoding = \SetaPDF_Core_Encoding::WIN_ANSI, $diffEncoding = [/** value is missing */], $embedded = true, $forceLicenseRestrictions = false) {}

        /**
         * Creates a standard /ToUnicode stream for TrueType fonts.
         *
         * Actually it writes only a single range. Gaps will be closed by the replacement character (U+FFFD).
         *
         * @param array $chars
         * @return string
         */
        protected static function _createToUnicodeStream($chars) {}

        /**
         * Get the glyph width.
         *
         * This method is a proxy method if the width-array is not initialized and
         * the font is build from a TTF font.
         *
         * @see SetaPDF_Core_Font_Type1::getGlyphWidth()
         * @param string $char
         * @param string $encoding The input encoding
         * @return float|int
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the final character code of a single character.
         *
         * If the font is based on a TTF file and the $diffEncoding is set to 'auto'
         * this method will build the differences from the encoding automatically.
         * It will simply recreate a completely new encoding starting at 0.
         *
         * @param string $char The character
         * @param string $encoding
         * @return string
         * @throws SetaPDF_Core_Font_Exception
         */
        public function getCharCode($char, $encoding = 'UTF-16BE') {}

        /**
         * A callback function which will update font data before it is written to the final PDF file.
         *
         * This method should not be called manually. It is registered as a callback of the
         * font object, which was created in the create()-method.
         */
        public function updateAutoEncoding() {}

        /**
         * A function which will create the current ToUnicode CMap.
         */
        protected function _updateToUnicodeStream() {}

        /**
         * Get the base encoding for a TrueType font.
         *
         * See PDF 32000-1:2008 - 9.6.6.4 Encodings for TrueType Fonts:
         * "[...]A nonsymbolic font should specify MacRomanEncoding or WinAnsiEncoding as the
         * value of its Encoding entry, with no Differences array[...]"
         *
         * @return array
         */
        public function getBaseEncodingTable() {}

        /**
         * Returns the font bounding box.
         *
         * @param boolean $recalc Set to true, to re-calculate the font bounding box by analysing the metrics of all
         *                        embedded glyphs.
         * @return array
         */
        public function getFontBBox($recalc = false) {}

        /**
         * Get the TTF/OTF parser for the embedded font programm.
         *
         * @return bool|SetaPDF_Core_Font_TrueType_File
         */
        public function getStreamParser() {}

    }
}

namespace
{

    /**
     * Class for Type0 fonts
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Type0 extends \SetaPDF_Core_Font implements \SetaPDF_Core_Font_DescriptorInterface
    {
        /**
         * @var SetaPDF_Core_Font_Descriptor
         */
        protected $_fontDescriptor;

        /**
         * @var SetaPDF_Core_Font_Cmap_CmapInterface
         */
        protected $_toUnicodeTable;

        /**
         * @var SetaPDF_Core_Font_Cmap
         */
        protected $_encodingTable;

        /**
         * Cache for width values
         *
         * @var array
         */
        protected $_widths = [/** value is missing */];

        /**
         * Cache array for the splitCharCodes method.
         *
         * @var array
         */
        protected $_splitCharCodesCache = [/** value is missing */];

        /**
         * The average width of glyphs in the font.
         *
         * @var integer|float
         */
        protected $_avgWidth;

        /**
         * The Calcilated font bounding box.
         *
         * @var array
         */
        protected $_calcedFontBBox;

        /**
         * The TTF/OTF parser of the embedded font file.
         *
         * @var SetaPDF_Core_Font_TrueType_File
         */
        protected $_streamParser;

        /**
         * Get the descandant font dictionary.
         *
         * In PDF there's only a single descendant font.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        protected function _getDescendantFontDictionary() {}

        /**
         * Get the descendant font.
         *
         * @return SetaPDF_Core_Font_Cid
         */
        public function getDescendantFont() {}

        /**
         * Get the font descriptor object.
         *
         * @return SetaPDF_Core_Font_Descriptor
         */
        public function getFontDescriptor() {}

        /**
         * Get the char codes table of this font.
         *
         * @return SetaPDF_Core_Font_Cmap_CmapInterface|boolean
         * @throws SetaPDF_Exception_NotImplemented
         * @internal
         */
        protected function _getCharCodesTable() {}

        /**
         * Get the CMaps table for this font.
         *
         * @return array|SetaPDF_Core_Font_Cmap
         */
        protected function _getEncodingTable() {}

        /**
         * Get the font name.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get the font family.
         *
         * @return string|null
         */
        public function getFontFamily() {}

        /**
         * Checks if the font is bold.
         *
         * @return boolean
         */
        public function isBold() {}

        /**
         * Checks if the font is italic.
         *
         * @return boolean
         */
        public function isItalic() {}

        /**
         * Checks if the font is monospace.
         *
         * @return boolean
         */
        public function isMonospace() {}

        /**
         * Returns the font bounding box.
         *
         * @param boolean $recalc Set to true, to re-calculate the font bounding box by analysing the metrics of all
         *                        embedded glyphs.
         * @return array
         */
        public function getFontBBox($recalc = false) {}

        /**
         * Get the TTF/OTF parser for the embedded font programm.
         *
         * @return bool|SetaPDF_Core_Font_TrueType_File
         */
        public function getStreamParser() {}

        /**
         * Returns the italic angle.
         *
         * @return float
         */
        public function getItalicAngle() {}

        /**
         * Returns the distance from baseline of highest ascender (Typographic ascent).
         *
         * @return float
         */
        public function getAscent() {}

        /**
         * Returns the distance from baseline of lowest descender (Typographic descent).
         *
         * @return float
         * @throws SetaPDF_Exception_NotImplemented
         * @internal
         */
        public function getDescent() {}

        /**
         * Get the missing glyph width.
         *
         * @return integer|float
         */
        public function getMissingWidth() {}

        /**
         * Get the average glyph width.
         *
         * @param boolean $calculateIfUndefined
         * @return integer|float
         */
        public function getAvgWidth($calculateIfUndefined = false) {}

        /**
         * Get the max glyph width.
         *
         * @return integer|float
         */
        public function getMaxWidth() {}

        /**
         * Get the width of a glyph/character.
         *
         * @param string $char
         * @param string $encoding The input encoding
         * @return float|int
         * @throws SetaPDF_Exception_NotImplemented
         * @internal
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the width of a glpyh by its char code.
         *
         * @param string $charCode
         * @return float|int
         */
        public function getGlyphWidthByCharCode($charCode) {}

        /**
         * Get the width of glyphs by their char codes.
         *
         * @param string $charCodes
         * @return float|int
         */
        public function getGlyphsWidthByCharCodes($charCodes) {}

        /**
         * Converts char codes from the font specific encoding to another encoding.
         *
         * @param string $charCodes The char codes in the font specific encoding.
         * @param string $encoding The resulting encoding
         * @param bool $asArray
         * @return string|array
         */
        public function getCharsByCharCodes($charCodes, $encoding = 'UTF-8', $asArray = true) {}

        /**
         * Split a string of char codes into single char codes.
         *
         * @param string $charCodes
         * @return array
         */
        public function splitCharCodes($charCodes) {}

    }
}

namespace
{

    /**
     * Class for Type1 fonts
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Type1 extends \SetaPDF_Core_Font_Simple implements \SetaPDF_Core_Font_DescriptorInterface
    {
        /**
         * The font descriptor object
         *
         * @var SetaPDF_Core_Font_Descriptor
         */
        protected $_fontDescriptor;

        /**
         * Glyph widths
         *
         * @var array
         */
        protected $_widths;

        /**
         * The UTF-16BE unicode value for a substitute character
         *
         * @var null|string
         */
        protected $_substituteCharacter;

        /**
         * A cache of width values
         *
         * @var array
         */
        protected $_glyphsWidthCache = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         * @throws SetaPDF_Core_Font_Exception
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Get the font descriptor object.
         *
         * @return SetaPDF_Core_Font_Descriptor
         */
        public function getFontDescriptor() {}

        /**
         * Get the font name.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get the font family.
         *
         * @return string
         */
        public function getFontFamily() {}

        /**
         * Checks if the font is bold.
         *
         * @return boolean
         */
        public function isBold() {}

        /**
         * Checks if the font is italic.
         *
         * @return boolean
         */
        public function isItalic() {}

        /**
         * Checks if the font is monospace.
         *
         * @return boolean
         */
        public function isMonospace() {}

        /**
         * Returns the font bounding box.
         *
         * @return array
         */
        public function getFontBBox() {}

        /**
         * Returns the italic angle.
         *
         * @return float
         */
        public function getItalicAngle() {}

        /**
         * Returns the distance from baseline of highest ascender (Typographic ascent).
         *
         * @return float
         */
        public function getAscent() {}

        /**
         * Returns the distance from baseline of lowest descender (Typographic descent).
         *
         * @return float
         */
        public function getDescent() {}

        /**
         * Get the average glyph width.
         *
         * @param boolean $calculateIfUndefined
         * @return integer|float
         */
        public function getAvgWidth($calculateIfUndefined = false) {}

        /**
         * Get the max glyph width.
         *
         * @return integer|float
         */
        public function getMaxWidth() {}

        /**
         * Get the missing glyph width.
         *
         * @return integer|float
         */
        public function getMissingWidth() {}

        /**
         * Resolves the width values from the font descriptor and fills the {@link $_width}-array.
         */
        protected function _getWidths() {}

        /**
         * Get the width of a glyph/character.
         *
         * @see SetaPDF_Core_Font::getGlyphWidth()
         * @param string $char
         * @param string $encoding The input encoding
         * @return float|int
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the width of a glpyh by its char code.
         *
         * @param string $charCode
         * @return float|int
         */
        public function getGlyphWidthByCharCode($charCode) {}

        /**
         * Get the base encoding of the font.
         *
         * If no BaseEncoding entry is available we use the
         * Standard encoding for now. This should be extended
         * to get the fonts build in encoding later.
         *
         * @return array
         */
        public function getBaseEncodingTable() {}

    }
}

namespace
{

    /**
     * Class representing a Type3 font.
     *
     * This class is only useable by existing MMType1 fonts.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Font_Type3 extends \SetaPDF_Core_Font
    {
        /**
         * The font name
         *
         * @var string
         */
        protected $_fontName;

        /**
         * The to unicode table.
         *
         * @var SetaPDF_Core_Font_Cmap
         */
        protected $_toUnicodeTable;

        /**
         * The encoding table.
         *
         * @var array
         */
        protected $_encodingTable;

        /**
         * Glyph widths
         *
         * @var array
         */
        protected $_widths;

        /**
         * The font bounding box
         *
         * @var array
         */
        protected $_fontBBox;

        /**
         * The average width of glyphs in the font.
         *
         * @var integer|float
         */
        protected $_avgWidth;

        /**
         * The font matrix
         *
         * @var SetaPDF_Core_Geometry_Matrix
         */
        protected $_fontMatrix;

        /**
         * The font descriptor object
         *
         * @var SetaPDF_Core_Font_Descriptor
         */
        protected $_fontDescriptor;

        /**
         * @return SetaPDF_Core_Font_Cmap|boolean
         * @throws SetaPDF_Exception_NotImplemented
         * @internal
         */
        protected function _getCharCodesTable() {}

        /**
         * Get the encoding table based on the Encoding dictionary and it's Differences entry (if available).
         *
         * @return array
         */
        protected function _getEncodingTable() {}

        /**
         * Get the font name.
         *
         * @return string
         */
        public function getFontName() {}

        /**
         * Get the font family.
         *
         * @return false A type 3 font does not have a font family.
         */
        public function getFontFamily() {}

        /**
         * Checks if the font is bold.
         *
         * @return boolean
         */
        public function isBold() {}

        /**
         * Checks if the font is italic.
         *
         * @return boolean
         */
        public function isItalic() {}

        /**
         * Checks if the font is monospace.
         *
         * @return boolean
         */
        public function isMonospace() {}

        /**
         * Get the font matrix.
         *
         * @return SetaPDF_Core_Geometry_Matrix
         * @throws SetaPDF_Core_Exception
         */
        public function getFontMatrix() {}

        /**
         * Returns the font bounding box.
         *
         * @param boolean $recalc Set to true, to re-calculate the font bounding box by analysing the metrics of all
         *                        embedded glyphs.
         * @return array
         * @throws SetaPDF_Core_Exception
         * @internal
         */
        public function getFontBBox($recalc = false) {}

        /**
         * Get the font descriptor object.
         *
         * @return SetaPDF_Core_Font_Descriptor
         */
        public function getFontDescriptor() {}

        /**
         * Returns the italic angle.
         *
         * @return float
         */
        public function getItalicAngle() {}

        /**
         * Returns the distance from baseline of highest ascender (Typographic ascent).
         *
         * @return float|false
         */
        public function getAscent() {}

        /**
         * Returns the distance from baseline of lowest descender (Typographic descent).
         *
         * @return float
         * @throws SetaPDF_Exception_NotImplemented
         * @internal
         */
        public function getDescent() {}

        /**
         * Get the average glyph width.
         *
         * @param boolean $calculateIfUndefined
         * @return integer|float
         */
        public function getAvgWidth($calculateIfUndefined = false) {}

        /**
         * Get the max. glyph width.
         *
         * @return integer|float
         */
        public function getMaxWidth() {}

        /**
         * Get the missing glyph width.
         *
         * @return integer|float
         */
        public function getMissingWidth() {}

        /**
         * Resolves the width values from the font descriptor and fills the {@link $_width}-array.
         */
        protected function _getWidths() {}

        /**
         * Get the width of a glyph/character.
         *
         * @see SetaPDF_Core_Font::getGlyphWidth()
         * @param string $char
         * @param string $encoding The input encoding
         * @return float|int
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the width of a glpyh by its char code.
         *
         * @param string $charCode
         * @return float|int
         */
        public function getGlyphWidthByCharCode($charCode) {}

        /**
         * Converts char codes from the font specific encoding to another encoding.
         *
         * @param string $charCodes The char codes in the font specific encoding.
         * @param string $encoding The resulting encoding
         * @param bool $asArray
         * @return string|array
         */
        public function getCharsByCharCodes($charCodes, $encoding = 'UTF-8', $asArray = true) {}

        /**
         * Get the base encoding of the font.
         *
         * If no BaseEncoding entry is available we use the
         * Standard encoding for now. This should be extended
         * to get the fonts build in encoding later.
         *
         * @return array
         */
        public function getBaseEncodingTable() {}

    }
}

namespace
{

    /**
     * Interface to check for collisions between geometries
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Geometry
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Geometry_Collidable
    {
        /**
         * Checks if this geometry collides with another geometry.
         *
         * @param SetaPDF_Core_Geometry_Collidable $geometry
         * @return bool
         */
        public function collides(\SetaPDF_Core_Geometry_Collidable $geometry);

    }
}

namespace
{

    /**
     * Class representing a transformation matrix of six elements.
     *
     * Internally the matrix is represented as a 3x3 matrix.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Geometry
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Geometry_Matrix
    {
        /**
         * Matrix value a
         *
         * @var float|int
         */
        protected $_a = 1;

        /**
         * Matrix value b
         *
         * @var float|int
         */
        protected $_b = 0;

        /**
         * Matrix value c
         *
         * @var float|int
         */
        protected $_c = 0;

        /**
         * Matrix value d
         *
         * @var float|int
         */
        protected $_d = 1;

        /**
         * Matrix value e
         *
         * @var float|int
         */
        protected $_e = 0;

        /**
         * Matrix value f
         *
         * @var float|int
         */
        protected $_f = 0;

        /**
         * The constructor.
         *
         * @param int|array $a
         * @param int $b
         * @param int $c
         * @param int $d
         * @param int $e
         * @param int $f
         */
        public function __construct($a = 1, $b = 0, $c = 0, $d = 1, $e = 0, $f = 0) {}

        /**
         * Get the value of element A.
         *
         * @return mixed
         */
        public function getA() {}

        /**
         * Get the value of element B.
         *
         * @return mixed
         */
        public function getB() {}

        /**
         * Get the value of element C.
         *
         * @return mixed
         */
        public function getC() {}

        /**
         * Get the value of element D.
         *
         * @return mixed
         */
        public function getD() {}

        /**
         * Get the value of element E.
         *
         * @return mixed
         */
        public function getE() {}

        /**
         * Get the value of element F.
         *
         * @return mixed
         */
        public function getF() {}

        /**
         * Get all matrix elements values.
         *
         * @return array
         */
        public function getValues() {}

        /**
         * Multiply the matrix by another matrix.
         *
         * @param SetaPDF_Core_Geometry_Matrix $by
         * @return SetaPDF_Core_Geometry_Matrix
         */
        public function multiply(\SetaPDF_Core_Geometry_Matrix $by) {}

    }
}

namespace
{

    /**
     * Class representing a point
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Geometry
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Geometry_Point implements \SetaPDF_Core_Geometry_Collidable
    {
        /**
         * The x coordinate value
         * 
         * @var float
         */
        protected $_x = 0;

        /**
         * The y coordinate value
         * 
         * @var float
         */
        protected $_y = 0;

        /**
         * The constructor.
         * 
         * @param float $x The x coordinate
         * @param float $y The y coordinate
         */
        public function __construct($x, $y) {}

        /**
         * Get the x coordinate value.
         * 
         * @return float
         */
        public function getX() {}

        /**
         * Set the x coordinate value.
         *
         * @param float $x The new x coordinate
         */
        public function setX($x) {}

        /**
         * Get the y coordinate value.
         *
         * @return float
         */
        public function getY() {}

        /**
         * Set the y coordinate value.
         *
         * @param float $y The new y coordinate
         */
        public function setY($y) {}

        /**
         * Compares a point against this one.
         * 
         * @param SetaPDF_Core_Geometry_Point $point Compare point
         * @return boolean
         */
        public function isEqual(\SetaPDF_Core_Geometry_Point $point) {}

        /**
         * @inheritdoc
         */
        public function collides(\SetaPDF_Core_Geometry_Collidable $geometry) {}

    }
}

namespace
{

    /**
     * Class representing a rectangle
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Geometry
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Geometry_Rectangle implements \SetaPDF_Core_Geometry_Collidable
    {
        /**
         * ll => lower left
         * ur => upper right
         *
         * @var float
         */
        private $_llX;

        /**
         * ll => lower left
         * ur => upper right
         *
         * @var float
         */
        private $_llY;

        /**
         * ll => lower left
         * ur => upper right
         *
         * @var float
         */
        private $_urX;

        /**
         * ll => lower left
         * ur => upper right
         *
         * @var float
         */
        private $_urY;

        /**
         * The constructor.
         *
         * There three ways to create a rectangle:
         *
         * <code>
         * - 2 params   SetaPDF_Core_Geometry_Point $a  point1
         *              SetaPDF_Core_Geometry_Point $b  point2
         *
         * - 3 params   SetaPDF_Core_Geometry_Point $a pointLL
         *              int|float $b width
         *              int|float $c height
         *
         * - 4 params   int|float $a x of point1
         *              int|float $b y of point1
         *              int|float $c x of point2
         *              int|float $d y of point2
         * </code>
         *
         * @param int|float|SetaPDF_Core_Geometry_Point $a point1 OR pointLL OR x of point1
         * @param int|float|SetaPDF_Core_Geometry_Point $b point2 OR width OR y of point1
         * @param int|float $c height OR x of point2
         * @param int|float $d none OR y of point2
         * @throws InvalidArgumentException
         */
        public function __construct($a, $b, $c = null, $d = null) {}

        /**
         * Reset the complete rectangle by using two opposite points of the new rectangle.
         *
         * @param int|float $x1
         * @param int|float $y1
         * @param int|float $x2
         * @param int|float $y2
         * @throws InvalidArgumentException
         */
        public function init($x1, $y1, $x2, $y2) {}

        /**
         * Set the height of the rectangle.
         *
         * The lower left point couldn't be moved by this method.
         *
         * @param int|float $height
         * @throws InvalidArgumentException
         */
        public function setHeight($height) {}

        /**
         * Set the width of the rectangle.
         *
         * The lower left point couldn't be moved by this method.
         *
         * @param int|float $width
         * @throws InvalidArgumentException
         */
        public function setWidth($width) {}

        /**
         * Set the width and the height of the rectangle.
         *
         * The lower left point couldn't be moved by this method.
         *
         * @param int|float $width
         * @param int|float $height
         * @throws InvalidArgumentException
         */
        public function setDimensions($width, $height) {}

        /**
         * Set the lower left point of the rectangle.
         *
         * If you don't move this point over the x of the lower right or the y of the upper left this point stay the lower left.
         *
         * If you move this point over only one of them, this point will replace them and the other point will be lower left.
         *
         * If you move this point over both(x and y), this point will be the new upper right and upper right the new lower left.
         *
         * @param int|float|SetaPDF_Core_Geometry_Point $a
         * @param int|float $b
         */
        public function setLl($a, $b = null) {}

        /**
         * Set the lower right point of the rectangle.
         *
         * @see setLl()
         * @param int|float|SetaPDF_Core_Geometry_Point $a
         * @param int|float $b
         */
        public function setLr($a, $b = null) {}

        /**
         * Set the upper left point of the rectangle.
         *
         * @see setLl()
         * @param int|float|SetaPDF_Core_Geometry_Point $a
         * @param int|float $b
         */
        public function setUl($a, $b = null) {}

        /**
         * Set the upper right point of the rectangle.
         *
         * @see setLl()
         * @param int|float|SetaPDF_Core_Geometry_Point $a
         * @param int|float $b
         */
        public function setUr($a, $b = null) {}

        /**
         * Returns the lower left point of the rectangle.
         *
         * Note: changing the returned point object don't changing the rectangle.
         *
         * @return SetaPDF_Core_Geometry_Point
         */
        public function getLl() {}

        /**
         * Returns the lower right point of the rectangle.
         *
         * Note: changing the returned point object don't changing the rectangle.
         *
         * @return SetaPDF_Core_Geometry_Point
         */
        public function getLr() {}

        /**
         * Returns the upper left point of the rectangle.
         *
         * Note: changing the returned point object don't changing the rectangle.
         *
         * @return SetaPDF_Core_Geometry_Point
         */
        public function getUl() {}

        /**
         * Returns the upper right point of the rectangle.
         *
         * Note: changing the returned point object don't changing the rectangle.
         *
         * @return SetaPDF_Core_Geometry_Point
         */
        public function getUr() {}

        /**
         * Returns the actual width of the rectangle.
         *
         * @return float
         */
        public function getWidth() {}

        /**
         * Returns the actual height of the rectangle.
         *
         * @return float
         */
        public function getHeight() {}

        /**
         * Returns the width and height of the rectangle.
         *
         * @return array
         */
        public function getDimensions() {}

        /**
         * Checks whether a point is inside or on the border of this rectangle.
         *
         * @param int|float $x
         * @param int|float $y
         * @param boolean $ignoreEqual If the point lays on the border and this is true false will returned
         * @return boolean
         */
        private function _pointInside($x, $y, $ignoreEqual = false) {}

        /**
         * Checks whether this rectangle contains another geometric object.
         *
         * @param SetaPDF_Core_Geometry_Point|SetaPDF_Core_Geometry_Rectangle $geometry
         * @return boolean
         * @throws InvalidArgumentException
         */
        public function contains($geometry) {}

        /**
         * Checks whether the geometry shape intersect this rectangle.
         *
         * @param SetaPDF_Core_Geometry_Rectangle $geometry
         * @return boolean
         * @throws InvalidArgumentException
         */
        public function intersect($geometry) {}

        /**
         * Scale the rectangle by a value into all directions.
         *
         * @param float $by
         * @return SetaPDF_Core_Geometry_Rectangle
         */
        public function scale($by) {}

        /**
         * Scales the rectangle by a value on the x directon.
         *
         * @param float $by
         * @return SetaPDF_Core_Geometry_Rectangle
         */
        public function scaleX($by) {}

        /**
         * Scales the rectangle by a value on the y directon.
         *
         * @param float $by
         * @return SetaPDF_Core_Geometry_Rectangle
         */
        public function scaleY($by) {}

        /**
         * @inheritdoc
         */
        public function collides(\SetaPDF_Core_Geometry_Collidable $geometry) {}

    }
}

namespace
{

    /**
     * Class representing a vecotr.
     *
     * Internally the matrix is represented as a 3x3 matrix.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Geometry
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Geometry_Vector
    {
        /**
         * The X value.
         *
         * @var float
         */
        protected $_x;

        /**
         * The Y value.
         *
         * @var float
         */
        protected $_y;

        /**
         * The Z value.
         *
         * @var float
         */
        protected $_z;

        /**
         * Creates an instance by an array.
         *
         * @param array $array
         * @return SetaPDF_Core_Geometry_Vector
         */
        public static function byArray(array $array) {}

        /**
         * Creates an instance by a point.
         *
         * @param SetaPDF_Core_Geometry_Point $point
         * @return SetaPDF_Core_Geometry_Vector
         */
        public static function byPoint(\SetaPDF_Core_Geometry_Point $point) {}

        /**
         * The constructor.
         *
         * @param integer|float $x
         * @param integer|float $y
         * @param integer|float $z
         */
        public function __construct($x = 0, $y = 0, $z = 0) {}

        /**
         * Get the value of X.
         *
         * @return float
         */
        public function getX() {}

        /**
         * Get the value of Y.
         *
         * @return float
         */
        public function getY() {}

        /**
         * Get the value of Z.
         *
         * @return float
         */
        public function getZ() {}

        /**
         * Add a vector to this vector and return the resulting vector.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function add(\SetaPDF_Core_Geometry_Vector $vector) {}

        /**
         * Subtract a vector from this vector and return the resulting vector.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function subtract(\SetaPDF_Core_Geometry_Vector $vector) {}

        /**
         * Multiply the vector with a float value or a matrix and return the resulting vector.
         *
         * @param float|integer|SetaPDF_Core_Geometry_Matrix $with
         * @return SetaPDF_Core_Geometry_Vector
         * @TODO Rewrite to 2 methods mulitply() and multiplyWithMatrix() with type hints.
         */
        public function multiply($with) {}

        /**
         * Devide the vector by a float value and return the resulting vector.
         *
         * @param float|integer $by
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function divide($by) {}

        /**
         * Compute the cross product of this and another vector and return the resulting vector.
         *
         * @param $with
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function cross($with) {}

        /**
         * Computes the scalar/dot/inner product of this and another vector.
         *
         * @param SetaPDF_Core_Geometry_Vector $with
         * @return float
         */
        public function scalar(\SetaPDF_Core_Geometry_Vector $with) {}

        /**
         * Normalize the vector.
         *
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function normalize() {}

        /**
         * Get the length of the vector.
         *
         * @return float
         */
        public function getLength() {}

        /**
         * Get the squared length of the vector.
         *
         * @return float
         */
        public function getLengthSquared() {}

        /**
         * Get all vector values.
         *
         * @return array
         */
        public function getValues() {}

        /**
         * @return SetaPDF_Core_Geometry_Point
         */
        public function toPoint() {}

    }
}

namespace
{

    /**
     * ICC profile parser
     *
     * This ICC profile parser is based on the specs ICC.1:2001-04 and ICC.1:2010.
     * The parser actually only offers an access to the header data and description tag.
     *
     * @see Spec ICC.1:2001-04
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_IccProfile_Parser
    {
        /**
         * The reader instance
         *
         * @var SetaPDF_Core_Reader_Binary
         */
        protected $_reader;

        /**
         * Information about tagged element data offset and size
         *
         * @var null|array
         */
        protected $_tagsData;

        /**
         * @var null|array
         */
        protected $_headerData;

        /**
         * @var null|array
         */
        protected $_descriptionData;

        /**
         * The constructor.
         *
         * @param string|SetaPDF_Core_Reader_Binary $reader
         * @throws SetaPDF_Core_Exception
         */
        public function __construct($reader) {}

        /**
         * Release resources.
         */
        public function cleanUp() {}

        /**
         * Get the reader instance.
         *
         * @return SetaPDF_Core_Reader_Binary
         */
        public function getReader() {}

        /**
         * Get all data resolved by the header description.
         *
         * @return array
         */
        public function getHeaderData() {}

        /**
         * Get the profile size.
         *
         * @see getHeaderData()
         * @return integer
         */
        public function getProfileSize() {}

        /**
         * Get preferred Color Management Module.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getPreferredCMM() {}

        /**
         * Get the profile version number.
         *
         * A 4 byte string:
         * Byte 0 = Major Revision in Binary-Coded Decimal
         * Byte 1 = Minor Revision & Bug Fix Revision in each nibble in Binary-Coded Decimal
         * Byte 2 + 3 = reserved, must be set to 0
         *
         * @see getHeaderData()
         * @param boolean $raw
         * @return string
         */
        public function getVersion($raw = false) {}

        /**
         * Get the Profile/Device Class signature.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getClass() {}

        /**
         * Get the color space signature or readable form.
         *
         * @see getHeaderData()
         * @param boolean $signature
         * @return string
         */
        public function getColorSpace($signature = false) {}

        /**
         * Get the Profile Connection Space signature.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getPCS() {}

        /**
         * Get the Primary Platform signature.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getPrimaryPlatform() {}

        /**
         * Get Profile flags.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getFlags() {}

        /**
         * Get the Device manufacturer of the device for which this profile is created.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getDeviceManufacturer() {}

        /**
         * Get the Device model of the device for which this profile is created.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getDeviceModel() {}

        /**
         * Get the Device attributes.
         *
         * @return string
         */
        public function getDeviceAttributes() {}

        /**
         * Get the Profile Creator signature.
         *
         * @see getHeaderData()
         * @return string
         */
        public function getCreator() {}

        /**
         * Get the number of components/channels.
         *
         * @see Spec ICC.1:2001-04 - Table 48
         * @return int
         */
        public function getNumberOfComponents() {}

        /**
         * Get description.
         *
         * If the profile is of version 4 a language and country code can be passed to
         * get a specific description entry.
         *
         * To get an overview of all resolved description data see {@link getDescriptionData()}.
         *
         * @see getDescriptionData()
         * @param string $encoding
         * @param null $languageCode
         * @param null $countryCode
         *
         * @return array|null|string
         */
        public function getDescription($encoding = 'UTF-8', $languageCode = null, $countryCode = null) {}

        /**
         * Get all resolved description data.
         *
         * @return array|null
         */
        public function getDescriptionData() {}

        /**
         * Parse the header data.
         *
         * @throws SetaPDF_Core_Exception
         */
        protected function _parseHeader() {}

        /**
         * Parse the tag table.
         */
        protected function _parseTagTable() {}

        /**
         * Parse the description tag.
         */
        protected function _parseDescTag() {}

    }
}

namespace
{

    /**
     * Class for handling a ICC profile stream
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_IccProfile_Stream
    {
        /**
         * The indirect object of this stream
         *
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectObject;

        /**
         * A ICC profile parser instance
         *
         * @var SetaPDF_Core_IccProfile_Parser
         */
        protected $_parser;

        /**
         * Creates an ICC profile stream.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Reader_Binary|string $iccProfile A path to a ICC profile or a reader object
         * @return SetaPDF_Core_IccProfile_Stream
         */
        public static function create(\SetaPDF_Core_Document $document, $iccProfile) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject
         * @throws InvalidArgumentException
         */
        public function __construct(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Release resources.
         */
        public function cleanUp() {}

        /**
         * Get the indirect object.
         *
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function getIndirectObject() {}

        /**
         * Get the stream object.
         *
         * @return SetaPDF_Core_Type_Stream
         */
        public function getStreamObject() {}

        /**
         * Get the stream dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        protected function _getDictionary() {}

        /**
         * Get the color component count.
         *
         * @return integer
         */
        public function getColorComponents() {}

        /**
         * Get the alternate color space.
         *
         * @return null|SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         */
        public function getAlternate() {}

        /**
         * Set the alternate color space.
         *
         * @param SetaPDF_Core_ColorSpace $colorSpace
         */
        public function setAlternate(?\SetaPDF_Core_ColorSpace $colorSpace = null) {}

        /**
         * Get a parser instance for this ICC profile stream.
         *
         * @return SetaPDF_Core_IccProfile_Parser
         */
        public function getParser() {}

    }
}

namespace
{

    /**
     * Image exception
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Image
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Image_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Class representing an JPEG image
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Image
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Image_Jpeg extends \SetaPDF_Core_Image
    {
        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_SOS = "\xDA";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_APP0 = "\xE0";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_SOF0 = "\xC0";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_SOF1 = "\xC1";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_SOF2 = "\xC2";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_SOI = "\xD8";

        /**
         * Handled JPEG marker
         *
         * @var string
         */
        const MARKER_EOI = "\xD9";

        /**
         * Process the image data.
         * 
         * @see SetaPDF_Core_Image::_process()
         */
        protected function _process() {}

        /**
         * Converts the JPEG image to an external object.
         * 
         * @see SetaPDF_Core_Image::toXObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_XObject_Image
         */
        public function toXObject(\SetaPDF_Core_Document $document) {}

    }
}

namespace
{

    /**
     * Class representing an JPEG2000 image
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Image
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Image_Jpeg2000 extends \SetaPDF_Core_Image
    {
        protected $_opacityAvailable = false;

        /**
         * Process the image data.
         *
         * @see SetaPDF_Core_Image::_process()
         */
        protected function _process() {}

        /**
         * Reads the header information for the following box.
         *
         * @param mixed $boxLength The BoxLength will be written in this variable.
         * @param mixed $boxType The BoxType will be written in this variable.
         * @throws SetaPDF_Exception_NotImplemented
         */
        protected function _readBoxHeader(&$boxLength, &$boxType) {}

        /**
         * Converts the JPEG 2000 image to an external object.
         *
         * @see SetaPDF_Core_Image::toXObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_XObject_Image
         */
        public function toXObject(\SetaPDF_Core_Document $document) {}

    }
}

namespace
{

    /**
     * Class representing an PNG image
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Image
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Image_Png extends \SetaPDF_Core_Image
    {
        /**
         * Palette data
         *
         * @var string
         */
        protected $_palette = '';

        /**
         * Transparency data
         *
         * @var array
         */
        protected $_transparency = [/** value is missing */];

        /**
         * Image data
         *
         * @var string
         */
        protected $_imageData = '';

        /**
         * Processes the image data so all needed information is available.
         */
        protected function _process() {}

        /**
         * Converts the PNG image to an external object.
         *
         * @see SetaPDF_Core_Image::toXObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_XObject_Image
         * @throws SetaPDF_Core_Image_Exception
         */
        public function toXObject(\SetaPDF_Core_Document $document) {}

        /**
         * Extracts the alpha channel from the image data.
         *
         * @param array $decodeParameters
         * @return array
         */
        protected function _extractAlphaChannel($decodeParameters) {}

    }
}

namespace
{

    /**
     * Cross reference table interface
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Parser_CrossReferenceTable_CrossReferenceTableInterface
    {
    }
}

namespace
{

    /**
     * Cross reference table exception
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_CrossReferenceTable_Exception extends \SetaPDF_Core_Parser_Exception
    {
    }
}

namespace
{

    /**
     * Invalid token exception
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_Pdf_InvalidTokenException extends \SetaPDF_Core_Parser_Exception
    {
    }
}

namespace
{

    /**
     * A parser for PDF content
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_Content
    {
        /**
         * The stream to parse
         *
         * @var string
         */
        protected $_stream;

        /**
         * Token stack
         *
         * @var array
         */
        protected $_stack = [/** value is missing */];

        /**
         * Registered operators and their callbacks
         *
         * @var array
         */
        protected $_operators = [/** value is missing */];

        /**
         * @var SetaPDF_Core_Parser_RawPdf
         */
        protected $_parser;

        /**
         * The constructor.
         *
         * @param string $stream
         */
        public function __construct($stream) {}

        /**
         * Release memory / cycled references
         */
        public function cleanUp() {}

        /**
         * Register a callback for an operator token.
         *
         * @param string|array $operator
         * @param callable $callback
         */
        public function registerOperator($operator, $callback) {}

        /**
         * Unregister an operator and its callback.
         *
         * @param string $operator
         */
        public function unregisterOperator($operator) {}

        /**
         * Process the stream.
         */
        public function process() {}

        /**
         * Processes the stream until a specifc oprator is matched.
         *
         * This method can be used to disable the process method for a specific token range.
         * For example an inline image can be ignored with this mehtod.
         *
         * @param string $operator
         * @return bool
         * @throws SetaPDF_Core_Exception
         */
        public function skipUntil($operator) {}

        /**
         * Get the pdf parser instance for the passed content stream.
         *
         * @return SetaPDF_Core_Parser_RawPdf
         */
        public function getParser() {}

    }
}

namespace
{

    /**
     * A PDF cross reference parser for corrupted pdfs
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_CorruptedCrossReferenceTable extends \SetaPDF_Core_Document_CrossReferenceTable implements \SetaPDF_Core_Parser_CrossReferenceTable_CrossReferenceTableInterface
    {
        /**
         * The PDF parser instance
         *
         * @var SetaPDF_Core_Parser_Pdf
         */
        protected $_parser;

        /**
         * The trailer dictionary
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_trailer;

        /**
         *
         * @var null
         */
        protected $_matchedPositions = [/** value is missing */];

        /**
         * Object offsets in the parser File
         *
         * @var array
         */
        protected $_parserObjectOffsets = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Parser_Pdf $parser
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        public function __construct(\SetaPDF_Core_Parser_Pdf $parser) {}

        /**
         * Check if the xref table uses compressed xref streams.
         *
         * @return boolean
         */
        public function isCompressed() {}

        /**
         * Get all defined object ids.
         *
         * @return array
         */
        public function getDefinedObjectIds() {}

        /**
         * Get the generation number by an object id.
         *
         * @param integer $objectId
         * @return integer|boolean
         */
        public function getGenerationNumberByObjectId($objectId) {}

        /**
         * Screens the file for objects and keywords.
         */
        protected function _screen() {}

        /**
         * Extracts object ids and their offsets from a buffer.
         *
         * @param string $buffer
         * @param int $start
         */
        protected function _extractObjectIds($buffer, $start) {}

        /**
         * Extracts trailer information from a buffer.
         *
         * @param string $buffer
         * @param int $start
         */
        protected function _extractTrailers($buffer, $start) {}

        /**
         * Extracts offsets for specific keywords from a buffer.
         *
         * @param string $buffer
         * @param int $start
         */
        protected function _matchKeywords($buffer, $start) {}

        /**
         * Ensures that a trailer dictionary exists or is created.
         *
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        public function ensureTrailer() {}

        /**
         * Returns the offset position for a specific object.
         *
         * @param int $objectId
         * @param int|null $generation
         * @return bool|int
         */
        public function getParserOffsetFor($objectId, $generation = null) {}

        /**
         * Returns the trailer dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getTrailer() {}

    }
}

namespace
{

    /**
     * A PDF cross reference parser
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_CrossReferenceTable extends \SetaPDF_Core_Document_CrossReferenceTable implements \SetaPDF_Core_Parser_CrossReferenceTable_CrossReferenceTableInterface
    {
        /**
         * Constant for none compression.
         *
         * @var integer
         */
        const COMPRESSED_NONE = 0;

        /**
         * Constant for full compression.
         *
         * @var integer
         */
        const COMPRESSED_ALL = 1;

        /**
         * Constant for a hybrid compression.
         *
         * @var integer
         */
        const COMPRESSED_HYBRID = 2;

        /**
         * The byte count in which the initial xref keyword should be searched for
         *
         * @var integer
         */
        public static $fileTrailerSearchLength = 5500;

        /**
         * A flag indicating the way of reading the xref table.
         *
         * If set to true, the xref table will only read/resolved if an access
         * to an object is needed. This is very fast for a small amount of access (updates).
         * If set to false, the complete xref-table will be read in at once.
         * This is faster if the document should be completely rewritten.
         *
         * @var boolean
         */
        public static $readOnAccess = true;

        /**
         * The PDF parser instance
         *
         * @var SetaPDF_Core_Parser_Pdf
         */
        protected $_parser;

        /**
         * The initial pointer to the xref table
         *
         * @var integer
         */
        protected $_pointerToXref;

        /**
         * Offset positions of subsections or cross reference stream objects
         *
         * @var array
         */
        protected $_xrefSubsection = [/** value is missing */];

        /**
         * Object offsets in the parser File
         *
         * @var array
         */
        protected $_parserObjectOffsets = [/** value is missing */];

        /**
         * The trailer dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_trailer;

        /**
         * Cross reference uses compressed object streams, hybrid or none
         *
         * @var integer
         */
        protected $_compressed = 0;

        /**
         * An array holding all resolved indirect objects representing compressed xref tables.
         *
         * @var array
         */
        protected $_compressedXrefObjects = [/** value is missing */];

        /**
         * Offset for PDF documents with invalid data before the PDF header.
         *
         * @var int
         */
        protected $_startOffset;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Parser_Pdf $parser
         */
        public function __construct(\SetaPDF_Core_Parser_Pdf $parser) {}

        /**
         * Release memory/references.
         */
        public function cleanUp() {}

        /**
         * Check if the xref table uses compressed xref streams.
         *
         * Use getCompressed
         * @return integer
         */
        public function isCompressed() {}

        /**
         * Get all defined object ids.
         *
         * This method returns an array of all objects which are noticed in any cross reference table.
         * The appearance of an object id in this list is not an evidence of existence of the desired object.
         *
         * @return array
         */
        public function getDefinedObjectIds() {}

        /**
         * Get the generation number by an object id.
         *
         * @param integer $objectId
         * @return integer|boolean
         */
        public function getGenerationNumberByObjectId($objectId) {}

        /**
         * Counts the bytes to the initial PDF file header to get an offset which will be used along with all other byte offsets.
         *
         * @see getStartOffset()
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        protected function _findStartOffset() {}

        /**
         * Get the start offset.
         *
         * @return int
         */
        public function getStartOffset() {}

        /**
         * Read the document trailer and initiate the initial parsing of the xref table.
         *
         * @param integer|boolean $xrefOffset
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        protected function _readTrailerAndXref($xrefOffset) {}

        /**
         * Returns the trailer dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getTrailer() {}

        /**
         * Get all indirect objects holding cross reference streams.
         *
         * @return array
         */
        public function getCompressedXrefObjects() {}

        /**
         * Returns the offset position of an object.
         *
         * @param integer $objectId
         * @param integer $generation
         * @param integer $objectGeneration The final generation number, resolved if no generation number was given.
         * @return boolean|mixed
         */
        public function getParserOffsetFor($objectId, $generation = null, &$objectGeneration = null) {}

        /**
         * Find the initial point to the xref table.
         *
         * @return integer
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        public function getPointerToXref() {}

        /**
         * Read the xref table at a specific position.
         *
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception
         */
        protected function _readXref() {}

    }
}

namespace
{

    /**
     * Parser exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * A PDF parser
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_Pdf
    {
        /**
         * The reader class
         *
         * @var SetaPDF_Core_Reader_ReaderInterface
         */
        protected $_reader;

        /**
         * The tokenizer
         *
         * @var SetaPDF_Core_Tokenizer
         */
        protected $_tokenizer;

        /**
         * The owner document
         *
         * @var SetaPDF_Core_Document
         */
        protected $_owner;

        /**
         * The current object which is parsed
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_currentObject;

        /**
         * If set to true the owning object is passed to parsed child elements
         *
         * This is needed to create a relation between a parsed object and its owning element.
         * The complete chain will be able to get a relation to the owning document.
         * Needed for example for handling en- and decryption of strings or streams.
         *
         * @var boolean
         */
        protected $_passOwningObjectToChilds = false;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function __construct(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Define if the owning object should be passed to it's childs.
         *
         * @param boolean $passOwningObjectToChilds
         * @see $_passOwningObjectToChilds
         */
        public function setPassOwningObjectToChilds($passOwningObjectToChilds = true) {}

        /**
         * Released memory and resources.
         */
        public function cleanUp() {}

        /**
         * Set the reader object.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function setReader(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Get the reader object.
         *
         * @return SetaPDF_Core_Reader_ReaderInterface
         */
        public function getReader() {}

        /**
         * Get the tokenizer object.
         *
         * @return SetaPDF_Core_Tokenizer
         */
        public function getTokenizer() {}

        /**
         * Set the owner pdf document.
         *
         * @param SetaPDF_Core_Type_Owner $owner
         */
        public function setOwner(\SetaPDF_Core_Type_Owner $owner) {}

        /**
         * Get the owner pdf document.
         *
         * @return null|SetaPDF_Core_Document
         */
        public function getOwner() {}

        /**
         * Get the PDF version.
         *
         * @TODO Should not be located in this class
         * @return string
         * @throws SetaPDF_Core_Parser_Exception
         */
        public function getPdfVersion() {}

        /**
         * Get the next token.
         *
         * @return string
         */
        protected function _getNextToken() {}

        /**
         * Reset the reader to a specific position.
         *
         * @param integer $pos
         */
        public function reset($pos = 0) {}

        /**
         * Skips tokens until a special token is found.
         *
         * This method can be used to e.g. jump over binary inline image data.
         *
         * @param string $token
         * @return bool
         */
        public function skipUntilToken($token) {}

        /**
         * Ensures that the token will evaluate to an expected object type (or not).
         *
         * @param string $token
         * @param string|null $expectedType
         * @return bool
         * @throws SetaPDF_Core_Parser_Pdf_InvalidTokenException
         */
        private function _ensureExpectedValue($token, $expectedType) {}

        /**
         * Read a value.
         *
         * @param string|null $expectedType
         * @return SetaPDF_Core_Type_AbstractType|false
         */
        public function readValue($expectedType = null) {}

        /**
         * Read a value based on a token.
         *
         * @param string|null $token
         * @param string|null $expectedType
         * @return SetaPDF_Core_Type_AbstractType|false
         * @throws SetaPDF_Core_Parser_Pdf_InvalidTokenException
         * @throws SetaPDF_Core_Exception
         * @throws UnexpectedValueException
         */
        private function _readValue($token, $expectedType = null) {}

    }
}

namespace
{

    /**
     * A PDF parser for standard tokens.
     *
     * This class doesn't work with object instances but only returns simple array structures
     * with raw extraced PDF data.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Parser
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Parser_RawPdf
    {
        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_ARRAY = 1;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_BOOLEAN = 2;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_DICTIONARY = 3;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_HEX_STRING = 4;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_INDIRECT_OBJECT = 5;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_INDIRECT_REFERENCE = 6;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_NAME = 7;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_NULL = 8;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_NUMERIC = 9;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_STRING = 10;

        /**
         * A PDF type constant.
         *
         * @var integer
         */
        const TYPE_TOKEN = 11;

        /**
         * The reader class
         *
         * @var SetaPDF_Core_Reader_ReaderInterface
         */
        protected $_reader;

        /**
         * The tokenizer
         *
         * @var SetaPDF_Core_Tokenizer
         */
        protected $_tokenizer;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function __construct(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Released memory and resources.
         */
        public function cleanUp() {}

        /**
         * Set the reader object.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function setReader(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Get the reader object.
         *
         * @return SetaPDF_Core_Reader_ReaderInterface
         */
        public function getReader() {}

        /**
         * Get the tokenizer object.
         *
         * @return SetaPDF_Core_Tokenizer
         */
        public function getTokenizer() {}

        /**
         * Get the next token.
         *
         * @return string
         */
        protected function _getNextToken() {}

        /**
         * Reset the reader to a specific position.
         *
         * @param integer $pos
         */
        public function reset($pos = 0) {}

        /**
         * Skips tokens until a special token is found.
         *
         * This method can be used to e.g. jump over binary inline image data.
         *
         * @param string $token
         * @return bool
         */
        public function skipUntilToken($token) {}

        /**
         * Read a value.
         *
         * @return array|false
         * @throws SetaPDF_Core_Parser_Pdf_InvalidTokenException
         * @throws SetaPDF_Core_Exception
         * @throws UnexpectedValueException
         */
        public function readValue() {}

        /**
         * Read a value based on a token.
         *
         * @param string|null $token
         * @return array|false
         * @throws SetaPDF_Core_Parser_Pdf_InvalidTokenException
         * @throws SetaPDF_Core_Exception
         * @throws UnexpectedValueException
         */
        private function _readValue($token) {}

        /**
         * Converts an array structure into an object structure.
         *
         * @param $data
         * @return SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Boolean|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_HexString|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_Null|SetaPDF_Core_Type_Numeric|SetaPDF_Core_Type_String|SetaPDF_Core_Type_Token
         */
        public function convertToObject($data) {}

    }
}

namespace
{

    /**
     * An abstract reader class
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Reader_AbstractReader
    {
        /**
         * The length of the buffer
         *
         * @var int
         */
        protected $_length = 0;

        /**
         * The total length
         *
         * @var int
         */
        protected $_totalLength;

        /**
         * The current file position
         *
         * @var int
         */
        public $_pos = 0;

        /**
         * The offset to the current position
         * 
         * @var int
         */
        protected $_offset = 0;

        /**
         * The current buffer
         *
         * @var string
         */
        protected $_buffer = '';

        /**
         * Returns the byte length of the buffer.
         *
         * @param boolean $atOffset
         * @return int
         */
        public function getLength($atOffset = false) {}

        /**
         * Get the current position of the pointer.
         * 
         * @return int
         */
        public function getPos() {}

        /**
         * Returns the current buffer.
         *
         * @param boolean $atOffset
         * @return string
         */
        public function getBuffer($atOffset = true) {}

        /**
         * Gets a byte at a specific position.
         * 
         * If the position is invalid the method will return false.
         *
         * If non position is set $this->_offset will used.
         *
         * @param integer $pos
         * @return string|boolean
         */
        public function getByte($pos = null) {}

        /**
         * Returns a byte at a specific position, returns it and set the offset to the next byte position.
         *
         * If the position is invalid the method will return false.
         *
         * If non position is set $this->_offset will used.
         * 
         * @param integer $pos
         * @return string|boolean
         */
        public function readByte($pos = null) {}

        /**
         * Get a specific byte count from the current or at a specific offset position and set the
         * internal pointer to the next byte.
         *
         * If the position is invalid the method will return false.
         *
         * If non position is set $this->_offset will used.
         *
         * @param integer $length
         * @param integer $pos
         * @return string
         */
        public function readBytes($length, $pos = null) {}

        /**
         * Read a line from the current position.
         * 
         * @param integer $length
         * @return string
         */
        public function readLine($length = 1024) {}

        /**
         * Set the offset position.
         *
         * @param int $offset
         * @throws SetaPDF_Core_Reader_Exception
         */
        public function setOffset($offset) {}

        /**
         * Returns the current offset of the current position.
         * 
         * @return integer
         */
        public function getOffset() {}

        /**
         * Add an offset to the current offset.
         *
         * @param integer $offset
         */
        public function addOffset($offset) {}

        /**
         * Make sure that there is at least one character beyond the current offset in the buffer.
         * 
         * @return boolean
         */
        public function ensureContent() {}

        /**
         * Ensures bytes in the buffer with a specific length and location in the file.
         *
         * @param int $pos
         * @param int $length
         * @see reset()
         */
        public function ensure($pos, $length) {}

    }
}

namespace
{

    /**
     * Class representing a binary reader
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_Binary
    {
        /**
         * Big endian byte order
         *
         * @var string
         */
        const BYTE_ORDER_BIG_ENDIAN = 'bigEndian';

        /**
         * Little endian byte order
         *
         * @var string
         */
        const BYTE_ORDER_LITTLE_ENDIAN = 'littleEndian';

        /**
         * The main reader instance
         *
         * @var SetaPDF_Core_Reader_ReaderInterface
         */
        protected $_reader;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function __construct(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Release resources/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the reader.
         *
         * @return SetaPDF_Core_Reader_ReaderInterface
         */
        public function getReader() {}

        /**
         * Reads a 8-bit/1-byte signed integer.
         *
         * @param integer|null $pos
         * @return integer
         */
        public function readInt8($pos = null) {}

        /**
         * Reads a 8-bit/1-byte unsigned integer.
         *
         * @param integer|null $pos
         * @return integer
         */
        public function readUInt8($pos = null) {}

        /**
         * Reads a 16-bit signed integer.
         *
         * @param integer|null $pos
         * @param string $byteOrder
         * @return integer
         */
        public function readInt16($pos = null, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 16-bit unsigned integer.
         *
         * @param integer|null $pos
         * @param string $byteOrder
         * @return integer
         */
        public function readUInt16($pos = null, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 32-bit signed integer.
         *
         * @param integer|null $pos
         * @param string $byteOrder
         * @return mixed
         */
        public function readInt32($pos = null, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 32-bit unsigned integer.
         *
         * @param integer|null $pos
         * @param string $byteOrder
         * @return mixed
         */
        public function readUInt32($pos = null, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Read a single byte.
         *
         * @param integer $pos
         * @return string
         */
        public function readByte($pos = null) {}

        /**
         * Read a specific amount of bytes.
         *
         * @param integer $length
         * @param integer $pos
         * @return string
         */
        public function readBytes($length, $pos = null) {}

        /**
         * Reset the reader to a specific position.
         *
         * @param integer $position
         * @param integer $length
         */
        public function reset($position, $length) {}

        /**
         * Seek to a position.
         *
         * @param integer $position
         */
        public function seek($position) {}

        /**
         * Skip a specific byte count.
         *
         * @param integer $length
         */
        public function skip($length) {}

    }
}

namespace
{

    /**
     * Reader exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Class for a file reader
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_File extends \SetaPDF_Core_Reader_Stream
    {
        /**
         * The filename
         *
         * @var string
         */
        protected $_filename = '';

        /**
         * The constructor.
         *
         * @param string $filename
         */
        public function __construct($filename) {}

        /**
         * Implementation of the __sleep() method.
         *
         * @return array
         */
        public function __sleep() {}

        /**
         * Opens the file.
         *
         * Mainly used for testing purposes.
         *
         * @param string $filename
         * @return resource
         */
        protected function _openFile($filename) {}

        /**
         * Closes the file handle.
         *
         * Mainly used for testing purposes.
         *
         * @see SetaPDF_Core_Reader_File::_fp
         */
        protected function _closeFile() {}

        /**
         * Wakeup method.
         *
         * @see http://www.php.net/language.oop5.magic.php#language.oop5.magic.sleep
         */
        public function __wakeup() {}

        /**
         * Set the filename.
         *
         * @param string $filename
         * @throws SetaPDF_Core_Reader_Exception
         */
        protected function _setFilename($filename) {}

        /**
         * Returns the filename.
         *
         * @return string
         */
        public function getFilename() {}

        /**
         * Close the file handle.
         *
         * @see SetaPDF_Core_Reader_ReaderInterface::cleanUp()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * A simple class representing a file path.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_FilePath
    {
        /**
         * The file path
         *
         * @var string
         */
        protected $_path;

        /**
         * The constructor
         *
         * @param string $path
         */
        public function __construct($path) {}

        /**
         * Set the path.
         *
         * @param string $path
         */
        public function setPath($path) {}

        /**
         * Get the path.
         *
         * @return string
         */
        public function getPath() {}

        /**
         * @return string
         */
        public function __toString() {}

    }
}

namespace
{

    /**
     * Class for a file reader respecting the maximum allowed open file handles/descriptors.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_MaxFile extends \SetaPDF_Core_Reader_File
    {
        /**
         * Defines if the reader is sleeping
         *
         * @var boolean
         */
        protected $_sleeping = true;

        /**
         * The position of the point before sleep() was called
         *
         * @var integer
         */
        protected $_sleepPosition = 0;

        /**
         * The handler instance
         *
         * @var SetaPDF_Core_Reader_MaxFileHandler
         */
        protected $_handler;

        /**
         * The constructor.
         *
         * @param string $filename
         * @param SetaPDF_Core_Reader_MaxFileHandler|null $handler The handler to which this instance should be bound and notify
         *                                                    when opening closing file handles.
         * @throws Exception
         */
        public function __construct($filename, ?\SetaPDF_Core_Reader_MaxFileHandler $handler = null) {}

        /**
         * Returns the handler instance.
         *
         * @param boolean $check
         * @return SetaPDF_Core_Reader_MaxFileHandler
         */
        public function getHandler($check = true) {}

        /**
         * Set a handler.
         *
         * @param SetaPDF_Core_Reader_MaxFileHandler|null $handler
         */
        public function setHandler(?\SetaPDF_Core_Reader_MaxFileHandler $handler = null) {}

        /**
         * Implementation of the __sleep() method.
         *
         * @return array
         */
        public function __sleep() {}

        /**
         * Release memory/cylced references.
         */
        public function cleanUp() {}

        /**
         * Opens the file.
         *
         * @param string $filename
         * @return resource
         */
        protected function _openFile($filename) {}

        /**
         * Closes the file handle.
         */
        protected function _closeFile() {}

        /**
         * Gets the total available length.
         *
         * @return int
         */
        public function getTotalLength() {}

        /**
         * Resets the buffer to a specific position and reread the buffer with the given length.
         *
         * If the $pos is negative the start buffer position will be the $pos'th position from
         * the end of the file.
         *
         * If the $pos is negative and the absolute value is bigger then the totalLength of
         * the file $pos will set to zero.
         *
         * @param int|null $pos Start position of the new buffer
         * @param int $length Length of the new buffer. Mustn't be negative
         */
        public function reset($pos = 0, $length = 200) {}

        /**
         * Forcefully read more data into the buffer.
         *
         * @param int $minLength
         * @return boolean
         */
        public function increaseLength($minLength = 100) {}

        /**
         * Copies the complete content to a writer instance.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         */
        public function copyTo(\SetaPDF_Core_WriteInterface $writer) {}

        /**
         * Checks if the reader is sleeping.
         *
         * @return boolean
         */
        public function isSleeping() {}

        /**
         * Set the reader into sleep-state.
         *
         * In this implementation the file handles will be closed to avoid reaching the limit
         * of open file handles.
         *
         * @see SetaPDF_Core_Reader_ReaderInterface::sleep()
         */
        public function sleep() {}

        /**
         * Wake up the reader if it is in sleep-state.
         *
         * Re-open the file handle.
         *
         * @see SetaPDF_Core_Reader_ReaderInterface::wakeUp()
         * @throws SetaPDF_Core_Reader_Exception
         * @return boolean
         */
        public function wakeUp() {}

    }
}

namespace
{

    /**
     * Class that handles SetaPDF_Core_Reader_MaxFile instances.
     *
     * It is responsible for observing the open file handles and ensures that a specific limit is not reached by
     * setting other instances into sleep-mode.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_MaxFileHandler
    {
        /**
         * The reader instances
         *
         * @var SetaPDF_Core_Reader_MaxFile[]
         */
        protected $_instances = [/** value is missing */];

        /**
         * Maximum open handles
         *
         * @var int
         */
        protected $_maxOpenHandles = 1000;

        /**
         * Currently open handles.
         *
         * @var int
         */
        protected $_openHandles = 0;

        /**
         * The constructor.
         *
         * @param int $maxOpenHandles
         */
        public function __construct($maxOpenHandles = 1000) {}

        /**
         * Set the maximum open handles.
         *
         * @param int $maxOpenHandles
         */
        public function setMaxOpenHandles($maxOpenHandles) {}

        /**
         * Get the maximum open handles.
         *
         * @return int
         */
        public function getMaxOpenHandles() {}

        /**
         * Helper method to create a reader instance.
         *
         * @param $filename
         * @return SetaPDF_Core_Reader_MaxFile
         * @see SetaPDF_Core_Reader_MaxFile
         */
        public function createReader($filename) {}

        /**
         * Registers a reader instance.
         *
         * @param SetaPDF_Core_Reader_MaxFile $reader
         * @internal
         */
        public function registerReader(\SetaPDF_Core_Reader_MaxFile $reader) {}

        /**
         * Unregisters a reader instance.
         *
         * @param SetaPDF_Core_Reader_MaxFile $reader
         * @internal
         */
        public function unregisterReader(\SetaPDF_Core_Reader_MaxFile $reader) {}

        /**
         * Get all reader instances registered in this handler instance.
         *
         * @return SetaPDF_Core_Reader_MaxFile[]
         */
        public function getInstances() {}

        /**
         * Ensures a free handle.
         */
        public function ensureFreeHandle() {}

        /**
         * Shall be triggered if a handle is opened.
         */
        public function onHandleOpened() {}

        /**
         * Shall be triggered if a handle is closed.
         */
        public function onHandleClosed() {}

        /**
         * Get the currently opened handles count.
         *
         * @return int
         */
        public function getOpenHandles() {}

    }
}

namespace
{

    /**
     * Interface of a reader implementation 
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Reader_ReaderInterface
    {
        /**
         * Returns the byte length of the buffer.
         *
         * @param boolean $atOffset
         * @return int
         */
        public function getLength($atOffset = false);

        /**
         * Gets the total available length.
         * 
         * @return int
         */
        public function getTotalLength();

        /**
         * Gets the current position of the pointer.
         * 
         * @return int
         */
        public function getPos();

        /**
         * Returns the current buffer.
         *
         * @param boolean $atOffset
         * @return string
         */
        public function getBuffer($atOffset = true);

        /**
         * Get the byte at the current or at a specific offset position and sets the internal
         * pointer to the next byte.
         * 
         * @param integer $pos
         * @return string
         */
        public function readByte($pos = null);

        /**
         * Get a specific byte count from the current or at a specific offset position and set
         * the internal pointer to the next byte.
         * 
         * @param integer $length
         * @param integer $pos
         * @return string
         */
        public function readBytes($length, $pos = null);

        /**
         * Get the byte at the current or at a specific offset position.
         *
         * @param int $pos
         * @return string
         */
        public function getByte($pos = null);

        /**
         * Reads a line from the current buffer.
         * 
         * @param int $length
         * @return string
         */
        public function readLine($length = 1024);

        /**
         * Sets the offset of the current position.
         *
         * @param int $offset
         */
        public function setOffset($offset);

        /**
         * Returns the current offset of the current position.
         * 
         * @return integer
         */
        public function getOffset();

        /**
         * Adds an offset to the current offset.
         *
         * @param integer $offset
         */
        public function addOffset($offset);

        /**
         * Resets the buffer to a specific position and reread the buffer with the given length.
         *
         * @param int|null $pos
         * @param int $length
         */
        public function reset($pos = 0, $length = 100);

        /**
         * Ensures bytes in the buffer with a specific length and location in the file.
         *
         * @param int $pos
         * @param int $length
         * @see reset()
         */
        public function ensure($pos, $length);

        /**
         * Make sure that there is at least one character beyond the current offset in the buffer.
         * 
         * @return boolean
         */
        public function ensureContent();

        /**
         * Forcefully read more data into the buffer.
         *
         * @param int $minLength
         */
        public function increaseLength($minLength = 100);

        /**
         * Copies the complete content to the writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         */
        public function copyTo(\SetaPDF_Core_WriteInterface $writer);

        /**
         * Method which is called when a document is cleaned up.
         */
        public function cleanUp();

    }
}

namespace
{

    /**
     * Class for a stream reader
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_Stream extends \SetaPDF_Core_Reader_AbstractReader implements \SetaPDF_Core_Reader_ReaderInterface
    {
        /**
         * The stream resource
         *
         * @var resource
         */
        protected $_stream;

        /**
         * The constructor.
         *
         * @param resource $stream
         */
        public function __construct($stream) {}

        /**
         * The destruct method.
         *
         * @see http://www.php.net/__destruct
         */
        public function __destruct() {}

        /**
         * Implementation of the __sleep() method.
         *
         * It is not possible to serialize a stream reader because a stream is not serializable.
         *
         * @throws BadMethodCallException
         */
        public function __sleep() {}

        /**
         * Set the stream.
         *
         * @param resource $stream
         * @throws InvalidArgumentException
         */
        protected function _setStream($stream) {}

        /**
         * Returns the stream.
         *
         * @return resource
         */
        public function getStream() {}

        /**
         * Gets the total available length.
         *
         * @return int
         */
        public function getTotalLength() {}

        /**
         * Resets the buffer to a specific position and reread the buffer with the given length.
         *
         * If the $pos is negative the start buffer position will be the $pos'th position from
         * the end of the file.
         *
         * If the $pos is negative and the absolute value is bigger then the totalLength of
         * the file $pos will set to zero.
         *
         * @param int|null $pos Start position of the new buffer
         * @param int $length Length of the new buffer. Mustn't be negative
         */
        public function reset($pos = 0, $length = 200) {}

        /**
         * Forcefully read more data into the buffer.
         *
         * @param int $minLength
         * @return boolean
         */
        public function increaseLength($minLength = 100) {}

        /**
         * Copies the complete content to a writer instance.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         */
        public function copyTo(\SetaPDF_Core_WriteInterface $writer) {}

        /**
         * Implementation of SetaPDF_Core_Reader_ReaderInterface (empty body for this type of reader).
         *
         * @see SetaPDF_Core_Reader_ReaderInterface::sleep()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Class for a string reader
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Reader
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Reader_String extends \SetaPDF_Core_Reader_AbstractReader implements \SetaPDF_Core_Reader_ReaderInterface
    {
        /**
         * The complete string.
         *
         * @var string
         */
        protected $_string = '';

        /**
         * The constructor.
         *
         * @param string $string
         */
        public function __construct($string) {}

        /**
         * Returns the complete string.
         *
         * @return string
         */
        public function __toString() {}

        /**
         * Set the string.
         *
         * @param string $string
         */
        public function setString($string) {}

        /**
         * Get the complete string.
         *
         * @return string
         */
        public function getString() {}

        /**
         * Gets the total available length.
         *
         * @return int
         */
        public function getTotalLength() {}

        /**
         * Resets the buffer to a specific position and reread the buffer with the given length.
         *
         * The behavior of the arguments is the same like "substr" ($pos=$start; $length=$length).
         *
         * @see http://www.php.net/substr
         * @param int|null $pos Start position of the new buffer.
         * @param int $length Length of the new buffer.
         */
        public function reset($pos = 0, $length = 100) {}

        /**
         * Forcefully read more data into the buffer.
         *
         * @param int $minLength
         * @return boolean;
         */
        public function increaseLength($minLength = 50000) {}

        /**
         * Copies the complete content to the writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         */
        public function copyTo(\SetaPDF_Core_WriteInterface $writer) {}

        /**
         * Implementation of SetaPDF_Core_Reader_ReaderInterface (empty body for this type of reader).
         *
         * @see SetaPDF_Core_Reader_ReaderInterface::sleep()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Resource class for handling external graphic states
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Resource_ExtGState implements \SetaPDF_Core_Resource
    {
        /**
         * The graphics state parameter dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The indirect object for this graphic state
         *
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectObject;

        /**
         * Creates a graphics state parameter dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function createExtGStateDictionary() {}

        /**
         * The constructor.
         *
         * @see createExtGStateDictionary()
         * @throws InvalidArgumentException
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary|string $extGStateDictionary
         */
        public function __construct($extGStateDictionary = null) {}

        /**
         * Set the line width.
         *
         * @see PDF 32000-1:2008 - 8.4.3.2, "Line Width"
         * @param float $lineWidth
         */
        public function setLineWidth($lineWidth) {}

        /**
         * Set the line cap style.
         *
         * @see PDF 32000-1:2008 - 8.4.3.3, "Line Cap Style"
         * @param int|float $lineCapStyle
         */
        public function setLineCapStyle($lineCapStyle) {}

        /**
         * Set the line join style.
         *
         * @see PDF 32000-1:2008 - 8.4.3.4, "Line Join Style"
         * @param int|float $lineJoinStyle
         */
        public function setLineJoinStyle($lineJoinStyle) {}

        /**
         * Set the miter limit.
         *
         * @see PDF 32000-1:2008 - 8.4.3.5, "Miter Limit"
         * @param int|float $miterLimit
         */
        public function setMiterLimit($miterLimit) {}

        /**
         * Set the name of the rendering intent.
         *
         * @see PDF 32000-1:2008 - 8.6.5.8, "Rendering Intents"
         * @param string $renderingIntent
         */
        public function setRenderingIntent($renderingIntent) {}

        /**
         * Set the flag specifying whether to apply overprint.
         *
         * @see PDF 32000-1:2008 - 8.6.7, "Overprint Control"
         * @param boolean $overprintControl
         */
        public function setOverprintControl($overprintControl) {}

        /**
         * Set the flag specifying whether to apply overprint for non-stroking operations.
         *
         * @see PDF 32000-1:2008 - 8.6.7, "Overprint Control"
         * @param boolean $overprintControl
         */
        public function setOverprintControlNonStroking($overprintControl) {}

        /**
         * Set the overprint mode.
         *
         * @see PDF 32000-1:2008 - 8.6.7, "Overprint Control"
         * @param integer $overprintMode
         */
        public function setOverprintMode($overprintMode) {}

        /**
         * Set the font configuration.
         * 
         * @param array $font
         * @throws SetaPDF_Exception_NotImplemented
         * @todo Implement
         * @internal
         */
        public function setFont($font) {}

        /**
         * Set the blend mode to be used in transparent image model.
         *
         * @see PDF 32000-1:2008 - 11.3.5, "Blend Mode" and 11.6.3, "Specifying Blending Colour Space and Blend Mode"
         * @param null|string|SetaPDF_Core_Type_Name $blendMode
         * TODO Implement handling of an array parameter
         */
        public function setBlendMode($blendMode) {}

        /**
         * Set the current stroking alpha constant.
         * 
         * @param float $opacity
         */
        public function setConstantOpacity($opacity) {}

        /**
         * Set the current non-stroking alpha constant.
         *
         * @param float $opacity
         */
        public function setConstantOpacityNonStroking($opacity) {}

        /**
         * Get the graphics state parameter dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Gets an indirect object for this graphics state parameter dictionary.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document|null $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Returns the resource type for the graphic state.
         * 
         * @return string
         * @see SetaPDF_Core_Resource::getResourceType()
         */
        public function getResourceType() {}

        /**
         * Sets the numeric $value on the offset $name.
         *
         * @param null|string|SetaPDF_Core_Type_Name $name
         * @param int|float $value
         */
        protected function _setNumeric($name, $value) {}

        /**
         * Sets the name $value on the offset $name.
         *
         * @param null|string|SetaPDF_Core_Type_Name $name
         * @param string $value
         */
        protected function _setName($name, $value) {}

        /**
         * Sets the boolean $value on the offset $name.
         *
         * @param null|string|SetaPDF_Core_Type_Name $name
         * @param string $value
         */
        protected function _setBoolean($name, $value) {}

    }
}

namespace
{

    /**
     * Generator class for AES 128 bit public-key security handler
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey_Aes128 extends \SetaPDF_Core_SecHandler_PublicKey
    {
        /**
         * Factory method for AES 128 bit public-key security handler.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[]|SetaPDF_Core_SecHandler_PublicKey_Recipient $recipients
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_PublicKey_Aes128
         */
        public static function factory(\SetaPDF_Core_Document $document, $recipients, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for AES 256 bit public-key security handler
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey_Aes256 extends \SetaPDF_Core_SecHandler_PublicKey
    {
        /**
         * Factory method for AES 256 bit public-key security handler.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[]|SetaPDF_Core_SecHandler_PublicKey_Recipient $recipients
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_PublicKey_Aes256
         */
        public static function factory(\SetaPDF_Core_Document $document, $recipients, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for RC4 40 bit public-key security handler
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey_Arcfour128 extends \SetaPDF_Core_SecHandler_PublicKey
    {
        /**
         * Factory method for RC4 128 bit public-key security handler.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[]|SetaPDF_Core_SecHandler_PublicKey_Recipient $recipients
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_PublicKey_Arcfour128
         */
        public static function factory(\SetaPDF_Core_Document $document, $recipients) {}

    }
}

namespace
{

    /**
     * Generator class for RC4 128 bit public-key security handler with crypt filters
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey_Arcfour128Cf extends \SetaPDF_Core_SecHandler_PublicKey
    {
        /**
         * Factory method for RC4 128 bit public-key security handler with crypt filters.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[]|SetaPDF_Core_SecHandler_PublicKey_Recipient $recipients
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_PublicKey_Arcfour128Cf
         */
        public static function factory(\SetaPDF_Core_Document $document, $recipients, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Class representing a recipient of a public-key encrypted PDF document.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey_Recipient
    {
        /**
         * The permissions for this recipient.
         *
         * @var int
         */
        protected $_permissions = 0;

        /**
         * The certificate/public key for this recipient.
         *
         * @var mixed
         * @see http://php.net/manual/en/openssl.certparams.php
         */
        protected $_certificate;

        /**
         * The constructor.
         *
         * @param mixed $certificate The certificate of the recipient. See {@link http://php.net/manual/en/openssl.certparams.php} for further details.
         * @param int $permissions
         */
        public function __construct($certificate, $permissions = 0) {}

        /**
         * Set the permissions for this recipient.
         *
         * @param int $permissions
         */
        public function setPermissions($permissions) {}

        /**
         * Get the permissions for this recipient.
         *
         * @return int
         */
        public function getPermissions() {}

        /**
         * Get the certificate.
         *
         * @return mixed
         */
        public function getCertificate() {}

    }
}

namespace
{

    /**
     * Generator class for AES 128 bit security handler
     *  
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Aes128 extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for AES 128 bit security handler.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in PDFDocEncoding
         * @param string $userPassword The user password in PDFDocEncoding
         * @param integer $permissions
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Aes128
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for AES 256 bit security handler (revision 6)
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Aes256 extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for AES 256 bit security handler.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in UTF-8 encoding
         * @param string $userPassword The user password in UTF-8 encoding
         * @param integer $permissions
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Aes256
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for AES 256 bit security handler (revision 5 - DEPRECTAED IN ISO/DIS 32000-2)
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Aes256R5 extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for AES 256 bit security handler. (revision 5 - DEPRECTAED IN ISO/DIS 32000-2)
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in UTF-8 encoding
         * @param string $userPassword The user password in UTF-8 encoding
         * @param integer $permissions
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Aes256R5
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for RC4 128 bit security handler
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Arcfour128 extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for RC4 128 bit security handler.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in PDFDocEncoding
         * @param string $userPassword The user password in PDFDocEncoding
         * @param integer $permissions
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Arcfour128
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0) {}

    }
}

namespace
{

    /**
     * Generator class for RC4 128 bit security handler with crypt filters
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Arcfour128Cf extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for RC4 128 bit security handler with crypt filters.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in PDFDocEncoding
         * @param string $userPassword The user password in PDFDocEncoding
         * @param integer $permissions
         * @param boolean $encryptMetadata
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Arcfour128Cf
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0, $encryptMetadata = true) {}

    }
}

namespace
{

    /**
     * Generator class for RC4 40 bit security handler
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard_Arcfour40 extends \SetaPDF_Core_SecHandler_Standard
    {
        /**
         * Factory method for RC4 40 bit security handler.
         * 
         * @param SetaPDF_Core_Document $document
         * @param string $ownerPassword The owner password in PDFDocEncoding
         * @param string $userPassword The user password in PDFDocEncoding
         * @param integer $permissions
         * @throws SetaPDF_Core_SecHandler_Exception
         * @return SetaPDF_Core_SecHandler_Standard_Arcfour40
         */
        public static function factory(\SetaPDF_Core_Document $document, $ownerPassword, $userPassword = '', $permissions = 0) {}

    }
}

namespace
{

    /**
     * Abstract security handler class for handling PDF encryption features.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_SecHandler_AbstractHandler
    {
        /**
         * The document to which this security handler is attached
         *
         * @var SetaPDF_Core_Document
         */
        protected $_document;

        /**
         * The key length in bytes
         *
         * This value is still needed if crypt filters are in use:
         *   - It is needed to compute the encryption key.
         *   - It is needed to compute the O value
         *  It is NOT documented which key length should be used for this things
         *  if a crypt filter is in use.
         *
         * @var integer
         */
        protected $_keyLength = 5;

        /**
         * The encryption key
         *
         * @var string
         */
        protected $_encryptionKey;

        /**
         * The encryption dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_encryptionDictionary;

        /**
         * Defines if this security handler is authenticated
         *
         * @var boolean
         */
        protected $_auth = false;

        /**
         * The auth mode
         *
         * Says who is authenticated: user or owner
         *
         * @var string|null
         */
        protected $_authMode;

        /**
         * Metadata are encrypted or not
         *
         * @var boolean
         */
        protected $_encryptMetadata = true;

        /**
         * The algorithm an key length to be used for en/decrypting strings
         *
         * @var array
         */
        protected $_stringAlgorithm = [/** value is missing */];

        /**
         * The algorithm an key length to be used for en/decrypting stream
         *
         * @var array
         */
        protected $_streamAlgorithm = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Type_Dictionary $encryptionDictionary
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function __construct(\SetaPDF_Core_Document $document, \SetaPDF_Core_Type_Dictionary $encryptionDictionary) {}

        /**
         * Returns the document instance of this security handler.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Gets the encryption dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getEncryptionDictionary() {}

        /**
         * Get the stream algorithm data.
         *
         * @return array
         */
        public function getStreamAlgorithm() {}

        /**
         * Get the string algorithm data.
         *
         * @return array
         */
        public function getStringAlgorithm() {}

        /**
         * Encrypt a string.
         *
         * @param string $data
         * @param SetaPDF_Core_Type_IndirectObject $param
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function encryptString($data, $param = null) {}

        /**
         * Encrypt a stream.
         *
         * @param string $data
         * @param SetaPDF_Core_Type_IndirectObject $param
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function encryptStream($data, $param = null) {}

        /**
         * Decrypt a string.
         *
         * @param string $data
         * @param SetaPDF_Core_Type_IndirectObject $param
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function decryptString($data, $param = null) {}

        /**
         * Decrypt a stream.
         *
         * @param string $data
         * @param SetaPDF_Core_Type_IndirectObject $param
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function decryptStream($data, $param = null) {}

        /**
         * Get the auth method.
         *
         * @return string "user", "owner" or an empty string if not authenticated.
         */
        public function getAuthMode() {}

        /**
         * Queries if a permission is granted.
         *
         * @param integer $permission
         * @return boolean
         */
        public function getPermission($permission) {}

        /**
         * Queries if the security handler is authenticated.
         *
         * If not it tries by calling auth() without a password.
         *
         * @return boolean
         */
        public function isAuth() {}

        /**
         * Get the encryption key if known/authenticated.
         *
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function getEncryptionKey() {}

        /**
         * Returns true if the metadata are/will be encrypted.
         *
         * @return boolean
         */
        public function getEncryptMetadata() {}

        /**
         * Encrypts or decrypts data using Algorithm 1 of the PDF specification.
         *
         * @param string $data
         * @param array $algorithm
         * @param SetaPDF_Core_Type_IndirectObject $param
         * @param boolean $encrypt
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        protected function _crypt($data, $algorithm, $param = null, $encrypt = true) {}

        /**
         * Computes a hash for security handler revision 6.
         *
         * @param string $data
         * @param string $inputPassword
         * @param string $userKey
         * @return string
         */
        protected function _computeHashR6($data, $inputPassword, $userKey = '') {}

        /**
         * Generate random bytes.
         *
         * Internally the method tries to use PHPs internal available methods for pseudo-random bytes creation:
         * {@link http://php.net/random_bytes random_bytes()},
         * {@link http://php.net/openssl_random_pseudo_bytes openssl_random_pseudo_bytes()},
         * {@link http://php.net/mcrypt_create_iv mcrypt_create_iv()}. If none of these methods is available a random
         * string is generated by using {@link http://php.net/mt_rand mt_rand()}.
         *
         * @param $length
         * @return string
         */
        public function generateRandomBytes($length) {}

        /**
         * Get the PDF version, which is needed for the currently used encryption algorithm.
         *
         * @return string
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function getPdfVersion() {}

    }
}

namespace
{

    /**
     * Security handler exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Exception extends \SetaPDF_Core_Exception
    {
        /**
         * @var integer
         */
        const NOT_AUTHENTICATED = 1536;

        /**
         * @var integer
         */
        const UNSUPPORTED_CRYPT_FILTER_METHOD = 1537;

        /**
         * @var integer
         */
        const UNSUPPORTED_REVISION = 1538;

        /**
         * @var integer
         */
        const NOT_ALLOWED = 1539;

    }
}

namespace
{

    /**
     * Security handler class handling public key encryption features.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_PublicKey extends \SetaPDF_Core_SecHandler_AbstractHandler implements \SetaPDF_Core_SecHandler_SecHandlerInterface
    {
        /**
         * Permission constant.
         *
         * When set permits change of encryption and enables all other permissions.
         *
         * @see PDF 32000-1:2008 - Table 24 - Public-Key security handler user access permissions
         * @var integer
         */
        const PERM_OWNER = 2;

        /**
         * An array of temporary filenames which needs to be deleted on destruction.
         *
         * @var array
         */
        private $_tempFiles = [/** value is missing */];

        /**
         * An array holding authentication data.
         *
         * @var array
         */
        protected $_authData = [/** value is missing */];

        /**
         * The cipher id that is passed to openssl_pkcs7_encrypt().
         *
         * @var int
         * @see http://php.net/manual/en/openssl.ciphers.php
         */
        protected $_cipherId = 0;

        /**
         * Set the cipher id, that will be passed to openssl_pkcs7_encrypt().
         *
         * ISO/DIS 32000-2: 7.6.5.3 Public-key encryption algorithms:
         * <cite>
         * The algorithms that shall be used to encrypt the enveloped data in the PKCS#7 object are: RC4 with key
         * lengths up to 256-bits, DES, Triple DES, RC2 with key lengths up to 128 bits, 128-bit AES in Cipher Block
         * Chaining (CBC) mode, 192-bit AES in CBC mode, 256-bit AES in CBC mode.
         * </cite>
         *
         * @param $cipherId
         * @see http://php.net/manual/en/openssl.ciphers.php
         */
        public function setCipherId($cipherId) {}

        /**
         * Get the cipher id, that will be passed to openssl_pkcs7_encrypt().
         *
         * @return int
         * @see http://php.net/manual/en/openssl.ciphers.php
         */
        public function getCipherId() {}

        /**
         * Removes temporary files.
         */
        protected function _cleanUp() {}

        /**
         * Prepares the PKCS#7 envelopes.
         *
         * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[] $recipients
         * @param string $seed
         * @return string[]
         * @throws Exception
         */
        protected function _prepareEnvelopes(array $recipients, $seed) {}

        /**
         * Computes the encryption key.
         *
         * @param string[] $envelopes
         * @param string $seed
         * @param bool|true $encryptMetadata
         * @return string
         */
        protected function _computeEncryptionKey(array $envelopes, $seed, $encryptMetadata = true) {}

        /**
         * Prepares permission flag.
         *
         * @param int $permissions
         * @return string
         */
        protected function _preparePermission($permissions) {}

        /**
         * Returns current permissions.
         *
         * @return integer
         * @see SetaPDF_Core_SecHandler_SecHandlerInterface::getPermissions()
         */
        public function getPermissions() {}

        /**
         * Authenticate to the security handler with a certificate and private key.
         *
         * @param mixed $recipientCert See parameter $recipcert of
         *                             {@link http://php.net/openssl_pkcs7_decrypt openssl_pkcs7_decrypt()}.
         * @param mixed $recipientKey See parameter $recipkey of
         *                             {@link http://php.net/openssl_pkcs7_decrypt openssl_pkcs7_decrypt()}.
         * @return bool
         * @throws SetaPDF_Core_SecHandler_Exception
         * @throws Exception
         */
        public function auth($recipientCert = null, $recipientKey = null) {}

    }
}

namespace
{

    /**
     * Security handler interface
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_SecHandler_SecHandlerInterface
    {
        /**
         * Returns the document instance of this security handler.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument();

        /**
         * Returns the encryption dictionary.
         * 
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getEncryptionDictionary();

        /**
         * Encrypts stream data through the desired security handler.
         * 
         * @param string $data
         * @param mixed $param 
         */
        public function encryptStream($data, $param = null);

        /**
         * Encrypts string data through the desired security handler.
         * 
         * @param string $data
         * @param mixed $param 
         */
        public function encryptString($data, $param = null);

        /**
         * Decrypts stream data through the desired security handler.
         * 
         * @param string $data
         * @param null|array|SetaPDF_Core_Type_IndirectObject $param An array of possible arguments
         */
        public function decryptStream($data, $param = null);

        /**
         * Decrypts string data through the desired security handler.
         * 
         * @param string $data
         * @param null|array|SetaPDF_Core_Type_IndirectObject $param An array of possible arguments
         */
        public function decryptString($data, $param = null);

        /**
         * Authenticate to the document with given credentials.
         * 
         * @param mixed $data Credentials data
         * @return boolean Authentication was successful or not
         */
        public function auth($data = null);

        /**
         * Returns the status if the handler is authenticated and ready to encrypt and decrypt strings or streams.
         * 
         * @return boolean
         */
        public function isAuth();

        /**
         * Queries if a permission is granted.
         * 
         * @param integer $permission
         */
        public function getPermission($permission);

        /**
         * Returns current permissions.
         * 
         * @return integer
         */
        public function getPermissions();

        /**
         * Returns the needed PDF version for this security handler.
         * 
         * @return string
         */
        public function getPdfVersion();

        /**
         * Returns true if the metadata are/will be encrypted.
         * 
         * @return boolean
         */
        public function getEncryptMetadata();

        /**
         * Get the auth mode.
         *
         * @return string
         */
        public function getAuthMode();

        /**
         * Get the encryption key if known/authenticated.
         *
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public function getEncryptionKey();

    }
}

namespace
{

    /**
     * Security handler class handling standard encryption features
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_SecHandler_Standard extends \SetaPDF_Core_SecHandler_AbstractHandler implements \SetaPDF_Core_SecHandler_SecHandlerInterface
    {
        /**
         * The padding string
         * 
         * @var string
         */
        protected static $_padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x0\x4E\x56\xFF\xFA\x1\x8\x2E\x2E\x0\xB6\xD0\x68\x3E\x80\x2F\xC\xA9\xFE\x64\x53\x69\x7A";

        /**
         * Ensures bits in the permission flag.
         *
         * @param $permissions
         * @param $revision
         * @return int
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        public static function ensurePermissions($permissions, $revision) {}

        /**
         * Get the revision of the security handler.
         *
         * @return mixed
         */
        public function getRevision() {}

        /**
         * Authenticate against the security handler.
         * 
         * This method will try to auth first with the owner password.
         *
         * If this will fail it will try to auth to the user password.
         * 
         * @param string $data The password to authenticate with
         * @return boolean Authentication was successful or not
         */
        public function auth($data = null) {}

        /**
         * Authenticate with the owner password.
         * 
         * @param string $password
         * @return boolean
         */
        public function authByOwnerPassword($password) {}

        /**
         * Authenticate with the user password.
         * 
         * @param string $password
         * @return boolean
         */
        public function authByUserPassword($password) {}

        /**
         * Internal method to authenticate with the user password.
         * 
         * @param string $userPassword
         * @return string|boolean The encryption key if the authentication was successful.<br/>
         *                        <b>False</b> if not.
         */
        protected function _authByUserPassword($userPassword = '') {}

        /**
         * Internal method to authenticate with the owner password.
         * 
         * @param string $ownerPassword
         * @return string|boolean The encryption key if the authentication was successful.<br/>
         *                        <b>False</b> if not.
         * @throws SetaPDF_Exception_NotImplemented
         */
        protected function _authByOwnerPassword($ownerPassword = '') {}

        /**
         * Returns current permissions.
         * 
         * @return integer
         * @see SetaPDF_Core_SecHandler_SecHandlerInterface::getPermissions()
         */
        public function getPermissions() {}

        /**
         * Compute the encryption key based on a password.
         *
         * @param string $password
         * @return string
         * @throws SetaPDF_Exception_NotImplemented
         */
        protected function _computeEncryptionKey($password = '') {}

        /**
         * Compute the O value.
         * 
         * @param string $userPassword
         * @param string $ownerPassword
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        protected function _computeOValue($userPassword, $ownerPassword = '') {}

        /**
         * Compute the U value.
         * 
         * @param string $encryptionKey
         * @return string
         * @throws SetaPDF_Core_SecHandler_Exception
         */
        protected function _computeUValue($encryptionKey) {}

        /**
         * Get the encryption key by the user password.
         * 
         * @param string $password
         * @return string
         */
        protected function _getEncryptionKeyByUserPassword($password = '') {}

    }
}

namespace
{

    /**
     * Class representing a text block which can be drawn onto a canvas object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Text
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Text_Block
    {
        /**
         * An array for caching calculation results
         *
         * @var array
         */
        protected $_dataCache = [/** value is missing */];

        /**
         * A callback which is called if the internal data cache is cleared
         * 
         * @var callback
         */
        protected $_dataCacheClearCallback;

        /**
         * The font to use
         * 
         * @var SetaPDF_Core_Font
         */
        protected $_font;

        /**
         * The font size
         *
         * @var float|integer
         */
        protected $_fontSize = 12;

        /**
         * The text in user defined encoding
         * 
         * @var string
         */
        protected $_text;

        /**
         * The encoding of the text
         * 
         * @var string
         */
        protected $_encoding = 'UTF-8';

        /**
         * The text string in UTF-16BE encoding for internal usage
         * 
         * @var string
         */
        protected $_internalText;

        /**
         * The text alignment
         * 
         * @var string
         */
        protected $_align = 'left';

        /**
         * A specific width of this text stamp
         * 
         * @var number
         */
        protected $_width;

        /**
         * The rendering mode
         * 
         * @var integer
         */
        protected $_renderingMode = 0;

        /**
         * The line height
         *
         * @var null|number
         */
        protected $_lineHeight;

        /**
         * The text color
         *
         * @var null|SetaPDF_Core_DataStructure_Color
         */
        protected $_textColor;

        /**
         * The color of the text outline
         *
         * @var null|SetaPDF_Core_DataStructure_Color
         */
        protected $_outlineColor;

        /**
         * The outline width
         *
         * @var number
         */
        protected $_outlineWidth = 1;

        /**
         * The character spacing value
         * 
         * @var number
         */
        protected $_charSpacing = 0;

        /**
         * Word spacing value
         * 
         * @var number
         */
        protected $_wordSpacing = 0;

        /**
         * The background color
         *
         * @var null|SetaPDF_Core_DataStructure_Color
         */
        protected $_backgroundColor;

        /**
         * The border color
         *
         * @var null|SetaPDF_Core_DataStructure_Color
         */
        protected $_borderColor;

        /**
         * The border width
         *
         * @var number
         */
        protected $_borderWidth = 0;

        /**
         * Padding top value
         *
         * @var number
         */
        protected $_paddingTop = 0;

        /**
         * Padding right value
         *
         * @var number
         */
        protected $_paddingRight = 0;

        /**
         * Padding bottom value
         *
         * @var number
         */
        protected $_paddingBottom = 0;

        /**
         * Padding left value
         *
         * @var number
         */
        protected $_paddingLeft = 0;

        /**
         * The constructor.
         * 
         * @param SetaPDF_Core_Font $font
         * @param number $fontSize
         */
        public function __construct(\SetaPDF_Core_Font $font, $fontSize = null) {}

        /**
         * Release resources / cycled references.
         */
        public function cleanUp() {}

        /**
         * Sets a callback function which is called if the internal cache is cleared.
         * 
         * @param callback $callback
         */
        public function setDataCacheClearCallback($callback) {}

        /**
         * Clears the internal data cache.
         */
        protected function _clearDataCache() {}

        /**
         * Set the font object and size.
         *
         * @param SetaPDF_Core_Font $font
         * @param number $fontSize
         */
        public function setFont(\SetaPDF_Core_Font $font, $fontSize = null) {}

        /**
         * Set the font size.
         *
         * If -1 is passed the font size is calculated based on the available {@link setWidth() width} and the text content.
         *
         * @param number $fontSize
         */
        public function setFontSize($fontSize) {}

        /**
         * Get the font object.
         *
         * @return SetaPDF_Core_Font
         */
        public function getFont() {}

        /**
         * Get the font size.
         *
         * If the font size was initially set to -1 this method will calculate the font size based on the available
         * {@link setWidth() width} and the text content.
         *
         * @return number
         */
        public function getFontSize() {}

        /**
         * Set the text.
         *
         * @param string $text
         * @param string $encoding The encoding of $text
         */
        public function setText($text, $encoding = 'UTF-8') {}

        /**
         * Get the text.
         * 
         * @param string $encoding
         * @return string
         */
        public function getText($encoding = 'UTF-8') {}

        /**
         * Set the text alignment.
         *
         * @param string $align
         */
        public function setAlign($align) {}

        /**
         * Get the text alignment.
         *
         * @return string
         */
        public function getAlign() {}

        /**
         * Set the line height / leading.
         *
         * @param float|integer|null $lineHeight
         */
        public function setLineHeight($lineHeight) {}

        /**
         * Get the line height / leading.
         * 
         * If no explicit line height is defined this method will return a line height
         * based on the lly and ury values of the font bounding box. 
         * 
         * @return number
         */
        public function getLineHeight() {}

        /**
         * Set the text color.
         *
         * @see SetaPDF_Core_DataStructure_Color::createByComponents()
         * @param SetaPDF_Core_DataStructure_Color|SetaPDF_Core_Type_Array|array|number $color
         */
        public function setTextColor($color) {}

        /**
         * Get the text color object.
         *
         * If no text color is defined the a greyscale black color will be returned
         *
         * @return SetaPDF_Core_DataStructure_Color
         */
        public function getTextColor() {}

        /**
         * Set the texts outline color.
         *
         * Only used with a specific text rendering mode.
         *
         * @see SetaPDF_Core_DataStructure_Color::createByComponents()
         * @see setRenderingMode()
         * @param SetaPDF_Core_DataStructure_Color|SetaPDF_Core_Type_Array|array|number $color
         */
        public function setOutlineColor($color) {}

        /**
         * Get the texts outline color object.
         *
         * If no outline color is defined the a greyscale black color will be returned.
         * The outline color is only used at specific rendering modes.
         *
         * @see setRenderingMode()
         * @return SetaPDF_Core_DataStructure_Color
         */
        public function getOutlineColor() {}

        /**
         * Set the outline width.
         *
         * The outline width is only used at specific rendering modes.
         *
         * @param float $outlineWidth
         */
        public function setOutlineWidth($outlineWidth) {}

        /**
         * Get the outline width.
         *
         * The outline width is only used at specific rendering modes.
         *
         * @return float
         */
        public function getOutlineWidth() {}

        /**
         * Set the background color.
         *
         * @see SetaPDF_Core_DataStructure_Color::createByComponents()
         * @param SetaPDF_Core_DataStructure_Color|SetaPDF_Core_Type_Array|array|number|null $color
         */
        public function setBackgroundColor($color) {}

        /**
         * Get the background color object.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getBackgroundColor() {}

        /**
         * Set the border color.
         *
         * @see SetaPDF_Core_DataStructure_Color::createByComponents()
         * @param SetaPDF_Core_DataStructure_Color|SetaPDF_Core_Type_Array|array|number|null $color
         */
        public function setBorderColor($color) {}

        /**
         * Get the border color object.
         *
         * If no border color is defined the a greyscale black color will be returned.
         *
         * @return null|SetaPDF_Core_DataStructure_Color
         */
        public function getBorderColor() {}

        /**
         * Set the border width.
         *
         * @param number $borderWidth
         */
        public function setBorderWidth($borderWidth) {}

        /**
         * Get the border width.
         *
         * @return number
         */
        public function getBorderWidth() {}

        /**
         * Set the width of the text block.
         * 
         * @param number $width
         */
        public function setWidth($width) {}

        /**
         * Get the width of the stamp object.
         * 
         * This method returns the complete width of the text block. To get only the width of the
         * text use the {@link getTextWidth()} method.
         * 
         * The value set in {@link setWidth()} may be differ to the one returned by this method
         * because of padding values.
         *  
         * @return number
         */
        public function getWidth() {}

        /**
         * Get the width of the longest text line.
         * 
         * @return number
         */
        public function getTextWidth() {}

        /**
         * Get the text width by an array of text lines.
         *
         * @param $fontSize
         * @param array $lines
         * @return int|mixed
         */
        private function _getTextWidth($fontSize, array $lines) {}

        /**
         * Set the rendering mode.
         *
         * @see SetaPDF_Core_Canvas_Text::setRenderingMode()
         * @param integer $renderingMode
         */
        public function setRenderingMode($renderingMode = 0) {}

        /**
         * Get the defined rendering mode.
         *
         * @see SetaPDF_Core_Canvas_Text::setRenderingMode()
         * @return number
         */
        public function getRenderingMode() {}

        /**
         * Set the padding.
         *
         * @param number $padding
         */
        public function setPadding($padding) {}

        /**
         * Set the top padding.
         *
         * @param number $paddingTop
         */
        public function setPaddingTop($paddingTop) {}

        /**
         * Get the top padding.
         *
         * @return number
         */
        public function getPaddingTop() {}

        /**
         * Set the right padding.
         *
         * @param number $paddingRight
         */
        public function setPaddingRight($paddingRight) {}

        /**
         * Get the right padding.
         *
         * @return number
         */
        public function getPaddingRight() {}

        /**
         * Set the bottom padding.
         *
         * @param number $paddingBottom
         */
        public function setPaddingBottom($paddingBottom) {}

        /**
         * Get the bottom padding.
         *
         * @return number
         */
        public function getPaddingBottom() {}

        /**
         * Set the left padding.
         *
         * @param number $paddingLeft
         */
        public function setPaddingLeft($paddingLeft) {}

        /**
         * Get the left padding.
         *
         * @return number
         */
        public function getPaddingLeft() {}

        /**
         * Set the character spacing value.
         * 
         * @param number $charSpacing
         */
        public function setCharSpacing($charSpacing) {}

        /**
         * Get the character spacing value.
         * 
         * @return number
         */
        public function getCharSpacing() {}

        /**
         * Set the word spacing value.
         *
         * @param number $wordSpacing
         */
        public function setWordSpacing($wordSpacing) {}

        /**
         * Get the word spacing value.
         *
         * @return number
         */
        public function getWordSpacing() {}

        /**
         * Get the text as lines and caches the result.
         *
         * @return array
         */
        protected function _getLines() {}

        /**
         * Get the line count of the text block.
         * 
         * @return integer
         */
        public function getLineCount() {}

        /**
         * Get the height of this text block.
         *
         * Calculation is done by number of lines, line-height and top and bottom padding values.
         *
         * @see SetaPDF_Stamper_Stamp::getHeight()
         * @return number
         */
        public function getHeight() {}

        /**
         * Get the height of the text.
         * 
         * @return number
         */
        public function getTextHeight() {}

        /**
         * Draws the text block onto a canvas.
         * 
         * @param SetaPDF_Core_Canvas $canvas
         * @param number $x The lower left x-value of the text block
         * @param number $y The lower left y-value of the text block
         */
        public function draw(\SetaPDF_Core_Canvas $canvas, $x, $y) {}

        /**
         * Get the correct x-value for the text string to start writing.
         * 
         * @param number $x
         * @return number
         */
        protected function _fixX($x) {}

        /**
         * Get the correct y-value for the text string to start writing.
         *
         * @param number $y
         * @return number
         */
        protected function _fixY($y) {}

        /**
         * Draws the text onto the canvas.
         * 
         * @param SetaPDF_Core_Canvas $canvas
         * @param number $x The lower left x-value of the text block
         * @param number $y The lower left y-value of the text block
         */
        protected function _drawText(\SetaPDF_Core_Canvas $canvas, $x, $y) {}

        /**
         * Adds rendering mode specific data onto the canvas.
         * 
         * @param SetaPDF_Core_Canvas $canvas
         */
        protected function _drawRenderingMode(\SetaPDF_Core_Canvas $canvas) {}

        /**
         * Draws the border and background onto the canvas.
         * 
         * @param SetaPDF_Core_Canvas $canvas
         * @param number $x The lower left x-value of the text block
         * @param number $y The lower left y-value of the text block
         */
        protected function _drawBorderAndBackground(\SetaPDF_Core_Canvas $canvas, $x, $y) {}

    }
}

namespace
{

    /**
     * Class representing a pair of a name object and a value in a dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Dictionary_Entry extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * The key
         *
         * @var SetaPDF_Core_Type_Name
         */
        protected $_key;

        /**
         * The value
         *
         * @var SetaPDF_Core_Type_AbstractType
         */
        protected $_value;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Name $key
         * @param SetaPDF_Core_Type_AbstractType $value
         */
        public function __construct(?\SetaPDF_Core_Type_Name $key = null, ?\SetaPDF_Core_Type_AbstractType $value = null) {}

        /**
         * Implementation of __clone().
         *
         * @see SetaPDF_Core_Type_AbstractType::__clone()
         * @internal
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Add an observer to the object.
         *
         * Implementation of the observer pattern.
         *
         * This overwritten method forwards the attach()-call to the key and value.
         *
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Triggered if a value of this object is changed.
         *
         * Forward this to the parent document.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Set the key object.
         *
         * @param SetaPDF_Core_Type_Name $key
         */
        public function setKey(\SetaPDF_Core_Type_Name $key) {}

        /**
         * Get the key object.
         *
         * @return SetaPDF_Core_Type_Name
         */
        public function getKey() {}

        /**
         * Get the key value.
         *
         * @return string
         */
        public function getKeyValue() {}

        /**
         * Set the value object.
         *
         * @param mixed $value
         * @throws InvalidArgumentException
         */
        public function setValue($value) {}

        /**
         * Get the value object.
         *
         * @return SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_IndirectReference
         */
        public function getValue() {}

        /**
         * Ensures the value.
         *
         * @param boolean $forceObservation
         * @return SetaPDF_Core_Type_AbstractType
         * @see SetaPDF_Core_Type_AbstractType::ensure()
         */
        public function ensure($forceObservation = null) {}

        /**
         * Converts the object to a pdf string.
         *
         * @param SetaPDF_Core_Document SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP array and returns it.
         *
         * @see SetaPDF_Core_Type_AbstractType::toPhp()
         * @return array
         */
        public function toPhp() {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Helper class for handling of dictionaries
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Dictionary_Helper
    {
        /**
         * Resolves an attributes value by name.
         *
         * If the $name key is in the dictionary this will return the value of this entry.
         *
         * If the $parent key is in the dictionary and is also a dictionary this will search
         * the $name key in this and return it if found.
         *
         * If nothing is found $default will be returned.
         *
         * @param SetaPDF_Core_Type_Dictionary $dict
         * @param string $name
         * @param null $default
         * @param bool $ensure
         * @param string $parentName
         * @return null|SetaPDF_Core_Type_AbstractType|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_Array
         */
        public static function resolveAttribute(\SetaPDF_Core_Type_Dictionary $dict, $name, $default = null, $ensure = true, $parentName = 'Parent') {}

        /**
         * Resolves an dictionary in a tree containing a specific name.
         *
         * If the $name key is in the dictionary this will return the dictionary.
         *
         * If the $parent key is in the dictionary and is also a dictionary this will search
         * the $name key in this and return the child dictionary.
         *
         * If nothing is found false will be returned.
         *
         * @param SetaPDF_Core_Type_Dictionary $dict
         * @param string $name attribute/key name
         * @param string $parentName
         * @return SetaPDF_Core_Type_Dictionary|boolean
         */
        public static function resolveDictionaryByAttribute(\SetaPDF_Core_Type_Dictionary $dict, $name, $parentName = 'Parent') {}

        /**
         * Resolves an object in a tree containing a specific name.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $object
         * @param string $name attribute/key name
         * @param string $parentName
         * @return boolean|SetaPDF_Core_Type_IndirectObjectInterface
         * @todo move to an object helper class
         */
        public static function resolveObjectByAttribute(\SetaPDF_Core_Type_IndirectObjectInterface $object, $name, $parentName = 'Parent') {}

        /**
         * Checks if a value of a key equals an expected value.
         * 
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         * @param string $key
         * @param mixed $value
         * @return boolean
         */
        public static function keyHasValue(\SetaPDF_Core_Type_Dictionary $dictionary, $key, $value) {}

        /**
         * Get the value.
         *
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         * @param string $key
         * @param null|mixed $defaultValue
         * @param boolean $phpValueFromScalarTypes
         * @return null
         */
        public static function getValue(\SetaPDF_Core_Type_Dictionary $dictionary, $key, $defaultValue = null, $phpValueFromScalarTypes = false) {}

    }
}

namespace
{

    /**
     * Indirect reference exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_IndirectReference_Exception extends \SetaPDF_Core_Type_Exception
    {
    }
}

namespace
{

    /**
     * Abstract class for all PDF types 
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Type_AbstractType
    {
        /**
         * The Objects to notify on any change
         *
         * This will be the PDF document or another value holding
         * this one. Initially this will be an array.
         * 
         * @var array
         */
        protected $_observers = [/** value is missing */];

        /**
         * Defines if this object is under observation
         * 
         * @var boolean
         */
        protected $_observed = false;

        /**
         * Parses a php value to a pdf string and writes it into a writer.
         *
         * PHP data type     -> PDF data type
         *
         * Null              -> SetaPDF_Core_Type_Null
         *
         * Boolean           -> SetaPDF_Core_Type_Boolean
         *
         * Integer/Double    -> SetaPDF_Core_Type_Numeric
         *
         * String            -> SetaPDF_Core_Type_String or SetaPDF_Core_Type_Name(if the string starts with "/")
         *
         * Indexed array     -> SetaPDF_Core_Type_Array
         *
         * Associative array -> SetaPDF_Core_Type_Dictionary
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param mixed $value
         * @throws InvalidArgumentException
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * The constructor.
         */
        public function __construct() {}

        /**
         * Implementation of __clone().
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Implementation of __sleep.
         * 
         * We remove the observers from all elements because they will get read if they are
         * waked up in an observed object.
         * 
         * @return array
         */
        public function __sleep() {}

        /**
         * Implementation of __wakeup.
         * 
         * Unset the observed flag.
         */
        public function __wakeup() {}

        /**
         * Add an observer to the object.
         * 
         * Implementation of the Observer Pattern.
         * 
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Checks if this object is observed.
         * 
         * @return boolean
         */
        public function isObserved() {}

        /**
         * Detach an observer from the object.
         * 
         * Implementation of the Observer Pattern.
         * 
         * @param SplObserver $observer
         */
        public function detach(\SplObserver $observer) {}

        /**
         * Detach all observers from this object.
         *
         * Be careful with this method!!!
         *
         * @ignore
         */
        public function detachAll() {}

        /**
         * Notifies all attached observers.
         * 
         * Implementation of the Observer Pattern.
         *
         * Has to be called by any method that changes a value.
         */
        public function notify() {}

        /**
         * Returns the main value.
         * 
         * This method is used for automatically resolving of
         * indirect references.
         *
         * @param boolean|null $forceObservation
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function ensure($forceObservation = null) {}

        /**
         * Sets the value of the PDF type.
         *
         * @param mixed $value
         */
        abstract public function setValue($value);

        /**
         * Gets the PDF value.
         *
         * @return mixed
         */
        abstract public function getValue();

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        abstract public function toPdfString(\SetaPDF_Core_Document $pdfDocument);

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        abstract public function writeTo(\SetaPDF_Core_Document $pdfDocument);

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         * 
         * @return mixed
         */
        abstract public function toPhp();

        /**
         * This method is used to clean up an object by releasing memory and references.
         * 
         * The observers has to be removed with the detach()-method. Only if there is no observer left
         * this method should really release resources.
         * 
         * The method has to be implemented by each object type
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Class representing an array
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Array extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * The values
         *
         * An array of {@link SetaPDF_Core_Type_AbstractType} objects
         *
         * @var $_values array
         */
        protected $_values = [/** value is missing */];

        /**
         * The array count
         *
         * @var integer
         */
        protected $_count = 0;

        /**
         * Parses a php array to a pdf array string and writes it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array $values
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $values) {}

        /**
         * The constructor.
         *
         * @param array $values An array filled with values of type SetaPDF_Core_Type_AbstractType
         * @throws InvalidArgumentException
         */
        public function __construct(?array $values = null) {}

        /**
         * Implementation of {@link http://www.php.net/language.oop5.cloning.php#object.clone __clone()}.
         *
         * @see SetaPDF_Core_Type_AbstractType::__clone()
         * @internal
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Add an observer to the object.
         *
         * This method forwards the attach()-call
         * to all values of this array.
         *
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Triggered if a value of this object is changed.
         *
         * Forward this to other observers.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Sets the values.
         *
         * @param array|SetaPDF_Core_Type_Array $values An array of SetaPDF_Core_Type_AbstractType objects
         * @throws InvalidArgumentException
         */
        public function setValue($values) {}

        /**
         * Gets the value.
         *
         * @return array
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @see SetaPDF_Core_Type_AbstractType::toPhp()
         * @return array
         */
        public function toPhp() {}

        /**
         * Returns the number of elements in the array.
         *
         * @link http://www.php.net/Countable.count Countable::count
         * @return int
         */
        public function count() {}

        /**
         * Checks whether a offset exists.
         *
         * @link http://www.php.net/ArrayAccess.offsetExists ArrayAccess::offsetExists
         * @param int $offset An offset to check for.
         * @return boolean
         */
        public function offsetExists($offset) {}

        /**
         * Offset to retrieve.
         *
         * @link http://www.php.net/ArrayAccess.offsetGet ArrayAccess::offsetGet
         * @param int $offset The offset to retrieve.
         * @return SetaPDF_Core_Type_AbstractType|null
         */
        public function offsetGet($offset) {}

        /**
         * Offset to set.
         *
         * @link http://www.php.net/ArrayAccess.offsetSet ArrayAccess::offsetSet
         * @param null|int $offset The offset to assign the value to.
         * @param SetaPDF_Core_Type_AbstractType $value The value to set.
         * @throws InvalidArgumentException
         */
        public function offsetSet($offset, $value) {}

        /**
         * Checks whether a offset exists.
         *
         * @link http://www.php.net/ArrayAccess.offsetUnset ArrayAccess::offsetUnset
         * @param string $offset
         */
        public function offsetUnset($offset) {}

        /**
         * Prepends one element to the beginning of the array.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         */
        public function unshift(\SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Inserts an element before another one.
         *
         * Index mustn't be higher than the count of elements in array.
         *
         * Index 0 is allowed in an empty array.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         * @param null|integer $beforeIndex
         * @throws InvalidArgumentException
         */
        public function insertBefore(\SetaPDF_Core_Type_AbstractType $value, $beforeIndex = 0) {}

        /**
         * Pushes a value onto the end of the array.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         */
        public function push(\SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Merges this PDF array with other PDF arrays.
         *
         * @params SetaPDF_Core_Type_Array Any number of arrays
         * @throws InvalidArgumentException
         */
        public function merge() {}

        /**
         * Merges this PDF array with other PDF arrays while only taking not existing values.
         *
         * @params SetaPDF_Core_Type_Array Any number of arrays
         * @throws InvalidArgumentException
         */
        public function mergeUnique() {}

        /**
         * Clears the array.
         */
        public function clear() {}

        /**
         * Returns the index of the element.
         *
         * If the element isn't in this array -1 will returned.
         *
         * @param SetaPDF_Core_Type_AbstractType $element
         * @return int
         */
        public function indexOf(\SetaPDF_Core_Type_AbstractType $element) {}

        /**
         * Returns the current element.
         *
         * @link http://www.php.net/Iterator.current Iterator::current
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function current() {}

        /**
         * Moves forward to next element.
         *
         * @link http://www.php.net/Iterator.next Iterator::next
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function next() {}

        /**
         * Returns the key of the current element.
         *
         * @link http://www.php.net/Iterator.key Iterator::key
         * @return integer
         */
        public function key() {}

        /**
         * Checks if current position is valid.
         *
         * @see http://www.php.net/Iterator.valid
         * @return boolean
         */
        public function valid() {}

        /**
         * Rewinds the Iterator to the first element.
         *
         * @link http://www.php.net/Iterator.rewind Iterator::rewind
         */
        public function rewind() {}

        /**
         * Returns an iterator for the current entry.
         *
         * @link http://www.php.net/RecursiveIterator.getChildren RecursiveIterator::getChildren
         * @return array
         */
        public function getChildren() {}

        /**
         * Check whether the current entry is an SetaPDF_Core_Type_Array.
         *
         * @link http://www.php.net/RecursiveIterator.hasChildren RecursiveIterator::hasChildren
         * @return boolean
         */
        public function hasChildren() {}

    }
}

namespace
{

    /**
     * Class representing a boolean value
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Boolean extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The value
         * 
         * @var $_value boolean
         */
        protected $_value = false;

        /**
         * Parses a boolean value to a pdf boolean string and writes it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param boolean $value
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * The constructor.
         * 
         * @param boolean $value
         */
        public function __construct($value = null) {}

        /**
         * Implementation of __wakeup.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Set the value.
         * 
         * @param boolean $value
         */
        public function setValue($value) {}

        /**
         * Gets the value.
         * 
         * @return boolean
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         * 
         * @return boolean
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * This class acts like a proxy for all available SetaPDF_Core_Type_* classes
     *
     * The class allows a developer to attach callbacks before and/or after any
     * native method of the original type instance.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Callback extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * @var SetaPDF_Core_Type_AbstractType
         */
        protected $_value;

        /**
         * @var callback
         */
        protected $_callbacks;

        /**
         * Constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Add a callback before or after a specific method call.
         *
         * @param string $method
         * @param callback $callback
         * @param bool $before
         * @throws InvalidArgumentException
         */
        public function addCallback($method, $callback, $before = true) {}

        /**
         * Implementation of __clone().
         *
         * @internal
         */
        public function __clone() {}

        /**
         * Overloads all method calls.
         *
         * @param string $method
         * @param array $arguments
         * @return mixed
         * @throws BadMethodCallException
         */
        public function __call($method, array $arguments) {}

        /**
         * Sets the value of the PDF type.
         *
         * @param mixed $value
         */
        public function setValue($value) {}

        /**
         * Gets the PDF value.
         *
         * @return mixed
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return mixed
         */
        public function toPhp() {}

        /**
         * Release resources/memory.
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * Class representing a dictionary
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Dictionary extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * The entries/values in the dictionary
         *
         * @var array An array of SetaPDF_Core_Type_Dictionary_Entry objects
         */
        protected $_entries = [/** value is missing */];

        /**
         * Defines if this object make use of pdf string callbacks
         *
         * @var boolean
         */
        protected $_usePdfStringCallbacks = false;

        /**
         * An array of callbacks before this object is converted to a PDF string.
         *
         * @var array
         */
        protected $_pdfStringCallbacks = [/** value is missing */];

        /**
         * Parses an associative array to a pdf dictionary string and writes it to a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param array $values
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $values) {}

        /**
         * The constructor.
         *
         * @param array $entries An array filled with SetaPDF_Core_Type_Dictionary_Entry OR an associative array
         * @throws InvalidArgumentException
         */
        public function __construct(?array $entries = null) {}

        /**
         * Implementation of {@link http://www.php.net/language.oop5.magic.php#object.wakeup __wakeup()}.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Implementation of {@link http://www.php.net/language.oop5.cloning.php#object.clone __clone()}.
         *
         * @see SetaPDF_Core_Type_AbstractType::__clone()
         * @internal
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Add an observer to the object.
         *
         * Implementation of the Observer Pattern. This overwritten method forwards the attach()-call
         * to all dictionary values.
         *
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Triggered if a value of this object is changed. Forward this to the "parent" object.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Set the values of the dictionary.
         *
         * @param array $entries Array of SetaPDF_Core_Type_Dictionary_Entry objects
         * @throws InvalidArgumentException
         */
        public function setValue($entries) {}

        /**
         * Gets the value.
         *
         * Returns all entries of this dictionary or a specific value of a named entry.
         *
         * @param string|null $offset The name of the entry or null to receive all entries
         * @return array|SetaPDF_Core_Type_AbstractType|null An array of SetaPDF_Core_Type_Dictionary_Entry objects,
         *          a SetaPDF_Core_Type_AbstractType instance or null if the given offset was not found
         */
        public function getValue($offset = null) {}

        /**
         * Returns the key names.
         *
         * @return array
         */
        public function getKeys() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return array
         */
        public function toPhp() {}

        /**
         * Checks whether a offset exists.
         *
         * @link http://www.php.net/ArrayAccess.offsetExists ArrayAccess::offsetExists
         * @param string $offset An offset to check for.
         * @return boolean
         */
        public function offsetExists($offset) {}

        /**
         * Offset to retrieve.
         *
         * @link http://www.php.net/ArrayAccess.offsetGet ArrayAccess::offsetGet
         * @param string $offset The offset to retrieve.
         * @return SetaPDF_Core_Type_Dictionary_Entry
         */
        public function offsetGet($offset) {}

        /**
         * Offset to set.
         *
         * If offset is null then the value need to be a SetaPDF_Core_Type_Dictionary_Entry.
         *
         * If value is scalar and offset is already set the setValue method of the offset will be used.
         *
         * Otherwise it should be an instance of SetaPDF_Core_Type_AbstractType.
         *
         * @link http://www.php.net/ArrayAccess.offsetSet ArrayAccess::offsetSet
         * @param null|string|SetaPDF_Core_Type_Name $offset The offset to assign the value to.
         * @param SetaPDF_Core_Type_Dictionary_Entry|SetaPDF_Core_Type_AbstractType|mixed $value The value to set.
         * @throws InvalidArgumentException
         */
        public function offsetSet($offset, $value) {}

        /**
         * Checks whether a offset exists.
         *
         * @link http://www.php.net/ArrayAccess.offsetUnset ArrayAccess::offsetUnset
         * @param string $offset
         */
        public function offsetUnset($offset) {}

        /**
         * Returns the number of elements in the dictionary.
         *
         * @link http://www.php.net/Countable.count Countable::count
         * @return int
         */
        public function count() {}

        /**
         * Returns the current element.
         *
         * @link http://www.php.net/Iterator.current Iterator::current
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function current() {}

        /**
         * Moves forward to next element.
         *
         * @link http://www.php.net/Iterator.next Iterator::next
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function next() {}

        /**
         * Returns the key of the current element.
         *
         * @link http://www.php.net/Iterator.key Iterator::key
         * @return integer
         */
        public function key() {}

        /**
         * Checks if current position is valid.
         *
         * @see http://www.php.net/Iterator.valid Iterator::valid
         * @return boolean
         */
        public function valid() {}

        /**
         * Rewinds the Iterator to the first element.
         *
         * @link http://www.php.net/Iterator.rewind Iterator::rewind
         */
        public function rewind() {}

        /**
         * Register a callback function which is called before the object is converted to a PDF string.
         *
         * @param callback $callback
         * @param string $name
         */
        public function registerPdfStringCallback($callback, $name) {}

        /**
         * Unregister a callback function.
         *
         * @param string $name
         */
        public function unRegisterPdfStringCallback($name) {}

        /**
         * Execute the registered callbacks before the object is converted to a PDF string.
         */
        protected function _handlePdfStringCallback() {}

    }
}

namespace
{

    /**
     * Type exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * Class representing a hexadecimal string
     
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_HexString extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_StringValue, \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The value
         * 
         * @var string
         */
        protected $_value = '';

        /**
         * The owning object
         * 
         * @var SetaPDF_Core_Type_AbstractType
         */
        protected $_owningObject;

        /**
         * Flag indicating if the string is currently encrypted
         * 
         * @var boolean
         */
        protected $_encrypted = false;

        /**
         * Flag indicating that the object should bypass the security handler
         * 
         * @var boolean
         */
        protected $_bypassSecHandler = false;

        /**
         * A singleton AsciiHex filter instance
         * 
         * @var SetaPDF_Core_Filter_AsciiHex
         */
        private static $_filter;

        /**
         * Singleton method to get an AsciiHex filter instance.
         * 
         * @return SetaPDF_Core_Filter_AsciiHex
         */
        private static function _getFilter() {}

        /**
         * Converts a hex encoded string to a normal string.
         * 
         * @param string $hex
         * @return string
         */
        public static function hex2str($hex) {}

        /**
         * Converts a string to a hex encoded string.
         * 
         * @param string $str
         * @return string
         */
        public static function str2hex($str) {}

        /**
         * Writes a string as hex encoded string to a writer instance.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param string $value
         * @param boolean $fromString Convert the string to hex encoded string
         * @return string|void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value, $fromString = true) {}

        /**
         * The constructor.
         * 
         * @param string $value
         * @param boolean $fromString
         * @param SetaPDF_Core_Type_AbstractType $owningObject
         */
        public function __construct($value = null, $fromString = true, $owningObject = null) {}

        /**
         * Implementation of __wakeup.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Set the value.
         * 
         * @param string $value
         * @param boolean $fromString
         */
        public function setValue($value, $fromString = true) {}

        /**
         * Get the value.
         * 
         * If $asString is set to true the value will be passed to the {@link hex2str()} method
         * before it is returned.
         * 
         * @param boolean $asString
         * @return string
         */
        public function getValue($asString = true) {}

        /**
         * Bypass the security handler or not.
         * 
         * @param boolean $bypassSecHandler
         */
        public function setBypassSecHandler($bypassSecHandler = true) {}

        /**
         * Decrypts the value.
         * 
         * @return string
         */
        protected function _decrypt() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release memory.
         * 
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @see SetaPDF_Core_Type_AbstractType::toPhp()
         * @return string
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing an indirect object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_IndirectObject extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * The value of the indirect object
         *
         * @var SetaPDF_Core_Type_AbstractType
         */
        protected $_value;

        /**
         * The initial object id
         *
         * @var int
         */
        protected $_objectId;

        /**
         * The initial generation number
         *
         * @var integer
         */
        protected $_gen = 0;

        /**
         * The owner object
         *
         * @var SetaPDF_Core_Type_Owner
         */
        protected $_owner;

        /**
         * The object identifier
         *
         * @var string
         */
        protected $_objectIdent;

        /**
         * The constructor.
         *
         * @param null|SetaPDF_Core_Type_AbstractType $value
         * @param SetaPDF_Core_Type_Owner $owner
         * @param integer $objectId
         * @param integer $gen
         * @throws InvalidArgumentException
         */
        public function __construct(?\SetaPDF_Core_Type_AbstractType $value = null, ?\SetaPDF_Core_Type_Owner $owner = null, $objectId = 0, $gen = 0) {}

        /**
         * Implementation of __clone().
         *
         * This has to be used with care, because a single object can only be used one time per document.
         * You only should use this, if you want to extract an object of an existing document and
         * reuse it changed in another one.
         *
         * The internal object-, generation number and document references are kept.
         *
         * At the end several objects will have the same object identifier!!
         *
         * @see SetaPDF_Core_Type_AbstractType::__clone()
         * @internal
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Implementation of __sleep().
         *
         * We also return observers for this object because it is needed if the object is unserialized as part
         * of a document.
         *
         * @see SetaPDF_Core_Type_AbstractType::__sleep()
         * @internal
         */
        public function __sleep() {}

        /**
         * Implementation of __wakeup-
         *
         * Forward/reinit observation after unserialization.
         *
         * @see SetaPDF_Core_Type_AbstractType::__wakeup()
         * @internal
         */
        public function __wakeup() {}

        /**
         * Returns the initial object id.
         *
         * @return integer
         */
        public function getObjectId() {}

        /**
         * Returns the initial generation number.
         *
         * @return integer
         */
        public function getGen() {}

        /**
         * Returns the owner document.
         *
         * @return SetaPDF_Core_Document
         */
        public function getOwnerPdfDocument() {}

        /**
         * Get the owner object of this indirect object.
         *
         * @return SetaPDF_Core_Type_Owner
         */
        public function getOwner() {}

        /**
         * Observe the object if an owner document is attached.
         */
        public function observe() {}

        /**
         * Add an observer to the object.
         *
         * Implementation of the Observer Pattern. This overwritten method forwards the attach()-call
         * to the value of the indirect object.
         *
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Triggered if a value of this object is changed.
         *
         * Forward this to other observing objects.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Get the Object Identifier.
         *
         * This identifier has nothing to do with the object numbers
         * of a PDF document. They will be used to map an object to
         * document related object numbers.
         *
         * @return string
         */
        public function getObjectIdent() {}

        /**
         * Sets the value of the PDF type.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         * @throws InvalidArgumentException
         */
        public function setValue($value) {}

        /**
         * Gets the PDF value.
         *
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function getValue() {}

        /**
         * Ensures the access to the value.
         *
         * This method automatically forwards the request to the value.
         *
         * @param boolean|null $forceObservation
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function ensure($forceObservation = null) {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @see SetaPDF_Core_Type_AbstractType::toPhp()
         * @return array
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Interface indirect objects and object references
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Type_IndirectObjectInterface
    {
        /**
         * Returns the initial object id.
         *
         * @return integer
         */
        public function getObjectId();

        /**
         * Returns the initial generation number.
         *
         * @return integer
         */
        public function getGen();

        /**
         * Get the Object Identifier.
         *
         * This identifier has nothing to do with the object numbers
         * of a PDF document. They will be used to map an object to
         * document related object numbers.
         *
         * @return string
         */
        public function getObjectIdent();

        /**
         * Returns the owner document.
         *
         * @return SetaPDF_Core_Document
         */
        public function getOwnerPdfDocument();

        /**
         * Ensures the access to the value.
         *
         * @param boolean $forceObservation
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function ensure($forceObservation = null);

    }
}

namespace
{

    /**
     * Class representing an indirect reference
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_IndirectReference extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_IndirectObjectInterface
    {
        /**
         * The owner instance
         *
         * @var SetaPDF_Core_Type_Owner
         */
        protected $_owner;

        /**
         * The initial object id
         *
         * @var int
         */
        protected $_objectId;

        /**
         * The initial generation number
         *
         * @var integer
         */
        protected $_gen = 0;

        /**
         * The object identifier
         *
         * @var string
         */
        protected $_objectIdent;

        /**
         * The constructor.
         *
         * @param integer|SetaPDF_Core_Type_IndirectObject $objectId
         * @param integer|null $gen
         * @param SetaPDF_Core_Type_Owner $owner
         * @throws InvalidArgumentException
         */
        public function __construct($objectId, $gen = 0, ?\SetaPDF_Core_Type_Owner $owner = null) {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @throws SetaPDF_Core_Type_IndirectReference_Exception
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Automatically resolves the indirect reference to the object.
         *
         * The $forceObservation is used to forward/handle the observer pattern.
         *
         * If it is set to true or this object is observed already the resolved object will get observed automatically.
         *
         * If the parameter is set to false, the document is detached from the resolved object,
         * so that it is only possible to use this object as a read only object.
         *
         * @param boolean $forceObservation If this is set to true, the resolved object will be observed automatically
         * @return SetaPDF_Core_Type_AbstractType
         * @throws SetaPDF_Core_Type_IndirectReference_Exception
         */
        public function ensure($forceObservation = null) {}

        /**
         * Returns the initial object id.
         *
         * @return integer
         */
        public function getObjectId() {}

        /**
         * Returns the initial generation number.
         *
         * @return integer
         */
        public function getGen() {}

        /**
         * Returns the owner document.
         *
         * @return SetaPDF_Core_Document
         */
        public function getOwnerPdfDocument() {}

        /**
         * Get the owner object of this indirect object.
         *
         * @return SetaPDF_Core_Type_Owner
         */
        public function getOwner() {}

        /**
         * Get the Object Identifier.
         *
         * This identifier has nothing to do with the object numbers
         * of a PDF document. They will be used to map an object to
         * document related object numbers.
         *
         * @return string
         */
        public function getObjectIdent() {}

        /**
         * Set the indirect object value.
         *
         * @param SetaPDF_Core_Type_IndirectObject $value
         * @throws InvalidArgumentException
         */
        public function setValue($value) {}

        /**
         * Get the indirect object.
         *
         * @return null|SetaPDF_Core_Type_IndirectObject
         * @throws SetaPDF_Core_Type_IndirectReference_Exception
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @see SetaPDF_Core_Type_AbstractType::toPhp()
         * @return array
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing a name object
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Name extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The plaintext value
         * 
         * @var string
         */
        protected $_value = '';

        /**
         * The escaped value
         * 
         * @var string
         */
        protected $_rawValue = '';

        /**
         * Converting a character into a 2-digit hexadecimal code prefixed by a number sign.
         * 
         * @param array $matches
         * @return string
         */
        protected static function _escapeChar($matches) {}

        /**
         * Converts a 2-digit hexadecimal code representation into a single byte/character.
         * 
         * @param array $matches
         * @return string
         */
        protected static function _unescapeChar($matches) {}

        /**
         * Escapes a name string.
         * 
         * @param string $value
         * @return string
         */
        public static function escape($value) {}

        /**
         * Unescapes a name string.
         * 
         * @param string $value
         * @return string
         */
        public static function unescape($value) {}

        /**
         * Parses a php string value to a pdf name string and write it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param string $value
         * @param boolean $isRawValue
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value, $isRawValue = false) {}

        /**
         * The constructor.
         * 
         * @param string $value
         * @param boolean $raw
         */
        public function __construct($value = null, $raw = false) {}

        /**
         * Implementation of __wakeup.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Set the name value.
         * 
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         * @param mixed $value
         */
        public function setValue($value) {}

        /**
         * Get the name value.
         * 
         * @see SetaPDF_Core_Type_AbstractType::getValue()
         * @return string
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return string
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing a null object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Null extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * Parses a php null value to a pdf null string and writes it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param null $value
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * Implementation of the abstract setValue() method which is useless for this object type.
         * 
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         * @param null $value
         * @throws SetaPDF_Core_Type_Exception
         */
        public function setValue($value) {}

        /**
         * Get the null value.
         *
         * @see SetaPDF_Core_Type_AbstractType::getValue()
         * @return null
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return null
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing a numeric object
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Numeric extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The numeric value
         * 
         * @var integer|float
         */
        protected $_value = 0;

        /**
         * This helper method simulates the overflow behavior of a 32bit system on a 64bit system.
         * 
         * @param integer $value
         * @return integer
         */
        public static function ensure32BitInteger($value) {}

        /**
         * Parses a php integer or float value to a pdf numeric string and write it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param integer|float $value
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * The constructor.
         * 
         * @param integer|float $value
         */
        public function __construct($value = null) {}

        /**
         * Set the numeric value.
         * 
         * @param float|integer $value
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         */
        public function setValue($value) {}

        /**
         * Ger the numeric value.
         *
         * @return float
         * @see SetaPDF_Core_Type_AbstractType::getValue()
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return float
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing an object stream object.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_ObjectStream extends \SetaPDF_Core_Type_Stream implements \SetaPDF_Core_Type_Owner
    {
        /**
         * The stream parser instance.
         *
         * @var SetaPDF_Core_Parser_Pdf
         */
        private $_parser;

        /**
         * An array of object offsets in the stream keyed by object ids.
         *
         * @var array
         */
        private $_objectOffsets = [/** value is missing */];

        /**
         * The document instance to which this object stream belongs to.
         *
         * @var SetaPDF_Core_Type_Owner
         */
        private $_owner;

        /**
         * Defines if a inner object had triggered a change to invalid the state of this object stream.
         *
         * @var bool
         */
        private $_valid = true;

        /**
         * Release memory/cycled references.
         */
        public function cleanUp() {}

        /**
         * Set the owner instance.
         *
         * @param SetaPDF_Core_Type_Owner $owner
         */
        public function setOwner(\SetaPDF_Core_Type_Owner $owner) {}

        /**
         * Get the owner instance.
         *
         * @return SetaPDF_Core_Type_Owner
         */
        public function getOwner() {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getOwnerPdfDocument() {}

        /**
         * Get the stream parser.
         *
         * @return SetaPDF_Core_Parser_Pdf
         */
        protected function _getParser() {}

        /**
         * Get the offset value for a specific object id.
         *
         * @param integer $objectId
         * @return integer
         * @throws SetaPDF_Core_Document_ObjectNotFoundException
         */
        protected function _getObjectOffset($objectId) {}

        /**
         * Get the offsets of all objects in this object stream.
         *
         * @return array
         */
        public function getOffsets() {}

        /**
         * Resolves an indirect object in this object stream.
         *
         * @param integer $objectId
         * @return SetaPDF_Core_Type_IndirectObject
         * @throws SetaPDF_Core_Document_ObjectNotFoundException
         * @throws SetaPDF_Core_Exception
         */
        public function resolveIndirectObject($objectId) {}

        /**
         * Triggered if a value of this object is changed. Forward this to the document in that case.
         *
         * A stream can only be observed by an indirect object.
         *
         * So let's check the observers for this type and forward it to its owning document instance
         * until we manage creation of object streams.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Checks wheter an object of this objects stream was changed or not.
         *
         * @return bool
         */
        public function isValid() {}

    }
}

namespace
{

    /**
     * Interface representing an owner object which encapsulates other data.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Type_Owner
    {
    }
}

namespace
{

    /**
     * Interface for scalar values
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     * @see SetaPDF_Core_Type_String, SetaPDF_Core_Type_HexString
     */
    interface SetaPDF_Core_Type_ScalarValue
    {
    }
}

namespace
{

    /**
     * Class representing a stream object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Stream extends \SetaPDF_Core_Type_AbstractType
    {
        /**
         * The dictionary of the stream object
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_value;

        /**
         * The stream content
         *
         * @var string
         */
        protected $_stream = '';

        /**
         * The unfiltered stream content
         *
         * @var string
         */
        protected $_unfilteredStream;

        /**
         * Flag saying that the current stream data is filtered or not
         *
         * @var boolean
         */
        protected $_filtered = false;

        /**
         * The original owning object
         *
         * Needed if the stream is encrypted
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_owningObject;

        /**
         * Flag saying that the stream is encrypted or not
         *
         * @var boolean
         */
        protected $_encrypted = false;

        /**
         * Flag saying that this stream should by pass the security handler
         *
         * @var boolean
         */
        protected $_bypassSecHandler = false;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary $value
         * @param string $stream
         * @param SetaPDF_Core_Type_IndirectObject $owningObject
         */
        public function __construct(?\SetaPDF_Core_Type_Dictionary $value = null, $stream = '', ?\SetaPDF_Core_Type_IndirectObject $owningObject = null) {}

        /**
         * Implementation of __wakeup.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Implementation of __clone().
         *
         * @see SetaPDF_Core_Type_AbstractType::__clone()
         * @internal
         */
        public function __clone() {}

        /**
         * Clone the object recursively in the context of a document.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function deepClone(\SetaPDF_Core_Document $document) {}

        /**
         * Add an observer to the object.
         *
         * Implementation of the Observer Pattern.
         *
         * @param SplObserver $observer
         */
        public function attach(\SplObserver $observer) {}

        /**
         * Triggered if a value of this object is changed. Forward this to the object.
         *
         * @param SplSubject $SplSubject
         */
        public function update(\SplSubject $SplSubject) {}

        /**
         * Set the PDF dictionary for this stream object.
         *
         * @param SetaPDF_Core_Type_Dictionary $value The value
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         * @throws InvalidArgumentException
         */
        public function setValue($value) {}

        /**
         * Get the dictionary of this stream.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getValue() {}

        /**
         * Set the stream content.
         *
         * @param string $stream
         */
        public function setStream($stream) {}

        /**
         * Get the plain stream content.
         *
         * @param boolean $filtered
         * @return string
         */
        public function getStream($filtered = false) {}

        /**
         * Append a stream to the existing stream.
         *
         * @param string $bytes
         */
        public function appendStream($bytes) {}

        /**
         * Alias for SetaPDF_Core_Type_Stream::appendStream.
         *
         * @param string $bytes
         */
        public function write($bytes) {}

        /**
         * Clears the stream.
         */
        public function clear() {}

        /**
         * Set the bypass security handler flag.
         *
         * @param boolean $bypassSecHandler
         */
        public function setBypassSecHandler($bypassSecHandler = true) {}

        /**
         * Decrypts the stream (if needed).
         *
         * @return string
         */
        protected function _decrypt() {}

        /**
         * Unfilter the stream.
         */
        public function unfilterStream() {}

        /**
         * Checks if an Crypt is defined for this stream.
         */
        public function hasCryptFilter() {}

        /**
         * Applies filter to the stream.
         *
         * @param string $stream
         * @param boolean $encode
         * @param SetaPDF_Core_Document $pdfDocument The document, on which the stream will get used. This value is only needed for a crypt filter (to be implemented!)
         * @return mixed
         * @throws SetaPDF_Exception
         * @throws SetaPDF_Exception_NotImplemented
         */
        protected function _applyFilter($stream, $encode = false, ?\SetaPDF_Core_Document $pdfDocument = null) {}

        /**
         * Pre-Process the stream for the output in a specific PDF document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return mixed|string
         */
        protected function _preProcess(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return array
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Class representing a string
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_String extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_StringValue, \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The plaintext value
         * 
         * @var string
         */
        protected $_value = '';

        /**
         * The escaped/encrypted value
         * 
         * @var string
         */
        protected $_rawValue = '';

        /**
         * The original owning object.
         * 
         * Needed if the string is encrypted
         * 
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_owningObject;

        /**
         * Flag saying that the stream is encrypted or not
         *
         * @var boolean
         */
        protected $_encrypted = false;

        /**
         * Flag saying that this stream should by pass the security handler
         *
         * @var boolean
         */
        protected $_bypassSecHandler = false;

        /**
         * Escapes sequences in a string according to the PDF specification.
         *  
         * @param string $s
         * @return string
         */
        public static function escape($s) {}

        /**
         * Unescapes escaped sequences in a PDF string according to the PDF specification.
         *
         * @param string $s
         * @return string
         */
        public static function unescape($s) {}

        /**
         * Parses a php string value to a pdf string and write it into a writer.
         *
         * @see SetaPDF_Core_Type_AbstractType
         * @param SetaPDF_Core_WriteInterface $writer
         * @param string|mixed $value If it's not a string, it need to have a __toString() implementation.
         * @return void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * The constructor.
         * 
         * @param string $value
         * @param boolean $raw
         * @param SetaPDF_Core_Type_IndirectObject $owningObject
         */
        public function __construct($value = '', $raw = false, ?\SetaPDF_Core_Type_IndirectObject $owningObject = null) {}

        /**
         * Implementation of __wakeup.
         *
         * @internal
         */
        public function __wakeup() {}

        /**
         * Set the string value.
         *
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         * @param string $value
         */
        public function setValue($value) {}

        /**
         * Get the string value.
         *
         * @see SetaPDF_Core_Type_AbstractType::getValue()
         * @return string
         */
        public function getValue() {}

        /**
         * Set the bypass security handler flag.
         *
         * @param boolean $bypassSecHandler
         */
        public function setBypassSecHandler($bypassSecHandler = true) {}

        /**
         * Decrypts the string (if needed).
         *
         * @return string
         */
        protected function _decrypt() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Release objects/memory.
         *
         * @see SetaPDF_Core_Type_AbstractType::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return string
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Interface for string values
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     * @see SetaPDF_Core_Type_String, SetaPDF_Core_Type_HexString
     */
    interface SetaPDF_Core_Type_StringValue
    {
    }
}

namespace
{

    /**
     * Class representing a token
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Type
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Type_Token extends \SetaPDF_Core_Type_AbstractType implements \SetaPDF_Core_Type_ScalarValue
    {
        /**
         * The token value
         * 
         * @var boolean|string
         */
        protected $_value = false;

        /**
         * Parses a string value to a pdf token string and writes it into a writer.
         *
         * @param SetaPDF_Core_WriteInterface $writer
         * @param null|string $value
         * @return string|void
         */
        public static function writePdfString(\SetaPDF_Core_WriteInterface $writer, $value) {}

        /**
         * The constructor.
         * 
         * @param string $value
         */
        public function __construct($value = null) {}

        /**
         * Set the token value.
         * 
         * @param string $value
         * @see SetaPDF_Core_Type_AbstractType::setValue()
         */
        public function setValue($value) {}

        /**
         * Get the token value.
         * 
         * @return string
         * @see SetaPDF_Core_Type_AbstractType::getValue()
         */
        public function getValue() {}

        /**
         * Returns the type as a formatted PDF string.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         * @return string
         */
        public function toPdfString(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Writes the type as a formatted PDF string to the document.
         *
         * @param SetaPDF_Core_Document $pdfDocument
         */
        public function writeTo(\SetaPDF_Core_Document $pdfDocument) {}

        /**
         * Converts the PDF data type to a PHP data type and returns it.
         *
         * @return string
         */
        public function toPhp() {}

    }
}

namespace
{

    /**
     * Abstract class for a writer object
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Writer_AbstractWriter
    {
        /**
         * Status property
         * 
         * @var string
         */
        protected $_status = 0;

        /**
         * Method which should/will be called when the writing process starts.
         */
        public function start() {}

        /**
         * Method which should/will be called when the writing process is finished.
         */
        public function finish() {}

        /**
         * Get the current status of the writer object.
         * 
         * @return string
         */
        public function getStatus() {}

        /**
         * Method which should/will be called when the document objects cleanUp() method is called.
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * A class representing a binary writer
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Binary
    {
        /**
         * Big endian byte order
         *
         * @var string
         */
        const BYTE_ORDER_BIG_ENDIAN = 'bigEndian';

        /**
         * Little endian byte order
         *
         * @var string
         */
        const BYTE_ORDER_LITTLE_ENDIAN = 'littleEndian';

        /**
         * The main writer instance
         *
         * @var SetaPDF_Core_Writer_WriterInterface
         */
        protected $_writer;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer
         */
        public function __construct(\SetaPDF_Core_Writer_WriterInterface $writer) {}

        /**
         * Release resources/cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the writer.
         *
         * @return SetaPDF_Core_Writer_WriterInterface
         */
        public function getWiter() {}

        /**
         * Writes a 8-bit/1-byte signed integer.
         *
         * @param integer $int
         * @return self
         */
        public function writeInt8($int) {}

        /**
         * Writes a 8-bit/1-byte unsigned integer.
         * @param integer $int
         *
         * @return self
         */
        public function writeUInt8($int) {}

        /**
         * Writes a 16-bit signed integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return self
         */
        public function writeInt16($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 16-bit unsigned integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return self
         */
        public function writeUInt16($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 32-bit signed integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return mixed
         */
        public function writeInt32($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 32-bit unsigned integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return mixed
         */
        public function writeUInt32($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes various bytes.
         *
         * @param string $bytes
         */
        public function writeBytes($bytes) {}

    }
}

namespace
{

    /**
     * A writer class which chains different writer objects
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Chain extends \SetaPDF_Core_Writer_AbstractWriter implements \SetaPDF_Core_Writer_WriterInterface
    {
        /**
         * Writer instances
         *
         * @var SetaPDF_Core_Writer_WriterInterface[]
         */
        protected $_writers = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Writer_WriterInterface[] $writers An array of writer instances
         */
        public function __construct(array $writers = [/** value is missing */]) {}

        /**
         * Add a writer object to the chain.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer
         */
        public function addWriter(\SetaPDF_Core_Writer_WriterInterface $writer) {}

        /**
         * Method which should/will be called when the writing process starts.
         *
         * @throws SetaPDF_Core_Writer_Exception
         */
        public function start() {}

        /**
         * Forward the string to the registered writer objects.
         *
         * @param string $s
         */
        public function write($s) {}

        /**
         * Forward the finish() call to the registered writer objects.
         */
        public function finish() {}

        /**
         * Proxy method for the getPos() method.
         *
         * @see SetaPDF_Core_Writer_WriterInterface::getPos()
         */
        public function getPos() {}

        /**
         * Forwards the cleanUp() call to the registered writer objects.
         *
         * @see SetaPDF_Core_Writer_AbstractWriter::cleanUp()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * A writer class which uses simple echo calls
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Echo extends \SetaPDF_Core_Writer_AbstractWriter implements \SetaPDF_Core_Writer_WriterInterface
    {
        /**
         * The current position
         *
         * @var integer
         */
        protected $_pos = 0;

        /**
         * Echo the string.
         *
         * @param string $s
         */
        public function write($s) {}

        /**
         * Returns the current position.
         *
         * @return integer
         */
        public function getPos() {}

    }
}

namespace
{

    /**
     * Writer exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Exception extends \SetaPDF_Core_Exception
    {
    }
}

namespace
{

    /**
     * A writer class for files or writable streams
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_File extends \SetaPDF_Core_Writer_AbstractWriter implements \SetaPDF_Core_Writer_WriterInterface, \SetaPDF_Core_Writer_FileInterface
    {
        /**
         * Path to the output file
         *
         * @var string
         */
        protected $_path;

        /**
         * The file handle resource
         *
         * @var null|resource
         */
        protected $_handle;

        /**
         * The constructor.
         *
         * @param string $path The path to the output file
         */
        public function __construct($path) {}

        /**
         * Get the file path of the writer.
         *
         * @return string
         */
        public function getPath() {}

        /**
         * Method called when the writing process starts.
         *
         * It setups the file handle for this writer.
         */
        public function start() {}

        /**
         * Write the content to the output file.
         *
         * @param string $s
         */
        public function write($s) {}

        /**
         * This method is called when the writing process is finished.
         *
         * It closes the file handle.
         */
        public function finish() {}

        /**
         * Returns the current position of the output file.
         *
         * @return integer
         */
        public function getPos() {}

        /**
         * Copies an existing file into the target file and resets the file handle to the end of the file.
         *
         * @param resource $source
         */
        public function copy($source) {}

        /**
         * Close the file handle if needed.
         *
         * @see SetaPDF_Core_Writer_AbstractWriter::cleanUp()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * An interface for file writer classes.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
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
}

namespace
{

    /**
     * A writer class for HTTP delivery
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Http extends \SetaPDF_Core_Writer_String
    {
        /**
         * The document filename
         *
         * @var string
         */
        protected $_filename = 'document.pdf';

        /**
         * Flag saying that the file should be displayed inline or not
         *
         * @var boolean
         */
        protected $_inline = false;

        /**
         * The constructor.
         *
         * @param string $filename The path to which the writer should write to
         * @param boolean $inline Defines if the document should be displayed inline or if a download should be forced
         */
        public function __construct($filename = 'document.pdf', $inline = false) {}

        /**
         * This method is called when the writing process is finished.
         *
         * It sends the HTTP headers and send the buffer to the client.
         *
         * @throws SetaPDF_Core_Writer_Exception
         */
        public function finish() {}

    }
}

namespace
{

    /**
     * A writer class for immediately HTTP delivery without sending a Length header
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_HttpStream extends \SetaPDF_Core_Writer_Echo
    {
        /**
         * The document filename
         *
         * @var string
         */
        protected $_filename = 'document.pdf';

        /**
         * Flag saying that the file should be displayed inline or not
         *
         * @var boolean
         */
        protected $_inline = false;

        /**
         * The constructor.
         *
         * @param string $filename The path to which the writer should write to
         * @param boolean $inline Defines if the document should be displayed inline or if a download should be forced
         */
        public function __construct($filename = 'document.pdf', $inline = false) {}

        /**
         * This method is called when the writing process is started.
         *
         * It sends the HTTP headers.
         */
        public function start() {}

    }
}

namespace
{

    /**
     * A writer class for string results
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_String extends \SetaPDF_Core_Writer_Echo
    {
        /**
         * The string buffer
         *
         * @var string
         */
        protected $_buffer = '';

        /**
         * Initiate the buffer property.
         */
        public function start() {}

        /**
         * Add content to the buffer.
         *
         * @param string $s
         */
        public function write($s) {}

        /**
         * Get the string buffer.
         *
         * @return string
         */
        public function getBuffer() {}

        /**
         * __toString()-implementation.
         *
         * @return string
         */
        public function __toString() {}

    }
}

namespace
{

    /**
     * A writer class for temporary files
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_TempFile implements \SetaPDF_Core_Writer_WriterInterface, \SetaPDF_Core_Writer_FileInterface
    {
        /**
         * A temporary directory path
         *
         * @var string|null
         */
        public static $_tempDir;

        /**
         * The file prefix for the temporary files
         *
         * @var string
         */
        public static $_filePrefix = '.htSetaPDF';

        /**
         * Defines if the temporary file should be deleted in the destruct method or not
         *
         * @var bool
         */
        protected static $_keepFile = false;

        /**
         * Temporary file writers.
         *
         * @var array
         */
        public static $tempWriters = [/** value is missing */];

        /**
         * The internal file writer instance.
         *
         * @var SetaPDF_Core_Writer_File
         */
        protected $_writer;

        /**
         * Set the temporary directory path.
         *
         * @param null|string $tempDir
         * @throws InvalidArgumentException
         */
        public static function setTempDir($tempDir) {}

        /**
         * Get the current temporary directory path.
         *
         * @return null|string
         */
        public static function getTempDir() {}

        /**
         * Set the file prefix for temporary files.
         *
         * @param string $filePrefix
         */
        public static function setFilePrefix($filePrefix) {}

        /**
         * Get the file prefix for temporary files.
         *
         * @return string
         */
        public static function getFilePrefix() {}

        /**
         * Set whether files should be kept or deleted automatically when an instance is destructed.
         *
         * @param bool $keepFile
         */
        public static function setKeepFile($keepFile) {}

        /**
         * Get whether files should be kept or deleted automatically when an instance is destructed.
         *
         * @return bool
         */
        public static function getKeepFile() {}

        /**
         * Creates a temporary path.
         *
         * If a parameters is left, the static class method ({@link getTempDir()} or {@link getFilePrefix()}) will be
         * used to resolve the desired data.
         *
         * @param null $tempDir
         * @param null $filePrefix
         *
         * @return string
         * @throws InvalidArgumentException
         */
        public static function createTempPath($tempDir = null, $filePrefix = null) {}

        /**
         * Creates a temporary file and returns the temporary path to it.
         *
         * @param string $content
         * @return string
         */
        public static function createTempFile($content) {}

        /**
         * The constructor.
         *
         * @param null $tempDir
         * @param null $filePrefix
         */
        public function __construct($tempDir = null, $filePrefix = null) {}

        /**
         * The destructor.
         *
         * This method deletes the temporary file.
         * This behavior could be controlled by the {@link setKeepFile()}-method.
         */
        public function __destruct() {}

        /**
         * Get the path of the temporary file.
         *
         * @return string
         */
        public function getPath() {}

        /**
         * Proxy method.
         *
         * @see SetaPDF_Core_Writer_WriterInterface::cleanUp()
         */
        public function cleanUp() {}

        /**
         * Proxy method.
         *
         * @see SetaPDF_Core_Writer_WriterInterface::finish()
         */
        public function finish() {}

        /**
         * Proxy method.
         *
         * @return int
         * @see SetaPDF_Core_Writer_WriterInterface::getPos()
         */
        public function getPos() {}

        /**
         * Proxy method.
         *
         * @see SetaPDF_Core_Writer_WriterInterface::finish()
         */
        public function start() {}

        /**
         * Proxy method.
         *
         * @param string $s
         * @see SetaPDF_Core_Writer_WriterInterface::write()
         */
        public function write($s) {}

        /**
         * Proxy method.
         *
         * @return int|string
         * @see SetaPDF_Core_Writer_WriterInterface::getStatus()
         */
        public function getStatus() {}

    }
}

namespace
{

    /**
     * A writer class for a referenced variable
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer_Var extends \SetaPDF_Core_Writer_AbstractWriter implements \SetaPDF_Core_Writer_WriterInterface
    {
        /**
         * The variable reference
         *
         * @var string
         */
        protected $_var;

        /**
         * The current position
         *
         * @var integer
         */
        protected $_pos = 0;

        /**
         * The constructor.
         *
         * @param string $var A reference to the variable to write to
         */
        public function __construct(&$var) {}

        /**
         * Initiate the referenced variable.
         *
         * @see SetaPDF_Core_Writer_AbstractWriter::start()
         */
        public function start() {}

        /**
         * Adds content to the referenced variable.
         *
         * @param string $s
         */
        public function write($s) {}

        /**
         * Returns the current position.
         *
         * @return integer
         */
        public function getPos() {}

        /**
         * __toString()-implementation.
         *
         * @return string
         */
        public function __toString() {}

        /**
         * Unset the reference to the variable.
         *
         * @see SetaPDF_Core_Writer_AbstractWriter::cleanUp()
         */
        public function cleanUp() {}

    }
}

namespace
{

    /**
     * The writer interface
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Writer_WriterInterface extends \SetaPDF_Core_WriteInterface
    {
        /**
         * Method called when the writing process starts.
         *
         * This method could send for example headers.
         */
        public function start();

        /**
         * This method is called when the writing process is finished.
         *
         * It could close a file handle for example or send headers and flush a buffer.
         */
        public function finish();

        /**
         * Get the current writer status.
         *
         * @see SetaPDF_Core_Writer
         * @return integer
         */
        public function getStatus();

        /**
         * Gets the current position/offset.
         *
         * @return integer
         */
        public function getPos();

        /**
         * Method called if a documents cleanUp-method is called.
         */
        public function cleanUp();

    }
}

namespace
{

    /**
     * Class representing a Form XObject
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_XObject_Form extends \SetaPDF_Core_XObject implements \SetaPDF_Core_Canvas_ContainerInterface
    {
        /**
         * The BBox rectangle
         */
        protected $_bbox;

        /**
         * The canvas object for this form XObject
         *  
         * @var SetaPDF_Core_Canvas
         */
        protected $_canvas;

        /**
         * Create an Form XObject.
         * 
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_DataStructure_Rectangle|array $bbox
         * @return SetaPDF_Core_XObject_Form
         */
        public static function create(\SetaPDF_Core_Document $document, $bbox) {}

        /**
         * Ensures the default keys.
         */
        public function ensureDefaultKeys() {}

        /**
         * Get the canvas for this form XObject.
         * 
         * @return SetaPDF_Core_Canvas
         */
        public function getCanvas() {}

        /**
         * Get the indirect object of this XObject.
         * 
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getObject() {}

        /**
         * Get the stream proxy.
         * 
         * @return SetaPDF_Core_Canvas_StreamProxyInterface
         */
        public function getStreamProxy() {}

        /**
         * Get the BBox value or rectangle.
         * 
         * @param boolean $asRect
         * @return SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Type_Array
         */
        public function getBBox($asRect = true) {}

        /**
         * Get the bounding box after applying the transformation matrix.
         *
         * @return SetaPDF_Core_Geometry_Rectangle
         */
        protected function _getBBox() {}

        /**
         * Get the height of the XObject.
         * 
         * @see SetaPDF_Core_Canvas_ContainerInterface::getHeight()
         * @param float $width To get the height in relation to a width value keeping the aspect ratio
         * @return float
         */
        public function getHeight($width = null) {}

        /**
         * Get the width of the XObject.
         * 
         * @see SetaPDF_Core_Canvas_ContainerInterface::getWidth()
         * @param float $height To get the width in relation to a height value keeping the aspect ratio
         * @return float
         */
        public function getWidth($height = null) {}

        /**
         * Get the form matrix.
         *
         * @param boolean $asArray Defines whether the matrix be returned as an array or as a matrix instance.
         * @return boolean|SetaPDF_Core_Geometry_Matrix|array
         */
        public function getMatrix($asArray = false) {}

        /**
         * Set the form matrix.
         *
         * @param int[]|SetaPDF_Core_Geometry_Matrix $matrix An array of six numbers or a matrix instance.
         */
        public function setMatrix($matrix) {}

        /**
         * Get a group attributes object.
         * 
         * @return null|SetaPDF_Core_TransparencyGroup
         */
        public function getGroup() {}

        /**
         * Set the group attributes object.
         * 
         * @param false|SetaPDF_Core_TransparencyGroup $group
         * @throws InvalidArgumentException
         */
        public function setGroup($group) {}

        /**
         * Draw the external object on the canvas.
         *
         * @param SetaPDF_Core_Canvas $canvas
         * @param float $x
         * @param float $y
         * @param float $width
         * @param float $height
         * @return mixed|void
         */
        public function draw(\SetaPDF_Core_Canvas $canvas, $x = 0, $y = 0, $width = null, $height = null) {}

    }
}

namespace
{

    /**
     * Class representing an Image XObject
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_XObject_Image extends \SetaPDF_Core_XObject
    {
        /**
         * Create an image xobject by a reader object.
         * 
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         * @return SetaPDF_Core_XObject_Image
         */
        public static function create(\SetaPDF_Core_Document $document, \SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Get the height of the image.
         * 
         * @param float $width To get the height in relation to a width value keeping the aspect ratio
         * @return float
         */
        public function getHeight($width = null) {}

        /**
         * Get the width of the image.
         * 
         * @param float $height To get the width in relation to a height value keeping the aspect ratio
         * @return float
         */
        public function getWidth($height = null) {}

        /**
         * Get the color space of this image.
         *
         * @param bool $pdfValue
         * @return SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation|string
         * @throws SetaPDF_Exception_NotImplemented
         */
        public function getColorSpace($pdfValue = false) {}

        /**
         * Get the number of bits used to represen each colour component.
         *
         * @return bool|int
         */
        public function getBitsPerComponent() {}

        /**
         * Draw the external object on the canvas.
         *
         * @param SetaPDF_Core_Canvas $canvas
         * @param float $x
         * @param float $y
         * @param float $width
         * @param float $height
         * @return void
         */
        public function draw(\SetaPDF_Core_Canvas $canvas, $x = 0, $y = 0, $width = null, $height = null) {}

    }
}

namespace
{

    /**
     * A class that allows you to convert base data types to bytes and vice versa.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_BitConverter
    {
        /**
         * Constant for big endian byte order.
         *
         * @var string
         */
        const BYTE_ORDER_BIG_ENDIAN = 'bigEndian';

        /**
         * Constant for little endian byte order.
         *
         * @var string
         */
        const BYTE_ORDER_LITTLE_ENDIAN = 'littleEndian';

        const INT8 = 'Int8';

        const CHAR = 'Int8';

        const UINT8 = 'UInt8';

        const BYTE = 'UInt8';

        const INT16 = 'Int16';

        const SHORT = 'Int16';

        const UINT16 = 'UInt16';

        const USHORT = 'UInt16';

        const INT32 = 'Int32';

        const LONG = 'Int32';

        const UINT32 = 'UInt32';

        const ULONG = 'UInt32';

        const FIXED = 'Fixed';

        /**
         * The machine byte order.
         *
         * @var string
         */
        protected static $_machineByteOrder;

        /**
         * Get the size by a specific type.
         *
         * @param string $type
         * @return int
         */
        public static function getSize($type) {}

        /**
         * Get the machine byte order.
         *
         * @return string
         */
        public static function getMachineByteOrder() {}

        /**
         * Reads a signed integer.
         *
         * @param string $byte
         * @param integer $size
         * @return integer
         */
        public static function formatFromInt($byte, $size) {}

        /**
         * Reads an unsigned integer.
         *
         * @param string $byte
         * @param integer $size
         * @return integer
         */
        public static function formatFromUInt($byte, $size) {}

        /**
         * Writes a signed integer.
         *
         * @param integer $int
         * @param integer $size
         * @return string
         */
        public static function formatToInt($int, $size) {}

        /**
         * Writes an unsigned integer.
         *
         * @param integer $int
         * @param integer $size
         * @return string
         */
        public static function formatToUInt($int, $size) {}

        /**
         * Reads a 8-bit/1-byte signed integer.
         *
         * @param string $byte
         * @return integer
         */
        public static function formatFromInt8($byte) {}

        /**
         * Writes a 8-bit/1-byte signed integer.
         *
         * @param integer $int
         * @return string
         */
        public static function formatToInt8($int) {}

        /**
         * Reads a 8-bit/1-byte unsigned integer.
         *
         * @param string $byte
         * @return integer
         */
        public static function formatFromUInt8($byte) {}

        /**
         * Writes a 8-bit/1-byte unsigned integer.
         *
         * @param integer $int
         * @return string
         */
        public static function formatToUInt8($int) {}

        /**
         * Reads a 16-bit signed integer.
         *
         * @param string $bytes
         * @param string $byteOrder
         * @return integer
         */
        public static function formatFromInt16($bytes, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 16-bit signed integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return string
         */
        public static function formatToInt16($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 16-bit unsigned integer.
         *
         * @param string $bytes
         * @param string $byteOrder
         * @return integer
         */
        public static function formatFromUInt16($bytes, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 16-bit unsigned integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return string
         */
        public static function formatToUInt16($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 32-bit signed integer.
         *
         * @param string $bytes
         * @param string $byteOrder
         * @return mixed
         */
        public static function formatFromInt32($bytes, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Writes a 32-bit signed integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return string
         */
        public static function formatToInt32($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 32-bit unsigned integer.
         *
         * @param string $bytes
         * @param string $byteOrder
         * @return mixed
         */
        public static function formatFromUInt32($bytes, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Formats a 32-bit unsigned integer.
         *
         * @param integer $int
         * @param string $byteOrder
         * @return mixed
         */
        public static function formatToUInt32($int, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * @see http://www.php.net/function.unpack.php#106041
         * @param string $bin Binary string
         * @param string $byteOrder Byte Order, use BYTE_ORDER_XXX constant
         * @return mixed
         * @internal
         */
        private static function _uint32($bin, $byteOrder = self::BYTE_ORDER_BIG_ENDIAN) {}

        /**
         * Reads a 32-bit signed fixed-point number.
         *
         * @param string $bytes
         * @return float
         */
        public static function formatFromFixed($bytes) {}

        /**
         * Writes a 32-bit signed fixed-point number.
         *
         * @param float $float
         * @return string
         */
        public static function formatToFixed($float) {}

    }
}

namespace
{

    /**
     * A class representing a Canvas
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Canvas
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Canvas extends \SetaPDF_Core_Canvas_Simple implements \SetaPDF_Core_Canvas_StreamProxyInterface
    {
        const GS_SYNC_CURRENT_TRANSFORMATION_MATRIX = 1;

        const GS_SYNC_TEXT = 2;

        const GS_SYNC_COLOR = 4;

        /**
         * The writer
         *
         * @var SetaPDF_Core_Canvas_StreamProxyInterface
         */
        protected $_streamProxy;

        /**
         * Draw helper instance
         *
         * @var SetaPDF_Core_Canvas_Draw
         */
        protected $_draw;

        /**
         * Path helper instance
         *
         * @var SetaPDF_Core_Canvas_Path
         */
        protected $_path;

        /**
         * Text helper instance
         *
         * @var SetaPDF_Core_Canvas_Text
         */
        protected $_text;

        /**
         * A helper instance for marked content
         * 
         * @var SetaPDF_Core_Canvas_MarkedContent
         */
        protected $_markedContent;

        /**
         * A graphic state instance
         *
         * @var SetaPDF_Core_Canvas_GraphicState
         */
        protected $_graphicState;

        /**
         * Cached written content
         * 
         * @var string
         */
        protected $_cache = '';

        /**
         * Should the output be cached or not
         * 
         * @var boolean
         */
        protected $_cacheOutput = false;

        /**
         * Sync level
         *
         * @var int
         */
        protected $_graphicStateSync = 1;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Canvas_ContainerInterface $canvasContainer The canvas container
         */
        public function __construct(\SetaPDF_Core_Canvas_ContainerInterface $canvasContainer) {}

        /**
         * Release objects to free memory and cycled references.
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

        /**
         * Get the bitmask that defines which values should be synced with the graphic state object.
         *
         * @see graphicState()
         * @return int
         */
        public function getGraphicStateSync() {}

        /**
         * Set the bitmask defining, which values should be synced with the graphic state object.
         *
         * @param integer $graphicStateSync
         */
        public function setGraphicStateSync($graphicStateSync) {}

        /**
         * Get the draw helper.
         *
         * @return SetaPDF_Core_Canvas_Draw
         */
        public function draw() {}

        /**
         * Get the path helper.
         *
         * @return SetaPDF_Core_Canvas_Path
         */
        public function path() {}

        /**
         * Get the text helper.
         *
         * @return SetaPDF_Core_Canvas_Text
         */
        public function text() {}

        /**
         * Get the marked content helper.
         * 
         * @return SetaPDF_Core_Canvas_MarkedContent
         */
        public function markedContent() {}

        /**
         * Return the graphic state object if no graphic state is defined an new instance will be initialized.
         *
         * @return SetaPDF_Core_Canvas_GraphicState
         */
        public function graphicState() {}

        /**
         * Get the height of the canvas.
         *
         * @return float
         */
        public function getHeight() {}

        /**
         * Get the width of the canvas.
         *
         * @return float
         */
        public function getWidth() {}

        /**
         * Clears the complete canvas content.
         */
        public function clear() {}

        /**
         * Get the whole byte stream of the canvas.
         *
         * @see SetaPDF_Core_Canvas_StreamProxyInterface::getStream()
         * @return string
         */
        public function getStream() {}

        /**
         * Writes bytes to the canvas content stream.
         *
         * @param string $bytes The bytes to write
         * @see SetaPDF_Core_WriteInterface::write()
         */
        public function write($bytes) {}

        /**
         * Get the stream proxy.
         *
         * @return SetaPDF_Core_Canvas_StreamProxyInterface
         */
        public function getStreamProxy() {}

        /**
         * Start caching.
         *
         * The output of write() will be cached.
         *
         * This will also clear the cache.
         */
        public function startCache() {}

        /**
         * Stop caching the output of write().
         *
         * This will also clear the cache.
         */
        public function stopCache() {}

        /**
         * Returns the cache.
         *
         * @return string
         */
        public function getCache() {}

        /**
         * Add a resource to the pages/xobjects resources dictionary.
         *
         * @param string|SetaPDF_Core_Resource $type The resource type (Font, XObject, ExtGState,...) or an implementation of SetaPDF_Core_Resource
         * @param SetaPDF_Core_Resource|SetaPDF_Core_Type_IndirectObjectInterface $object The resource to add
         * @param SetaPDF_Core_Document $document The document instance
         * @return string The name of the added resource.
         * @throws InvalidArgumentException
         */
        public function addResource($type, $object = null, ?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set a resource for the canvas.
         *
         * @param string $type The resource type (Font, XObject, ExtGState,...) or an implementation of SetaPDF_Core_Resource
         * @param string $name The name of the resource
         * @param SetaPDF_Core_Resource|SetaPDF_Core_Type_IndirectObjectInterface $object
         * @param SetaPDF_Core_Document $document
         * @throws InvalidArgumentException
         * @return string
         */
        public function setResource($type, $name, $object, ?\SetaPDF_Core_Document $document = null) {}

        /**
         * Set the color.
         *
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color The color
         * @param boolean $stroking Do stroking?
         * @return SetaPDF_Core_Canvas
         */
        public function setColor($color, $stroking = true) {}

        /**
         * Set the stroking color.
         *
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color The stroking color
         * @return SetaPDF_Core_Canvas
         */
        public function setStrokingColor($color) {}

        /**
         * Set the non-stroking color.
         *
         * @param SetaPDF_Core_DataStructure_Color|int[]|int|string $color The non-stroking color
         * @return SetaPDF_Core_Canvas
         */
        public function setNonStrokingColor($color) {}

        /**
         * Set the current color space.
         *
         * @param SetaPDF_Core_ColorSpace|SetaPDF_Core_Type_Name|string $colorSpace The color space
         * @param bool $stroking Do stroking?
         * @return SetaPDF_Core_Canvas
         */
        public function setColorSpace($colorSpace, $stroking = true) {}

        /**
         * Set the stroking color space.
         *
         * @param SetaPDF_Core_ColorSpace|SetaPDF_Core_Type_Name|string $colorSpace The color space
         * @return SetaPDF_Core_Canvas
         */
        public function setStrokingColorSpace($colorSpace) {}

        /**
         * Set the non-stroking color space.
         *
         * @param SetaPDF_Core_ColorSpace|SetaPDF_Core_Type_Name|string $colorSpace The color space
         * @return SetaPDF_Core_Canvas
         */
        public function setNonStrokingColorSpace($colorSpace) {}

        /**
         * Set a named graphic state.
         *
         * @param SetaPDF_Core_Resource_ExtGState $graphicState The graphic state
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Canvas
         * @throws InvalidArgumentException
         */
        public function setGraphicState(\SetaPDF_Core_Resource_ExtGState $graphicState, ?\SetaPDF_Core_Document $document = null) {}

        /**
         * Open a new graphic state and copy the entire graphic state onto the stack of the new graphic state.
         *
         * @return SetaPDF_Core_Canvas
         */
        public function saveGraphicState() {}

        /**
         * Restore the last graphic state and pop all matrices of the current graphic state out of the matrix stack.
         *
         * @return SetaPDF_Core_Canvas
         */
        public function restoreGraphicState() {}

        /**
         * Returns the user space coordinates of the transformation matrix.
         *
         * @param int $x x-coordinate
         * @param int $y y-coordinate
         * @deprecated
         * @see toUserSpace()
         * @return array ('x' => $x, 'y' => $y)
         */
        public function getUserSpaceXY($x, $y) {}

        /**
         * Returns the user space coordinates vector.
         *
         * @param SetaPDF_Core_Geometry_Vector $vector
         * @return SetaPDF_Core_Geometry_Vector
         */
        public function toUserSpace(\SetaPDF_Core_Geometry_Vector $vector) {}

        /**
         * Add a transformation matrix to the matrix stack of the current graphic state.
         *
         * @see PDF-Reference PDF 32000-1:2008 8.3.4 Transformation Matrices
         * @param int|float $a A
         * @param int|float $b B
         * @param int|float $c C
         * @param int|float $d D
         * @param int|float $e E
         * @param int|float $f F
         * @return SetaPDF_Core_Canvas
         */
        public function addCurrentTransformationMatrix($a, $b, $c, $d, $e, $f) {}

        /**
         * Rotate the transformation matrix by $angle degrees at the origin defined by $x and $y.
         *
         * @param int|float $x X-coordinate of rotation point
         * @param int|float $y Y-coordinate of rotation point
         * @param float $angle Angle to rotate in degrees
         * @return SetaPDF_Core_Canvas
         */
        public function rotate($x, $y, $angle) {}

        /**
         * Normalize the graphic state in view to an outer rotation (e.g. page rotation).
         *
         * @param number $rotation
         * @param SetaPDF_Core_DataStructure_Rectangle $box
         * @return bool
         */
        public function normalizeRotation($rotation, \SetaPDF_Core_DataStructure_Rectangle $box) {}

        /**
         * Normalize the graphic state in view to an outer rotation (e.g. page rotation) and shifted origin.
         *
         * @param number $rotation
         * @param SetaPDF_Core_DataStructure_Rectangle $box
         * @return bool
         */
        public function normalizeRotationAndOrigin($rotation, \SetaPDF_Core_DataStructure_Rectangle $box) {}

        /**
         * Scale the transformation matrix by the factor $scaleX and $scaleY.
         *
         * @param int|float $scaleX Scale factor on X
         * @param int|float $scaleY Scale factor on Y
         * @return SetaPDF_Core_Canvas
         */
        public function scale($scaleX, $scaleY) {}

        /**
         * Move the transformation matrix by $shiftX and $shiftY on x-axis and y-axis.
         *
         * @param int|float $shiftX Points to move on x-axis
         * @param int|float $shiftY Points to move on y-axis
         * @return SetaPDF_Core_Canvas
         */
        public function translate($shiftX, $shiftY) {}

        /**
         * Skew the transformation matrix.
         *
         * @param float $angleX Angle to x-axis in degrees
         * @param float $angleY Angle to y-axis in degrees
         * @param int $x Points to stretch on x-axis
         * @param int $y Point to stretch on y-axis
         * @return SetaPDF_Core_Canvas
         */
        public function skew($angleX, $angleY, $x = 0, $y = 0) {}

        /**
         * Draw an external object.
         *
         * If a form XObject instance is passed, it will be added to the resources automatically.
         *
         * @param string $name The name or a form XObject instance.
         * @throws InvalidArgumentException
         * @return SetaPDF_Core_Canvas
         */
        public function drawXObject($name) {}

    }
}

namespace
{

    /**
     * Default implementation of a color space
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage ColorSpace
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_ColorSpace
    {
        /**
         * The indirect object for this color space
         *
         * @var SetaPDF_Core_Type_IndirectObjectInterface
         */
        protected $_indirectObject;

        /**
         * The main color space PDF value
         *
         * @var SetaPDF_Core_Type_Name|SetaPDF_Core_Type_Array
         */
        protected $_value;

        /**
         * Creates a color space instance based on the incoming value.
         *
         * @param string|SetaPDF_Core_Type_Name|SetaPDF_Core_Type_Array|SetaPDF_Core_Type_IndirectObjectInterface $object A color space definition
         * @return string|SetaPDF_Core_ColorSpace|SetaPDF_Core_ColorSpace_DeviceCmyk|SetaPDF_Core_ColorSpace_DeviceGray|SetaPDF_Core_ColorSpace_DeviceRgb|SetaPDF_Core_ColorSpace_IccBased|SetaPDF_Core_ColorSpace_Separation
         * @throws InvalidArgumentException
         */
        public static function createByDefinition($object) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_AbstractType $value A color space definition
         */
        public function __construct(\SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Get the color space family name of this color space.
         *
         * @return string
         * @throws SetaPDF_Core_Exception
         */
        public function getFamily() {}

        /**
         * Get the main color space PDF value.
         *
         * @return SetaPDF_Core_Type_Name|SetaPDF_Core_Type_Array
         */
        public function getPdfValue() {}

        /**
         * Get the default decode array of this color space.
         *
         * @return array
         */
        public function getDefaultDecodeArray() {}

        /**
         * Get the color components of this color space.
         *
         * @return integer
         */
        public function getColorComponents() {}

    }
}

namespace
{

    /**
     * A class representing a PDF document
     *
     * This class represents a PDF document in all SetaPDF components.
     * It offers the main functionalities for managing objects, cross
     * reference tables and writers of the document instance.
     *
     * It also tracks changes of objects and security handlers.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Document
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Document
    {
        /**
         * State constant
         *
         * @var string
         */
        const STATE_NONE = 'none';

        /**
         * State constant
         *
         * @var string
         */
        const STATE_WRITING_BODY = 'writingBody';

        /**
         * State constant
         *
         * @var string
         */
        const STATE_WRITING_XREF = 'writingXRef';

        /**
         * State constant
         *
         * @var string
         */
        const STATE_SAVED = 'saved';

        /**
         * State constant
         *
         * @var string
         */
        const STATE_FINISHED = 'finished';

        /**
         * State constant
         *
         * @var string
         */
        const STATE_CLEANED_UP = 'cleanedUp';

        /**
         * Save method constant defining an incremental update
         *
         * @var string
         */
        const SAVE_METHOD_UPDATE = 1;

        /**
         * Save method constant defining a rewrite by resolving objects starting at the root object
         *
         * @var string
         */
        const SAVE_METHOD_REWRITE = 0;

        /**
         * Save method constant defining a rewrite by writing all available objects
         *
         * @var string
         */
        const SAVE_METHOD_REWRITE_ALL = null;

        /**
         * A counter for generating unique instance identifications
         *
         * @var integer
         */
        protected static $_instanceCounter = 0;

        /**
         * A random prefix for generating unique instance identifications
         *
         * @var string
         */
        protected static $_instanceIdentPrefix;

        /**
         * Incremental update or rewrite the document
         *
         * @see SetaPDF_Core_Document::save()
         * @var integer
         */
        protected $_saveMethod = 0;

        /**
         * A flag defining the state of the document object instance
         *
         * @var string
         */
        protected $_state = 'none';

        /**
         * PDF version
         *
         * @see SetaPDF_Core_Document::setPdfVersion()
         * @var string
         */
        protected $_pdfVersion = '1.3';

        /**
         * An instance of a cross reference
         *
         * If the document is created of an existing one
         * this will be an instance of SetaPDF_Core_Parser_CrossReferenceTable
         *
         * @var SetaPDF_Core_Document_CrossReferenceTable
         */
        protected $_xref;

        /**
         * Defines if the cross reference table will be compressed
         *
         * @see SetaPDF_Core_Document::setCompressXref()
         * @var boolean
         */
        protected $_compressXref = false;

        /**
         * Current/max object id
         *
         * @var integer
         */
        protected $_maxObjId = 0;

        /**
         * Newly created or resolved objects
         *
         * @var array
         */
        protected $_objects = [/** value is missing */];

        /**
         * Array for information about object streams
         *
         * @var array
         */
        protected $_objectStreams = [/** value is missing */];

        /**
         * The parser object used for parsing object streams
         *
         * @var SetaPDF_Core_Parser_Pdf
         */
        protected $_objectStreamsParser;

        /**
         * The trailer dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_trailer;

        /**
         * Flag defining if the trailer was touched/changed
         *
         * @var boolean
         */
        protected $_trailerChanged = false;

        /**
         * Changed objects
         *
         * @var array
         */
        protected $_changedObjects;

        /**
         * Referenced objects
         *
         * This array holds information about objects to which
         * references were written. Needed to create deep
         * copies of an object from one to another document
         *
         * @var array
         */
        protected $_referencedObjects = [/** value is missing */];

        /**
         * Blocked referenced objects
         *
         * This array holds objects which should NOT be automatically
         * resolved.
         *
         * @var array
         */
        protected $_blockedReferencedObjects = [/** value is missing */];

        /**
         * A relation between objects and ids
         *
         * @var array
         */
        protected $_objectsToIds = [/** value is missing */];

        /**
         * The writer instance
         *
         * @see SetaPDF_Core_Document::setWriter()
         * @see SetaPDF_Core_Document::__construct()
         * @var SetaPDF_Core_Writer_WriterInterface
         */
        protected $_writer;

        /**
         * The parser object of the existing document
         *
         * @var SetaPDF_Core_Parser_Pdf
         */
        protected $_parser;

        /**
         * The indirect object which is currently written
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_currentObject;

        /**
         * The object id and generation number of the currently written object
         *
         * @var array
         */
        protected $_currentObjectData;

        /**
         * The security handler of the existing document
         *
         * @var SetaPDF_Core_SecHandler_SecHandlerInterface
         */
        protected $_secHandlerIn;

        /**
         * The security handler of the new document
         *
         * @var SetaPDF_Core_SecHandler_SecHandlerInterface
         */
        protected $_secHandler;

        /**
         * Identification of a document instance
         *
         * @var string
         */
        protected $_instanceIdent;

        /**
         * Documents catalog instance
         *
         * @var SetaPDF_Core_Document_Catalog
         */
        protected $_catalog;

        /**
         * The documents info object instance
         *
         * @var SetaPDF_Core_Document_Info
         */
        protected $_info;

        /**
         * Flag saying that objects should be cleaned up automatically
         *
         * @var boolean
         */
        protected $_cleanUpObjects = true;

        /**
         * A method/function which should be called to fill the document body
         *
         * @var callback
         */
        protected $_fileBodyMethod;

        /**
         * Defining whether the PDF objects should be written at once or object by object
         *
         * @var boolean
         */
        protected $_directWrite = false;

        /**
         * Flag saying that write callbacks are in use
         *
         * @var boolean
         */
        protected $_useWriteCallbacks = false;

        /**
         * Array of write callbacks
         *
         * @var array
         */
        protected $_writeCallbacks = [/** value is missing */];

        /**
         * The none permanent file identifier
         *
         * @var string
         */
        protected $_newFileIdentifier;

        /**
         * Defines if referenced objects should be cached or not
         *
         * @var boolean
         */
        protected $_cacheReferencedObjects = false;

        /**
         * An array of callbacks that should be called before the save method is executed.
         *
         * @var array
         */
        protected $_beforeSaveCallbacks = [/** value is missing */];

        /**
         * Creates an instance of a document based on an existing PDF.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader A reader instance
         * @param SetaPDF_Core_Writer_WriterInterface $writer A writer instance
         * @param string $className The class name to initiate
         * @return SetaPDF_Core_Document Returns a SetaPDF_Core_Document instance
         * @throws SetaPDF_Core_Parser_CrossReferenceTable_Exception|Exception
         */
        public static function load(\SetaPDF_Core_Reader_ReaderInterface $reader, ?\SetaPDF_Core_Writer_WriterInterface $writer = null, $className = 'SetaPDF_Core_Document') {}

        /**
         * Initiate an instance by a filename.
         *
         * @param string $filename The path to the pdf file
         * @param SetaPDF_Core_Writer_WriterInterface $writer A writer instance
         * @param string $className The class name to initiate
         * @return SetaPDF_Core_Document
         */
        public static function loadByFilename($filename, ?\SetaPDF_Core_Writer_WriterInterface $writer = null, $className = 'SetaPDF_Core_Document') {}

        /**
         * Initiate an instance by a pdf string.
         *
         * @param string $string Content of the pdf
         * @param SetaPDF_Core_Writer_WriterInterface $writer A writer instance
         * @param string $className The class name to initiate
         * @return SetaPDF_Core_Document
         */
        public static function loadByString($string, ?\SetaPDF_Core_Writer_WriterInterface $writer = null, $className = 'SetaPDF_Core_Document') {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer The writer to which the document should be written
         */
        public function __construct(?\SetaPDF_Core_Writer_WriterInterface $writer = null) {}

        /**
         * Reset the prefix to force a recreation.
         *
         * @return void
         * @internal
         */
        public function __wakeup() {}

        /**
         * Implement magic methods for getting helper objects.
         *
         * You can use the methods from SetaPDF_Core_Document_Catalog::getDocumentMagicMethods().
         *
         * Additional you can use "getFormFiller", "getMerger", "getSigner" and "getStamper" if you want to
         * receive instances of these components.
         *
         * @see http://www.php.net/manual/language.oop5.overloading.php#object.call
         * @see SetaPDF_Core_Document_Catalog::getDocumentMagicMethods()
         * @param string $method The method name
         * @param array $arguments The arguments
         * @return mixed
         * @throws BadMethodCallException
         */
        public function __call($method, $arguments) {}

        /**
         * Set the writer object.
         *
         * A writer instance can only be set prior the first call to {@link SetaPDF_Core_Document::save() save()} or
         * after a {@link SetaPDF_Core_Document::finish() finish()} call.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer The new writer object
         * @throws BadMethodCallException
         * @return SetaPDF_Core_Document
         */
        public function setWriter(?\SetaPDF_Core_Writer_WriterInterface $writer = null) {}

        /**
         * Get current writer object.
         *
         * @return SetaPDF_Core_Writer_WriterInterface|null
         */
        public function getWriter() {}

        /**
         * Get the parser object.
         *
         * @return SetaPDF_Core_Parser_Pdf|null
         */
        public function getParser() {}

        /**
         * Return the current object state.
         *
         * @return string
         */
        public function getState() {}

        /**
         * Returns the trailer dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getTrailer() {}

        /**
         * Returns the PDF version of the document.
         *
         * @return string
         */
        public function getPdfVersion() {}

        /**
         * Set the PDF version of the document.
         *
         * @param string $pdfVersion The pdf version
         * @return void
         */
        public function setPdfVersion($pdfVersion) {}

        /**
         * Set the minimal PDF version.
         *
         * @param string $minPdfVersion The minimal pdf version
         */
        public function setMinPdfVersion($minPdfVersion) {}

        /**
         * Get the catalog object.
         *
         * @return SetaPDF_Core_Document_Catalog
         */
        public function getCatalog() {}

        /**
         * Get the documents info object.
         *
         * @return SetaPDF_Core_Document_Info
         */
        public function getInfo() {}

        /**
         * Implementation of the observer pattern.
         *
         * This method is automatically called if an observed object
         * was changed.
         *
         * @param SplSubject $subject The SplSubject notifying the observer of an update.
         * @return void
         */
        public function update(\SplSubject $subject) {}

        /**
         * Define whether the cross reference should be compressed or not.
         *
         * By default the SetaPDF-Core component writes the cross-reference in the standard format or in the format which
         * is defined in the source document, if any available.
         *
         * @param boolean $compressXref Pass true to enforce that the cross reference will be compressed. Pass false to
         *                              enforce a standard uncompressed cross reference table.
         * @return void
         * @throws BadMethodCallException
         */
        public function setCompressXref($compressXref) {}

        /**
         * Get the cross reference object.
         *
         * @return SetaPDF_Core_Document_CrossReferenceTable
         */
        public function getXref() {}

        /**
         * Set the behavior if the cleanUp()-methods of objects get called automatically.
         *
         * @param boolean $cleanUpObjects The flag status
         */
        public function setCleanUpObjects($cleanUpObjects) {}

        /**
         * Define if referenced objects should be cached or not.
         *
         * @param boolean $cacheReferencedObjects The flag status
         */
        public function setCacheReferencedObjects($cacheReferencedObjects) {}

        /**
         * Says that referenced objects get cached or not.
         *
         * @return boolean
         */
        public function getCacheReferencedObjects() {}

        /**
         * Cache written object references.
         *
         * This method is called if an indirect object reference is written.
         * This makes sure that the class knows about maybe unwritten objects.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object
         * @return array
         * @throws SetaPDF_Core_Document_ObjectNotFoundException
         */
        public function addIndirectObjectReferenceWritten(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * This prohibit that a reference to this objects will be written.
         *
         * Objects defined via this method will not automatically be resolved if
         * an reference to them was written.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object
         * @see addIndirectObjectReferenceWritten()
         */
        public function blockReferencedObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Remove a blocked object.
         *
         * @see blockReferencedObject()
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object
         */
        public function unBlockReferencedObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Return the object id and generation number for an indirect object or reference.
         *
         * This method makes sure that objects are nearly independent of their original
         * document and the matching between document, object and their ids is handled at
         * one place: in this method.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object
         * @return array
         */
        public function getIdForObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Resolves an indirect object.
         *
         * @param integer $objectId The object id
         * @param integer|null $generation The generation number. Could be also "null" to
         *          find an object with an unknown generation number with the xref parser
         * @param boolean $cache Should the object be cached?
         * @throws SetaPDF_Core_Document_ObjectNotDefinedException|SetaPDF_Core_Document_ObjectNotFoundException
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function resolveIndirectObject($objectId, $generation = 0, $cache = true) {}

        /**
         * Releases an indirect object from the internal object cache.
         * 
         * @param SetaPDF_Core_Type_IndirectObject $object
         * @return boolean
         */
        public function releaseObject(\SetaPDF_Core_Type_IndirectObject $object) {}

        /**
         * Create a new indirect object.
         *
         * @param SetaPDF_Core_Type_AbstractType $value The value of the new indirect object
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function createNewObject(?\SetaPDF_Core_Type_AbstractType $value = null) {}

        /**
         * Checks if an indirect object is already registered for/in this document instance.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object to check
         *
         * @return bool
         */
        public function objectRegistered(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Clones an indirect object.
         *
         * @param SetaPDF_Core_Type_IndirectObject $indirectObject The indirect object to clone
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function cloneIndirectObject(\SetaPDF_Core_Type_IndirectObject $indirectObject) {}

        /**
         * Makes sure that an object is ensured through this document (if possible).
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject The indirect object to ensure
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         */
        public function ensureObject(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Delete an indirect object.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $object The indirect object to delete
         */
        public function deleteObject(\SetaPDF_Core_Type_IndirectObjectInterface $object) {}

        /**
         * Deletes an indirect object by its object id and generation number.
         *
         * @param integer $objectId The object id of the object
         * @param integer $generation The generation id of the object
         */
        public function deleteObjectById($objectId, $generation = 0) {}

        /**
         * Checks whether a security handler is attached to this document.
         *
         * @return boolean
         */
        public function hasSecHandler() {}

        /**
         * Alias for hasSecHandler().
         *
         * @deprecated
         * @return bool
         */
        public function hasSecurityHandler() {}

        /**
         * Returns the security handler of the original document.
         *
         * @return null|SetaPDF_Core_SecHandler_SecHandlerInterface
         */
        public function getSecHandlerIn() {}

        /**
         * Set the security handler for this document.
         *
         * @param SetaPDF_Core_SecHandler_SecHandlerInterface $secHandler The new secHandler
         * @return void
         * @throws BadMethodCallException|SetaPDF_Core_SecHandler_Exception
         */
        public function setSecHandler(?\SetaPDF_Core_SecHandler_SecHandlerInterface $secHandler = null) {}

        /**
         * Get the security handler for the output document.
         *
         * @return SetaPDF_Core_SecHandler_SecHandlerInterface|SetaPDF_Core_SecHandler_Standard
         */
        public function getSecHandler() {}

        /**
         * Defines whether the PDF objects should be written individually (true) or after assembling a single string (false).
         *
         * @param bool $directWrite
         */
        public function setDirectWrite($directWrite) {}

        /**
         * Gets whether the PDF objects should be written individually (true) or after assembling a single string (false).
         *
         * @return bool
         */
        public function getDirectWrite() {}

        /**
         * Writes content to the attached writer.
         *
         * @param string $s
         * @return mixed
         * @throws SetaPDF_Core_Exception
         */
        public function write($s) {}

        /**
         * Adds a callback that will get executed before the save method is processed.
         *
         * @see removeBeforeSaveCallback()
         * @param $name
         * @param $callback
         * @return bool
         */
        public function addBeforeSaveCallback($name, $callback) {}

        /**
         * Removes a callback that was added before.
         *
         * @see addBeforeSaveCallback()
         * @param $name
         * @return bool
         */
        public function removeBeforeSaveCallback($name) {}

        /**
         * Saves the document.
         *
         * The PDF format offers a way to add changes to a document by simply appending the changes to
         * the end of the file. This method is called incremental update and has the advantage that it
         * is very fast, because only changed objects have to be written. This behavior is the default
         * one, when calling the save()-method. Sadly it makes it easy to revert the document to the
         * previous state by simply cutting the bytes of the last revision.
         *
         * The parameter of the save()-method allows you to define that the document should be rebuild
         * from scratch by resolving the complete object structure. Just pass SetaPDF_Core_Document::SAVE_METHOD_REWRITE
         * to it. This task is very performance intensive, because the complete document have to be parsed,
         * interpreted and rewritten.
         *
         * Additionally it is possible to rewrite the whole document with all available objects. The benefit of this
         * solution is that it will keep compressed object streams intact: SetaPDF_Core_Document::SAVE_METHOD_REWRITE_ALL.
         * The disadvantage ist, that unused objects may be copied/written, too.
         *
         * @param boolean|integer $method Update or rewrite the document
         * @return SetaPDF_Core_Document
         * @throws InvalidArgumentException
         * @throws SetaPDF_Core_Exception
         * @throws BadMethodCallException
         */
        public function save($method = true) {}

        /**
         * Get the current used save method.
         *
         * This method can be used by objects at writing time to evaluate if it is possible to edit referencing values or
         * not.
         *
         * @return integer
         */
        public function getSaveMethod() {}

        /**
         * Writes an object to the resulting document but evaluates first if a write is neccesarry.
         *
         * @param SetaPDF_Core_Document $document
         * @param integer $objectId
         * @param integer $generation
         * @param boolean $cache
         */
        protected function _writeObject(\SetaPDF_Core_Document $document, $objectId, $generation, $cache) {}

        /**
         * Forwards a finish signal to the attached writer.
         *
         * @return SetaPDF_Core_Document
         */
        public function finish() {}

        /**
         * Writes the file header.
         *
         * @return void
         */
        protected function _writeFileHeader() {}

        /**
         * Set the callback method/function which will write the file body.
         *
         * @param callback $callback
         */
        public function setFileBodyMethod($callback) {}

        /**
         * Main method which writes the file body.
         *
         * This method should extended/overwritten to implement
         * individual logic if the document should be build at runtime.
         *
         * @return boolean If body was written
         */
        protected function _writeFileBody() {}

        /**
         * Write the cross reference table.
         *
         * @return void
         */
        protected function _writeCrossReferenceTable() {}

        /**
         * Update or create a file identifier.
         *
         * @return string The new file identifier
         */
        protected function _updateFileIdentifier() {}

        /**
         * Get a file identifier.
         *
         * @param boolean $permanent
         * @param boolean $create
         * @return string
         */
        public function getFileIdentifier($permanent = false, $create = true) {}

        /**
         * Set a custom non-permanent file identifier.
         *
         * @param string $newFileIdentifier
         */
        public function setNewFileIdentifier($newFileIdentifier) {}

        /**
         * Cleans up trailer entries.
         *
         * @param SetaPDF_Core_Type_Dictionary $trailer
         * @return void
         */
        protected function _cleanUpTrailer(\SetaPDF_Core_Type_Dictionary $trailer) {}

        /**
         * Write the trailer dictionary and the pointer top the initial xref table.
         *
         * @return void
         */
        protected function _writeTrailer() {}

        /**
         * Write changed objects.
         *
         * @return boolean was an object written?
         */
        public function writeChangedObjects() {}

        /**
         * Write referenced objects.
         */
        public function writeReferencedObjects() {}

        /**
         * Writes an object to the resulting document.
         *
         * This method should only called in the _writeFileBody()-method
         * or in the callback method of it.
         *
         * @param SetaPDF_Core_Type_IndirectObject $object
         */
        public function writeObject(\SetaPDF_Core_Type_IndirectObject $object) {}

        /**
         * Method called when a PDF type will be written.
         *
         * This method could be used to manipulate a value just before it will get written to the writer object.
         *
         * @param SetaPDF_Core_Type_AbstractType $value
         * @return SetaPDF_Core_Type_AbstractType
         */
        public function handleWriteCallback(\SetaPDF_Core_Type_AbstractType $value) {}

        /**
         * Register a write callback.
         *
         * @param callback $callback
         * @param string $type
         * @param string $name
         */
        public function registerWriteCallback($callback, $type, $name) {}

        /**
         * Un-Register a write callback.
         *
         * @param string $type
         * @param string $name
         */
        public function unRegisterWriteCallback($type, $name) {}

        /**
         * Returns the currently written object.
         *
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getCurrentObject() {}

        /**
         * Returns the currently written object data.
         *
         * @return array
         */
        public function getCurrentObjectData() {}

        /**
         * Get the object of the currently written/handled object.
         *
         * @return SetaPDF_Core_Document
         */
        public function getCurrentObjectDocument() {}

        /**
         * Get the instance identifier of this document.
         *
         * @return string
         */
        public function getInstanceIdent() {}

        /**
         * Release objects.
         *
         * @return void
         */
        protected function _releaseObjects() {}

        /**
         * Release objects to free memory and cycled references.
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

        /**
         * Implementation of the SetaPDF_Core_Type_Owner interface.
         *
         * @return $this
         */
        public function getOwnerPdfDocument() {}

    }
}

namespace
{

    /**
     * Class representing an embedded file stream
     *
     * @see PDF 32000-1:2008 - 7.11.4 Embedded file streams
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_EmbeddedFileStream
    {
        /**
         * Constanst for the "Size" key in a embedded file parameter dictionary.
         *
         * @var string
         */
        const PARAM_SIZE = 'Size';

        /**
         * Constanst for the "CreationDate" key in a embedded file parameter dictionary.
         *
         * @var string
         */
        const PARAM_CREATION_DATE = 'CreationDate';

        /**
         * Constanst for the "ModDate" key in a embedded file parameter dictionary.
         *
         * @var string
         */
        const PARAM_MODIFICATION_DATE = 'ModDate';

        /**
         * Constanst for the "CheckSum" key in a embedded file parameter dictionary.
         *
         * The checksum shall be calculated by applying the standard MD5 message-digest algorithm to the bytes of the
         * embedded file stream.
         *
         * @var string
         */
        const PARAM_CHECK_SUM = 'CheckSum';

        /**
         * The indirect object
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_indirectObject;

        /**
         * Create an embedded file stream.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Reader_ReaderInterface|string $pathOrReader A reader instance or a path to a file.
         * @param array $params See {@link SetaPDF_Core_EmbeddedFileStream::setParams() setParams()} method.
         * @param null|string $mimeType The subtype of the embedded file. Shall conform to the MIME media type names defined
         *                              in Internet RFC 2046
         * @return SetaPDF_Core_EmbeddedFileStream
         */
        public static function create(\SetaPDF_Core_Document $document, $pathOrReader, array $params = [/** value is missing */], $mimeType = null) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject
         */
        public function __construct(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Get the indirect object.
         *
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getIndirectObject() {}

        /**
         * Get the stream dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        protected function _getDictionary() {}

        /**
         * Get the subtype of the embedded file.
         *
         * @return null|string
         */
        public function getMimeType() {}

        /**
         * Set the mime type (or subtype) of the embedded file stream.
         *
         * @param string|null $mimeType
         */
        public function setMimeType($mimeType) {}

        /**
         * Get the entries and data of the embedded file parameter dictionary.
         *
         * @return array
         */
        public function getParams() {}

        /**
         * Set the entries in the embedded file parameter dictionary.
         *
         * @param array $params See class constants self::PARAMS_* for possible keys.
         * @param bool $reset Defines whether to remove all previously set entries or not.
         * @see SetaPDF_Core_EmbeddedFileStream::PARAM_CHECK_SUM
         * @see SetaPDF_Core_EmbeddedFileStream::PARAM_CREATION_DATE
         * @see SetaPDF_Core_EmbeddedFileStream::PARAM_MODIFICATION_DATE
         * @see SetaPDF_Core_EmbeddedFileStream::PARAM_SIZE
         */
        public function setParams(array $params, $reset = true) {}

        /**
         * Get the stream content.
         *
         * @return string
         */
        public function getStream() {}

    }
}

namespace
{

    /**
     * A wrapper class for handling PDF specific encodings
     *
     * This class is a wrapper around iconv/mb_*-functions to offer a transparent
     * support of PDF specific and independent, unknown encodings.
     *
     * By default the class will use mb functions if available. Otherwise it will fallback to iconv functions.
     * To use specific functions just set the static property:
     *
     * <code>
     * SetaPDF_Core_Encoding::setLibrary('mb');
     * // or
     * SetaPDF_Core_Encoding::setLibrary('iconv');
     * </code>
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Encoding
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Encoding
    {
        /**
         * WinAnsiEncoding
         *
         * @var string
         */
        const WIN_ANSI = 'WinAnsiEncoding';

        /**
         * PDFDocEncoding
         *
         * @var string
         */
        const PDF_DOC = 'PDFDocEncoding';

        /**
         * StandardEncoding
         *
         * @var string
         */
        const STANDARD = 'StandardEncoding';

        /**
         * MacRomanEncoding
         *
         * @var string
         */
        const MAC_ROMAN = 'MacRomanEncoding';

        /**
         * MacExpertEncoding
         *
         * @var string
         */
        const MAX_EXPERT = 'MacExpertEncoding';

        /**
         * ZapfDingbats
         *
         * @var string
         */
        const ZAPF_DINGBATS = 'ZapfDingbats';

        /**
         * Symbol
         *
         * @var string
         */
        const SYMBOL = 'Symbol';

        /**
         * Library to use for conversion between encodings
         *
         * @var string
         */
        public static $library;

        /**
         * Set the library to use for multibyte string operations.
         *
         * @param string $library Possible values are 'mb' for mbstring functions or 'iconv' for iconv functions.
         */
        public static function setLibrary($library) {}

        /**
         * Get the library to use for multibyte string operations.
         *
         * If none is defined the method will check for the mbstring module and define it or iconv automatically.
         *
         * @return string
         */
        public static function getLibrary() {}

        /**
         * Checks if an encoding is a PDF specific predefined encoding.
         *
         * @param string $encoding
         * @return boolean
         */
        public static function isPredefinedEncoding($encoding) {}

        /**
         * Get the translation table of a predefined PDF specific encodings.
         *
         * @param string $encoding
         * @return array
         * @throws InvalidArgumentException
         */
        public static function getPredefinedEncodingTable($encoding) {}

        /**
         * Converts a string from one to another encoding.
         *
         * A kind of wrapper around iconv/mb_convert_encoding plus the separate processing of
         * PDF related encodings.
         *
         * @param string $string        The string to convert in $inEncoding
         * @param string $inEncoding    The "in"-encoding
         * @param string $outEncoding    The "out"-encoding
         * @return string
         */
        public static function convert($string, $inEncoding, $outEncoding) {}

        /**
         * Converts a PDF string (in PDFDocEncoding or UTF-16BE) to another encoding.
         *
         * This method automatically detects UTF-16BE encoding in the input string and
         * removes the BOM.
         *
         * @param string $string The string to convert in PDFDocEncoding or UTF-16BE
         * @param string $outEncoding The "out"-encoding
         * @return string
         */
        public static function convertPdfString($string, $outEncoding = 'UTF-8') {}

        /**
         * Converts a string into PdfDocEncoding or UTF-16BE.
         *
         * Actually directly converts to UTF-16BE to support unicode.
         * Method should be optimized to choose the correct encoding (PdfDoc or UTF-16BE)
         * depending on the characters used.
         *
         * @todo Implement auto-detection of needed encoding
         * @param string $string
         * @param string $inEncoding
         * @return string
         */
        public static function toPdfString($string, $inEncoding = 'UTF-8') {}

        /**
         * Converts a string from UTF-16BE to another predefined encoding.
         *
         * @param array|SetaPDF_Core_Font_Cmap_CmapInterface $table The translation table
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @param string $substituteChar
         * @return string
         */
        public static function fromUtf16Be($table, $string, $ignore = false, $translit = false, $substituteChar = '') {}

        /**
         * Converts a string to UTF-16BE from another predefined 1-byte encoding.
         *
         * @param array|SetaPDF_Core_Font_Cmap_CmapInterface $table The translation table
         * @param string $string The input string
         * @param boolean $ignore Characters that cannot be represented in the target charset are silently discarded
         * @param boolean $translit Transliteration activated
         * @return string
         */
        public static function toUtf16Be($table, $string, $ignore = false, $translit = false) {}

        /**
         * Converts an unicode point to UTF16Be.
         *
         * @param integer $unicodePoint
         * @return string
         */
        public static function unicodePointToUtf16Be($unicodePoint) {}

        /**
         * Converts a UTF16BE character to a unicode point.
         *
         * @param string $utf16
         * @return int
         */
        public static function utf16BeToUnicodePoint($utf16) {}

        /**
         * Checks a string for UTF-16BE BOM.
         *
         * @param string $string
         * @return bool
         */
        public static function isUtf16Be($string) {}

        /**
         * Get the length of a string in a specific encoding.
         *
         * @param string $string
         * @param string $encoding
         * @return int
         */
        public static function strlen($string, $encoding = 'UTF-8') {}

        /**
         * Return part of a string.
         *
         * @param string $string
         * @param int $start
         * @param int $length
         * @param string $encoding
         * @return string|bool Returns false on error
         */
        public static function substr($string, $start, $length = null, $encoding = 'UTF-8') {}

        /**
         * Splits a string into an array.
         *
         * @param $string
         * @param string $encoding
         * @return array
         */
        public static function strSplit($string, $encoding = 'UTF-8') {}

    }
}

namespace
{

    /**
     * The exception class for the SetaPDF-Core Components
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Exception extends \SetaPDF_Exception
    {
    }
}

namespace
{

    /**
     * Class representing a file specification
     *
     * @see PDF 32000-1:2008 - 7.11.2 File Specification Strings
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_FileSpecification
    {
        /**
         * Default file system constant
         *
         * @var null
         */
        const FILE_SYSTEM_UNDEFINED = null;

        /**
         * URL file system contant
         *
         * @var string
         */
        const FILE_SYSTEM_URL = 'URL';

        /**
         * The dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * Create a file specification with an embedded file stream.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Reader_ReaderInterface|string $pathOrReader A reader instance or a path to a file.
         * @param string $filename The filename in UTF-8 encoding.
         * @param array $fileStreamParams See {@link SetaPDF_Core_EmbeddedFileStream::setParams() setParams()} method.
         * @param null|string $mimeType The subtype of the embedded file. Shall conform to the MIME media type names defined
         *                              in Internet RFC 2046
         * @return SetaPDF_Core_FileSpecification
         */
        public static function createEmbedded(\SetaPDF_Core_Document $document, $pathOrReader, $filename, array $fileStreamParams = [/** value is missing */], $mimeType = null) {}

        /**
         * Creates a file specification dictionary.
         *
         * @param string $fileSpecificationString
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function createDictionary($fileSpecificationString) {}

        /**
         * The constructor.
         *
         * If the parameter cannot be evaluated to a dictionary it will be passed to the
         * {@link SetaPDF_Core_FileSpecification::createDictionary() createDictionary} method to create an appropriate
         * dictionary.
         *
         * @param string|SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary|SetaPDF_Core_Type_StringValue $fileSpecification
         * @see createDictionary()
         */
        public function __construct($fileSpecification) {}

        /**
         * Get the dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Get the file specification value.
         *
         * @return string|null
         */
        public function getFileSpecification() {}

        /**
         * Set the file specification value.
         *
         * @param string|null $fileSpecification
         */
        public function setFileSpecification($fileSpecification) {}

        /**
         * Get the unicode text file specification value.
         *
         * @param string $encoding
         * @return string|null
         */
        public function getUnicodeFileSpecification($encoding = 'UTF-8') {}

        /**
         * Set the unicode text file specification value.
         *
         * @param string|null $fileSpecification
         * @param string $encoding
         */
        public function setUnicodeFileSpecification($fileSpecification, $encoding = 'UTF-8') {}

        /**
         * Get the volatile flag.
         *
         * @return boolean
         */
        public function getVolatile() {}

        /**
         * Set the volatile flag.
         *
         * @param boolean|null $volatile
         */
        public function setVolatile($volatile) {}

        /**
         * Get name of the file system.
         *
         * @return null|string
         */
        public function getFileSystem() {}

        /**
         * Set the file system name.
         *
         * @param null|string $fileSystem
         */
        public function setFileSystem($fileSystem) {}

        /**
         * Set the descriptive text associated with the file specification.
         *
         * @param string|null $desc
         * @param string $encoding
         */
        public function setDescription($desc, $encoding = 'UTF-8') {}

        /**
         * Get the descriptive text associated with the file specification.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getDescription($encoding = 'UTF-8') {}

        /**
         * Get the embedded file stream object.
         *
         * @param boolean $unicode If true use the UF key. Otherwise the F key.
         * @return null|SetaPDF_Core_EmbeddedFileStream
         */
        public function getEmbeddedFileStream($unicode = false) {}

        /**
         * Set the embedded file stream object.
         *
         * @param SetaPDF_Core_EmbeddedFileStream $embeddedFileStream
         * @param bool $unicode If true use the UF key. Otherwise the F key.
         */
        public function setEmbeddedFileStream(\SetaPDF_Core_EmbeddedFileStream $embeddedFileStream, $unicode = false) {}

        /**
         * Get the collection item data.
         *
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getCollectionItem() {}

        /**
         * Set the collection item data.
         *
         * @param SetaPDF_Core_Type_Dictionary|null $item
         */
        public function setCollectionItem(?\SetaPDF_Core_Type_Dictionary $item = null) {}

    }
}

namespace
{

    /**
     * Abstract class representing a Font
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Font
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Font implements \SetaPDF_Core_Font_Glyph_Collection_CollectionInterface, \SetaPDF_Core_Resource
    {
        /**
         * Info constant
         *
         * @var string
         */
        const INFO_COPYRIGHT = 'copyright';

        /**
         * Info constant
         *
         * @var string
         */
        const INFO_CREATION_DATE = 'creationDate';

        /**
         * Info constant
         *
         * @var string
         */
        const INFO_UNIQUE_ID = 'uniqueId';

        /**
         * Info constant
         *
         * @var string
         */
        const INFO_VERSION = 'version';

        /**
         * The font dictionary
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The indirect object of the font
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_indirectObject;

        /**
         * Array holding information about the font
         * 
         * @var array
         */
        protected $_info = [/** value is missing */];

        /**
         * Glyph withds
         *
         * @var array
         */
        protected $_widths;

        /**
         * Widths by char codes
         *
         * @var array
         */
        protected $_widthsByCharCode;

        /**
         * Cache for glyph widths
         *
         * @var array
         */
        protected $_glyphsWidthCache = [/** value is missing */];

        /**
         * The substitute character in a fonts specific encoding.
         *
         * @var string
         */
        protected $_substituteCharacter;

        /**
         * A char code cache which is used in {@link SetaPDF_Core_Font::getCharByCharCode()}.
         *
         * @var array
         */
        protected $_charCodeCache = [/** value is missing */];

        /**
         * An array caching font objects
         *
         * @var array
         */
        protected static $_fonts = [/** value is missing */];

        /**
         * Release font instances by a document instance.
         *
         * @param SetaPDF_Core_Document $document
         * @see freeCache()
         * @deprecated
         */
        public static function freeFontCache(\SetaPDF_Core_Document $document) {}

        /**
         * Release font instances by a document instance.
         *
         * @param SetaPDF_Core_Document $document
         */
        public static function freeCache(\SetaPDF_Core_Document $document) {}

        /**
         * Get a font object by an indirect reference.
         * 
         * The needed font object class is automatically resolve via the Subtype value
         * of the font dictionary.
         * 
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObjectOrDictionary
         * @return SetaPDF_Core_Font
         * @throws SetaPDF_Exception_NotImplemented
         * @throws SetaPDF_Core_Font_Exception
         */
        public static function get($indirectObjectOrDictionary) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface|SetaPDF_Core_Type_Dictionary $indirectObjectOrDictionary
         */
        public function __construct($indirectObjectOrDictionary) {}

        /**
         * Get the font dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Gets an indirect object for this font.
         *
         * @see SetaPDF_Core_Resource::getIndirectObject()
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_Type_IndirectObjectInterface
         * @throws InvalidArgumentException
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type.
         * 
         * @see SetaPDF_Core_Resource::getResourceType()
         * @return string
         */
        public function getResourceType() {}

        /**
         * Get the Subtype entry of the font dictionary.
         *
         * @return mixed
         */
        public function getType() {}

        /**
         * Returns the table to map character codes to unicode values.
         *
         * @return array|SetaPDF_Core_Font_Cmap_CmapInterface|false
         */
        abstract protected function _getCharCodesTable();

        /**
         * Returns the encoding table.
         *
         * @return array|SetaPDF_Core_Font_Cmap_CmapInterface|false
         */
        abstract protected function _getEncodingTable();

        /**
         * Get the font name.
         *
         * @return string
         */
        abstract public function getFontName();

        /**
         * Get the font family.
         *
         * @return string
         */
        abstract public function getFontFamily();

        /**
         * Checks if the font is bold.
         *
         * @return boolean
         */
        abstract public function isBold();

        /**
         * Checks if the font is italic.
         *
         * @return boolean
         */
        abstract public function isItalic();

        /**
         * Checks if the font is monospace.
         *
         * @return boolean
         */
        abstract public function isMonospace();

        /**
         * Returns the font bounding box.
         *
         * @return array Format is [llx lly urx ury]
         */
        abstract public function getFontBBox();

        /**
         * Returns the italic angle.
         *
         * @return float
         */
        abstract public function getItalicAngle();

        /**
         * Returns the distance from baseline of highest ascender (Typographic ascent).
         *
         * @return float
         */
        abstract public function getAscent();

        /**
         * Returns the distance from baseline of lowest descender (Typographic descent).
         *
         * @return float
         */
        abstract public function getDescent();

        /**
         * Get the average glyph width.
         *
         * @param boolean $calculateIfUndefined
         * @return integer|float
         */
        public function getAvgWidth($calculateIfUndefined = false) {}

        /**
         * Get the max. glyph width.
         *
         * @return integer|float
         */
        public function getMaxWidth() {}

        /**
         * Get the missing glyph width.
         *
         * @return integer|float
         */
        public function getMissingWidth() {}

        /**
         * Get information about the font.
         *
         * @param string $name The name of the font
         * @return bool|string
         */
        public function getInfo($name) {}

        /**
         * Get the width of a glyph/character.
         *
         * @param string $char The character
         * @param string $encoding The input encoding
         * @return float|int
         */
        public function getGlyphWidth($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the width of a glpyh by its char code.
         *
         * @param string $charCode
         * @return float|int
         */
        public function getGlyphWidthByCharCode($charCode) {}

        /**
         * Get the width of the glyphs/characters.
         *
         * @param string $chars The characters
         * @param string $encoding The input encoding
         * @return float|int
         */
        public function getGlyphsWidth($chars, $encoding = 'UTF-16BE') {}

        /**
         * Get the width of glyphs by their char codes.
         *
         * @param string $charCodes
         * @return float|int
         */
        public function getGlyphsWidthByCharCodes($charCodes) {}

        /**
         * Get the final character code of a single character.
         *
         * @param string $char The character
         * @param string $encoding The output encoding
         * @return string
         */
        public function getCharCode($char, $encoding = 'UTF-16BE') {}

        /**
         * Get the final character codes of a character string.
         *
         * @param string $chars The character string
         * @param string $encoding The output encoding
         * @return array
         */
        public function getCharCodes($chars, $encoding = 'UTF-16BE') {}

        /**
         * Converts a char code from the font specific encoding to another encoding.
         *
         * @param string $charCode The char code in the font specific encoding.
         * @param string $encoding The resulting encoding
         * @return string
         */
        public function getCharByCharCode($charCode, $encoding = 'UTF-8') {}

        /**
         * Converts char codes from the font specific encoding to another encoding.
         *
         * @param string $charCodes The char codes in the font specific encoding.
         * @param string $encoding The resulting encoding
         * @param bool $asArray
         * @return string|array
         */
        public function getCharsByCharCodes($charCodes, $encoding = 'UTF-8', $asArray = true) {}

        /**
         * Split a string of char codes into single char codes.
         *
         * @param string $charCodes
         * @return array
         */
        public function splitCharCodes($charCodes) {}

    }
}

namespace
{

    /**
     * Base class for image handling
     * 
     * This class is responsible for getting the correct image type implementation for
     * a desired image type.
     * 
     * Actually PNG and JPEG classes exist. 
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Image
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_Image
    {
        /**
         * Image type
         *
         * @var string
         */
        const TYPE_JPEG = 'jpeg';

        /**
         * Image type
         *
         * @var string
         */
        const TYPE_GIF = 'gif';

        /**
         * Image type
         *
         * @var string
         */
        const TYPE_JPEG2000 = 'jpeg2000';

        /**
         * Image type
         *
         * @var string
         */
        const TYPE_PNG = 'png';

        /**
         * Image type
         *
         * @var string
         */
        const TYPE_TIFF = 'tiff';

        /**
         * Image type
         *
         * @var string
         */
        const TYPE_UNKNOWN = 'unknown';

        /**
         * Binary Reader
         *
         * @var SetaPDF_Core_Reader_Binary
         */
        protected $_binaryReader;

        /**
         * Bits per component
         *
         * @var integer
         */
        protected $_bitsPerComponent = 8;

        /**
         * The pixel width
         *
         * @var integer
         */
        protected $_width;

        /**
         * The pixel height
         *
         * @var integer
         */
        protected $_height;

        /**
         * Dots-per-inch in the X direction
         *
         * @var integer
         */
        protected $_dpiX = 0;

        /**
         * Dots-per-inch in the Y direction
         *
         * @var integer
         */
        protected $_dpiY = 0;

        /**
         * The image type specific colorspace
         *
         * @var integer
         */
        protected $_colorSpace;

        /**
         * Flag for color inversion
         *
         * @var boolean
         * todo Use it
         */
        protected $_inverted = false;

        /**
         * Get an image by a reader.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader The reader instance
         * @throws SetaPDF_Exception_NotImplemented If the image type is not supported (supported types: JPEG, PNG, JPEG2000).
         * @return SetaPDF_Core_Image
         */
        public static function get(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * Get an image by a path.
         *
         * @param string $path The path to the image
         * @return SetaPDF_Core_Image
         */
        public static function getByPath($path) {}

        /**
         * Get an image type by a reader.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         * @return string
         */
        public static function getType(\SetaPDF_Core_Reader_ReaderInterface $reader) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function __construct(?\SetaPDF_Core_Reader_ReaderInterface $reader = null) {}

        /**
         * Processes the image data so all needed information is available.
         */
        abstract protected function _process();

        /**
         * Converts an image to an external object.
         *
         * @param SetaPDF_Core_Document $document
         * @return SetaPDF_Core_XObject_Image
         */
        abstract public function toXObject(\SetaPDF_Core_Document $document);

        /**
         * Get the bits per component value.
         *
         * @return number
         */
        public function getBitsPerComponent() {}

        /**
         * Get the width.
         *
         * @param float $height Value for keeping the aspect ratio
         * @return number
         */
        public function getWidth($height = null) {}

        /**
         * Get the height.
         *
         * @param float $width Value for keeping the aspect ratio
         * @return number
         */
        public function getHeight($width = null) {}

        /**
         * Get the dots-per-inch in the X direction.
         *
         * @return number
         */
        public function getDpiX() {}

        /**
         * Get the dots-per-inch in the Y direction.
         *
         * @return number
         */
        public function getDpiY() {}

        /**
         * Get the image type specific colorspace.
         *
         * @return number
         */
        public function getColorSpace() {}

    }
}

namespace
{

    /**
     * A class representing an Output Intent dictionary entry
     *
     * @see PDF 32000-1:2008 - 14.11.5 Output Intents
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_OutputIntent
    {
        /**
         * Predefined output intent subtype
         *
         * @var string
         */
        const SUBTYPE_GTS_PDFX = 'GTS_PDFX';

        /**
         * Predefined output intent subtype
         *
         * @var string
         */
        const SUBTYPE_GTS_PDFA1 = 'GTS_PDFA1';

        /**
         * Predefined output intent subtype
         *
         * @var string
         */
        const SUBTYPE_ISO_PDFE1 = 'ISO_PDFE1';

        /**
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * Creates an output intent instance.
         *
         * @param string $subtype
         * @param SetaPDF_Core_IccProfile_Stream $profile
         * @return SetaPDF_Core_OutputIntent
         */
        public static function createByProfile($subtype, \SetaPDF_Core_IccProfile_Stream $profile) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         * @throws InvalidArgumentException if
         */
        public function __construct(\SetaPDF_Core_Type_Dictionary $dictionary) {}

        /**
         * Get the dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the subtype.
         *
         * @param string $subtype
         */
        public function setSubtype($subtype) {}

        /**
         * Get the subtype.
         *
         * @return mixed
         */
        public function getSubtype() {}

        /**
         * Set the text string concisely identifying the intended output device or production condition in human-readable form.
         *
         * @param string|null $outputCondition
         * @param string $encoding
         */
        public function setOutputCondition($outputCondition, $encoding = 'UTF-8') {}

        /**
         * Get the text string concisely identifying the intended output device or production condition in human-readable form.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getOutputCondition($encoding = 'UTF-8') {}

        /**
         * Set the text string identifying the intended output device or production condition in human- or machine-readable form.
         *
         * @param string|null $outputConditionIdentifier
         * @param string $encoding
         */
        public function setOutputConditionIdentifier($outputConditionIdentifier, $encoding = 'UTF-8') {}

        /**
         * Get the text string identifying the intended output device or production condition in human- or machine-readable form.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getOutputConditionIdentifier($encoding = 'UTF-8') {}

        /**
         * Set the registry in which the condition designated by OutputConditionIdentifier is defined.
         *
         * @param string|null $registryName
         * @param string $encoding
         */
        public function setRegistryName($registryName, $encoding = 'UTF-8') {}

        /**
         * Get the registry in which the condition designated by OutputConditionIdentifier is defined.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getRegistryName($encoding = 'UTF-8') {}

        /**
         * Set the human-readable text string containing additional information or comments about the intended target device or production condition.
         *
         * @param string|null $info
         * @param string $encoding
         */
        public function setInfo($info, $encoding = 'UTF-8') {}

        /**
         * Get the human-readable text string containing additional information or comments about the intended target device or production condition.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getInfo($encoding = 'UTF-8') {}

        /**
         * Set the ICC profile stream defining the transformation from the PDF document’s source colours to output device colorants.
         *
         * @param SetaPDF_Core_IccProfile_Stream $stream
         */
        public function setDestOutputProfile(?\SetaPDF_Core_IccProfile_Stream $stream = null) {}

        /**
         * Get the ICC profile stream defining the transformation from the PDF document’s source colours to output device colorants.
         *
         * @return null|SetaPDF_Core_IccProfile_Stream
         */
        public function getDestOutputProfile() {}

        /**
         * Set a text stream in the dictionary.
         *
         * @param string $key
         * @param string $value
         * @param string $encoding
         */
        protected function _setTextString($key, $value, $encoding) {}

        /**
         * @param string $key
         * @param string $encoding
         * @return null|string
         */
        protected function _getTextString($key, $encoding) {}

    }
}

namespace
{

    /**
     * Page Boundaries
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_PageBoundaries
    {
        /**
         * MediaBox
         *
         * The media box defines the boundaries of the physical medium on which the page is to be printed.
         *
         * @see PDF 32000-1:2008 - 14.11.2 Page Boundaries
         * @var string
         */
        const MEDIA_BOX = 'MediaBox';

        /**
         * CropBox
         *
         * The crop box defines the region to which the contents of the page shall be clipped (cropped) when displayed or
         * printed.
         *
         * @see PDF 32000-1:2008 - 14.11.2 Page Boundaries
         * @var string
         */
        const CROP_BOX = 'CropBox';

        /**
         * BleedBox
         *
         * The bleed box defines the region to which the contents of the page shall be clipped when output in a
         * production environment.
         *
         * @see PDF 32000-1:2008 - 14.11.2 Page Boundaries
         * @var string
         */
        const BLEED_BOX = 'BleedBox';

        /**
         * TrimBox
         *
         * The trim box defines the intended dimensions of the finished page after trimming.
         *
         * @see PDF 32000-1:2008 - 14.11.2 Page Boundaries
         * @var string
         */
        const TRIM_BOX = 'TrimBox';

        /**
         * ArtBox
         *
         * The art box defines the extent of the page’s meaningful content (including potential white space) as intended
         * by the page’s creator.
         *
         * @see PDF 32000-1:2008 - 14.11.2 Page Boundaries
         * @var string
         */
        const ART_BOX = 'ArtBox';

        /**
         * All page boundaries
         *
         * @var array
         */
        public static $all = [/** value is missing */];

        /**
         * Checks if a name is a valid page boundary name.
         *
         * @param string $name The boundary name
         * @return boolean A boolean value whether the name is valid or not.
         */
        public static function isValidName($name) {}

        /**
         * Prohibit object initiation by defining the constructor to be private.
         *
         * @internal
         */
        private function __construct() {}

    }
}

namespace
{

    /**
     * Class for getting and handling page formats
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_PageFormats
    {
        /**
         * Page format constant
         *
         * @var string
         */
        const A3 = 'a3';

        /**
         * Page format constant
         *
         * @var string
         */
        const A4 = 'a4';

        /**
         * Page format constant
         *
         * @var string
         */
        const A5 = 'a5';

        /**
         * Page format constant
         *
         * @var string
         */
        const LETTER = 'letter';

        /**
         * Page format constant
         *
         * @var string
         */
        const LEGAL = 'legal';

        /**
         * Portrait orientation
         *
         * @var string
         */
        const ORIENTATION_PORTRAIT = 'portrait';

        /**
         * Landscape orientation
         *
         * @var string
         */
        const ORIENTATION_LANDSCAPE = 'landscape';

        /**
         * If this orientation is used the 0 key will be the width while 1 will hold the height
         *
         * @var string
         */
        const ORIENTATION_AUTO = 'auto';

        /**
         * Formats in default user space (points) in portrait orientation
         *
         * @var array width, height
         */
        public static $formats = [/** value is missing */];

        /**
         * Returns a normalized format by a page format name or by an array.
         *
         * @param string|array $format The format as an array with 2 values or a pre-defined format constant
         * @param string $orientation The orientation
         * @return array Array where the keys '0' and 'width' are the width and keys '1' and 'height' are the height.
         * @throws InvalidArgumentException
         */
        public static function getFormat($format, $orientation = self::ORIENTATION_PORTRAIT) {}

        /**
         * Returns the orientation using width and height.
         *
         * @param int|float $width
         * @param int|float $height
         * @return string See SetaPDF_Core_PageFormats::ORIENTATION_XXX constants
         */
        public static function getOrientation($width, $height) {}

        /**
         * Get a page format as a boundary rect as a SetaPDF_Core_Type_Array.
         *
         * @param string|array $format
         * @param string $orientation
         * @param string $boundaryName
         * @return SetaPDF_Core_Type_Array|SetaPDF_Core_Type_Dictionary_Entry
         * @todo TEST THIS
         */
        public static function getAsBoundary($format, $orientation = self::ORIENTATION_PORTRAIT, $boundaryName = null) {}

        /**
         * Get the height of a page format.
         *
         * @param string|array $format
         * @param string $orientation
         * @return integer
         */
        public static function getHeight($format, $orientation = self::ORIENTATION_PORTRAIT) {}

        /**
         * Get the width of a page format.
         *
         * @param string|array $format
         * @param string $orientation
         * @return integer
         */
        public static function getWidth($format, $orientation = self::ORIENTATION_PORTRAIT) {}

        /**
         * Checks if a rectangle is approximately the same size as a given format.
         *
         * @param string|array $format The format as an array or as one of the defined page formats
         * @param array|SetaPDF_Core_Document_Page|SetaPDF_Core_DataStructure_Rectangle|SetaPDF_Core_Geometry_Rectangle $rect The rectangle or the page that needs to be compared
         * @param int|float $threshold The allowed difference between the rectangle and the format
         * @return boolean|string false or a string containing the matched orientation.
         */
        public static function is($format, $rect, $threshold = 1) {}

        /**
         * Prohibit object initiation by defining the constructor to be private.
         *
         * @internal
         */
        private function __construct() {}

    }
}

namespace
{

    /**
     * Interface for PDF resources
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    interface SetaPDF_Core_Resource
    {
        const TYPE_FONT = 'Font';

        const TYPE_X_OBJECT = 'XObject';

        const TYPE_EXT_G_STATE = 'ExtGState';

        const TYPE_COLOR_SPACE = 'ColorSpace';

        const TYPE_PATTERN = 'Pattern';

        const TYPE_SHADING = 'Shading';

        const TYPE_PROPERTIES = 'Properties';

        const TYPE_PROC_SET = 'ProcSet';

        /**
         * Get the indirect object of this resource.
         *
         * @param SetaPDF_Core_Document|null $document
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null);

        /**
         * Get the resource type of an implementation.
         * 
         * @return string
         */
        public function getResourceType();

    }
}

namespace
{

    /**
     * Main class for PDF security handlers
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage SecHandler
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_SecHandler
    {
        /**
         * Standard Security Handler
         *
         * @var string
         */
        const STANDARD = 'standard';

        /**
         * Public Key Security Handler
         *
         * @var string
         */
        const PUB_KEY = 'publicKey';

        /**
         * Encryption constant
         *
         * @var string
         */
        const ARCFOUR = 4;

        /**
         * Encryption constant
         *
         * @var string
         */
        const ARCFOUR_40 = 12;

        /**
         * Encryption constant
         *
         * @var string
         */
        const ARCFOUR_128 = 20;

        /**
         * Encryption constant
         *
         * @var string
         */
        const AES = 32;

        /**
         * Encryption constant
         *
         * @var string
         */
        const AES_128 = 96;

        /**
         * Encryption constant
         *
         * @var string
         */
        const AES_256 = 160;

        /**
         * Permission constant.
         *
         * For handlers of revision 2: Print the document.
         *
         * Handlers of a revision of 3 or greater: Print the document (possibly not at the highest quality level, depending
         * on whether {@link SetaPDF_Core_SecHandler::PERM_DIGITAL_PRINT} is also set).
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_PRINT = 4;

        /**
         * Permission constant.
         *
         * Modify the contents of the document by operations other than those controlled by
         * {@link SetaPDF_Core_SecHandler::PERM_ANNOT}, {@link SetaPDF_Core_SecHandler::PERM_FILL_FORM} and
         * {@link SetaPDF_Core_SecHandler::PERM_ASSEMBLE}.
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_MODIFY = 8;

        /**
         * Permission constant.
         *
         * For handlers of revision 2: Copy or otherwise extract text and graphics from the document, including extracting
         * text and graphics (in support of accessibility to users with disabilities or for other purposes).
         *
         * For handlers of revision 3 or greater: Copy or otherwise extract text and graphics from the document by
         * operations other than that controlled by bit {@link SetaPDF_Core_SecHandler::PERM_ACCESSIBILITY}.
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_COPY = 16;

        /**
         * Permission constant.
         *
         * Add or modify text annotations, fill in interactive form fields, and, if {@link SetaPDF_Core_SecHandler::PERM_MODIFY}
         * is also set, create or modify interactive form fields (including signature fields).
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_ANNOT = 32;

        /**
         * Permission constant.
         *
         * For handlers of revision 3 or greater: Fill in existing interactive form fields (including signature fields),
         * even if {@link SetaPDF_Core_SecHandler::PERM_ANNOT} is not set.
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_FILL_FORM = 256;

        /**
         * Permission constant.
         *
         * For handlers of revision 3 or greater: Extract text and graphics (in support of accessibility to users with
         * disabilities or for other purposes).
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_ACCESSIBILITY = 512;

        /**
         * Permission constant.
         *
         * For handlers of revision 3 or greater: Assemble the document (insert, rotate, or delete pages and create
         * bookmarks or thumbnail images), even if {@link SetaPDF_Core_SecHandler::PERM_MODIFY} is not set.
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_ASSEMBLE = 1024;

        /**
         * Permission constant.
         *
         * Print the document to a representation from which a faithful digital copy of the PDF content could be generated.
         * When this is not set (and {@link SetaPDF_Core_SecHandler::PERM_PRINT} is set), printing is limited to a low-level
         * representation of the appearance, possibly of degraded quality.
         *
         * @see PDF 32000-1:2008 - Table 22 - User access permissions
         * @var integer
         */
        const PERM_DIGITAL_PRINT = 2048;

        /**
         * User auth mode
         *
         * @var string
         */
        const USER = 'user';

        /**
         * Owner auth mode
         *
         * @var string
         */
        const OWNER = 'owner';

        /**
         * The encryption engine to use (mcrypt or openssl).
         *
         * @var string
         */
        public static $engine = 'openssl';

        /**
         * Checks a permission against the security handler of a document.
         *
         * @param SetaPDF_Core_Document $document The document instance
         * @param integer $permission Permission to check
         * @param null|string $message Custom error message
         * @return bool
         * @throws SetaPDF_Core_SecHandler_Exception if no rights are granted for the permission.
         */
        public static function checkPermission(\SetaPDF_Core_Document $document, $permission, $message = null) {}

        /**
         * Returns a standard predefined security handler.
         *
         * The type parameter will define things like algorithm and key length.
         * Additionally the type could be an encryption dictionary,
         * which will setup the desired security handler.
         *
         * @param SetaPDF_Core_Document $document
         * @param SetaPDF_Core_Type_Dictionary $encryptionDictionary
         * @return SetaPDF_Core_SecHandler_SecHandlerInterface
         * @throws SetaPDF_Core_Exception
         * @throws SetaPDF_Exception_NotImplemented
         */
        public static function factory(\SetaPDF_Core_Document $document, \SetaPDF_Core_Type_Dictionary $encryptionDictionary) {}

        /**
         * Encrypts or decrypts data using the RC4/Arcfour algorithm.
         *
         * @param string $key
         * @param string $data
         * @return string
         */
        public static function arcfour($key, $data) {}

        /**
         * Encrypts data using AES 128 bit algorithm.
         *
         * @param string $key
         * @param string $data
         * @return string
         */
        public static function aes128Encrypt($key, $data) {}

        /**
         * Encrypts data using AES 256 bit algorithm.
         *
         * @param string $key
         * @param string $data
         * @return string
         */
        public static function aes256Encrypt($key, $data) {}

        /**
         * Decrypts data using AES 128 bit algorithm.
         *
         * @param string $key
         * @param string $data
         * @return string
         */
        public static function aes128Decrypt($key, $data) {}

        /**
         * Decrypts data using AES 256 bit algorithm.
         *
         * @param string $key
         * @param string $data
         * @return string
         */
        public static function aes256Decrypt($key, $data) {}

    }
}

namespace
{

    /**
     * Helper class for writing and handling text
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Text
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Text
    {
        /**
         * Alignment constant
         *
         * @var string
         */
        const ALIGN_LEFT = 'left';

        /**
         * Alignment constant
         *
         * @var string
         */
        const ALIGN_CENTER = 'center';

        /**
         * Alignment constant
         *
         * @var string
         */
        const ALIGN_RIGHT = 'right';

        /**
         * Alignment constant
         *
         * @var string
         */
        const ALIGN_JUSTIFY = 'justify';

        /**
         * Delimiter characters to recognize text blocks
         *
         * Value 0 means that the character prefer breaking after that character e.g. ! or ?
         *
         * Value 1 means that the character prefer breaking before that character e.g. + or :
         *
         * @var array
         */
        public static $possibleDelimiter = [/** value is missing */];

        /**
         * Characters that can ignore the delimiters and 'glues' multiple textblocks together
         *
         * @var array
         */
        public static $possibleGlueCharacters = [/** value is missing */];

        /**
         * Splits a UTF-16BE encoded string into lines based on a specific font and width.
         *
         * @param string $text The text encoded in UTF-16BE
         * @param float $width
         * @param SetaPDF_Core_Font_Glyph_Collection_CollectionInterface $font
         * @param float $fontSize
         * @param int $charSpacing
         * @param int $wordSpacing
         * @return array An array of UTF-16BE encoded strings
         * @throws InvalidArgumentException
         */
        public static function getLines($text, $width = null, ?\SetaPDF_Core_Font_Glyph_Collection_CollectionInterface $font = null, $fontSize = null, $charSpacing = 0, $wordSpacing = 0) {}

        /**
         * Normalizes line breaks in an UTF-16BE encoded string.
         *
         * \r\n to \n
         * \r to \n
         *
         * @param string $text
         * @return string
         */
        public static function normalizeLineBreaks($text) {}

    }
}

namespace
{

    /**
     * Tokenizer class for PDF documents
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Tokenizer
    {
        /**
         * The reader object
         *
         * @var SetaPDF_Core_Reader_ReaderInterface
         */
        protected $_reader;

        protected $stack = [/** value is missing */];

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function __construct(\SetaPDF_Core_Reader_ReaderInterface &$reader) {}

        /**
         * Clean up resources and release cycled references.
         */
        public function cleanUp() {}

        /**
         * Clears the token stack.
         */
        public function clearStack() {}

        /**
         * Add a token onto the token stack.
         *
         * @param string $token
         */
        public function pushStack($token) {}

        /**
         * Set the reader class.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface $reader
         */
        public function setReader(\SetaPDF_Core_Reader_ReaderInterface &$reader) {}

        /**
         * Get the reader class.
         *
         * @return SetaPDF_Core_Reader_ReaderInterface
         */
        public function getReader() {}

        /**
         * Read a token from the reader (or internal stack).
         *
         * @return string
         */
        public function readToken() {}

        /**
         * Leap white spaces.
         *
         * @return boolean
         */
        public function leapWhiteSpaces() {}

        /**
         * Check if the current byte is a regular character.
         *
         * @return boolean
         */
        public function isCurrentByteRegularCharacter() {}

    }
}

namespace
{

    /**
     * Class representing a transparency group
     * 
     * @see PDF 32000-1:2008 - 11.6.6 Transparency Group XObjects
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_TransparencyGroup
    {
        /**
         * The dictionary
         * 
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * Creates a "Transparency Group XObjects" Group dictionary.
         * 
         * @return SetaPDF_Core_Type_Dictionary
         */
        public static function createDictionary() {}

        /**
         * Creates the Group dictionary for an Transparency Group XObject.
         * 
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         * @throws InvalidArgumentException
         */
        public function __construct($dictionary = null) {}

        /**
         * Get the dictionary.
         * 
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the colorspace for this group.
         * 
         * Actually only standard color spaces are allowed.
         * 
         * @param string|SetaPDF_Core_Type_Name $colorSpace
         */
        public function setColorSpace($colorSpace) {}

        /**
         * Return the color space.
         * 
         * @return SetaPDF_Core_Type_Name|SetaPDF_Core_Type_Array|null
         */
        public function getColorSpace() {}

        /**
         * Checks whether the transparency group is isolated.
         * 
         * @return boolean
         */
        public function isIsolated() {}

        /**
         * Set whether the transparency group is isolated.
         * 
         * @param boolean $isolated
         */
        public function setIsolated($isolated) {}

        /**
         * Checks whether the transparency group is a knockout group.
         * 
         * @return boolean
         */
        public function isKnockoutGroup() {}

        /**
         * Set whether the transparency group is a knockout group.
         *
         * @param boolean $knockoutGroup
         */
        public function setKnockoutGroup($knockoutGroup) {}

    }
}

namespace
{

    /**
     * A simple write interface
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
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
}

namespace
{

    /**
     * Class for writer constants and short hand writer object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @subpackage Writer
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core_Writer implements \SetaPDF_Core_WriteInterface
    {
        /**
         * Writer status flag
         *
         * @var integer
         */
        const ACTIVE = 1;

        /**
         * Writer status flag
         *
         * @var integer
         */
        const INACTIVE = 0;

        /**
         * Writer status flag
         *
         * @var integer
         */
        const FINISHED = null;

        /**
         * Writer status flag
         *
         * @var integer
         */
        const CLEANED_UP = null;

        /**
         * The content of the writer
         *
         * @var string
         */
        public $content = '';

        /**
         * Writes bytes to the output.
         *
         * @param string $bytes
         */
        public function write($bytes) {}

        /**
         * Implementation of the __toString method.
         *
         * @return string
         */
        public function __toString() {}

    }
}

namespace
{

    /**
     * Abstract class representing an external object
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    abstract class SetaPDF_Core_XObject implements \SetaPDF_Core_Resource
    {
        /**
         * An array caching XObject objects
         *
         * @var array
         */
        protected static $_xObjects = [/** value is missing */];

        /**
         * The indirect object of the XObject
         *
         * @var SetaPDF_Core_Type_IndirectObject
         */
        protected $_indirectObject;

        /**
         * Release XObject instances by a document instance.
         *
         * @param SetaPDF_Core_Document $document
         */
        public static function freeCache(\SetaPDF_Core_Document $document) {}

        /**
         * Get an external object by an indirect object/reference.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $xObjectReference
         * @param string $subType
         * @return SetaPDF_Core_XObject_Form|SetaPDF_Core_XObject_Image
         * @throws SetaPDF_Exception_NotImplemented
         */
        public static function get(\SetaPDF_Core_Type_IndirectObjectInterface $xObjectReference, $subType = null) {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_IndirectObjectInterface $indirectObject
         */
        public function __construct(\SetaPDF_Core_Type_IndirectObjectInterface $indirectObject) {}

        /**
         * Release memory and cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the indirect object of this XObject.
         *
         * @param SetaPDF_Core_Document|null $document
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getIndirectObject(?\SetaPDF_Core_Document $document = null) {}

        /**
         * Get the resource type for external objects.
         * 
         * @see SetaPDF_Core_Resource::getResourceType()
         * @return string
         */
        public function getResourceType() {}

        /**
         * Draw the external object on the canvas.
         *
         * @param SetaPDF_Core_Canvas $canvas
         * @param int $x
         * @param int $y
         * @param null|float $width
         * @param null|float $height
         * @return mixed
         */
        abstract public function draw(\SetaPDF_Core_Canvas $canvas, $x = 0, $y = 0, $width = null, $height = null);

    }
}

namespace
{

    /**
     * Not implemented exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Exception_NotImplemented extends \SetaPDF_Exception
    {
    }
}

namespace
{

    /**
     * Class representing a field in a schema.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Collection_Schema_Field
    {
        /**
         * The fields dictionary.
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * Create a schema field by a name and data type.
         *
         * @param string $fieldName
         * @param string $dataType
         * @param string $encoding
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public static function create($fieldName, $dataType, $encoding = 'UTF-8') {}

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary $dictionary
         */
        public function __construct(\SetaPDF_Core_Type_Dictionary $dictionary) {}

        /**
         * Get the fields dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the data type.
         *
         * @param string $dataType
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public function setDataType($dataType) {}

        /**
         * Get the data type.
         *
         * @return string
         */
        public function getDataType() {}

        /**
         * Set the textual field name that shall be presented to the user by the interactive PDF processor.
         *
         * @param string $name
         * @param string $encoding
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public function setName($name, $encoding = 'UTF-8') {}

        /**
         * Get the textual field name that shall be presented to the user by the interactive PDF processor.
         *
         * @param string $encoding
         * @return string
         */
        public function getName($encoding = 'UTF-8') {}

        /**
         * Set the relative order of the field name in the user interface.
         *
         * If you set it, you should set this in all fields. Otherwise you will get an unexpected result in different
         * PDF viewers.
         *
         * @param integer $order
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public function setOrder($order) {}

        /**
         * Get the relative order of the field name in the user interface.
         *
         * @return integer|null
         */
        public function getOrder() {}

        /**
         * Set the initial visibility of the field in the user interface.
         *
         * @param boolean $visibility
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public function setVisibility($visibility) {}

        /**
         * Get the initial visibility of the field in the user interface.
         *
         * @return boolean
         */
        public function getVisibility() {}

        /**
         * Set a flag indicating whether the interactive PDF processor should provide support for editing the field value.
         *
         * @param boolean $allowEdit
         * @return SetaPDF_Merger_Collection_Schema_Field
         */
        public function setAllowEdit($allowEdit) {}

        /**
         * Get a flag indicating whether the interactive PDF processor should provide support for editing the field value.
         *
         * @return boolean
         */
        public function getAllowEdit() {}

    }
}

namespace
{

    /**
     * Class representing a folder in a PDF Collection/Portfolio/Package.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Collection_Folder
    {
        /**
         * The collection instance.
         *
         * @var SetaPDF_Merger_Collection
         */
        protected $_collection;

        /**
         * The folder dictionary.
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The indirect object for this folder.
         *
         * @var null|SetaPDF_Core_Type_IndirectObject
         */
        protected $_indirectObject;

        /**
         * The constructor.
         *
         * @param SetaPDF_Merger_Collection $collection
         * @param string|SetaPDF_Core_Type_IndirectObjectInterface $indirectObjectOrName A folder name or an indirect
         *                                                                               object/reference to a dictionary
         *                                                                               representing a folder.
         */
        public function __construct(\SetaPDF_Merger_Collection $collection, $indirectObjectOrName) {}

        /**
         * Get the collection instance.
         *
         * @return SetaPDF_Merger_Collection
         */
        public function getCollection() {}

        /**
         * Get the indirect reference for this folder.
         *
         * @return SetaPDF_Core_Type_IndirectObject
         */
        public function getIndirectObject() {}

        /**
         * Get the dictionary for this folder.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the folder name.
         *
         * @param string $name The folder name in UTF-8 encoding.
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setName($name) {}

        /**
         * Get the folder name.
         *
         * @return string The folder name in UTF-8 encoding.
         */
        public function getName() {}

        /**
         * Get an folder instance of the parent folder.
         *
         * @return SetaPDF_Merger_Collection_Folder|false
         */
        public function getParent() {}

        /**
         * Set a parent folder.
         *
         * @param SetaPDF_Merger_Collection_Folder $parent
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setParent(\SetaPDF_Merger_Collection_Folder $parent) {}

        /**
         * Get and/or create the folder id.
         *
         * @return integer
         * @throws SetaPDF_Merger_Exception
         */
        public function getId() {}

        /**
         * Add a file to this folder.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface|string $pathOrReader A reader instance or a path to a file.
         * @param string $filename The filename in UTF-8 encoding.
         * @param null|string $description The description of the file.
         * @param array $fileStreamParams See {@link SetaPDF_Core_EmbeddedFileStream::setParams() SetaPDF_Core_EmbeddedFileStream::setParams()} method.
         * @param null|string $mimeType The subtype of the embedded file. Shall conform to the MIME media type names defined
         *                              in Internet RFC 2046
         * @param null|array|SetaPDF_Merger_Collection_Item $collectionItem The data described by the collection schema.
         * @return string The name that was used to register the file specification in the embedded files name tree.
         */
        public function addFile($pathOrReader, $filename, $description = null, array $fileStreamParams = [/** value is missing */], $mimeType = null, $collectionItem = null) {}

        /**
         * Set the collection item data.
         *
         * The data described by the collection schema.
         *
         * @param SetaPDF_Merger_Collection_Item|null $item
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setCollectionItem(?\SetaPDF_Merger_Collection_Item $item = null) {}

        /**
         * Get the collection item data.
         *
         * The data described by the collection schema.
         *
         * @return null|SetaPDF_Merger_Collection_Item
         */
        public function getCollectionItem() {}

        /**
         * Set the descriptive text associated with the file specification.
         *
         * @param string|null $desc
         * @param string $encoding
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setDescription($desc, $encoding = 'UTF-8') {}

        /**
         * Get the descriptive text associated with the file specification.
         *
         * @param string $encoding
         * @return null|string
         */
        public function getDescription($encoding = 'UTF-8') {}

        /**
         * Set the date the folder was first created.
         *
         * @param DateTime|null $creationDate
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setCreationDate(?\DateTime $creationDate = null) {}

        /**
         * Get the date the folder was first created.
         *
         * @return null|DateTime
         */
        public function getCreationDate() {}

        /**
         * Set the date of the most recent change to immediate child files or folders of this folder.
         *
         * @param DateTime|null $creationDate
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function setModificationDate(?\DateTime $creationDate = null) {}

        /**
         * Get the date of the most recent change to immediate child files or folders of this folder.
         *
         * @return null|DateTime
         */
        public function getModificationDate() {}

        /**
         * Add a subfolder to this folder.
         *
         * @param string $name The folder name.
         * @param null|string $description The description of the folder.
         * @param DateTime|null $creationDate If null "now" will be used.
         * @param DateTime|null $modificationDate If null "now" will be used.
         * @param null|array|SetaPDF_Merger_Collection_Item $collectionItem The data described by the collection schema.
         * @return SetaPDF_Merger_Collection_Folder
         */
        public function addFolder($name, $description = null, ?\DateTime $creationDate = null, ?\DateTime $modificationDate = null, $collectionItem = null) {}

        /**
         * Checks whether this folder has subfolders or not.
         *
         * @return boolean
         */
        public function hasSubfolders() {}

        /**
         * Get a folder by its name in UTF-8 encoding.
         *
         * @param string $name
         * @return false|SetaPDF_Merger_Collection_Folder
         */
        public function getSubfolder($name) {}

        /**
         * Get all subfolders of this folder.
         *
         * @return SetaPDF_Merger_Collection_Folder[]
         */
        public function getSubfolders() {}

        /**
         * Get all file specifications defined for this folder.
         *
         * @return array
         */
        protected function _getFiles() {}

        /**
         * Get all files in this folder.
         *
         * @return SetaPDF_Core_FileSpecification[] The keys are the names with which the files are registered in the
         *                                          embedded files name tree.
         */
        public function getFiles() {}

        /**
         * Get a file in this folder by its name in the embedded files name tree.
         *
         * @param string $name
         * @return false|SetaPDF_Core_FileSpecification
         */
        public function getFile($name) {}

        /**
         * Get files and folders in this folder.
         *
         * @return array
         */
        public function getChilds() {}

        /**
         * Delete a file within this folder.
         *
         * @param string $fileName The file name (in PDFDoc or UTF-16BE encoding) needs to be prefixed with the folder id.
         * @return bool
         */
        public function deleteFile($fileName) {}

        /**
         * Delete this folder, subfolders and files.
         *
         * @param bool $recursive Whether folders should be delete folders recursively or not.
         * @param bool $removeEmbeddedFiles Whether file specifications in this folder should be deleted or not.
         */
        public function delete($recursive = true, $removeEmbeddedFiles = true) {}

    }
}

namespace
{

    /**
     * Class representing a collection item.
     *
     * A collection item shall contain the data described in the collection schema for a particular file or folder.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Collection_Item
    {
        /**
         * The collection item dictionary.
         *
         * @var SetaPDF_Core_Type_Dictionary
         */
        protected $_dictionary;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Type_Dictionary|null $dictionary
         */
        public function __construct(?\SetaPDF_Core_Type_Dictionary $dictionary = null) {}

        /**
         * Get the dictionary.
         *
         * @return SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary() {}

        /**
         * Set the data of an entry in this collection item.
         *
         * @param string $name
         * @param mixed $value To create a subitem, pass an array of 2 values where the first value is the data and the
         *                     second value is the prefix.
         * @param null|string|SetaPDF_Merger_Collection_Schema $type If $type is null the type will be resolved by the PHP
         *                                                           type. Othersie a constant value of
         *                                                           SetaPDF_Merger_Collection_Schema::DATA_TYPE_* have to
         *                                                           be passed or an instance of
         *                                                           SetaPDF_Merger_Collection_Schema from which the type
         *                                                           will be resolved automatically and ensured that the
         *                                                           field exists in the schema.
         */
        public function setEntry($name, $value, $type = null) {}

        /**
         * Set several entries in this item.
         *
         * @param array $data The keys are the entry names.
         * @param SetaPDF_Merger_Collection_Schema $schema
         */
        public function setData(array $data, ?\SetaPDF_Merger_Collection_Schema $schema = null) {}

        /**
         * Get the data as PHP values.
         *
         * @return array If the value is a collection subitem the value will be an array of 2 values where the first key
         *               is the value and the second the prefix.
         */
        public function getData() {}

        /**
         * Prepares a value depending on its type.
         *
         * @param string|number $value
         * @param string $type
         * @return SetaPDF_Core_DataStructure_Date|SetaPDF_Core_Type_Numeric|SetaPDF_Core_Type_String
         * @throws SetaPDF_Exception_NotImplemented
         */
        private function _createPdfValue($value, $type) {}

    }
}

namespace
{

    /**
     * Class for handling data schemas in PDF Collections/Portfolios/Packages.
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Collection_Schema
    {
        /**
         * Constant defining a string data type
         *
         * @var string
         */
        const TYPE_STRING = 'S';

        /**
         * Constant defining a date data type
         *
         * @var string
         */
        const TYPE_DATE = 'D';

        /**
         * Constant defining a number type
         *
         * @var string
         */
        const TYPE_NUMBER = 'N';

        /**
         * Constant defining the file name property
         *
         * @var string
         */
        const DATA_FILE_NAME = 'F';

        /**
         * Constant defining the description property
         *
         * @var string
         */
        const DATA_DESCRIPTION = 'Desc';

        /**
         * Constant defining the modification date property
         *
         * @var string
         */
        const DATA_MODIFICATION_DATE = 'ModDate';

        /**
         * Constant defining the creation date property
         *
         * @var string
         */
        const DATA_CREATION_DATE = 'CreationDate';

        /**
         * Constant defining the size property
         *
         * @var string
         */
        const DATA_SIZE = 'Size';

        /**
         * Constant defining the compressed size property
         *
         * @var string
         */
        const DATA_COMPRESSED_SIZE = 'CompressedSize';

        /**
         * The collection instance.
         *
         * @var SetaPDF_Merger_Collection
         */
        protected $_collection;

        /**
         * The constructor.
         *
         * @param SetaPDF_Merger_Collection $collection
         */
        public function __construct(\SetaPDF_Merger_Collection $collection) {}

        /**
         * Remove cycled references.
         */
        public function cleanUp() {}

        /**
         * Get the collection instance.
         *
         * @return SetaPDF_Merger_Collection
         */
        public function getCollection() {}

        /**
         * Get and/or create the schema dictionary.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get all field instances.
         *
         * @return SetaPDF_Merger_Collection_Schema_Field[]
         */
        public function getFields() {}

        /**
         * Check if a field exists.
         *
         * @param string $name
         * @return boolean
         */
        public function hasField($name) {}

        /**
         * Get a field instance by its name.
         *
         * @param string $name
         * @return bool|SetaPDF_Merger_Collection_Schema_Field
         */
        public function getField($name) {}

        /**
         * Add a field to the schema.
         *
         * @param string $name The internal field key name.
         * @param null|string|SetaPDF_Merger_Collection_Schema_Field $fieldOrFieldName The field name or an instance of a field.
         * @param null|string $dataType The data field or type. See class constants for possible values.
         * @param null|integer $order The relative order of the field name in the user interface. You should set this,
         *                            otherwise you will get an unexpected result in different PDF viewers.
         * @return SetaPDF_Merger_Collection_Schema_Field
         * @see SetaPDF_Merger_Collection_Schema::DATA_FILE_NAME
         * @see SetaPDF_Merger_Collection_Schema::DATA_DESCRIPTION
         * @see SetaPDF_Merger_Collection_Schema::DATA_SIZE
         * @see SetaPDF_Merger_Collection_Schema::DATA_CREATION_DATE
         * @see SetaPDF_Merger_Collection_Schema::DATA_MODIFICATION_DATE
         * @see SetaPDF_Merger_Collection_Schema::DATA_COMPRESSED_SIZE
         * @see SetaPDF_Merger_Collection_Schema::TYPE_NUMBER
         * @see SetaPDF_Merger_Collection_Schema::TYPE_STRING
         * @see SetaPDF_Merger_Collection_Schema::TYPE_DATE
         */
        public function addField($name, $fieldOrFieldName = null, $dataType = null, $order = null) {}

        /**
         * Adds several fields to the schema.
         *
         * @param array $fields The keys are the internal field key name while the values are passed as additional parameter
         *                      to the {@link SetaPDF_Merger_Collection_Schema::addField() addField()} method.
         * @see SetaPDF_Merger_Collection_Schema::addField()
         */
        public function addFields(array $fields) {}

        /**
         * Remove a field from the schema.
         *
         * @param $name
         * @return boolean
         */
        public function removeField($name) {}

    }
}

namespace
{

    /**
     * Class for creating and managing PDF Collections (aka Portfolios, or Packages).
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Collection
    {
        /**
         * The collection view shall be presented in details mode.
         *
         * @var string
         */
        const VIEW_DETAILS = 'D';

        /**
         * The collection view shall be presented in tile mode.
         *
         * @var string
         */
        const VIEW_TILE = 'T';

        /**
         * The collection view shall be initially hidden.
         *
         * @var string
         */
        const VIEW_HIDDEN = 'H';

        /**
         * The collection view shall be presented by the navigator specified by the Navigator entry.
         *
         * @var string
         */
        const VIEW_NAVIGATOR = 'C';

        /**
         * Indicates that the window is split horizontally.
         *
         * @var string
         */
        const SPLIT_HORIZONTALLY = 'H';

        /**
         * Indicates that the window is split vertically.
         *
         * @var string
         */
        const SPLIT_VERTICALLY = 'V';

        /**
         * Indicates that the window is not split. The entire window region shall be dedicated to the file navigation view.
         *
         * @var string
         */
        const SPLIT_NO = 'N';

        /**
         * Sort in ascending order.
         *
         * @var boolean
         */
        const SORT_ASC = true;

        /**
         * Sort in descending order.
         *
         * @var string
         */
        const SORT_DESC = false;

        /**
         * The document instance of the cover sheet.
         *
         * @var SetaPDF_Core_Document
         */
        protected $_document;

        /**
         * The schema instance.
         *
         * @var SetaPDF_Merger_Collection_Schema
         */
        protected $_schema;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document $document
         */
        public function __construct(\SetaPDF_Core_Document $document) {}

        /**
         * Release cylced referenced.
         */
        public function cleanUp() {}

        /**
         * Get the document instance.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Checks whether the document instance has the Collection dictionary defined or not.
         *
         * @return boolean
         */
        public function isCollection() {}

        /**
         * Get the collection dictionary.
         *
         * @param bool $create
         * @return null|SetaPDF_Core_Type_Dictionary
         */
        public function getDictionary($create = false) {}

        /**
         * Get the schema instance.
         *
         * @return SetaPDF_Merger_Collection_Schema
         */
        public function getSchema() {}

        /**
         * Set the initial view.
         *
         * @param string $view A view constant.
         * @see SetaPDF_Merger_Collection::VIEW_DETAILS
         * @see SetaPDF_Merger_Collection::VIEW_TILE
         * @see SetaPDF_Merger_Collection::VIEW_HIDDEN
         */
        public function setView($view) {}

        /**
         * Get the initial view.
         *
         * @return string
         */
        public function getView() {}

        /**
         * Set the data that specifies the order in which the collection shall be sorted in the user interface.
         *
         * @param array $sort The key is the field name, while the value defines the direction. Valid key names are field
         *                    names defined in the schema or SetaPDF_Merger_Collection_Schema::DATA_* constants.
         * @see SetaPDF_Merger_Collection::SORT_ASC
         * @see SetaPDF_Merger_Collection::SORT_DESC
         */
        public function setSort(array $sort) {}

        /**
         * Get the data which specifies the order in which in the collection shall be sorted in the user interface.
         *
         * @return array The key is the field name, while the value describing the direction.
         * @see SetaPDF_Merger_Collection::SORT_ASC
         * @see SetaPDF_Merger_Collection::SORT_DESC
         */
        public function getSort() {}

        /**
         * Get and/or creates the split dictionary.
         *
         * @param bool $create
         * @return SetaPDF_Core_Type_Dictionary|null
         */
        private function _getSplitDictionary($create = false) {}

        /**
         * Set the orientation of the splitter bar.
         *
         * @param string $direction
         */
        public function setSplitterDirection($direction) {}

        /**
         * Get the orientation of the splitter bar.
         *
         * @return string|null
         */
        public function getSplitterDirection() {}

        /**
         * Set the initial position of the splitter bar.
         *
         * @param number $position
         */
        public function setSplitterPosition($position) {}

        /**
         * Get the initial position of the splitter bar.
         *
         * @return number|null
         */
        public function getSplitterPosition() {}

        /**
         * Add a file to the collection.
         *
         * @param SetaPDF_Core_Reader_ReaderInterface|string $pathOrReader A reader instance or a path to a file.
         * @param string $filename The filename in UTF-8 encoding.
         * @param null|string $description The description of the file.
         * @param array $fileStreamParams See {@link SetaPDF_Core_EmbeddedFileStream::setParams() SetaPDF_Core_EmbeddedFileStream::setParams()} method.
         * @param null|string $mimeType The subtype of the embedded file. Shall conform to the MIME media type names defined
         *                              in Internet RFC 2046
         * @param null|array|SetaPDF_Merger_Collection_Item $collectionItem The data described by the collection schema.
         * @return string The name that was used to register the file specification in the embedded files name tree.
         */
        public function addFile($pathOrReader, $filename, $description = null, array $fileStreamParams = [/** value is missing */], $mimeType = null, $collectionItem = null) {}

        /**
         * Removes a file from the collection.
         *
         * If the file doesn't exists false will be returned.
         *
         * @param string $name The name with which the file is registered in the documents embedded files name tree.
         * @return bool
         */
        public function deleteFile($name) {}

        /**
         * Set the name of the document, that should be initially presented.
         *
         * If you want to open a document, that is located in a subfolder, you will need to pass the id of the subfolder
         * as a prefix to the name:
         *
         * <code>
         * $collection->setInitialDocument('<' . $folder->getId() . '>' . $name);
         * </code>
         *
         * @param string $name
         */
        public function setInitialDocument($name) {}

        /**
         * Get the name of the document, that should be initially presented.
         *
         * @return string|null Null if it is not defined.
         */
        public function getInitialDocument() {}

        /**
         * Checks whether this collection has folders or not.
         *
         * @return bool
         */
        public function hasFolders() {}

        /**
         * Get and/or created the root folder instance.
         *
         * To ensure that a root folder is created pass true as the $create parameter.
         *
         * @param boolean $create Defines whether to create the folder if it does not exists or not.
         * @return SetaPDF_Merger_Collection_Folder|null
         */
        public function getRootFolder($create = false) {}

        /**
         * Add a folder to the collection.
         *
         * @param string $name The folder name.
         * @param null|string $description The description of the folder.
         * @param DateTime|null $creationDate If null "now" will be used.
         * @param DateTime|null $modificationDate If null "now" will be used.
         * @param null|array|SetaPDF_Merger_Collection_Item $collectionItem The data described by the collection schema.
         * @return SetaPDF_Merger_Collection_Folder
         **/
        public function addFolder($name, $description = null, ?\DateTime $creationDate = null, ?\DateTime $modificationDate = null, $collectionItem = null) {}

        /**
         * Get all embedded files from this collection/document.
         *
         * @return SetaPDF_Core_FileSpecification[]
         */
        public function getFiles() {}

        /**
         * Get a file by its name in the embedded files name tree.
         *
         * @param string $name
         * @return false|SetaPDF_Core_FileSpecification
         */
        public function getFile($name) {}

    }
}

namespace
{

    /**
     * Merger Exception
     * 
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger_Exception extends \SetaPDF_Exception
    {
        /**
         * The filename that was processed while the exception was created
         *
         * @var string
         */
        protected $_pdfFilename;

        /**
         * SetaPDF_Merger_Exception constructor.
         *
         * @param string $message The Exception message to throw.
         * @param int $code The Exception code.
         * @param Exception|null $previous The previous exception used for the exception chaining.
         * @param null $pdfFilename The PDF filename that was processed while the exception was created.
         */
        public function __construct($message = '', $code = 0, ?\Exception $previous = null, $pdfFilename = null) {}

        /**
         * Get the PDF filename that was processed while the exception was created.
         *
         * @return string
         */
        public function getPdfFilename() {}

    }
}

namespace
{

    /**
     * The class for main properties of the SetaPDF-Core Component
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Core
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Core
    {
        /**
         * The version
         *
         * @var string
         */
        const VERSION = '2.26.0.1122';

        /**
         * A float comparison precision
         *
         * @var float
         */
        const FLOAT_COMPARISON_PRECISION = 1.0E-5;

    }
}

namespace
{

    /**
     * Main exception of the SetaPDF package
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Exception extends \Exception
    {
    }
}

namespace
{

    /**
     * The main class of the SetaPDF-Merger Component
     *
     * @copyright  Copyright (c) 2017 Setasign - Jan Slabon (https://www.setasign.com)
     * @category   SetaPDF
     * @package    SetaPDF_Merger
     * @license    https://www.setasign.com/ Commercial
     */
    class SetaPDF_Merger
    {
        /**
         * Version
         *
         * @var string
         */
        const VERSION = '2.26.0.1122';

        /**
         * Constant defines that existing outline items should be copied as child items to the newly created outline item
         *
         * @var string
         */
        const COPY_OUTLINES_AS_CHILDS = 'copyOutlinesAsChilds';

        /**
         * Constant defines that existing outlines items should be copied to the outlines root
         *
         * @var string
         */
        const COPY_OUTLINES_TO_ROOT = 'copyOutlinesToRoot';

        /**
         * Key for the title property of an outline item
         *
         * @var string
         */
        const OUTLINES_TITLE = 'title';

        /**
         * Key for the color property of an outline item
         *
         * @var string
         */
        const OUTLINES_COLOR = 'color';

        /**
         * Key for the bold style property of an outline item
         *
         * @var string
         */
        const OUTLINES_BOLD = 'bold';

        /**
         * Key for the italic style property of an outline item
         *
         * @var string
         */
        const OUTLINES_ITALIC = 'italic';

        /**
         * Key for the parent property of an outline item
         *
         * @var string
         */
        const OUTLINES_PARENT = 'parent';

        /**
         * Key for the copy behavior of an outline item
         *
         * @var string
         */
        const OUTLINES_COPY = 'copy';

        /**
         * Keyword for all pages
         *
         * @var string
         */
        const PAGES_ALL = 'all';

        /**
         * Keyword for the first page
         *
         * @var string
         */
        const PAGES_FIRST = 'first';

        /**
         * Keyword for the last page
         *
         * @var string
         */
        const PAGES_LAST = 'last';

        /**
         * The initial document
         *
         * The initial document is the document to which the
         * new documents/pages will be added.
         *
         * It will be created automatically if none was provided
         * in the constructor.
         *
         * @var SetaPDF_Core_Document
         */
        protected $_initialDocument;

        /**
         * The currently processed document instance.
         *
         * @var SetaPDF_Core_Document
         */
        protected $_currentDocument;

        /**
         * The documents/pages which should be added
         *
         * @var array
         */
        protected $_documents = [/** value is missing */];

        /**
         * Cache for document objects by filename
         *
         * @var array
         */
        protected $_documentCache = [/** value is missing */];

        /**
         * Should names be copied/handled
         *
         * @var boolean
         */
        protected $_handleNames = true;

        /**
         * Callback method used for renaming names
         *
         * @see SetaPDF_Core_DataStructure_NameTree::adjustNameCallback()
         * @var callback
         */
        protected $_adjustNameCallback;

        /**
         * Renamed names
         *
         * @internal
         * @var array
         */
        protected $_renamed = [/** value is missing */];

        /**
         * An array to save information about changed form fields
         *
         * @var array
         */
        public $rewrittenFormFieldNamesData = [/** value is missing */];

        /**
         * Flag saying if same named form fields should be renamed.
         *
         * @var bool
         */
        protected $_renameSameNamedFormFields = true;

        /**
         * A callback which is called just before a page is added to the new document
         *
         * @var null|callback
         * @see SetaPDF_Merger::_beforePageAdded()
         */
        public $beforePageAddedCallback;

        /**
         * A max file handler.
         *
         * @var SetaPDF_Core_Reader_MaxFileHandler
         */
        protected $_maxFileHanlder;

        /**
         * The constructor.
         *
         * @param SetaPDF_Core_Document $initialDocument The initial document to start with
         */
        public function __construct(?\SetaPDF_Core_Document $initialDocument = null) {}

        /**
         * Returns the initial document.
         *
         * @see SetaPDF_Merger::$_initialDocument
         * @return SetaPDF_Core_Document
         */
        public function getInitialDocument() {}

        /**
         * Alias for getInitialDocument.
         *
         * @return SetaPDF_Core_Document
         */
        public function getDocument() {}

        /**
         * Set the writer for the initial document.
         *
         * @param SetaPDF_Core_Writer_WriterInterface $writer The writer instance
         */
        public function setWriter(\SetaPDF_Core_Writer_WriterInterface $writer) {}

        /**
         * Set the maximum file handler.
         *
         * @param SetaPDF_Core_Reader_MaxFileHandler|null $handler
         */
        public function setMaxFileHandler(?\SetaPDF_Core_Reader_MaxFileHandler $handler = null) {}

        /**
         * Get the maximum file handler.
         *
         * @return SetaPDF_Core_Reader_MaxFileHandler|null
         */
        public function getMaxFileHandler() {}

        /**
         * Helper method to get the page count of a document or file.
         *
         * @param string|SetaPDF_Core_Document $filename The filename or the document instance
         * @param boolean $cacheDocumentInstance Cache the document instance or not
         * @return integer
         */
        public function getPageCount($filename, $cacheDocumentInstance = true) {}

        /**
         * Add a document by filename.
         *
         * The document could include dynamic content like form fields, links or any other page annotation.
         *
         * Form fields are handled especially:
         * If a document was added with form fields which names were already used by a previously added
         * document the field name will be suffixed with a slash and a number.
         *
         * This behavior may lead to corrupted java scripts which may calculate field sums by field names!
         *
         * @param string|array $filenameOrConfig The filename or config array. If an array is passed the keys has to be
         *                                       named as the method parameters. All other parameters are optional then.
         * @param mixed $pages                   The pages to add from the file. See
         *                                       {@link SetaPDF_Merger::_checkPageNumber() _checkPageNumber()} for a full
         *                                       description.
         * @param string $name The name for a named destination for this file
         * @param null|string|array $outlinesConfig The outlines config
         * @param boolean $copyLayers Whether to copy layer information of the document
         *
         * @throws InvalidArgumentException
         * @return int|null
         */
        public function addFile($filenameOrConfig, $pages = null, $name = null, $outlinesConfig = null, $copyLayers = true) {}

        /**
         * Add a document.
         *
         * Same as {@link SetaPDF_Merger::addFile() addFile()} but the document has to be passed as
         * {@link SetaPDF_Core_Document} instance.
         *
         * @see addFile()
         *
         * @param SetaPDF_Core_Document|array $documentOrConfig The document or config array. If an array is passed the keys
         *                                                      has to be named as the method parameters. All other
         *                                                      parameters are optional then.
         * @param mixed $pages                                  The pages to add from the file. See
         *                                                      {@link SetaPDF_Merger::_checkPageNumber() _checkPageNumber()}
         *                                                      for a full description.
         * @param string $name The name for a named destination for this document
         * @param null|string|array $outlinesConfig The outlines config
         * @param boolean $copyLayers Whether to copy layer information of the document
         *
         * @throws InvalidArgumentException
         * @return int|null
         */
        public function addDocument($documentOrConfig, $pages = null, $name = null, $outlinesConfig = null, $copyLayers = true) {}

        /**
         * Checks the $outlinesConfig parameter if it is possible to add childs to the resulting outline item.
         *
         * @param string|array $outlinesConfig The outlines config
         * @return int|null
         */
        protected function _checkOutlinesConfig($outlinesConfig) {}

        /**
         * Will be called just before a page is added to the pages tree.
         *
         * An own callback can be defined through the $beforePageAddedCallback property.
         * Or this method can be overwritten to implement own logic in the scope of the class.
         *
         * @param SetaPDF_Core_Document_Page $page The page that will be added
         * @param int $pageNumber The number of the page
         */
        protected function _beforePageAdded(\SetaPDF_Core_Document_Page $page, $pageNumber) {}

        /**
         * Defines that the document's name dictionaries are merged into the resulting document.
         *
         * This behavior is enabled by default. It sadly needs much memory and script runtime,
         * because name trees could be very huge.
         *
         * @param boolean $handleNames The flag status
         * @param null|callback $adjustNameCallback See {@link SetaPDF_Core_DataStructure_Tree::merge()} for a detailed description of the callback
         */
        public function setHandleNames($handleNames = true, $adjustNameCallback = null) {}

        /**
         * Set the flag defining if same named form fields should be renamed (default behavior).
         *
         * If this flag is set to false the fields will be merged so that all same named fields
         * will have the same value. Notice that this could occur in an incorrect appearance if the
         * initial values are different.
         *
         * @param bool $renameSameNamedFormFields The flag status
         */
        public function setRenameSameNamedFormFields($renameSameNamedFormFields = true) {}

        /**
         * Merges the documents/pages in memory.
         *
         * This method merges the documents and/or pages to the initial
         * document object without calling the save()-method.
         * The document is hold in memory until it is "manually" saved through the
         * initial document instance.
         *
         * @return SetaPDF_Core_Document
         * @throws SetaPDF_Core_SecHandler_Exception
         * @throws SetaPDF_Merger_Exception
         */
        public function merge() {}

        /**
         * Handle creation and import of outlines.
         *
         * @param array $touchedPdfs
         * @param array $outlineTargets
         */
        protected function _handleOutlines($touchedPdfs, $outlineTargets) {}

        /**
         * Handle AcroForm data.
         *
         * @param array $touchedPdfs
         */
        protected function _handleAcroForms($touchedPdfs) {}

        /**
         * Handles AcroForm data by merging same named form fields.
         *
         * @param array $touchedPdfs
         */
        protected function _handleAcroFormsByMergingSameNamedFields($touchedPdfs) {}

        /**
         * Handles AcroForm data by renaming same named form fields.
         *
         * @param array $touchedPdfs
         */
        protected function _handleAcroFormsByRenamingSameNamedFields($touchedPdfs) {}

        /**
         * Removes a form field in its parent fields array
         *
         * @param $fieldObject
         */
        protected function _removeFormFieldFromFieldTree($fieldObject) {}

        /**
         * Imports names of all used documents and defined named destinations.
         *
         * @param array $touchedPdfs
         * @param array $namedDestinations
         */
        protected function _handleNames($touchedPdfs, $namedDestinations) {}

        /**
         * Handles optional content data (Layers).
         *
         * @param array $touchedPdfs
         */
        protected function _handleOptionalContent(array $touchedPdfs) {}

        /**
         * Callback method for renaming string values of renamed names.
         *
         * @see SetaPDF_Merger::_handleNames()
         * @param SetaPDF_Core_Document $document The document instance
         * @param SetaPDF_Core_Type_StringValue $value The string value
         */
        public function rewriteNamesCallback(\SetaPDF_Core_Document $document, \SetaPDF_Core_Type_StringValue $value) {}

        /**
         * Checks a page number against a condition.
         *
         * @param integer $pageNumber The page number
         * @param null|integer|string|array|callback $condition Valid conditions are:
         *          <ul>
         *          <li><b>PAGES_XXX</b> constant or <b>null</b> (equal to {@link SetaPDF_Merger::PAGES_ALL})</li>
         *          <li><b>Integer</b> with the valid page number</li>
         *          <li><b>String</b> with the valid page number or the valid range (e.g. '10-12')</li>
         *          <li><b>Array</b> with all valid page numbers</li>
         *          <li><b>Callback</b> with the arguments (int $pageNumber, SetaPDF_Core_Document $document)</li>
         *          </ul>
         * @return boolean
         */
        protected function _checkPageNumber($pageNumber, $condition = null) {}

        /**
         * Get a document instance by filename.
         *
         * @param string|SetaPDF_Core_Document $filename The filename
         * @param boolean $cache Cache the document by filename
         * @return SetaPDF_Core_Document
         * @throws SetaPDF_Merger_Exception
         */
        protected function _getDocument($filename, $cache = true) {}

        /**
         * Get a document instance by a filename.
         *
         * @param string $filename The filename
         * @param boolean $cache Cache the document by filename
         * @return SetaPDF_Core_Document
         */
        public function getDocumentByFilename($filename, $cache = true) {}

        /**
         * Get the currently processed document instance.
         *
         * This method can be used to get the document instance that is actually processed if an Exception is thrown.
         *
         * @return SetaPDF_Core_Document
         */
        public function getCurrentDocument() {}

        /**
         * Release objects to free memory and cycled references.
         *
         * After calling this method the instance of this object is unusable!
         *
         * @return void
         */
        public function cleanUp() {}

    }
}

