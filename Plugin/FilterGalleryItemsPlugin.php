<?php

namespace Grindnu\Media\Plugin;

use Grindnu\Media\Helper\Data;
use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\Data\Collection;

class FilterGalleryItemsPlugin
{
    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * @param Data $dataHelper
     */
    public function __construct(
        Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param Gallery $subject
     * @param Collection $result
     *
     * @return Collection
     */
    public function afterGetGalleryImages(
        Gallery $subject,
        Collection $result
    ) {
        $allowedMediaTypes = [];

        if ($this->dataHelper->allowImages()) {
            $allowedMediaTypes[] = 'image';
        }
        if ($this->dataHelper->allowVideos()) {
            $allowedMediaTypes[] = 'external-video';
        }

        $result->addFilter('media_type', [
            'in' => $allowedMediaTypes,
        ]);

        return $result;
    }
}
