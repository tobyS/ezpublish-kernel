<?php
/**
 * File containing the ScaleDownFilterLoader class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Bundle\EzPublishCoreBundle\Imagine\Filter\Loader;

use Imagine\Image\ImageInterface;
use Imagine\Exception\InvalidArgumentException;
use Liip\ImagineBundle\Imagine\Filter\Loader\LoaderInterface;

class ScaleDownOnlyFilterLoader implements LoaderInterface
{
    /**
     * @var LoaderInterface
     */
    private $thumbnailLoader;

    public function __construct( LoaderInterface $thumbnailLoader )
    {
        $this->thumbnailLoader = $thumbnailLoader;
    }

    /**
     * Loads and applies a filter on the given image.
     *
     * @param ImageInterface $image
     * @param array $options Numerically indexed array. First entry is width, second is height.
     *
     * @throws \Imagine\Exception\InvalidArgumentException
     *
     * @return ImageInterface
     */
    public function load( ImageInterface $image, array $options = array() )
    {
        if ( count( $options ) < 2 )
        {
            throw new InvalidArgumentException( 'Missing width and/or height options' );
        }

        return $this->thumbnailLoader->load(
            $image,
            array(
                'size' => $options,
                'mode' => ImageInterface::THUMBNAIL_INSET
            )
        );
    }
}
