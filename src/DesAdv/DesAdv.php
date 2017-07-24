<?php


namespace Pilulka\Edi\DesAdv;


class DesAdv
{
    /** @var  Header */
    private $header;
    /** @var  DeliveryInfo */
    private $deliveryInfo;
    /** @var  Items */
    private $items;

    /**
     * DesAdv constructor.
     * @param Header $header
     * @param DeliveryInfo $deliveryInfo
     * @param Items $items
     */
    public function __construct(Header $header, DeliveryInfo $deliveryInfo, Items $items)
    {
        $this->header = $header;
        $this->deliveryInfo = $deliveryInfo;
        $this->items = $items;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return DeliveryInfo
     */
    public function getDeliveryInfo()
    {
        return $this->deliveryInfo;
    }

    /**
     * @return Items
     */
    public function getItems()
    {
        return $this->items;
    }


}