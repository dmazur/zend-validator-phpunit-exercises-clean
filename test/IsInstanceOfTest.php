<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
namespace ZendTest\Validator;

use Zend\Validator\IsInstanceOf;

class IsInstanceOfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|IsInstanceOf
     */
    private $instanceOfMock;

    public function setUp()
    {
        $this->instanceOfMock = $this->getMockBuilder(IsInstanceOf::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testTest()
    {
        $instanceOf = new IsInstanceOf();
        $instanceOf->setClassName('Zend\Validator\IsInstanceOf');
        $this->assertTrue($instanceOf->isValid($instanceOf));
    }

    public function testMockedObjectValidation()
    {
        $instanceOf = new IsInstanceOf();
        $instanceOf->setClassName('Zend\Validator\IsInstanceOf');
        $this->assertTrue(
            $instanceOf->isValid($this->instanceOfMock)
        );

        $instanceOf->setClassName('PHPUnit_Framework_MockObject_MockObject');
        $this->assertTrue(
            $instanceOf->isValid($this->instanceOfMock)
        );
    }
}
