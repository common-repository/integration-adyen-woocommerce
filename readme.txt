=== Integration for Adyen with WooCommerce ===
Tags: online payments, credit card, iDeal, giropay, googlepay, SEPA
Requires at least: 5.0
Tested up to: 6.2
Stable tag: 1.8.1
Requires PHP: 7.4
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Accept all worldwide payment methods with Adyen.


== Description ==

Expand into any market and automatically serve customers their preferred payment methods with one quick and easy integration via WooCommerce. Let your customers pay the way they want, no matter in which country they are. Offer access to all important local payment methods, including all major cards, mobile wallets like Apple Pay and WeChat Pay, and many more



== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/integration-adyen-woocommerce` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Go to WooCommerce->Settings->Adyen to configure the plugin



== Screenshots ==

1. General settings



== Frequently Asked Questions ==

= Which payment methods does the Adyen plugin support? =

We have invested a lot of development time in expanding the payment methods of the Adyen WooCommerce plugin. At the moment we support the payment methods below:

* Alipay
* Apple Pay
* Bancontact
* Bancontact mobile
* BLIK
* Boleto
* Creditcard
* Giropay
* Google Pay
* GrabPay
* iDEAL
* Klarna
* MobilePay
* MolPay
* Online banking Poland
* PayPal
* SEPA direct debit (only for recurring payments)
* Sofort
* Swish
* Vipps
* WeChat Pay
* Truly

= Which countries are supported by Adyen? =

Adyen is a payment provider which supports worldwide payment methods. You can use Adyen all over the world, with local payment methods.

= Can visitors save their creditcard credentials? =

Yes, they can save their creditcard credentials. The creditcards will be saved within their WooCommerce account on your webshop.

This functionality is similar to the iFrame. Because of compliance reasons, you don’t want to have payment details within the database of your webshop. Therefore we use tokenization. When a new payment will be done, it will use the created token. Adyen will know the payment details based on that token.



== Upgrade Notice ==

Every update comes with fixes and improvements.



== Changelog ==

## 1.8.1 - 2024-03-05

### Added

* A warning message about the future of the plugin

## 1.8.0 - 2024-01-23

# Added

* New payment method `Trustly` (only one-time payments)
* New hooks have been added: `adn\core_hook_assets\public_assets`, `adn\validate_fields\require_cardholder_name` , `adn\validate_fields\require_cardholder_name`, `adn\validate_fields\require_cvc`, `adn\rest_api_hook\unexpected_event`, `adn\rest_api\is_authenticated\force_full_authentication`, `adn\rest_api\is_authenticated\log_unauthenticated_attempt`

# Changed

* Return specific response for unauthenticated Adyen webhooks
* For recurring payments the request property `paymentMethod/recurringDetailReference` has been replaced with `paymentMethod/storedPaymentMethodId`

# Fixed

* Don't hide the processing message when performing a redirecting payment
* Too small 3DS authentication pop-up window

## 1.7.0 - 2023-09-28

# Added

* Added support for `HPOS (High-Performance Order Storage)`
* The following hooks have been added: `adn\order\payment_result`, `adn\process_refund\allow_sepa_direct_debit_refunds_after_capture`, `adn\rest_api\payload_data`, `adn\rest_api_hook\authorisation\manual_immediate_capture`, `adn\rest_api_hook\authorisation\payment_completed`, `adn\rest_api_hook\authorisation\payment_failed`, `adn\rest_api_hook\cancellation\success`, `adn\rest_api_hook\cancellation\failure`, `adn\rest_api_hook\capture\payment_completed`. `adn\rest_api_hook\capture\payment_failed`, `adn\rest_api_hook\capture_failed`, `adn\rest_api_hook\refund\sucess`, `adn\rest_api_hook\refund\failure`, `adn\rest_api_hook\refund_failed`, `adn\rest_api_hook\cancel_or_refund\success`, `\rest_api_hook\cancel_or_refund\failure`, `adn\rest_api_hook\recurring_contract`

### Changed

* In case the proxy is not available then use fallback API endpoints

## 1.6.1 - 2023-07-20

### Fixed

* Some payment methods are not properly displayed on the checkout page due to a JS error
* The test mode is not correctly set for Google Pay

## 1.6.0 - 2023-07-13

## Added

* Added the payment method `Online banking Poland` which replaces the old one `DotPay`

## Changed

* The JS library of Adyen Web Component has been upgraded from `v4.8.0` to `5.33.0`
* The Adyen API versions have been ugraded as follow: Checkout from `v67` to `v68` and Recurring from `v49` to `v68`
* The error message "Notifications could not be authenticated.." has been improved to show more details for a better troubleshooting

## Removed

* The payment method `DotPay` has been removed since is replaced by `Online banking Poland`

## 1.5.3 - 2023-06-07

### Fixed

* Fixed the error `PHP Warning: Undefined array key "path"...`

## 1.5.2 - 2023-05-09

### Fixed

* The credit card form slides up and down when the user is typing in the address fields
* For some shops the Adyen webhooks fail due to an internal error

## 1.5.1 - 2023-03-23

### Fixed

* Google pay cannot be enabled due to a change in the method name generated by Adyen
* Correct the typo in the plugin installation steps
* The authorization of webhooks fails if the password has special characters
* The UI of Authorization page is broken

### Changed

* The support chat is now available in the plugin settings

## 1.5.0 - 2023-01-17

#### Added

* Added new payment method `Swish`
* Added new payment method `Bancontact mobile`
* Added new payment method `Vipps`
* Added new payment method `MobilePay`
* Added new payment method `MolPay`
* Added new payment method `GrabPay`
* Added support for using HMAC signature for Webhooks

#### Changed

* In case an order payment fails the error reason is saved now as note on the order
* The credit card form is expanding now automatiacally if there are not saved cards

#### Fixed

* Format the shop languages which contain suffixes like `_formal` or `_informal` to avoid errors in the request to Adyen

### 1.4.2 - 2022-12-22

* [FIX] - The tax calculation does not take into account correctly the WooCommerce tax settings

### 1.4.1 - 2022-11-29

* [FIX] - The Apple Pay token is not generated
* [FIX] - The tax is not taken into account in checkout, this leads to error `Apple Pay token amount-mismatch`
* [FIX] - Cancelled payments doesn't correctly redirect

### 1.4.0 - 2022-06-15

* [FIX] - Allow special characters for cardholder name
* [FIX] - Fix the warning `Warning: Invalid argument supplied for foreach() in /home/users/ivn-dev/public_html/content/plugins/integration-adyen-woocommerce/includes/service/class-service-checkout.php on line 163`
* [FIX] - For products with price 0 the tax is calculated wrongly
* [FIX] - Let WooCommerce to mark the order status as `Completed` for virtual & downloadable products
* [TWEAK] - Stop sending remote requests if the last response is 401 unauthorized
* [TWEAK] - Upgrade Adyen Web component from v4.4.0 to v4.8.0
* [FEATURE] - New setting option for each payment method to define a custom icon

### 1.3.2 - 2022-04-12

* [FIX] - Authorization of the plugin gets failed in some scenarios
* [CHANGE] - Replace Adyen's PHP library with our custom logic
* [TWEAK] - Added step-by-step guide how to configure Apple pay payment method

### 1.3.1 - 2022-03-15

* [FIX] - The price tax is not calculated correctly for line items

### 1.3.0 - 2022-02-09

* [FEATURE] - Added new payment method Dotpay
* [FEATURE] - Added new payment method BLIK
* [FEATURE] - Added new payment method Apple Pay
* [IMPROVEMENT] - Make more logic consistency between all payment methods
* [TWEAK] - The "Notification" settings section has been renamed to "Webhooks" to be consistent with Adyen
* [TWEAK] - The recurring reference is now used from the shop subscription instead to be retrieved from Adyen over and over again
* [TWEAK] - When a customer removes its personal data a note will be created on the order

### 1.2.1 - 2022-01-11

* [FIX] - Credit card form error in Javascript which affected the holder name field
* [FIX] - Use the first payment reference from the parent order instead of the subscription
* [FIX] - Add extra checks for Bancontact to make sure it gets the correct recurring reference

### 1.2.0 - 2021-08-05

* [FIX] - Wrong config for Google Pay
* [FIX] - Failed/canceled payments redirect to thank you page instead of the pay order page
* [FIX] - Installments are not displayed for credit card
* [FIX] - Wrong supported countries for Klarna
* [FEATURE] - Added recurring payments support for Klarna payment method

### 1.1.4 - 2021-05-27

* [FIX] - Fix Javascript conflict on License section

### 1.1.3 - 2021-05-13

* [FIX] - Sending payment details fails in some cases due to cookie
* [FIX] - Undefined function in Paypal method
* [FIX] - Change Google pay icon
* [IMPROVEMENT] - Upgrade Adyen PHP client library from v5.0.0 to v10.1.0
* [IMPROVEMENT] - Upgrade Adyen JS component from v3.12.1 to v4.4.0
* [TWEAK] - Small changes to Tools section

### 1.1.2 - 2021-04-12

* [IMPROVEMENT] - Rebuilt license management and the logic of receving updates

### 1.1.1 - 2020-10.03

* [FIX] - Fixed missing icon on "Use new card" button in checkout page
* [FIX] - Stored cards are not removed properly from the general cache and this gives conflicts for guest users
* [FIX] - Fixed wrong variable name "$s_address"
* [FIX] - Integration of Giropay payment method is changed to "API-only" mode because it does not work properly via JS component
* [FIX] - Mount the JS component of credit card form only once to avoid multiple unnecessary calls
* [FIX] - Inform the admin by a warning message when the domain key must be manually re-generated

### 1.1.0 - 2020-09.09

* [FIX] - Added a new setting option to define a "Reference Prefix" to avoid conflicts in processing orders on multisite installation
* [FEATURE] - Added PayPal payment method (no recurring payments supported yet)
* [FEATURE] - Added Klarna payment method (no recurring payments supported yet)
* [FEATURE] - Added a new option to allow customers to remove their payment personal data according to GDPR
* [FEATURE] - Added recurring payments support for Google Pay payment method
* [TWEAK] - Added more data in the API requests to avoid fraud detection
* [TWEAK] - Display supported countries and currencies on each payment method
* [TWEAK] - Added a new settings section called "Tools"

### 1.0.10 - 2020-08.13

* [FIX] - Added support for Bancontact payment method to be used with subscrptions as well
* [FIX] - Exclude stored credit cards from the general cache
* [FIX] - Fixed broken design of credit cards form in the checkout page
* [FIX] - Fixed JS scripts issue in Wordpress 5.5

### 1.0.9 - 2020-07.23

* [FIX] - Added support for variable subscription products to avoid the "pending payment" order status
* [FIX] - Made house number optional when paying with credit card
* [FIX] - Fixed the empty user reference when paying with a saved credit card
* [FIX] - Encapsulated the entire code to avoid conflicts with other plugins which use the same dependency libraries

### 1.0.8 - 2020-06-29

* [FIX] - The origin key was not regenerated on saving settings action

### 1.0.7 - 2020-06-25

* [FIX] - Fixed wrong reference for recurring orders
* [FIX] - Cache the available payment methods to increase the speed time
* [FIX] - Fixed conflicts for generating the origin keys
* [IMPROVEMENT] - Rearranged the settings page and made it accessible even if the license is inactive

### 1.0.6 - 2020-05-01

* [FIX] - Fixed the problem of removing stored cards from "My account" page
* [FIX] - Fixed wrong payment url for subscription products
* [FIX] - Fixed credit cards conflict for guest users
* [TWEAK] - Do not regenerate the credit card form when the checkout contents reload
* [TWEAK] - Add extra info (billing address) in the payment request

### 1.0.5 - 2020-02-19

* [FIX] - Credit card form is not loading due to `origin keys` is not generated
* [FIX] - Credit card form multiple click events conflict
* [FEATURE] - New option to set whether or not to remove plugin data on uninstall
* [TWEAK] - Rearrange settings sub-tabs
* [TWEAK] - Add falback for JS file dependencies

### 1.0.4 - 2020-01-09

* [FEATURE] - Added Google Pay payment method
* [FEATURE] - Added Wechat Pay payment method
* [TWEAK] - Show authentication  status
* [TWEAK] - Add caching for some API requests and a button to clear this cache

### 1.0.3 - 2019-11-26

* [FEATURE] - Boleto payment method added
* [FEATURE] - Alipay payment method added
* [FEATURE] - Card installments support added
* [FEATURE] - New option to capture payments manually
* [FEATURE] - New option to save credit cards for future payments
* [FEATURE] - New section in My Account page to display the saved credit cards

### 1.0.2 - 2019-09-25

* [FIX] - Fixed missing function for getting subscriptions

### 1.0.1 - 2019-09-20

* [FIX] - Fixed activation plugin issue

### 1.0.0 - 2019-09-05

* This is the first release, yeey!