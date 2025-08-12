<?php
/**
 * Copyright © Vikhyat. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vikhyat\BlogManager\Block\Adminhtml\Cashier;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class GenericButton
 */
abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->context = $context;
        $this->registry = $registry;
    }

    /**
     * Return outlet ID
     *
     * @return int|null
     */
    public function getOutletId()
    {
        $cashier = $this->registry->registry('cashier');
        return $cashier ? $cashier->getId() : null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}