<?php

namespace Drupal\modifiers;

/**
 * Provides an implementation of Modification interface.
 */
class Modification implements ModificationInterface {

  private $css;

  private $libraries;

  private $settings;

  private $attributes;

  private $links;

  /**
   * Constructs a new modification.
   *
   * @param array $css
   *   The modification styles.
   * @param array $libraries
   *   The modification libraries.
   * @param array $settings
   *   The modification settings.
   * @param array $attributes
   *   The modification attributes.
   * @param array $links
   *   The modification links.
   */
  public function __construct(array $css = [], array $libraries = [], array $settings = [], array $attributes = [], array $links = []) {
    $this->css = $css;
    $this->libraries = $libraries;
    $this->settings = $settings;
    $this->attributes = $attributes;
    $this->links = $links;
  }

  /**
   * {@inheritdoc}
   */
  public function getCss() {
    return $this->css;
  }

  /**
   * Sets the css property.
   *
   * @param array $css
   *   The modification styles.
   */
  public function setCss(array $css) {
    $this->css = $css;
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries() {
    return $this->libraries;
  }

  /**
   * Sets the libraries property.
   *
   * @param array $libraries
   *   The modification libraries.
   */
  public function setLibraries(array $libraries) {
    $this->libraries = $libraries;
  }

  /**
   * {@inheritdoc}
   */
  public function getSettings() {
    return $this->settings;
  }

  /**
   * Sets the settings property.
   *
   * @param array $settings
   *   The modification settings.
   */
  public function setSettings(array $settings) {
    $this->settings = $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function getAttributes() {
    return $this->attributes;
  }

  /**
   * Sets the attributes property.
   *
   * @param array $attributes
   *   The modification attributes.
   */
  public function setAttributes(array $attributes) {
    $this->attributes = $attributes;
  }

  /**
   * {@inheritdoc}
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * Sets the links property.
   *
   * @param array $links
   *   The modification links.
   */
  public function setLinks(array $links) {
    $this->links = $links;
  }

}
