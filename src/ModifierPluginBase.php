<?php

namespace Drupal\modifiers;

use Drupal\Core\Plugin\PluginBase;

/**
 * Provides a base implementation of Modifier interface.
 *
 * @see \Drupal\modifiers\Annotation\Modifier
 * @see \Drupal\modifiers\ModifierInterface
 * @see \Drupal\modifiers\ModifierPluginManager
 * @see plugin_api
 */
abstract class ModifierPluginBase extends PluginBase implements ModifierInterface {

  /**
   * Gets value of media query. Contains "all" if query is not defined.
   *
   * @param array $config
   *   The configuration array.
   *
   * @return string
   *   The string with media query.
   */
  protected static function getMediaQuery(array $config) {
    return empty($config['media_query']) ? 'all' : $config['media_query'];
  }

}
