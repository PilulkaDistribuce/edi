<?php
namespace Pilulka\Edi\Orders;

class LineTexts
{
    /**
     * @var LineText[]
     */
    private $texts;

    public function addText(LineText $text)
    {
        $this->texts[] = $text;
    }

    public function getXml(\SimpleXMLElement $collectionElement)
    {
        foreach ($this->texts as $index => $text) {
            $text->getXml($index, $collectionElement->addChild("text"));
        }
        return $collectionElement;
    }
}


