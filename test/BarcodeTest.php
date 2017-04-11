<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
namespace ZendTest\Validator;

use Zend\Validator\Barcode;
use Zend\Validator\Barcode\AbstractAdapter;

class BarcodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|AbstractAdapter
     */
    private $abstractAdapterMock;

    public function setUp()
    {
        $this->abstractAdapterMock = $this->getMockBuilder(AbstractAdapter::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getLength', 'hasValidLength'))
            ->getMock();
    }

    public function testIncorrectBarcode()
    {
        $this->abstractAdapterMock->expects($this->atLeastOnce())
            ->method('getLength')
            ->willReturn(14);

        $barcodeValidator = new Barcode([
            'adapter' => $this->abstractAdapterMock
        ]);
        $this->assertFalse($barcodeValidator->isValid('this is not a barcode'));
    }

    public function testIncorrectLength()
    {
        $this->abstractAdapterMock->expects($this->once())
            ->method('hasValidLength')
            ->with($this->equalTo('this is not a barcode'))
            ->willReturn(false);

        $barcodeValidator = new Barcode([
            'adapter' => $this->abstractAdapterMock
        ]);
        $this->assertFalse($barcodeValidator->isValid('this is not a barcode'));
    }
}
