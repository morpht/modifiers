<?php

namespace Drupal\modifiers;

/**
 * Defines a common interface for Modification objects.
 */
interface ModificationInterface {

  /**
   * Gets the css property.
   *
   * @return array
   *   The modification styles.
   */
  public function getCss();

  /**
   * Gets the libraries property.
   *
   * @return array
   *   The modification libraries.
   */
  public function getLibraries();

  /**
   * Gets the settings property.
   *
   * @return array
   *   The modification settings.
   */
  public function getSettings();

  /**
   * Gets the attributes property.
   *
   * @return array
   *   The modification attributes.
   */
  public function getAttributes();

  /**
   * Gets the links property.
   *
   * @return array
   *   The modification links.
   */
  public function getLinks();

}
