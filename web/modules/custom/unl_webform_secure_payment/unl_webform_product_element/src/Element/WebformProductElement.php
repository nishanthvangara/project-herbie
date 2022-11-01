<?php

namespace Drupal\unl_webform_product_element\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'webform_product_element'.
 *
 * Below is the definition for 'webform_product_element' which
 * renders a text field.
 *
 * @FormElement("webform_product_element")
 */
class WebformProductElement extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#size' => 60,
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
  public static function processWebformProductElement(&$element, FormStateInterface $form_state, &$complete_form) {
    // Here you can add and manipulate your element's properties and callbacks.
    return $element;
  }

  /**
   * Webform element validation handler for #type 'webform_product_element'.
   */
  public static function validateWebformProductElement(&$element, FormStateInterface $form_state, &$complete_form) {
    $has_access = (!isset($element['#access']) || $element['#access'] === TRUE);

    $value = $element['#value'];
    if ($value === '') {
      return;
    }

    $promotion_code = trim($value);
    if ($promotion_code === FALSE) {
      if ($has_access) {
        if (isset($element['#title'])) {
          $form_state->setError($element, t('%name must be a valid code.', ['%name' => $element['#title']]));
        }
        else {
          $form_state->setError($element);
        }
      }
      return;
    }

    $valid_codes = trim($element['#codes']);
    $valid_codes_array = array_map('trim', explode(PHP_EOL, $valid_codes));

    if ($has_access && in_array($promotion_code, $valid_codes_array) === FALSE) {
      $form_state->setError($element, t('%name must be a valid code.', ['%name' => $element['#title']]));
    }
  }

  /**
   * Prepares a #type 'email_multiple' render element for theme_element().
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #title, #value, #description, #size, #maxlength,
   *   #placeholder, #required, #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for theme_element().
   */
  public static function preRenderWebformProductElement(array $element) {
    $element['#attributes']['type'] = 'text';
    Element::setAttributes(
        $element,
        ['id', 'name', 'value', 'size', 'maxlength', 'placeholder']
    );
    static::setAttributes($element, ['form-text', 'webform_product_element']);
    return $element;
  }

}
