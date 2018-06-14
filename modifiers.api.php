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
 *   The modifier information to be altered, keyed by modifier ID.
 *
 * @see \Drupal\modifiers\Annotation\Modifier
 */
function hook_modifiers_info_alter(array &$modifiers) {
  if (isset($modifiers['example_modifier'])) {
    $modifiers['example_modifier']['class'] = '\Drupal\my_module\MuchBetterModifier';
    $modifiers['example_modifier']['label'] = t('Much Better Modifier');
  }
}

/**
 * Alter the referenced value mappings.
 *
 * Modules may implement this hook to alter the default mappings of entity
 * types and bundles to corresponding fields. First non-empty field is used.
 *
 * Default mappings:
 *
 * @code
 * $mappings = [
 *   'media' => [
 *     'image' => ['field_media_image', 'image', 'field_file'],
 *     'video' => ['field_media_video_embed_field', 'field_file'],
 *     'video_embed' => ['field_media_video_embed_field', 'field_file'],
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
 * @see \Drupal\modifiers\Modifiers::getReferencedValue()
 */
function hook_modifiers_mappings_alter(array &$mappings) {
  if (isset($mappings['taxonomy_term']['modifiers_color'])) {
    unset($mappings['taxonomy_term']['modifiers_color']);
    $mappings['taxonomy_term']['my_color_bundle'] = ['field_color'];
  }
}

/**
 * Alter the extracted configuration.
 *
 * Modules may implement this hook to alter the configuration that is
 * extracted from entity inside hook_entity_view_alter().
 * It is also possible to alter the build array (e.g. extra classes).
 *
 * @param array $config
 *   The configuration array to be altered, keyed by modifier ID.
 * @param array &$context
 *   Various aspects of the context in which the entity is going to be
 *   displayed, with the following keys:
 *   - 'build': The alterable build array for rendering.
 *   - 'entity': The entity being viewed.
 *   - 'display': The entity view display object.
 *
 * @see modifiers_entity_view_alter()
 */
function hook_modifiers_entity_view_config_alter(array &$config, array &$context) {
  if (isset($config['my_modifier'])) {
    foreach ($config['my_modifier'] as &$modifier_config) {
      $modifier_config['entity_type'] = $context['entity']->getEntityTypeId();
      $modifier_config['display_mode'] = $context['display']->getMode();
    }
  }
}

/**
 * @} End of "addtogroup hooks".
 */
