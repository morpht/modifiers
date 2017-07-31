<?php

namespace Drupal\modifiers\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Modifier annotation object.
 *
 * @see \Drupal\modifiers\ModifierInterface
 * @see \Drupal\modifiers\ModifierPluginBase
 * @see \Drupal\modifiers\ModifierPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class Modifier extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
