<?php

namespace Drupal\unl_webform_product_element\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
/**
 * Provides a 'webform_product_element'.
 *
 * Below is the definition for 'webform_product_element' which
 * renders a text field.
 *
 * @FormElement("webform_product_element")
 */
class WebformProductElement extends FormElement
{

  /**
   * {@inheritdoc}
   */
  public function getInfo()
  {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#size' => 30,
      '#process' => [
        [$class, 'processWebformProductElement'],
        [$class, 'processAjaxForm'],
      ],
      '#element_validate' => [
        [$class, 'validateWebformProductElement'],
      ],
      '#pre_render' => [
        [$class, 'preRenderWebformProductElement'],
      ],
      '#theme' => 'input__webform_product_element',
      '#theme_wrappers' => ['form_element'],
    ];
  }

  /**
   * Processes a 'webform_product_element' element.
   */
  public static function processWebformProductElement(&$element, FormStateInterface $form_state, &$complete_form)
  {
    // Here you can add and manipulate your element's properties and callbacks.

//    $messenger = \Drupal::service('messenger');
//    $messenger->addMessage('processWebformProductElement');
    return $element;
  }

  /**
   * Webform element validation handler for #type 'webform_product_element'.
   */
  public static function validateWebformProductElement(&$element, FormStateInterface $form_state, &$complete_form)
  {
//    $messenger = \Drupal::service('messenger');
//    $messenger->addMessage('validateWebformProductElement');

    // validation for each product


  }

  /**
   * Prepares a #type 'product' render element for theme_element().
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #title, #value, #description, #size, #maxlength,
   *   #placeholder, #required, #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for theme_element().
   */
  public static function preRenderWebformProductElement(array $element)
  {
    $element['#attributes']['readonly'] = 'readonly';
    $element['#attributes']['type'] = 'label';
    $element['#attributes']['value'] = $element["#product_name"]. ' : '. $element["#product_price"]. ' USD ';

    Element::setAttributes($element, ['id', 'name', 'value', 'size', 'maxlength', 'placeholder']);
    static::setAttributes($element, ['form-text', 'webform-product-element']);
    return $element;

  }
}
