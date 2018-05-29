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

    /**
     * {@inheritdoc}
     */
    public function validateData(array $data, array $attributes, $entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validateData');
        if (!$pluginInfo) {
            return parent::validateData($data, $attributes, $entityType);
        } else {
            return $this->___callPlugins('validateData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityType($entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setEntityType');
        if (!$pluginInfo) {
            return parent::setEntityType($entityType);
        } else {
            return $this->___callPlugins('setEntityType', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(array $attributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttributes');
        if (!$pluginInfo) {
            return parent::setAttributes($attributes);
        } else {
            return $this->___callPlugins('setAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributesWhiteList(array $attributesCodes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttributesWhiteList');
        if (!$pluginInfo) {
            return parent::setAttributesWhiteList($attributesCodes);
        } else {
            return $this->___callPlugins('setAttributesWhiteList', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributesBlackList(array $attributesCodes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttributesBlackList');
        if (!$pluginInfo) {
            return parent::setAttributesBlackList($attributesCodes);
        } else {
            return $this->___callPlugins('setAttributesBlackList', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setData');
        if (!$pluginInfo) {
            return parent::setData($data);
        } else {
            return $this->___callPlugins('setData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setTranslator($translator = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTranslator');
        if (!$pluginInfo) {
            return parent::setTranslator($translator);
        } else {
            return $this->___callPlugins('setTranslator', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslator()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTranslator');
        if (!$pluginInfo) {
            return parent::getTranslator();
        } else {
            return $this->___callPlugins('getTranslator', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasTranslator()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasTranslator');
        if (!$pluginInfo) {
            return parent::hasTranslator();
        } else {
            return $this->___callPlugins('hasTranslator', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMessages()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMessages');
        if (!$pluginInfo) {
            return parent::getMessages();
        } else {
            return $this->___callPlugins('getMessages', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasMessages()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasMessages');
        if (!$pluginInfo) {
            return parent::hasMessages();
        } else {
            return $this->___callPlugins('hasMessages', func_get_args(), $pluginInfo);
        }
    }
}
