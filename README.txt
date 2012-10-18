-- SUMMARY --

This module provides Bitpay payment option for Drupal Commerce.

For a full description of the module, visit the project page:
  http://drupal.org/project/

To submit bug reports and feature suggestions, or to track changes:
  http://drupal.org/project/issues/


-- REQUIREMENTS --

commerce
commerce_payment


-- INSTALLATION --

* Install as usual


-- CONFIGURATION --

* Configure Bitpay options in admin/commerce/config/bitpay
    All fields marked with start are required fields

    - BitPay API key *
        BitPay API access key. Something like aW4x5kLr4mer4fovDJLGTMXSATkf81DLKcm349ajd12
        Created at Bitpay website

    - BitPay secret key *
        Set the secret to a random string of characters (8 to 10 is sufficient). 
        This secret is used to verify the authenticity of incoming bit-pay invoice notifications.

    - Currency *
        This is the currency code set for the price setting. 
        The pricing currencies currently supported are USD, EUR, BTC, and all of the codes listed on this page:
        https://bitpay.com/bitcoin-exchange-rates

    - Redirect url
        This is the URL for a return link that is displayed on the receipt, to return the shopper back to your website after a successful purchase.
        Leave blank to use default commerce "checkout complete" -page.

    - Notification email
        This is the email where invoice update notifications should be sent. 
        Leave blank to use default settings defined in your Bitpay account.
-- TROUBLESHOOTING --

* If something goes wrong, contact project maintainers


-- FAQ --

Q: 

A: 



-- CONTACT --

Current maintainers:
* Viljami Räisä (ihqtzup) - http://drupal.org/user/2341694

This project has been sponsored by:
* Bittiraha.fi
  Finnish Bitcoin portal
  http://bittiraha.fi