<?php

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Eupago\Multibanco\Model\Adminhtml\Source;

use Magento\Payment\Model\Method\AbstractMethod;

/**
 * Class PaymentAction
 */
class PaymentAction extends AbstractMethod
{

    protected $_isInitializeNeeded = true;

    /**
     * {@inheritdoc}
     */
    public function getConfigPaymentAction()
    {
        return ($this->getConfigData('order_status') == 'pending') ? null : parent::getConfigPaymentAction();
    }

    protected function _registerPaymentRefund()
    {
        return true;
    }
}
