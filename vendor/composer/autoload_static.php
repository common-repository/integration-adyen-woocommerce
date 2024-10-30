<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd81469cb61d304d24bb51fba1191e20
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VIISON\\AddressSplitter\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VIISON\\AddressSplitter\\' => 
        array (
            0 => __DIR__ . '/..' . '/viison/address-splitter/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Woosa\\Adyen\\Abstract_Gateway' => __DIR__ . '/../..' . '/includes/payment-methods/class-abstract-gateway.php',
        'Woosa\\Adyen\\Alipay' => __DIR__ . '/../..' . '/includes/payment-methods/class-alipay.php',
        'Woosa\\Adyen\\Applepay' => __DIR__ . '/../..' . '/includes/payment-methods/class-applepay.php',
        'Woosa\\Adyen\\Authorization_Hook' => __DIR__ . '/../..' . '/includes/authorization/class-authorization-hook.php',
        'Woosa\\Adyen\\Bancontact' => __DIR__ . '/../..' . '/includes/payment-methods/class-bancontact.php',
        'Woosa\\Adyen\\Bancontact_Mobile' => __DIR__ . '/../..' . '/includes/payment-methods/class-bancontact-mobile.php',
        'Woosa\\Adyen\\Blik' => __DIR__ . '/../..' . '/includes/payment-methods/class-blik.php',
        'Woosa\\Adyen\\Boleto' => __DIR__ . '/../..' . '/includes/payment-methods/class-boleto.php',
        'Woosa\\Adyen\\Checkout' => __DIR__ . '/../..' . '/includes/checkout/class-checkout.php',
        'Woosa\\Adyen\\Checkout_Hook' => __DIR__ . '/../..' . '/includes/checkout/class-checkout-hook.php',
        'Woosa\\Adyen\\Checkout_Hook_AJAX' => __DIR__ . '/../..' . '/includes/checkout/class-checkout-hook-ajax.php',
        'Woosa\\Adyen\\Checkout_Hook_Assets' => __DIR__ . '/../..' . '/includes/checkout/class-checkout-hook-assets.php',
        'Woosa\\Adyen\\Core' => __DIR__ . '/../..' . '/includes/core/class-core.php',
        'Woosa\\Adyen\\Core_Hook' => __DIR__ . '/../..' . '/includes/core/class-core-hook.php',
        'Woosa\\Adyen\\Core_Hook_AJAX' => __DIR__ . '/../..' . '/includes/core/class-core-hook-ajax.php',
        'Woosa\\Adyen\\Core_Hook_Assets' => __DIR__ . '/../..' . '/includes/core/class-core-hook-assets.php',
        'Woosa\\Adyen\\Credit_Card' => __DIR__ . '/../..' . '/includes/payment-methods/class-credit-card.php',
        'Woosa\\Adyen\\Generate_Client_Key' => __DIR__ . '/../..' . '/includes/tools/class-tools-generate-client-key.php',
        'Woosa\\Adyen\\Giropay' => __DIR__ . '/../..' . '/includes/payment-methods/class-giropay.php',
        'Woosa\\Adyen\\Googlepay' => __DIR__ . '/../..' . '/includes/payment-methods/class-googlepay.php',
        'Woosa\\Adyen\\Grabpay' => __DIR__ . '/../..' . '/includes/payment-methods/class-grabpay.php',
        'Woosa\\Adyen\\Grabpay_MY' => __DIR__ . '/../..' . '/includes/payment-methods/class-grabpay-my.php',
        'Woosa\\Adyen\\Grabpay_PH' => __DIR__ . '/../..' . '/includes/payment-methods/class-grabpay-ph.php',
        'Woosa\\Adyen\\Grabpay_SG' => __DIR__ . '/../..' . '/includes/payment-methods/class-grabpay-sg.php',
        'Woosa\\Adyen\\Ideal' => __DIR__ . '/../..' . '/includes/payment-methods/class-ideal.php',
        'Woosa\\Adyen\\Interface_API_Client' => __DIR__ . '/..' . '/woosa/interface/class-interface-api-client.php',
        'Woosa\\Adyen\\Interface_API_Endpoint' => __DIR__ . '/..' . '/woosa/interface/class-interface-api-endpoint.php',
        'Woosa\\Adyen\\Interface_DB_Table' => __DIR__ . '/..' . '/woosa/interface/class-interface-db-table.php',
        'Woosa\\Adyen\\Interface_Entity_Task' => __DIR__ . '/..' . '/woosa/interface/class-interface-entity-task.php',
        'Woosa\\Adyen\\Interface_Hook' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook.php',
        'Woosa\\Adyen\\Interface_Hook_Assets' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-assets.php',
        'Woosa\\Adyen\\Interface_Hook_Order_Details' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-order-details.php',
        'Woosa\\Adyen\\Interface_Hook_Register_REST_API_Endpoints' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-register-rest-api-endpoints.php',
        'Woosa\\Adyen\\Interface_Hook_Settings' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-settings.php',
        'Woosa\\Adyen\\Interface_Hook_Settings_Section' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-settings-section.php',
        'Woosa\\Adyen\\Interface_Hook_Settings_Tab' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-settings-tab.php',
        'Woosa\\Adyen\\Interface_Hook_Worker_Format_Task' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-worker-format-task.php',
        'Woosa\\Adyen\\Interface_Hook_Worker_Run_Task' => __DIR__ . '/..' . '/woosa/interface/class-interface-hook-worker-run-task.php',
        'Woosa\\Adyen\\Klarna' => __DIR__ . '/../..' . '/includes/payment-methods/class-klarna.php',
        'Woosa\\Adyen\\Klarna_Account' => __DIR__ . '/../..' . '/includes/payment-methods/class-klarna-account.php',
        'Woosa\\Adyen\\Klarna_PayNow' => __DIR__ . '/../..' . '/includes/payment-methods/class-klarna-paynow.php',
        'Woosa\\Adyen\\Logger_Hook' => __DIR__ . '/../..' . '/includes/logger/class-logger-hook.php',
        'Woosa\\Adyen\\MOLPay' => __DIR__ . '/../..' . '/includes/payment-methods/class-molpay.php',
        'Woosa\\Adyen\\MOLPay_ML' => __DIR__ . '/../..' . '/includes/payment-methods/class-molpay-ml.php',
        'Woosa\\Adyen\\MOLPay_TH' => __DIR__ . '/../..' . '/includes/payment-methods/class-molpay-th.php',
        'Woosa\\Adyen\\Mobilepay' => __DIR__ . '/../..' . '/includes/payment-methods/class-mobilepay.php',
        'Woosa\\Adyen\\Module_Abstract_Entity' => __DIR__ . '/..' . '/woosa/abstract/class-module-abstract-entity.php',
        'Woosa\\Adyen\\Module_Abstract_Entity_Post' => __DIR__ . '/..' . '/woosa/abstract/class-module-abstract-entity-post.php',
        'Woosa\\Adyen\\Module_Abstract_Entity_User' => __DIR__ . '/..' . '/woosa/abstract/class-module-abstract-entity-user.php',
        'Woosa\\Adyen\\Module_Abstract_Tools' => __DIR__ . '/..' . '/woosa/tools/class-module-abstract-tools.php',
        'Woosa\\Adyen\\Module_Authorization' => __DIR__ . '/..' . '/woosa/authorization/class-module-authorization.php',
        'Woosa\\Adyen\\Module_Authorization_Hook' => __DIR__ . '/..' . '/woosa/authorization/class-module-authorization-hook.php',
        'Woosa\\Adyen\\Module_Authorization_Hook_AJAX' => __DIR__ . '/..' . '/woosa/authorization/class-module-authorization-hook-ajax.php',
        'Woosa\\Adyen\\Module_Authorization_Hook_Assets' => __DIR__ . '/..' . '/woosa/authorization/class-module-authorization-hook-assets.php',
        'Woosa\\Adyen\\Module_Authorization_Hook_Settings' => __DIR__ . '/..' . '/woosa/authorization/class-module-authorization-hook-settings.php',
        'Woosa\\Adyen\\Module_Core' => __DIR__ . '/..' . '/woosa/core/class-module-core.php',
        'Woosa\\Adyen\\Module_Core_Hook' => __DIR__ . '/..' . '/woosa/core/class-module-core-hook.php',
        'Woosa\\Adyen\\Module_Core_Hook_Assets' => __DIR__ . '/..' . '/woosa/core/class-module-core-hook-assets.php',
        'Woosa\\Adyen\\Module_Core_State' => __DIR__ . '/..' . '/woosa/core/class-module-core-state.php',
        'Woosa\\Adyen\\Module_Dependency' => __DIR__ . '/..' . '/woosa/dependency/class-module-dependency.php',
        'Woosa\\Adyen\\Module_Dependency_Hook' => __DIR__ . '/..' . '/woosa/dependency/class-module-dependency-hook.php',
        'Woosa\\Adyen\\Module_Intercom_Chat' => __DIR__ . '/..' . '/woosa/intercom-chat/class-module-intercom-chat.php',
        'Woosa\\Adyen\\Module_Intercom_Chat_Hook_Assets' => __DIR__ . '/..' . '/woosa/intercom-chat/class-module-intercom-chat-hook-assets.php',
        'Woosa\\Adyen\\Module_License' => __DIR__ . '/..' . '/woosa/license/class-module-license.php',
        'Woosa\\Adyen\\Module_License_Hook' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook.php',
        'Woosa\\Adyen\\Module_License_Hook_AJAX' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook-ajax.php',
        'Woosa\\Adyen\\Module_License_Hook_Assets' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook-assets.php',
        'Woosa\\Adyen\\Module_License_Hook_REST_API' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook-rest-api.php',
        'Woosa\\Adyen\\Module_License_Hook_Settings' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook-settings.php',
        'Woosa\\Adyen\\Module_License_Hook_Update' => __DIR__ . '/..' . '/woosa/license/class-module-license-hook-update.php',
        'Woosa\\Adyen\\Module_Settings' => __DIR__ . '/..' . '/woosa/settings/class-module-settings.php',
        'Woosa\\Adyen\\Module_Settings_Hook_General' => __DIR__ . '/..' . '/woosa/settings/class-module-settings-hook-general.php',
        'Woosa\\Adyen\\Module_Third_Party' => __DIR__ . '/..' . '/woosa/third-party/class-module-third-party.php',
        'Woosa\\Adyen\\Module_Tools' => __DIR__ . '/..' . '/woosa/tools/class-module-tools.php',
        'Woosa\\Adyen\\Module_Tools_Clear_Cache' => __DIR__ . '/..' . '/woosa/tools/class-module-tools-clear-cache.php',
        'Woosa\\Adyen\\Module_Tools_Hook' => __DIR__ . '/..' . '/woosa/tools/class-module-tools-hook.php',
        'Woosa\\Adyen\\Module_Tools_Hook_Assets' => __DIR__ . '/..' . '/woosa/tools/class-module-tools-hook-assets.php',
        'Woosa\\Adyen\\Module_Tools_Hook_Settings' => __DIR__ . '/..' . '/woosa/tools/class-module-tools-hook-settings.php',
        'Woosa\\Adyen\\My_Account_Hook' => __DIR__ . '/../..' . '/includes/my-account/class-my-account-hook.php',
        'Woosa\\Adyen\\My_Account_Hook_AJAX' => __DIR__ . '/../..' . '/includes/my-account/class-my-account-hook-ajax.php',
        'Woosa\\Adyen\\My_Account_Hook_Assets' => __DIR__ . '/../..' . '/includes/my-account/class-my-account-hook-assets.php',
        'Woosa\\Adyen\\Online_Banking_Poland' => __DIR__ . '/../..' . '/includes/payment-methods/class-online-banking-poland.php',
        'Woosa\\Adyen\\Option' => __DIR__ . '/..' . '/woosa/option/class-option.php',
        'Woosa\\Adyen\\Order' => __DIR__ . '/../..' . '/includes/order/class-order.php',
        'Woosa\\Adyen\\Order_Hook' => __DIR__ . '/../..' . '/includes/order/class-order-hook.php',
        'Woosa\\Adyen\\Paypal' => __DIR__ . '/../..' . '/includes/payment-methods/class-paypal.php',
        'Woosa\\Adyen\\REST_API' => __DIR__ . '/../..' . '/includes/rest-api/class-rest-api.php',
        'Woosa\\Adyen\\REST_API_Hook' => __DIR__ . '/../..' . '/includes/rest-api/class-rest-api-hook.php',
        'Woosa\\Adyen\\Request' => __DIR__ . '/..' . '/woosa/request/class-request.php',
        'Woosa\\Adyen\\Sepa_Direct_Debit' => __DIR__ . '/../..' . '/includes/payment-methods/class-sepa-direct-debit.php',
        'Woosa\\Adyen\\Service' => __DIR__ . '/../..' . '/includes/service/class-service.php',
        'Woosa\\Adyen\\Service_Checkout' => __DIR__ . '/../..' . '/includes/service/class-service-checkout.php',
        'Woosa\\Adyen\\Service_Hook' => __DIR__ . '/../..' . '/includes/service/class-service-hook.php',
        'Woosa\\Adyen\\Service_Recurring' => __DIR__ . '/../..' . '/includes/service/class-service-recurring.php',
        'Woosa\\Adyen\\Service_Util' => __DIR__ . '/../..' . '/includes/service/class-service-util.php',
        'Woosa\\Adyen\\Settings_Hook_General' => __DIR__ . '/../..' . '/includes/settings/class-settings-hook-general.php',
        'Woosa\\Adyen\\Settings_Hook_Webhooks' => __DIR__ . '/../..' . '/includes/settings/class-settings-hook-webhooks.php',
        'Woosa\\Adyen\\Sofort' => __DIR__ . '/../..' . '/includes/payment-methods/class-sofort.php',
        'Woosa\\Adyen\\Swish' => __DIR__ . '/../..' . '/includes/payment-methods/class-swish.php',
        'Woosa\\Adyen\\Tools_Hook' => __DIR__ . '/../..' . '/includes/tools/class-tools-hook.php',
        'Woosa\\Adyen\\Transient' => __DIR__ . '/..' . '/woosa/option/class-transient.php',
        'Woosa\\Adyen\\Trustly' => __DIR__ . '/../..' . '/includes/payment-methods/class-trustly.php',
        'Woosa\\Adyen\\Util' => __DIR__ . '/..' . '/woosa/util/class-util.php',
        'Woosa\\Adyen\\Util_Array' => __DIR__ . '/..' . '/woosa/util/class-util-array.php',
        'Woosa\\Adyen\\Util_Convert' => __DIR__ . '/..' . '/woosa/util/class-util-convert.php',
        'Woosa\\Adyen\\Util_DB_Table' => __DIR__ . '/..' . '/woosa/util/class-util-db-table.php',
        'Woosa\\Adyen\\Util_File' => __DIR__ . '/..' . '/woosa/util/class-util-file.php',
        'Woosa\\Adyen\\Util_Price' => __DIR__ . '/..' . '/woosa/util/class-util-price.php',
        'Woosa\\Adyen\\Util_Status' => __DIR__ . '/..' . '/woosa/util/class-util-status.php',
        'Woosa\\Adyen\\Vipps' => __DIR__ . '/../..' . '/includes/payment-methods/class-vipps.php',
        'Woosa\\Adyen\\Wechatpay' => __DIR__ . '/../..' . '/includes/payment-methods/class-wechatpay.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd81469cb61d304d24bb51fba1191e20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd81469cb61d304d24bb51fba1191e20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd81469cb61d304d24bb51fba1191e20::$classMap;

        }, null, ClassLoader::class);
    }
}
