<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Osc
 * @copyright   Copyright (c) 2017-2018 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Osc\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Mageplaza\Osc\Model\CheckoutRegister;

/**
 * Class PaypalExpressPlaceOrder
 * @package Mageplaza\Osc\Observer
 */
class PaypalExpressPlaceOrder implements ObserverInterface
{
    /**
     * @var \Mageplaza\Osc\Model\CheckoutRegister
     */
    protected $checkoutRegister;

    /**
     * PaypalExpressPlaceOrder constructor.
     * @param \Mageplaza\Osc\Model\CheckoutRegister $checkoutRegister
     */
    public function __construct(CheckoutRegister $checkoutRegister)
    {
        $this->checkoutRegister = $checkoutRegister;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(Observer $observer)
    {
        $this->checkoutRegister->checkRegisterNewCustomer();
    }
}