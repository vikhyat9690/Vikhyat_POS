<?php

namespace Vikhyat\BlogManager\Controller\Adminhtml\Cashier;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vikhyat\BlogManager\Service\JwtTokenService;

class Index extends Action
{
    protected $resultPageFactory;
    public const ADMIN_RESOURCE = 'Vikhyat_BlogManager::managecashier';

    public function __construct(
        PageFactory $resultPageFactory,
        protected JwtTokenService $jwt,
        Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('Cashier');
        $resultPage->setActiveMenu("Vikhyat_BlogManager::outlet_info");
        return $resultPage;
    }

    /**
     * Check permission
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vikhyat_BlogManager::managecashier');
    }
}
