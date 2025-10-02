<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Controller\Adminhtml\Loyalty;

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
    const ADMIN_RESOURCE = 'Vikhyat_BlogManager::editloyalty';  // Fixed ACL resource

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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('Loyalty Rules');
        $resultPage->setActiveMenu("Vikhyat_BlogManager::loyalty_info");
        
        return $resultPage;
    }

    /**
     * Check permission
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vikhyat_BlogManager::editloyalty');
    }
}