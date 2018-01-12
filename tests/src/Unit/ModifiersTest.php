<?php

namespace Drupal\Tests\modifiers\Unit;

use Drupal\modifiers\Modification;
use Drupal\modifiers\Modifiers;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers\Modifiers
 * @group modifiers
 */
class ModifiersTest extends UnitTestCase {

  /**
   * The tested modifiers service.
   *
   * @var \Drupal\modifiers\Modifiers
   */
  protected $modifiers;

  /**
   * The mocked module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $moduleHandler;

  /**
   * The mocked modifier plugin manager.
   *
   * @var \Drupal\modifiers\ModifierPluginManager|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $modifierPluginManager;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->moduleHandler = $this->getMock('\Drupal\Core\Extension\ModuleHandlerInterface');
    $this->modifierPluginManager = $this->getMockBuilder('Drupal\modifiers\ModifierPluginManager')
      ->disableOriginalConstructor()
      ->getMock();
    $this->modifiers = new Modifiers($this->moduleHandler, $this->modifierPluginManager);
  }

  /**
   * @covers ::apply
   */
  public function testApply() {
    // Attach all parts of modifications into build array.
    $modification_1 = new Modification([
      'all' => [
        '.selector' => [
          'property1:value1',
        ],
      ],
    ], [
      'module1/library1',
    ], [
      'setting1' => 'value1',
    ], [
      'all' => [
        '.selector' => [
          'class' => [
            'modifiers-class1',
          ],
          'attribute1' => 'value1',
        ],
      ],
    ], [
      [
        'attribute1' => 'value1',
      ],
    ]);
    $modification_2 = new Modification([
      'all' => [
        '.selector' => [
          'property2:value2',
        ],
      ],
    ], [
      'module2/library2',
    ], [
      'setting2' => 'value2',
    ], [
      'all' => [
        '.selector' => [
          'class' => [
            'modifiers-class2',
          ],
          'attribute2' => 'value2',
        ],
      ],
    ], [
      [
        'attribute2' => 'value2',
      ],
    ]);
    $modifications = [$modification_1, $modification_2];
    $actual_1 = [];
    $this->modifiers->apply($modifications, $actual_1, 'test');
    $expected_1 = [
      '#attached' => [
        'library' => [
          'module1/library1',
          'module2/library2',
        ],
        'drupalSettings' => [
          'modifiers' => [
            'settings' => [
              'test' => [
                [
                  'setting1' => 'value1',
                ],
                [
                  'setting2' => 'value2',
                ],
              ],
            ],
            'attributes' => [
              'test' => [
                'all' => [
                  '.selector' => [
                    'class' => [
                      'modifiers-class1',
                      'modifiers-class2',
                    ],
                    'attribute1' => 'value1',
                    'attribute2' => 'value2',
                  ],
                ],
              ],
            ],
          ],
        ],
        'html_head' => [
          [
            [
              '#type' => 'html_tag',
              '#tag' => 'link',
              '#attributes' => [
                'attribute1' => 'value1',
              ],
              '#weight' => 10,
            ],
            'modifications_links_0338fb17d26641c328e0ba76924e0857',
          ],
          [
            [
              '#type' => 'html_tag',
              '#tag' => 'link',
              '#attributes' => [
                'attribute2' => 'value2',
              ],
              '#weight' => 10,
            ],
            'modifications_links_23775fde18abee24af4e88d93c278cec',
          ],
          [
            [
              '#type' => 'html_tag',
              '#tag' => 'style',
              '#attributes' => [
                'media' => 'all',
                'data-modifiers' => 'test',
              ],
              '#value' => '.selector{property1:value1}.selector{property2:value2}',
              '#weight' => 10,
            ],
            'modifications_css_test',
          ],
        ],
      ],
    ];
    $this->assertEquals($expected_1, $actual_1);
  }

  /**
   * @covers ::renderCss
   */
  public function testRenderCss() {
    $method = new \ReflectionMethod($this->modifiers, 'renderCss');
    $method->setAccessible(TRUE);

    // Empty array needs to output empty string.
    $actual_1 = $method->invoke($this->modifiers, []);
    $expected_1 = '';
    $this->assertEquals($expected_1, $actual_1);

    // Single selector without media query.
    $actual_2 = $method->invoke($this->modifiers, [
      'all' => [
        '.selector' => [
          'property1:value1',
          'property2:value2',
        ],
      ],
    ]);
    $expected_2 = '.selector{property1:value1;property2:value2}';
    $this->assertEquals($expected_2, $actual_2);

    // Multiple selectors with media query.
    $actual_3 = $method->invoke($this->modifiers, [
      '(min-width:768px)' => [
        '.selector1' => [
          'property1:value1',
        ],
        '.selector2' => [
          'property2:value2',
        ],
      ],
    ]);
    $expected_3 = '@media(min-width:768px){.selector1{property1:value1}.selector2{property2:value2}}';
    $this->assertEquals($expected_3, $actual_3);
  }

  /**
   * @covers ::getColorValue
   */
  public function testGetColorValue() {
    $method = new \ReflectionMethod($this->modifiers, 'getColorValue');
    $method->setAccessible(TRUE);

    // Well-formed hexadecimal color.
    $actual_1 = $method->invoke($this->modifiers, 'DB7093', '0.1');
    $expected_1 = 'rgba(219,112,147,0.1)';
    $this->assertEquals($expected_1, $actual_1);

    // Using of hash character prefix.
    $actual_2 = $method->invoke($this->modifiers, '#FF1493', '0.2');
    $expected_2 = 'rgba(255,20,147,0.2)';
    $this->assertEquals($expected_2, $actual_2);

    // Short variant of color string.
    $actual_3 = $method->invoke($this->modifiers, 'F6A', '0.3');
    $expected_3 = 'rgba(255,102,170,0.3)';
    $this->assertEquals($expected_3, $actual_3);

    // Mall-formed color string.
    $actual_4 = $method->invoke($this->modifiers, 'GHI6J1', '0.4');
    $expected_4 = '';
    $this->assertEquals($expected_4, $actual_4);
  }

  /**
   * @covers ::getShortField
   */
  public function testGetShortField() {
    // Modifier field prefix.
    $actual_1 = $this->modifiers->getShortField('field_mod_color');
    $expected_1 = 'color';
    $this->assertEquals($expected_1, $actual_1);

    // Standard field prefix.
    $actual_2 = $this->modifiers->getShortField('field_height');
    $expected_2 = 'height';
    $this->assertEquals($expected_2, $actual_2);

    // Other prefixes.
    $actual_3 = $this->modifiers->getShortField('other_property');
    $expected_3 = 'other_property';
    $this->assertEquals($expected_3, $actual_3);
  }

}
