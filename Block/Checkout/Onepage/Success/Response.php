<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Eupago\Multibanco\Block\Checkout\Onepage\Success;

Class Response extends \Magento\Checkout\Block\Onepage\Success
{
    /**
     * Prepares block data
     *
     * @return void
     */
    protected $order;

    protected function _construct()
    {
        $this->setModuleName('Magento_Checkout');
        parent::_construct();
    }

    protected function prepareBlockData()
    {

        $this->order = $this->_checkoutSession->getLastRealOrder();
        $payment = $this->order->getPayment();
        $this->addData(
            [
                'entidade' => $payment->getAdditionalInformation('entidade'),
                'referencia' => $payment->getAdditionalInformation('referencia'),
                'data_limite' => $payment->getAdditionalInformation('data_limite'),
                'grand_total' => $this->getFormatValue(),
                'order_id' => $this->order->getIncrementId(),
            ]
        );

    }

    private function getFormatValue()
    {
        return number_format($this->order->getGrandTotal(), '2', '.', ',');
    }

    public function isMethodEupago()
    {
        if ($this->order->getPayment()->getMethod() == \Eupago\Multibanco\Model\Ui\ConfigProvider::CODE) {
            return true;
        }
        return false;
    }
}