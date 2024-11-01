<?php
// Updated 2012-12-17. FIX included blockSize < 1
declare(strict_types=1);

namespace Endroid\QrCode\Matrix;

use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeEnlarge;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeShrink;

final class Matrix implements MatrixInterface {

    /** @var array<int, array<int, int>> */
    private array $blockValues = [];
    // Error: syntax error, unexpected 'array' (T_ARRAY), expecting function (T_FUNCTION) or const (T_CONST)
    // Typing a property as an array is compliant with any PHP version >= 7.4.0. 

    private float $blockSize;
    private int $innerSize;
    private int $outerSize;
    private int $marginLeft;
    private int $marginRight;

    /** @param array<array<int>> $blockValues */
    public function __construct(array $blockValues, int $size, int $margin, RoundBlockSizeModeInterface $roundBlockSizeMode)
    {
        $this->blockValues = $blockValues;
        $this->blockSize = $size / $this->getBlockCount();
        
        // FIX
        if( $this->blockSize < 1 ){  $this->blockSize = 1;  } 
               
        $this->innerSize = $size;
        $this->outerSize = $size + (2 * $margin);

        if ($roundBlockSizeMode instanceof RoundBlockSizeModeEnlarge) {
            $this->blockSize = intval(ceil($this->blockSize));
            $this->innerSize = intval($this->blockSize * $this->getBlockCount());
            $this->outerSize = $this->innerSize + 2 * $margin;
        } elseif ($roundBlockSizeMode instanceof RoundBlockSizeModeShrink) {
            $this->blockSize = intval(floor($this->blockSize));
            $this->innerSize = intval($this->blockSize * $this->getBlockCount());
            $this->outerSize = $this->innerSize + 2 * $margin;
        } elseif ($roundBlockSizeMode instanceof RoundBlockSizeModeMargin) {
            $this->blockSize = intval(floor($this->blockSize));
            $this->innerSize = intval($this->blockSize * $this->getBlockCount());
        }

        // if ($this->blockSize < 1) { throw new \Exception('Too much data: increase image dimensions or lower error correction level'); }

        // FIX
        if( $this->innerSize >= $this->outerSize ){ 
            $this->outerSize = $this->innerSize + 4; 
        }

        $this->marginLeft = intval(($this->outerSize - $this->innerSize) / 2);
        $this->marginRight = $this->outerSize - $this->innerSize - $this->marginLeft;
    }

    public function getBlockValue(int $rowIndex, int $columnIndex): int
    {
        return $this->blockValues[$rowIndex][$columnIndex];
    }

    public function getBlockCount(): int
    {
        return count($this->blockValues[0]);
    }

    public function getBlockSize(): float
    {
        return $this->blockSize;
    }

    public function getInnerSize(): int
    {
        return $this->innerSize;
    }

    public function getOuterSize(): int
    {
        return $this->outerSize;
    }

    public function getMarginLeft(): int
    {
        return $this->marginLeft;
    }

    public function getMarginRight(): int
    {
        return $this->marginRight;
    }
}