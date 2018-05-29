<?php
namespace Magento\Authorization\Model\CompositeUserContext;

/**
 * Interceptor class for @see \Magento\Authorization\Model\CompositeUserContext
 */
class Interceptor extends \Magento\Authorization\Model\CompositeUserContext implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\ObjectManager\Helper\Composite $compositeHelper, $userContexts = array())
    {
        $this->___init();
        parent::__construct($compositeHelper, $userContexts);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUserId');
        if (!$pluginInfo) {
            return parent::getUserId();
        } else {
            return $this->___callPlugins('getUserId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUserType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUserType');
        if (!$pluginInfo) {
            return parent::getUserType();
        } else {
            return $this->___callPlugins('getUserType', func_get_args(), $pluginInfo);
        }
    }
}
