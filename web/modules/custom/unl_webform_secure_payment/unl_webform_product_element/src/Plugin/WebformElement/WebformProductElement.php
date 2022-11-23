<?php

namespace Drupal\unl_webform_product_element\Plugin\WebformElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Plugin\WebformElementBase;

/**
 * Provides a 'webform_product_element'.
 *
 * @WebformElement(
 *   id = "webform_product_element",
 *   label = @Translation("Product"),
 *   description = @Translation("Provides a product element."),
 *   category = @Translation("Advanced elements"),
 * )
 */
class WebformProductElement extends WebformElementBase {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    return parent::getDefaultProperties() + [
        'product_price' => 0,
        'product_name' => ''
      ];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form['product_element'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Product settings'),
    ];
    $form['product_element']['product_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name of the product'),
      '#required' => TRUE,
      '#description' => $this->t('Enter the name of the product'),
    ];
    $form['product_element']['product_price'] = [
      '#type' => 'number',
      '#title' => $this->t('Price of product'),
      '#required' => TRUE,
      '#description' => $this->t('Insert price of the product'),
    ];


    $form['#attached']['library'][] = 'unl_webform_product_element/webform.admin.product_element_style';
    $form['#attached']['library'][] = 'unl_webform_product_element/webform.admin.promotion_code_js';

    return $form;
  }

}
