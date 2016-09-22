<?php
namespace Pilulka\Edi\DesAdv;

class HeaderTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectHeader()
    {

        $header = new Header(new \SimpleXMLElement(<<<XML
<header>
    <message_type>DESADV</message_type>
    <message_id>51422678</message_id>
    <version>1.0.0</version>
    <creation_date>2013-11-04</creation_date>
    <creation_time>12:43</creation_time>
    <receiver>1234</receiver>
    <sender>5678</sender>
</header>
XML
        ));

        $this->assertSame("51422678", $header->getMessageId());
        $this->assertEquals(new \DateTime("2013-11-04 12:43"), $header->getCreationDate());
        $this->assertSame("1234", $header->getReceiver());
        $this->assertSame("5678", $header->getSender());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUnknownType()
    {
        new Header(new \SimpleXMLElement(<<<XML
<header>
    <message_type>ORDERS</message_type>
</header>
XML
        ));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMissingCreationDate()
    {
        new Header(new \SimpleXMLElement(<<<XML
<header>
    <message_type>DESADV</message_type>
    <version>1.0.0</version>
    <receiver>1234</receiver>
    <sender>5678</sender>
</header>
XML
        ));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMissingSender()
    {

        new Header(new \SimpleXMLElement(<<<XML
<header>
    <message_type>DESADV</message_type>
    <message_id>51422678</message_id>
    <version>1.0.0</version>
    <creation_date>2013-11-04</creation_date>
    <creation_time>12:43</creation_time>
    <receiver>1234</receiver>
</header>
XML
        ));
    }

    public function testIsTestingMessage()
    {

        $header = new Header(new \SimpleXMLElement(<<<XML
<header>
    <message_type>DESADV</message_type>
    <message_id>51422678</message_id>
    <version>1.0.0</version>
    <creation_date>2013-11-04</creation_date>
    <creation_time>12:43</creation_time>
    <receiver>1234</receiver>
    <sender>5678</sender>
    <test_flag>1</test_flag>
</header>
XML
        ));

        $this->assertSame(true, $header->isTesting());
    }
}
