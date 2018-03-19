<?php

/*
 * This file is part of the Imagine package.
 *
 * (c) Bulat Shakirzyanov <mallluhuct@gmail.com>
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagine\Image\Fill;

use Imagine\Image\Color;
use Imagine\Image\PointInterface;

/**
 * Interface for the fill
 */
interface FillInterface
{
    /**
     * Gets color of the fill for the given position
     *
     * @param PointInterface $position
     *
     * @return Color
     */
    public function getColor(PointInterface $position);
}