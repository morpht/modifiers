<?php

namespace Drupal\modifiers;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines a common interface for Modifier plugins.
 *
 * @see \Drupal\modifiers\Annotation\Modifier
 * @see \Drupal\modifiers\ModifierPluginBase
 * @see \Drupal\modifiers\ModifierPluginManager
 * @see plugin_api
 */
interface ModifierInterface extends PluginInspectionInterface {

  /**
   * Creates modification based on provided configuration.
   *
   * @param string $selector
   *   The modification selector.
   * @param array $config
   *   The modification configuration.
   *
   * @return \Drupal\modifiers\Modification|null
   *   The Modification object or null if empty.
   */
  public static function modification($selector, array $config);

}
