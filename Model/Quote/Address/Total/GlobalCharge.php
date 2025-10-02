<?php
namespace Vikhyat\BlogManager\Model\Quote\Address\Total;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Store\Model\ScopeInterface;

class GlobalCharge extends AbstractTotal
{
    public function __construct(
        protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->setCode('global_charge');
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ){
        parent::collect($quote, $shippingAssignment, $total);
        if(!count($shippingAssignment->getItems())) {
            return $this;
        }
        $amount = (float) $this->scopeConfig->getValue(
            'global_charge/global_rate/grobal_rate_amount',
            ScopeInterface::SCOPE_STORE
        );
        if($amount > 0) {
            $total->addTotalAmount($this->getCode(), $amount);
            $total->addBaseTotalAmount($this->getCode(), $amount);
            $total->setGrandTotal($total->getGrandTotal() + $amount);
            $total->setBaseGrandTotal($total->getBaseGrandTotal() + $amount);
            $quote->setData('global_charge', $amount);
        }
        return $this;
    }

    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        $amount = $quote->getData('global_charge');
        return [
            'code' => $this->getCode(),
            'title' => __('Global Charge'),
            'value' => $amount
        ];
    }
}