<?php

namespace Drupal\unl_webform_secure_payment\src\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;

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
          [$class, 'processWebformElementProduct'],
          [$class, 'processAjaxForm'],
        ],
        '#element_validate' => [
          [$class, 'validateWebformExampleElement'],
        ],
        '#pre_render' => [
          [$class, 'preRenderWebformExampleElement'],
        ],
        '#theme' => 'input__webform_example_element',
        '#theme_wrappers' => ['form_element'],
      ];
    }
  
    /**
     * Processes a 'webform_example_element' element.
     */
    public static function processWebformElementProduct(&$element, FormStateInterface $form_state, &$complete_form) {
      // Here you can add and manipulate your element's properties and callbacks.
      return $element;
    }
  
    /**
     * Webform element validation handler for #type 'webform_example_element'.
     */
    public static function validateWebformExampleElement(&$element, FormStateInterface $form_state, &$complete_form) {
      // Here you can add custom validation logic.
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
    public static function preRenderWebformExampleElement(array $element) {
      $element['#attributes']['type'] = 'text';
      Element::setAttributes($element, ['id', 'name', 'value', 'size', 'maxlength', 'placeholder']);
      static::setAttributes($element, ['form-text', 'webform-product-element']);
      return $element;
    }
  
  }
  