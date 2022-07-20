<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ST\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const XML_PATH_ENABLE_DEBUG = 'st/general/enable_debug';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Check whether debug log is enabled
     * @return bool
     */
    public function isEnableDebug(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_ENABLE_DEBUG,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

