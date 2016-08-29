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
        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0"?>
<header>
    <message_type>ORDERS</message_type>
    <version>3.0.0</version>
    <creation_date>2010-10-02</creation_date>
    <creation_time>12:20:22</creation_time>
    <receiver>1234</receiver>
    <sender>5678</sender>
</header>
XML
            ,
            $messageHeader->getXml()->asXml());
    }

    /**
     * @expectedException \LogicException
     */
    public function testMissingSender()
    {
        $messageHeader = new MessageHeader();
        $messageHeader->setCreationDate(new \DateTime("02-10-2010 12:20:22"));
        $messageHeader->setReceiverGLN("1234");
        $messageHeader->getXml();
    }
}
