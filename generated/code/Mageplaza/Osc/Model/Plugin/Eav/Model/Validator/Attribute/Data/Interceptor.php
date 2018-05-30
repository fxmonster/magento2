<?php
namespace Mageplaza\Osc\Model\Plugin\Eav\Model\Validator\Attribute\Data;

/**
 * Interceptor class for @see \Mageplaza\Osc\Model\Plugin\Eav\Model\Validator\Attribute\Data
 */
class Interceptor extends \Mageplaza\Osc\Model\Plugin\Eav\Model\Validator\Attribute\Data implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Eav\Model\AttributeDataFactory $attrDataFactory, \Mageplaza\Osc\Helper\Data $oscHelperData)
    {
        $this->___init();
        parent::__construct($attrDataFactory, $oscHelperData);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($entity)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isValid');
        if (!$pluginInfo) {
            return parent::isValid($entity);
        } else {
            return $this->___callPlugins('isValid', func_get_args(), $pluginInfo);
        }
    }
}
