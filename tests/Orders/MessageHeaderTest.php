<?php
namespace Pilulka\Edi\Orders;

class MessageHeaderTest extends \PHPUnit_Framework_TestCase
{
    public function testXmlOutput()
    {
        $messageHeader = new MessageHeader();
        $messageHeader->setCreationDate(new \DateTime("02-10-2010 12:20:22"));
        $messageHeader->setReceiverGLN("1234");
        $messageHeader->setSenderGLN("5678");
        $messageHeader->getXml();
        $this->assertTrue(true);
        // todo use assertXmlStringEqualsXmlString()
    }
}
