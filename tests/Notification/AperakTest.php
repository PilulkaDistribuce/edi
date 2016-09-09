<?php
namespace Pilulka\Edi\Notification;

class AperakTest extends \PHPUnit_Framework_TestCase
{

    public function testAccepted()
    {
        $notification = new Aperak(new \SimpleXMLElement( __DIR__ . "/../fixtures/aperak_accepted.xml",
            0, true));

        $this->assertSame("8594010260001", $notification->getReceiverGTIN());
        $this->assertSame("8594010120008", $notification->getSenderGTIN());
        $this->assertSame("6348504139", $notification->getNotificationNumber());
        $this->assertEquals(new \DateTime("2013-11-07 11:07:00"), $notification->getCreationDateTime());

        $this->assertSame(true, $notification->wasReferenceAccepted());
        $this->assertSame(Aperak::REFERENCE_INVOICE_NUMBER, $notification->getReferenceType());
        $this->assertEquals(201388511, $notification->getReferenceNumber());
        $this->assertEquals(new \DateTime("2013-11-05"), $notification->getReferenceCreationDate());

        $buyer = (object)["gtin" => "8594010120008", "name" => "MIKEL a.s."];
        $this->assertEquals($buyer, $notification->getBuyer());
        $supplier = (object)["gtin" => "8594010260001", "name" => "Koloniál s.r.o."];
        $this->assertEquals($supplier, $notification->getSupplier());

        $this->assertSame(["reference line no: 1\ncode: 1\nDoklad byl přijat do systému"],
            $notification->getMessages());
    }

    public function testRefused()
    {
        $notification = new Aperak(new \SimpleXMLElement( __DIR__ . "/../fixtures/aperak_refused.xml",
            0, true));

        $this->assertSame(false, $notification->wasReferenceAccepted());

        $this->assertSame(["reference line no: 1\ncode: 1144\nChybí IČO dodavatele"],
            $notification->getMessages());
    }
}
