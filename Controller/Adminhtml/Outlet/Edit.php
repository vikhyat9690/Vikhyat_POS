<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Controller\Adminhtml\Outlet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vikhyat\BlogManager\Api\OutletRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Edit
 * @package Vikhyat\BlogManager\Controller\Adminhtml\Outlet
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Vikhyat_BlogManager::editoutlet';  // Fixed ACL resource

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var OutletRepositoryInterface
     */
    protected $outletRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param OutletRepositoryInterface $outletRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        OutletRepositoryInterface $outletRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->outletRepository = $outletRepository;
        parent::__construct($context);
    }

    /**
     * Edit outlet action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = null;

        // Load existing outlet if ID provided
        if ($id) {
            try {
                $model = $this->outletRepository->getById($id);
                if (!$model->getEntityId()) {
                    $this->messageManager->addErrorMessage(__('This outlet no longer exists.'));
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This outlet no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Outlet') : __('New Outlet'),
            $id ? __('Edit Outlet') : __('New Outlet')
        );
        
        $resultPage->getConfig()->getTitle()->prepend(__('Outlets'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model && $model->getEntityId() ? $model->getOwnerName() : __('New Outlet')
        );
        
        return $resultPage;
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Vikhyat_BlogManager::editoutlet')  // Fixed menu reference
            ->addBreadcrumb(__('Blog Manager'), __('Blog Manager'))
            ->addBreadcrumb(__('Outlets'), __('Outlets'));
        return $resultPage;
    }
}