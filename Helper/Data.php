<?php

namespace Grindnu\Media\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @param string $path
     *
     * @return mixed
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function allowImages()
    {
        return !$this->excludeImages();
    }

    /**
     * @return bool
     */
    protected function excludeImages()
    {
        return (bool) $this->scopeConfig->getValue(
            'grindnu_media/settings/exclude_images',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function allowVideos()
    {
        return !$this->excludeVideos();
    }

    /**
     * @return bool
     */
    protected function excludeVideos()
    {
        return (bool) $this->scopeConfig->getValue(
            'grindnu_media/settings/exclude_videos',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param string $setting
     *
     * @return string
     */
    public function getSettingsFlag(string $setting)
    {
        $value = (bool) $this->getConfig(
            sprintf('grindnu_media/settings/%s', $setting)
        );

        return $value ? 'true' : 'false';
    }
}
