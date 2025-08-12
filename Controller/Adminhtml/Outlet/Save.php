<?php

namespace Vikhyat\BlogManager\Controller\Adminhtml\Outlet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Vikhyat\BlogManager\Model\OutletFactory;
use Vikhyat\BlogManager\Model\ResourceModel\Outlet as OutletResource;

class Save extends Action
{
    // const ADMIN_RESOURCE = 'Vikhyat_BlogManager::outlet_save';

    protected $outletFactory;
    protected $outletResource;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        OutletFactory $outletFactory,
        OutletResource $outletResource,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->outletFactory = $outletFactory;
        $this->outletResource = $outletResource;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$data) {
            $this->messageManager->addErrorMessage(__('No data found to save.'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $model = $this->outletFactory->create();

            if ($id) {
                $this->outletResource->load($model, $id);
                if (!$model->getId()) {
                    $this->messageManager->addErrorMessage(__('This outlet no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $outletImage = isset($data['outlet_image']) &&
            $data['outlet_image'] != null
             ? json_encode($data['outlet_image'][0])
             : '';
            unset($data['outlet_image']);
            $data['outlet_image'] = $outletImage;
            $model->addData($data);
            $this->outletResource->save($model);

            $this->messageManager->addSuccessMessage(__('You saved the outlet.'));
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
            }
            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the outlet.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
    }
}
