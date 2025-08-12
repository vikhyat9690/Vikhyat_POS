<?php

namespace Vikhyat\BlogManager\Controller\Adminhtml\Outlet;

use Magento\Framework\Controller\ResultFactory;

class ImageUpload extends \Magento\Backend\App\Action
{
    protected $uploaderFactory;
    protected $filesystem;
    protected $mediaDirectory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'outlet_image']); // matches form field name
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $path = $this->mediaDirectory->getAbsolutePath('blogmanager/');
            $result = $uploader->save($path);

            if (!$result) {
                throw new \Exception('File cannot be saved to path: ' . $path);
            }

            $fileName = ltrim($result['file'], '/');
            $mediaUrl = $this->_objectManager
                ->get(\Magento\Store\Model\StoreManagerInterface::class)
                ->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            $fileUrl = $mediaUrl . 'blogmanager/' . $fileName;

            $response = [
                'name' => $result['name'], // original name
                'url'  => $fileUrl,
                'size' => $result['size'],
                'type' => $result['type'],
                'file' => $fileName
            ];
            
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($response);
        } catch (\Exception $e) {
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData([
                'error' => $e->getMessage(),
                'errorcode' => $e->getCode()
            ]);
        }
    }
}
