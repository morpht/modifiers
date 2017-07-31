<?php

/**
 * @file
 * Hooks provided by the Modifiers module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter the available modifiers.
 *
 * Modules may implement this hook to alter the information that defines
 * modifiers. All properties that are available in
 * \Drupal\modifiers\Annotation\Modifier can be altered here, with the addition
 * of the "class" and "provider" keys.
 *
 * @param array $modifiers
 *   The modifier information to be altered, keyed by modifier IDs.
 *
 * @see \Drupal\modifiers\ModifierPluginBase
 */
function hook_modifiers_info_alter(array &$modifiers) {
  if (!empty($modifiers['example_modifier'])) {
    $modifiers['example_modifier']['class'] = '\Drupal\my_module\MuchBetterModifier';
    $modifiers['example_modifier']['label'] = t('Much Better Modifier');
  }
}

/**
 * @} End of "addtogroup hooks".
 */
