<?php
namespace Vikhyat\BlogManager\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\UrlInterface;

class CashierActions extends Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($item['entity_id'])) {
                $item[$this->getData('name')]['edit'] = [
                    'href'   => $this->urlBuilder->getUrl(
                        'blogmanager/cashier/edit',
                        ['id' => $item['entity_id']]
                    ),
                    'label'  => __('Edit'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
