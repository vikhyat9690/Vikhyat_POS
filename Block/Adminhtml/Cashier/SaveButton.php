<?php
namespace Vikhyat\BlogManager\Block\Adminhtml\Cashier;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton implements ButtonProviderInterface
{
    /**
     * Return button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Cashier'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        [
                            'actions' => [
                                [
                                    'targetName' => 'cashier_form.cashier_form',
                                    'actionName' => 'save',
                                    'params' => [true]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'sort_order' => 90,
        ];
    }
}
