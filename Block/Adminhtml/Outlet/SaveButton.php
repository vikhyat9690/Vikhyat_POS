<?php
namespace Vikhyat\BlogManager\Block\Adminhtml\Outlet;

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
            'label' => __('Save Outlet'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        [
                            'actions' => [
                                [
                                    'targetName' => 'outlet_form.outlet_form',
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
