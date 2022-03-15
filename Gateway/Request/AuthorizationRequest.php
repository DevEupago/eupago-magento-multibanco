<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Eupago\Multibanco\Gateway\Request;

use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class AuthorizationRequest implements BuilderInterface
{

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigInterface $config
    )
    {
        $this->config = $config;
    }

    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['payment'])
            || !$buildSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        /** @var PaymentDataObjectInterface $payment */
        $payment = $buildSubject['payment'];
        $order = $payment->getOrder();


        $per_dup = $this->config->getValue('per_dup');
        $n_dias = $this->config->getValue('payment_deadline');

        if($per_dup != 1 || (is_numeric($n_dias) && $n_dias > 0)) {
            $data_inicio = date("Y-m-d");
            $data_fim = (is_numeric($n_dias) && $n_dias > 0) ? date('Y-m-d', strtotime('+' . $n_dias . ' day', strtotime($data_inicio))) : "2099-12-31";
            $per_dup = ($per_dup == true) ? 1 : 0;
            $arraydados = [
                'method' => 'gerarReferenciaMBDL',
                'data_request' => [
                    'chave' => $this->config->getValue('api_key'),
                    'valor' => $order->getGrandTotalAmount(),
                    'id' => $order->getOrderIncrementId(),
                    'data_inicio' => $data_inicio,
                    'data_fim' => $data_fim,
                    'per_dup' => $per_dup
                ]
            ];
        } else {
            $arraydados = [
                'method' => 'gerarReferenciaMB',
                'data_request' => [
                    'chave' => $this->config->getValue('api_key'),
                    'valor' => $order->getGrandTotalAmount(),
                    'id' => $order->getOrderIncrementId(),
                ]
            ];
        }

        //mail("rui.barbosa@eupago.pt","Magento",print_r($this->config->getValue('payment_deadline'),true));

        return $arraydados;
    }
}
