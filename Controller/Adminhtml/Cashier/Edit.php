<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Controller\Adminhtml\Cashier;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vikhyat\BlogManager\Api\OutletRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;

/**
 * Class Edit
 * @package Vikhyat\BlogManager\Controller\Adminhtml\Outlet
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Vikhyat_BlogManager::editcashier';  // Fixed ACL resource

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CashierRepositoryInterface
     */
    protected $cashierRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param OutletRepositoryInterface $outletRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CashierRepositoryInterface $cashierRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->cashierRepository = $cashierRepository;
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
                $model = $this->cashierRepository->getById($id);
                if (!$model->getEntityId()) {
                    $this->messageManager->addErrorMessage(__('This cashier no longer exists.'));
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
            $id ? __('Edit Cashier') : __('New Casher'),
            $id ? __('Edit Cashier') : __('New Cashier')
        );
        
        $resultPage->getConfig()->getTitle()->prepend(__('Cashiers'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model && $model->getEntityId() ? $model->getOwnerName() : __('New Cashier')
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
        $resultPage->setActiveMenu('Vikhyat_BlogManager::editcashier')  // Fixed menu reference
            ->addBreadcrumb(__('Blog Manager'), __('Blog Manager'))
            ->addBreadcrumb(__('Cashiers'), __('Cashiers'));
        return $resultPage;
    }
}