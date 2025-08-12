<?php

namespace Vikhyat\BlogManager\Controller\Adminhtml\Outlet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;
    public const ADMIN_RESOURCE = 'Vikhyat_BlogManager::outletindex';

    public function __construct(
        PageFactory $resultPageFactory,
        Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('Outlets');
        $resultPage->setActiveMenu("Vikhyat_BlogManager::outlet_info");
        return $resultPage;
    }

    /**
     * Check permission
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vikhyat_BlogManager::outletindex');
    }
}
