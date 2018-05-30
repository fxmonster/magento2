<?php
namespace Magento\Customer\Model\Metadata\Validator;

/**
 * Interceptor class for @see \Magento\Customer\Model\Metadata\Validator
 */
class Interceptor extends \Magento\Customer\Model\Metadata\Validator implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Customer\Model\Metadata\ElementFactory $attrDataFactory)
    {
        $this->___init();
        parent::__construct($attrDataFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($entityData)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isValid');
        if (!$pluginInfo) {
            return parent::isValid($entityData);
        } else {
            return $this->___callPlugins('isValid', func_get_args(), $pluginInfo);
        }
    }
}
