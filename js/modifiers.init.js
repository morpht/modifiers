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
        this.initAttributes();
        this.initSettings();
      }
    },

    initSettings: function () {
      // Skip processing if there are no modifications.
      if (typeof drupalSettings.modifiers.settings !== 'undefined') {
        var modifications = [];

        // Group all modifications into single array.
        $.each(drupalSettings.modifiers.settings, function (index, group) {
          modifications = modifications.concat(group);
        });

        // Process all modifications.
        $.each(modifications, function (index, modification) {
          var callback = window[modification.namespace][modification.callback];
          if (typeof callback === 'function') {
            callback(modification.selector, modification.media, modification.args);
          }
        });
      }
    },

    initAttributes: function () {
      // Skip processing if there are no attributes.
      if (typeof drupalSettings.modifiers.attributes !== 'undefined') {
        var attributes = {};

        // Group all attributes into single array.
        $.each(drupalSettings.modifiers.attributes, function (index, group) {
          $.each(group, function (media, selectors) {
            // Initialize array for this media.
            if (typeof attributes[media] === 'undefined') {
              attributes[media] = {};
            }
            $.each(selectors, function (selector, values) {
              attributes[media][selector] = values;
            });
          });
        });

        // Process all attributes immediately.
        this.toggleAttributes(attributes);

        var that = this;
        // Process all attributes again after resize.
        window.addEventListener('resize', function () {
          that.toggleAttributes(attributes);
        });
      }
    },

    toggleAttributes: function (attributes) {
      var enable = {};
      var disable = {};

      // Check all media queries validity and split selectors to sets.
      $.each(attributes, function (media, selectors) {
        if (window.matchMedia(media).matches) {
          // Fill these selectors for enabling.
          $.each(selectors, function (selector, values) {
            enable[selector] = values;
          });
        }
        else {
          // Fill these selectors for disabling.
          $.each(selectors, function (selector, values) {
            disable[selector] = values;
          });
        }
      });

      // Remove unwanted attributes from target objects.
      $.each(disable, function (selector, values) {
        var element = $(selector);
        if (element.length) {
          // Process all attributes.
          $.each(values, function (attribute, value) {
            if (attribute === 'class') {
              $.each(value, function (index, item) {
                element.removeClass(item);
              });
            }
            else {
              element.prop(attribute, null);
            }
          });
        }
      });

      // Set required attributes to target objects.
      $.each(enable, function (selector, values) {
        var element = $(selector);
        if (element.length) {
          // Process all attributes.
          $.each(values, function (attribute, value) {
            if (attribute === 'class') {
              $.each(value, function (index, item) {
                element.addClass(item);
              });
            }
            else if (typeof value === 'object') {
              element.prop(attribute, value.join(' '));
            }
            else {
              element.prop(attribute, value);
            }
          });
        }
      });
    }
  };

})(jQuery, Drupal, drupalSettings);
