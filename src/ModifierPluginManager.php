<?php

namespace Drupal\modifiers;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Provides a Modifier plugin manager.
 *
 * @see \Drupal\modifiers\Annotation\Modifier
 * @see \Drupal\modifiers\ModifierInterface
 * @see \Drupal\modifiers\ModifierPluginBase
 * @see plugin_api
 */
class ModifierPluginManager extends DefaultPluginManager {

  /**
   * Constructs a ModifierPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/modifiers', $namespaces, $module_handler, 'Drupal\modifiers\ModifierInterface', 'Drupal\modifiers\Annotation\Modifier');

    $this->setCacheBackend($cache_backend, 'modifiers_plugins');
    $this->alterInfo('modifiers_info');
  }

}
