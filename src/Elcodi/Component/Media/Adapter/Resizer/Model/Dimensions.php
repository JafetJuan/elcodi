<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2016 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

declare(strict_types=1);

namespace Elcodi\Component\Media\Adapter\Resizer\Model;

use Elcodi\Component\Media\ElcodiMediaImageResizeTypes;

/**
 * Class Dimensions.
 */
class Dimensions
{
    /**
     * @var int
     *
     * originalWidth
     */
    private $originalWidth;

    /**
     * @var int
     *
     * originalHeight
     */
    private $originalHeight;

    /**
     * @var float
     *
     * originalAspectRatio
     */
    private $originalAspectRatio;

    /**
     * @var int
     *
     * srcY
     */
    private $srcY;

    /**
     * @var int
     *
     * srcX
     */
    private $srcX;

    /**
     * @var int
     *
     * srcWidth
     */
    private $srcWidth;

    /**
     * @var int
     *
     * srcHeight
     */
    private $srcHeight;

    /**
     * @var int
     *
     * dstY
     */
    private $dstY;

    /**
     * @var int
     *
     * dstX
     */
    private $dstX;

    /**
     * @var int
     *
     * dstWidth
     */
    private $dstWidth;

    /**
     * @var int
     *
     * dstHeight
     */
    private $dstHeight;

    /**
     * @var int
     *
     * dstFrameX
     */
    private $dstFrameX;

    /**
     * @var int
     *
     * dstFrameY
     */
    private $dstFrameY;

    /**
     * Construct.
     *
     * @param int $originalWidth
     * @param int $originalHeight
     * @param int $newWidth
     * @param int $newHeight
     * @param int $resizeType
     */
    private function __construct(
        int $originalWidth,
        int $originalHeight,
        int $newWidth,
        int $newHeight,
        int $resizeType
    ) {
        $this->originalWidth = $originalWidth;
        $this->originalHeight = $originalHeight;
        $this->originalAspectRatio = $originalWidth / $originalHeight;

        $this->resolveDimensions(
            $newWidth,
            $newHeight,
            $resizeType
        );
    }

    /**
     * Resolve dimensions.
     *
     * @param int $newWidth
     * @param int $newHeight
     * @param int $resizeType
     *
     * @return $this Self object
     */
    public function resolveDimensions(
        int $newWidth,
        int $newHeight,
        int $resizeType
    ) {
        $this->dstX = 0;
        $this->dstY = 0;
        $this->dstWidth = $newWidth;
        $this->dstHeight = $newHeight;
        $this->dstFrameX = $newWidth;
        $this->dstFrameY = $newHeight;

        $this->srcX = 0;
        $this->srcY = 0;
        $this->srcWidth = $this->originalWidth;
        $this->srcHeight = $this->originalHeight;

        if ($resizeType == ElcodiMediaImageResizeTypes::NO_RESIZE) {
            $this->dstWidth = $this->originalWidth;
            $this->dstHeight = $this->originalHeight;
            $this->dstFrameX = $this->originalWidth;
            $this->dstFrameY = $this->originalHeight;
        } elseif (in_array($resizeType, [
            ElcodiMediaImageResizeTypes::INSET,
            ElcodiMediaImageResizeTypes::INSET_FILL_WHITE,
            ElcodiMediaImageResizeTypes::OUTBOUNDS_FILL_WHITE,
            ElcodiMediaImageResizeTypes::OUTBOUND_CROP,
        ])) {
            $newAspectRatio = $newWidth / $newHeight;
            if ($newAspectRatio == $this->originalAspectRatio) {
                $height = $newHeight;
                $width = $newWidth;
            } elseif (
                ($newAspectRatio > $this->originalAspectRatio) ^
                (in_array($resizeType, [
                    ElcodiMediaImageResizeTypes::OUTBOUNDS_FILL_WHITE,
                    ElcodiMediaImageResizeTypes::OUTBOUND_CROP,
                ])
                )
            ) {
                $height = $newHeight;
                $width = $newHeight * $this->originalAspectRatio;
            } else {
                $width = $newWidth;
                $height = (int) ($newWidth / $this->originalAspectRatio);
            }
            $changeRatio = $height / $this->originalHeight;

            if ($resizeType == ElcodiMediaImageResizeTypes::OUTBOUND_CROP) {
                $this->srcX = (int) ((($width - $newWidth) / 2) / $changeRatio);
                $this->srcY = (int) ((($height - $newHeight) / 2) / $changeRatio);
                $this->srcWidth = (int) ($newWidth / $changeRatio);
                $this->srcHeight = (int) ($newHeight / $changeRatio);
            }

            if ($resizeType == ElcodiMediaImageResizeTypes::INSET_FILL_WHITE) {
                $this->dstX = (int) (($newWidth - $width) / 2);
                $this->dstY = (int) (($newHeight - $height) / 2);
            }

            if (in_array($resizeType, [
                ElcodiMediaImageResizeTypes::INSET,
                ElcodiMediaImageResizeTypes::INSET_FILL_WHITE,
                ElcodiMediaImageResizeTypes::OUTBOUNDS_FILL_WHITE,
            ])) {
                $this->dstWidth = $width;
                $this->dstHeight = $height;
            }

            if (in_array($resizeType, [
                ElcodiMediaImageResizeTypes::INSET,
                ElcodiMediaImageResizeTypes::OUTBOUNDS_FILL_WHITE,
            ])) {
                $this->dstFrameX = $width;
                $this->dstFrameY = $height;
            }
        }

        return $this;
    }

    /**
     * Get OriginalWidth.
     *
     * @return int
     */
    public function getOriginalWidth() : int
    {
        return (int) $this->originalWidth;
    }

    /**
     * Get OriginalHeight.
     *
     * @return int
     */
    public function getOriginalHeight() : int
    {
        return (int) $this->originalHeight;
    }

    /**
     * Get OriginalAspectRatio.
     *
     * @return float
     */
    public function getOriginalAspectRatio() : float
    {
        return (float) $this->originalAspectRatio;
    }

    /**
     * Get SrcY.
     *
     * @return int
     */
    public function getSrcY() : int
    {
        return (int) $this->srcY;
    }

    /**
     * Get SrcX.
     *
     * @return int
     */
    public function getSrcX() : int
    {
        return (int) $this->srcX;
    }

    /**
     * Get SrcWidth.
     *
     * @return int
     */
    public function getSrcWidth() : int
    {
        return (int) $this->srcWidth;
    }

    /**
     * Get SrcHeight.
     *
     * @return int
     */
    public function getSrcHeight() : int
    {
        return (int) $this->srcHeight;
    }

    /**
     * Get DstY.
     *
     * @return int
     */
    public function getDstY() : int
    {
        return (int) $this->dstY;
    }

    /**
     * Get DstX.
     *
     * @return int
     */
    public function getDstX() : int
    {
        return (int) $this->dstX;
    }

    /**
     * Get DstWidth.
     *
     * @return int
     */
    public function getDstWidth() : int
    {
        return (int) $this->dstWidth;
    }

    /**
     * Get DstHeight.
     *
     * @return int
     */
    public function getDstHeight() : int
    {
        return (int) $this->dstHeight;
    }

    /**
     * Get DstFrameX.
     *
     * @return int
     */
    public function getDstFrameX() : int
    {
        return (int) $this->dstFrameX;
    }

    /**
     * Get DstFrameY.
     *
     * @return int
     */
    public function getDstFrameY() : int
    {
        return (int) $this->dstFrameY;
    }

    /**
     * @param int $originalWidth  Original width
     * @param int $originalHeight Original height
     * @param int $newWidth       New width
     * @param int $newHeight      New height
     * @param int $type           Resize type
     *
     * @return self New instance
     */
    public static function create(
        int $originalWidth,
        int $originalHeight,
        int $newWidth,
        int $newHeight,
        int $type
    ) {
        return new self(
            $originalWidth,
            $originalHeight,
            $newWidth,
            $newHeight,
            $type
        );
    }
}
