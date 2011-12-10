<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

namespace ZendTest\Cache\Pattern;

use Zend\Cache;

/**
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cache
 */
class CommonPatternTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Zend\Cache\Pattern\PageCache
     */
    protected $_pattern;

    public function setUp()
    {
        $this->assertInstanceOf(
            'Zend\Cache\Pattern',
            $this->_pattern,
            'Internal pattern instance is needed for tests'
        );
    }

    public function tearDown()
    {
        unset($this->_pattern);
    }

    public function testOptionNamesValid()
    {
        $options = $this->_pattern->getOptions();
        foreach ($options as $name => $value) {
            $this->assertRegExp(
                '/^[a-z]*[a-z0-9_]*[a-z0-9]*$/',
                $name,
                "Invalid option name '{$name}'"
            );
        }
    }

    public function testOptionsGetAndSetDefault()
    {
        $options = $this->_pattern->getOptions();
        $this->_pattern->setOptions($options);
        $this->assertEquals($options, $this->_pattern->getOptions());
    }

    public function testOptionsFluentInterface()
    {
        $options = $this->_pattern->getOptions();
        foreach ($options as $option => $value) {
            $method = ucwords(str_replace('_', ' ', $option));
            $method = 'set' . str_replace(' ', '', $method);
            $this->assertSame(
                $this->_pattern,
                $this->_pattern->{$method}($value),
                "Method '{$method}' doesn't implement the fluent interface"
            );
        }

        $this->assertSame(
            $this->_pattern,
            $this->_pattern->setOptions(array()),
            "Method 'setOptions' doesn't implement the fluent interface"
        );
    }

}