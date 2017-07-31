# Modifiers

## Overview

The Modifier module defines a system for defining how modifications can be 
consistently applied to elements on a page. Modifiers work by leveraging the
power of the Drupal theming system and abstracting it to a Modifier interface
which provides for the application of modifications on elements defined by a 
selector.

The power of Modifiers comes from being applicable to elements as defined by a
selector. This means they can be applied to entities (Nodes, Blocks, Paragraphs,
Users, etc), theme regions (header, footer, etc), View Modes (full, teaser, 
etc), classes in the WYSIWYG and anything you can think of and define.

Modifiers are developed by architects and programmers and used by site builders
and editors. They are designed to make site building easy and pleasurable...
and fast. 

The module is comprised of a number of components which work together:
* A Modifier interface and plugin manager which defines what Modifiers do.
* An internal system which converts field content data into a simple array
structure which is used to configure the Modifier instances.
* A hook into entity rendering, allowing for modifiers to attach to entities.

This module is a foundation for two other helpful modules:
* [Look](https://www.drupal.org/project/look) Handle collections of Modifiers
and apply them on a per page basis.
* [Modifiers pack](https://www.drupal.org/project/modifiers_pack) A number of
Modifier implementations to get you up can running quickly with useful 
modifications such as colors, background images, parallax images, background 
video, shadows, corners and the like.

## It's so Convivial
At [convivial.io](https://convivial.io) you can see Look and Modifiers working 
together.

## Maintainers

This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com/).
