<?php
namespace Mageplaza\AbandonedCart\Controller\Checkout\Cart;

/**
 * Interceptor class for @see \Mageplaza\AbandonedCart\Controller\Checkout\Cart
 */
class Interceptor extends \Mageplaza\AbandonedCart\Controller\Checkout\Cart implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Quote\Model\QuoteFactory $quoteFactory, \Mageplaza\AbandonedCart\Model\Token $tokenModel, \Mageplaza\AbandonedCart\Model\LogsFactory $logsFactory, \Magento\Customer\Model\Session $customerSession, \Mageplaza\AbandonedCart\Helper\Data $helperData, \Magento\Checkout\Model\Session $checkoutSession)
    {
        $this->___init();
        parent::__construct($context, $quoteFactory, $tokenModel, $logsFactory, $customerSession, $helperData, $checkoutSession);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
