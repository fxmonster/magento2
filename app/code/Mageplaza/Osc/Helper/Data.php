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

namespace Mageplaza\Osc\Helper;

use Mageplaza\Core\Helper\AbstractData;
use Mageplaza\Osc\Model\System\Config\Source\ComponentPosition;

/**
 * Class Data
 * @package Mageplaza\Osc\Helper
 */
class Data extends AbstractData
{
    const CONFIG_MODULE_PATH = 'osc';

    /** Display configuration path */
    const CONFIG_PATH_DISPLAY = 'display_configuration';

    /** Design configuration path */
    const CONFIG_PATH_DESIGN = 'design_configuration';

    /** Geo configuration path */
    const CONFIG_PATH_GEOIP = 'geoip_configuration';

    /** Field position */
    const SORTED_FIELD_POSITION = 'osc/field/position';

    /** Is enable Geo Ip path */
    const GEO_IP_IS_ENABLED = 'osc/geoip_configuration/is_enable_geoip';

    /**
     * @var bool Osc Method Register
     */
    protected $_flagOscMethodRegister = false;

    /**
     * @var Address
     */
    protected $_addressHelper;

    /**
     * @return Address
     */
    public function getAddressHelper()
    {
        if(!$this->_addressHelper){
            $this->_addressHelper = $this->objectManager->get(Address::class);
        }

        return $this->_addressHelper;
    }

    /**
     * @param string $field
     * @param null $storeId
     * @return mixed
     */
    public function getModuleConfig($field = '', $storeId = null)
    {
        $field = ($field !== '') ? '/' . $field : '';

        return $this->getConfigValue(static::CONFIG_MODULE_PATH . $field, $storeId);
    }

    /**
     * Check the current page is osc
     *
     * @param null $store
     * @return bool
     */
    public function isOscPage($store = null)
    {
        $moduleEnable = $this->isEnabled($store);
        $isOscModule = ($this->_request->getRouteName() == 'onestepcheckout');

        return $moduleEnable && $isOscModule;
    }

    /**
     * @return bool
     */
    public function isFlagOscMethodRegister()
    {
        return $this->_flagOscMethodRegister;
    }

    /**
     * @param bool $flag
     */
    public function setFlagOscMethodRegister($flag)
    {
        $this->_flagOscMethodRegister = $flag;
    }

    /**
     * One step checkout page title
     *
     * @param null $store
     * @return mixed
     */
    public function getCheckoutTitle($store = null)
    {
        return $this->getConfigGeneral('title', $store) ?: 'One Step Checkout';
    }

    /************************ General Configuration *************************/
    /**
     * One step checkout page description
     *
     * @param null $store
     * @return mixed
     */
    public function getCheckoutDescription($store = null)
    {
        return $this->getConfigGeneral('description', $store);
    }

    /**
     * Get magento default country
     *
     * @param null $store
     * @return mixed
     */
    public function getDefaultCountryId($store = null)
    {
        return $this->objectManager->get('Magento\Directory\Helper\Data')->getDefaultCountry($store);
    }

    /**
     * Default shipping method
     *
     * @param null $store
     * @return mixed
     */
    public function getDefaultShippingMethod($store = null)
    {
        return $this->getConfigGeneral('default_shipping_method', $store);
    }

    /**
     * Default payment method
     *
     * @param null $store
     * @return mixed
     */
    public function getDefaultPaymentMethod($store = null)
    {
        return $this->getConfigGeneral('default_payment_method', $store);
    }

    /**
     * Allow guest checkout
     *
     * @param $quote
     * @param null $store
     * @return bool
     */
    public function getAllowGuestCheckout($quote, $store = null)
    {
        $allowGuestCheckout = boolval($this->getConfigGeneral('allow_guest_checkout', $store));

        if ($this->scopeConfig->isSetFlag(
            \Magento\Downloadable\Observer\IsAllowedGuestCheckoutObserver::XML_PATH_DISABLE_GUEST_CHECKOUT,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        )
        ) {
            foreach ($quote->getAllItems() as $item) {
                if (($product = $item->getProduct())
                    && $product->getTypeId() == \Magento\Downloadable\Model\Product\Type::TYPE_DOWNLOADABLE
                ) {
                    return false;
                }
            }
        }

        return $allowGuestCheckout;
    }

    /**
     * Redirect To OneStepCheckout
     * @param null $store
     * @return bool
     */
    public function isRedirectToOneStepCheckout($store = null)
    {
        return boolval($this->getConfigGeneral('redirect_to_one_step_checkout', $store));
    }

    /**
     * Show billing address
     *
     * @param null $store
     * @return mixed
     */
    public function getShowBillingAddress($store = null)
    {
        return boolval($this->getConfigGeneral('show_billing_address', $store));
    }

    /**
     * Google api key
     *
     * @param null $store
     * @return mixed
     */
    public function getGoogleApiKey($store = null)
    {
        return $this->getConfigGeneral('google_api_key', $store);
    }

    /**
     * Google restric country
     *
     * @param null $store
     * @return mixed
     */
    public function getGoogleSpecificCountry($store = null)
    {
        return $this->getConfigGeneral('google_specific_country', $store);
    }

    /**
     * Check if the page is https
     *
     * @return bool
     */
    public function isGoogleHttps()
    {
        $isEnable = ($this->getAutoDetectedAddress() == 'google');

        return $isEnable && $this->_request->isSecure();
    }

    /**
     * Get auto detected address
     * @param null $store
     * @return null|'google'|'pca'
     */
    public function getAutoDetectedAddress($store = null)
    {
        return $this->getConfigGeneral('auto_detect_address', $store);
    }

    /**
     * Login link will be hide if this function return true
     *
     * @param null $store
     * @return bool
     */
    public function isDisableAuthentication($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_login_link', $store);
    }

    /********************************** Display Configuration *********************
     *
     * @param $code
     * @param null $store
     * @return mixed
     */
    public function getDisplayConfig($code = '', $store = null)
    {
        $code = $code ? self::CONFIG_PATH_DISPLAY . '/' . $code : self::CONFIG_PATH_DISPLAY;

        return $this->getModuleConfig($code, $store);
    }

    /**
     * Item detail will be hided if this function return 'true'
     *
     * @param null $store
     * @return bool
     */
    public function isDisabledReviewCartSection($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_review_cart_section', $store);
    }

    /**
     * Product image will be hided if this function return 'true'
     *
     * @param null $store
     * @return bool
     */
    public function isHideProductImage($store = null)
    {
        return !$this->getDisplayConfig('is_show_product_image', $store);
    }

    /**
     * Coupon will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function disabledPaymentCoupon($store = null)
    {
        return $this->getDisplayConfig('show_coupon', $store) != ComponentPosition::SHOW_IN_PAYMENT;
    }

    /**
     * Coupon will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function disabledReviewCoupon($store = null)
    {
        return $this->getDisplayConfig('show_coupon', $store) != ComponentPosition::SHOW_IN_REVIEW;
    }

    /**
     * Comment will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function isDisabledComment($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_comments', $store);
    }

    /**
     * @param null $store
     * @return mixed
     */
    public function getShowTOC($store = null)
    {
        return $this->getDisplayConfig('show_toc', $store);
    }

    /**
     * @param null $store
     * @return mixed
     */
    public function isEnabledTOC($store = null)
    {
        return $this->getDisplayConfig('show_toc', $store) != ComponentPosition::NOT_SHOW;
    }

    /**
     * Term and condition checkbox in payment block will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function disabledPaymentTOC($store = null)
    {
        return $this->getDisplayConfig('show_toc', $store) != ComponentPosition::SHOW_IN_PAYMENT;
    }

    /**
     * Term and condition checkbox in review will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function disabledReviewTOC($store = null)
    {
        return $this->getDisplayConfig('show_toc', $store) != ComponentPosition::SHOW_IN_REVIEW;
    }

    /**
     * GiftMessage will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function isDisabledGiftMessage($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_gift_message', $store);
    }

    /**
     * Gift message items
     * @param null $store
     * @return bool
     */
    public function isEnableGiftMessageItems($store = null)
    {
        return (bool)$this->getDisplayConfig('is_enabled_gift_message_items', $store);
    }

    /**
     * Gift wrap block will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function isDisabledGiftWrap($store = null)
    {
        $giftWrapEnabled = $this->getDisplayConfig('is_enabled_gift_wrap', $store);
        $giftWrapAmount = $this->getOrderGiftwrapAmount();

        return !$giftWrapEnabled || ($giftWrapAmount < 0);
    }

    /**
     * Gift wrap amount
     *
     * @param null $store
     * @return mixed
     */
    public function getOrderGiftWrapAmount($store = null)
    {
        return doubleval($this->getDisplayConfig('gift_wrap_amount', $store));
    }

    /**
     * @return array
     */
    public function getGiftWrapConfiguration()
    {
        return [
            'gift_wrap_type' => $this->getGiftWrapType(),
            'gift_wrap_amount' => $this->formatGiftWrapAmount()
        ];
    }

    /**
     * Gift wrap type
     *
     * @param null $store
     * @return mixed
     */
    public function getGiftWrapType($store = null)
    {
        return $this->getDisplayConfig('gift_wrap_type', $store);
    }

    /**
     * @return mixed
     */
    public function formatGiftWrapAmount()
    {
        $giftWrapAmount = $this->objectManager->get('Magento\Checkout\Helper\Data')
            ->formatPrice($this->getOrderGiftWrapAmount());

        return $giftWrapAmount;
    }

    /**
     * Newsleter block will be hided if this function return 'true'
     *
     * @param null $store
     * @return mixed
     */
    public function isDisabledNewsletter($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_newsletter', $store);
    }

    /**
     * Is newsleter subcribed default
     *
     * @param null $store
     * @return mixed
     */
    public function isSubscribedByDefault($store = null)
    {
        return (bool)$this->getDisplayConfig('is_checked_newsletter', $store);
    }

    /**
     * Social Login On Checkout Page
     * @param null $store
     * @return bool
     */
    public function isDisabledSocialLoginOnCheckout($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_social_login', $store);
    }

    /**
     * Delivery Time
     * @param null $store
     * @return bool
     */
    public function isDisabledDeliveryTime($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_delivery_time', $store);
    }

    /**
     * House Security Code
     * @param null $store
     * @return bool
     */
    public function isDisabledHouseSecurityCode($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_house_security_code', $store);
    }

    /**
     * Delivery Time Format
     *
     * @param null $store
     *
     * @return string 'dd/mm/yy'|'mm/dd/yy'|'yy/mm/dd'
     */
    public function getDeliveryTimeFormat($store = null)
    {
        $deliveryTimeFormat = $this->getDisplayConfig('delivery_time_format', $store);

        return $deliveryTimeFormat ?: \Mageplaza\Osc\Model\System\Config\Source\DeliveryTime::DAY_MONTH_YEAR;
    }

    /**
     * Delivery Time Off
     * @param null $store
     * @return bool|mixed
     */
    public function getDeliveryTimeOff($store = null)
    {
        return $this->getDisplayConfig('delivery_time_off', $store);
    }

    /**
     * Survey
     * @param null $store
     * @return bool
     */
    public function isDisableSurvey($store = null)
    {
        return !$this->getDisplayConfig('is_enabled_survey', $store);
    }

    /**
     * Survey Question
     * @param null $store
     * @return mixed
     */
    public function getSurveyQuestion($store = null)
    {
        return $this->getDisplayConfig('survey_question', $store);
    }

    /**
     * @param null $stores
     * @return mixed
     * @throws \Zend_Serializer_Exception
     */
    public function getSurveyAnswers($stores = null)
    {
        return $this->unserialize($this->getDisplayConfig('survey_answers', $stores));
    }

    /**
     * Allow Customer Add Other Option
     * @param null $stores
     * @return mixed
     */
    public function isAllowCustomerAddOtherOption($stores = null)
    {
        return $this->getDisplayConfig('allow_customer_add_other_option', $stores);
    }

    /**
     * Get layout tempate: 1 or 2 or 3 columns
     *
     * @param null $store
     * @return string
     */
    public function getLayoutTemplate($store = null)
    {
        return 'Mageplaza_Osc/' . $this->getDesignConfig('page_layout', $store);
    }

    /***************************** Design Configuration *****************************
     *
     * @param string $code
     * @param null $store
     * @return mixed
     */
    public function getDesignConfig($code = '', $store = null)
    {
        $code = $code ? self::CONFIG_PATH_DESIGN . '/' . $code : self::CONFIG_PATH_DESIGN;

        return $this->getModuleConfig($code, $store);
    }

    /**
     * @return bool
     */
    public function isUsedMaterialDesign()
    {
        return $this->getDesignConfig('page_design') == 'material' ? true : false;
    }

    /***************************** GeoIP Configuration *****************************
     *
     * @param null $store
     * @return mixed
     */
    public function isEnableGeoIP($store = null)
    {
        return boolval($this->getModuleConfig(self::CONFIG_PATH_GEOIP . '/is_enable_geoip', $store));
    }

    /**
     * @param null $store
     * @return mixed
     */
    public function getDownloadPath($store = null)
    {
        return $this->getModuleConfig(self::CONFIG_PATH_GEOIP . '/download_path', $store);
    }

    /***************************** Compatible Modules *****************************
     *
     * @return bool
     */
    public function isEnabledMultiSafepay()
    {
        return $this->_moduleManager->isOutputEnabled('MultiSafepay_Connect');
    }

    /**
     * @return bool
     */
    public function isEnableModulePostNL()
    {
        return $this->isModuleOutputEnabled('TIG_PostNL');
    }

    /**
     * @return bool
     */
    public function isEnableAmazonPay()
    {
        return $this->isModuleOutputEnabled('Amazon_Payment');
    }

    /**
     * Get current theme id
     * @return mixed
     */
    public function getCurrentThemeId()
    {
        return $this->getConfigValue(\Magento\Framework\View\DesignInterface::XML_PATH_THEME_ID);
    }
}
