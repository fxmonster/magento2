<?php
namespace Mageplaza\Osc\Controller\Adminhtml\System\Config\Geoip;

/**
 * Interceptor class for @see \Mageplaza\Osc\Controller\Adminhtml\System\Config\Geoip
 */
class Interceptor extends \Mageplaza\Osc\Controller\Adminhtml\System\Config\Geoip implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Mageplaza\Osc\Helper\Data $oscHelper)
    {
        $this->___init();
        parent::__construct($context, $resultJsonFactory, $directoryList, $oscHelper);
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
