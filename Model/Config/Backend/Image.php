<?php

namespace Vikhyat\BlogManager\Model\Config\Backend;

use Magento\Config\Model\Config\Backend\Image as BackendImage;

class Image extends BackendImage
{
    const UPLOAD_DIR = 'blogmanager/logo/';

    /**
     * Return path to directory for upload (absolute path)
     */
    protected function _getUploadDir()
    {
        return $this->_mediaDirectory->getAbsolutePath(self::UPLOAD_DIR);
    }

    /**
     * Relative upload dir for URL building
     */
    protected function _getUploadDirRelative()
    {
        return self::UPLOAD_DIR;
    }

    /**
     * Don’t add scope info
     */
    protected function _addWhetherScopeInfo()
    {
        return false;
    }

    /**
     * Allowed extensions
     */
    protected function _getAllowedExtensions()
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'svg'];
    }

    /**
     * Return base URL for displaying image in admin
     */
    protected function _getBaseUrl()
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
            . $this->_getUploadDirRelative() . '/';
    }
}
