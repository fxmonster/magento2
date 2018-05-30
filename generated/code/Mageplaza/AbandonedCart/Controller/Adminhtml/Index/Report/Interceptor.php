<?php
namespace Mageplaza\AbandonedCart\Controller\Adminhtml\Index\Report;

/**
 * Interceptor class for @see \Mageplaza\AbandonedCart\Controller\Adminhtml\Index\Report
 */
class Interceptor extends \Mageplaza\AbandonedCart\Controller\Adminhtml\Index\Report implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Json\Helper\Data $jsonHelper, \Psr\Log\LoggerInterface $logger, \Mageplaza\AbandonedCart\Model\ResourceModel\Logs $abandonedCartLog, \Mageplaza\AbandonedCart\Model\LogsFactory $logsFactory, \Mageplaza\AbandonedCart\Model\AbandonedCart $abandonedCartModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $jsonHelper, $logger, $abandonedCartLog, $logsFactory, $abandonedCartModel);
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
