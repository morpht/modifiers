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
 * Alter the referenced value mappings.
 *
 * Modules may implement this hook to alter the default mappings of entity
 * types and bundles to corresponding fields.
 *
 * Default mappings:
 * @code
 * $mappings = [
 *   'media' => [
 *     'image' => ['image', 'field_file'],
 *     'video' => ['field_media_video_embed_field', 'field_file'],
 *   ],
 *   'taxonomy_term' => [
 *     'modifiers_color' => ['field_mod_color'],
 *   ],
 * ];
 * @endcode
 *
 * @param array $mappings
 *   The mappings to be altered, keyed by entity type and bundle.
 *
 * @see getReferencedValue()
 */
function hook_modifiers_mappings_alter(array &$mappings) {
  if (!empty($mappings['taxonomy_term']['modifiers_color'])) {
    unset($mappings['taxonomy_term']['modifiers_color']);
    $mappings['taxonomy_term']['my_color_bundle'] = ['field_color'];
  }
}

/**
 * @} End of "addtogroup hooks".
 */
