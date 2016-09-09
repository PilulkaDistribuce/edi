<?php
namespace Pilulka\Edi\Notification;

class Aperak
{
    const REFERENCE_ORDER_NUMBER = "ON";
    const REFERENCE_INVOICE_NUMBER = "IV";
    const REFERENCE_DELIVERY_LETTER = "AAK";

    /**
     * @var \SimpleXMLElement
     */
    private $xmlMessage;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xmlMessage = $xml;
    }

    /**
     * @return string
     */
    public function getReceiverGTIN()
    {
        return (string)$this->xmlMessage->header->delivery->to->state->ediid;
    }

    public function getSenderGTIN()
    {
        return (string)$this->xmlMessage->header->delivery->from->state->ediid;
    }

    public function getNotificationNumber()
    {
        return (string)$this->xmlMessage->header->manifest->document->userdocid;
    }

    public function wasReferenceAccepted()
    {
        $code = (string)$this->xmlMessage->body->xml_document->form_header->kod_potvrz;

        switch ($code) {
            case "6": return true;
                break;
            case "27": return false;
                break;
            default:
                break;
        }
        throw new \UnexpectedValueException("undefined return code in xml '$code'");
    }

    /**
     * @return \DateTime
     */
    public function getCreationDateTime()
    {
        $header = $this->xmlMessage->body->xml_document->form_header;
        $date = (string)$header->dat_vyst_zpr;
        $time = (string)$header->cas_vyst_zpr;
        return new \DateTime($date . " " . $time);
    }

    public function getReferenceType()
    {
        $type = (string)$this->xmlMessage->body->xml_document->form_header->druh_dok;
        if (!$type) return;

        switch ($type) {
            case self::REFERENCE_ORDER_NUMBER:
                return self::REFERENCE_ORDER_NUMBER;
            case self::REFERENCE_DELIVERY_LETTER:
                return self::REFERENCE_DELIVERY_LETTER;
            case self::REFERENCE_INVOICE_NUMBER:
                return self::REFERENCE_INVOICE_NUMBER;
        }
        throw new \UnexpectedValueException("unknown reference type '$type'");
    }

    public function getReferenceNumber()
    {
        return (string)$this->xmlMessage->body->xml_document->form_header
            ->ref_cis_dok;
    }

    public function getReferenceCreationDate()
    {
        return new \DateTime((string)$this->xmlMessage->body->xml_document
            ->form_header->dat_ref_cis_dok);
    }

    /**
     * @return \stdClass
     *  'gtin': string: buyer GTIN - mandatory
     *  'name': string: buyer name - optional
     */
    public function getBuyer()
    {
        $buyer = new \stdClass();
        $buyer->gtin = (string)$this->xmlMessage->body->xml_document->form_header
            ->ean_kup;
        $buyer->name = (string)$this->xmlMessage->body->xml_document->form_header
            ->jmeno_kup;
        return $buyer;
    }

    /**
     * @return \stdClass
     *  'gtin': string: supplier GTIN - mandatory
     *  'name': string: supplier name - optional
     */
    public function getSupplier()
    {
        $supplier = new \stdClass();
        $supplier->gtin = (string)$this->xmlMessage->body->xml_document->form_header
            ->ean_dod;
        $supplier->name = (string)$this->xmlMessage->body->xml_document->form_header
            ->jmeno_dod;
        return $supplier;
    }

    /**
     * @return string[]
     */
    public function getMessages()
    {
        $messages = [];
        foreach ($this->xmlMessage->body->xml_document->line_items->item as $xmlMessage) {
            $textMessage = "reference line no: " . $xmlMessage->cis_r . "\n"
                . "code: " . $xmlMessage->kod_chyby . "\n";
            foreach (range(1,5) as $textNumber) {
                if (($text = $xmlMessage->{"txt_chyby_$textNumber"})) {
                    $textMessage .= $text;
                };
            }
            $messages[] = rtrim($textMessage);
        }

        return $messages;
    }
}
