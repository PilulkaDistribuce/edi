<?php
namespace Pilulka\Edi\Orders;

class LineItems
{
    /**
     * @var LineItem[]
     */
    private $items = [];

    public function addItem(LineItem $item)
    {
        $this->items[] = $item;
    }

    public function fillXml(\SimpleXMLElement $collectionElement)
    {
        foreach ($this->items as $index => $item) {
            $item->fillXMl($index + 1, $collectionElement->addChild("item"));
        }
    }

    public function getCount()
    {
        return count($this->items);
    }

    public function getItems()
    {
        return $this->items;
    }
}
