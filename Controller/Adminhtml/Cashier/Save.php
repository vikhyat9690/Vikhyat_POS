<?php
namespace Vikhyat\BlogManager\Controller\Adminhtml\Cashier;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Vikhyat\BlogManager\Api\CashierRepositoryInterface;
use Vikhyat\BlogManager\Api\Data\CashierInterfaceFactory;
use Psr\Log\LoggerInterface;

class Save extends Action
{
    protected $dataPersistor;
    protected $cashierRepository;
    protected $cashierFactory;
    protected $encryptor;
    protected $logger;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        CashierRepositoryInterface $cashierRepository,
        CashierInterfaceFactory $cashierFactory,
        EncryptorInterface $encryptor,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->cashierRepository = $cashierRepository;
        $this->cashierFactory = $cashierFactory;
        $this->encryptor = $encryptor;
        $this->logger = $logger;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        try {
            // Debug logging
            $this->logger->info('Cashier Save - Received data: ' . json_encode($data));

            // Load existing or create new
            if (!empty($data['entity_id'])) {
                $cashier = $this->cashierRepository->getById($data['entity_id']);
                $this->logger->info('Cashier Save - Loaded existing cashier ID: ' . $data['entity_id']);
            } else {
                $cashier = $this->cashierFactory->create();
                $this->logger->info('Cashier Save - Created new cashier instance');
            }

            // Handle password
            if (!empty($data['password'])) {
                $data['password'] = $this->encryptor->getHash($data['password'], true);
                unset($data['confirm_password']);
                $this->logger->info('Cashier Save - Password hashed');
            } else {
                // Don't overwrite existing password
                unset($data['password']);
                $this->logger->info('Cashier Save - Password field removed (not provided)');
            }

            // Handle image data
            if (isset($data['cashier_image'])) {
                if (is_array($data['cashier_image']) && !empty($data['cashier_image'][0])) {
                    $cashierImage = json_encode($data['cashier_image'][0]);
                } else {
                    $cashierImage = '';
                }
                $data['cashier_image'] = $cashierImage;
                $this->logger->info('Cashier Save - Image data processed: ' . $cashierImage);
            }

            // Remove form_key and other unwanted fields
            $unwantedFields = ['form_key', 'confirm_password'];
            foreach ($unwantedFields as $field) {
                unset($data[$field]);
            }

            // Log data before setting
            $this->logger->info('Cashier Save - Data to be set: ' . json_encode($data));

            // Set data using individual setters if available, or setData
            foreach ($data as $key => $value) {
                $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
                if (method_exists($cashier, $setter)) {
                    $cashier->$setter($value);
                } else {
                    $cashier->setData($key, $value);
                }
            }

            // Log cashier data before save
            $this->logger->info('Cashier Save - Cashier data before save: ' . json_encode($cashier->getData()));

            // Save via repository
            $savedCashier = $this->cashierRepository->save($cashier);
            
            // Verify save
            $this->logger->info('Cashier Save - Saved cashier ID: ' . $savedCashier->getId());
            $this->logger->info('Cashier Save - Saved cashier data: ' . json_encode($savedCashier->getData()));

            $this->messageManager->addSuccessMessage(__('Cashier saved successfully.'));
            $this->dataPersistor->clear('cashier_form');

            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $savedCashier->getId()]);
            }
            return $resultRedirect->setPath('*/*/');

        } catch (\Exception $e) {
            $this->logger->error('Cashier Save Error: ' . $e->getMessage());
            $this->logger->error('Cashier Save Error Trace: ' . $e->getTraceAsString());
            
            $this->messageManager->addErrorMessage(__('Unable to save cashier: %1', $e->getMessage()));
            $this->dataPersistor->set('cashier_form', $data);
            
            return $resultRedirect->setPath(
                '*/*/edit',
                ['entity_id' => $this->getRequest()->getParam('entity_id')]
            );
        }
    }
}