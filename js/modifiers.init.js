/**
 * @file
 * Initializes all modifications.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.modifiers = {
    processed: false,

    attach: function () {
      // Process only once.
      if (this.processed === false) {
        this.processed = true;
        this.init();
      }
    },

    init: function () {
      // Skip processing if there are no modifications.
      if (drupalSettings.modifications !== undefined) {
        var modifications = [];

        // Group all modifications into single array.
        $.each(drupalSettings.modifications, function (index, group) {
          modifications = modifications.concat(group);
        });

        // Process all modifications.
        $.each(modifications, function (index, modification) {
          var callback = window[modification.namespace][modification.callback];
          if (typeof callback === 'function') {
            callback(modification.selector, modification.args);
          }
        });
      }
    }
  }

})(jQuery, Drupal, drupalSettings);
