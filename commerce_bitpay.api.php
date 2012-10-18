<?php

/**
 * @file
 * Hook documentation for the bitpay module.
 */


/**
 * Allows modules to alter the data array used to create a bitpay redirect
 * form prior to its form elements being created.
 *
 * @param &$data
 *   The data array used to create redirect form elements.
 * @param $order
 *   The full order object the redirect form is being generated for.
 */
function hook_commerce_bitpay_order_form_data_alter(&$data, $order) {
  // No example.
}