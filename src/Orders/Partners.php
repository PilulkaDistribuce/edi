<?php
namespace Pilulka\Edi\Orders;

class Partners
{
    /**
     * @var Partner[]
     */
    private $partners;

    public function addPartner(Partner $partner)
    {
        $this->partners[] = $partner;
    }

    public function fillXml(\SimpleXMLElement $collectionElement)
    {
        foreach ($this->partners as $partner) {
            $partner->fillXml($collectionElement->addChild("party"));
        }
    }
}
