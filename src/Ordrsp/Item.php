<?php


namespace Pilulka\Edi\Orders;

class Item
{
    private $item_number;
    private $article_gtin;
    private $article_id_supplier;
    private $article_name;
    private $quantity;
    private $unit;
    private $vat_rate;
    private $price;

    public function __construct(\SimpleXMLElement $xml)
    {
        if (!isset($xml->article_gtin)) {
            throw new \InvalidArgumentException("article_gtin aren't presented");
        }

        $this->item_number = (int)$xml->item_number;
        $this->article_gtin = (int)$xml->article_gtin;
        $this->article_id_supplier = (string)$xml->article_id_supplier;
        $this->article_name = (string)$xml->article_name;
        $this->quantity = (float)$xml->quantity;
        $this->unit = (string)$xml->unit;
        $this->vat_rate = (float)$xml->vat_rate;
        $this->price = (float)$xml->price;

    }

    /**
     * @return int
     */
    public function getItemNumber()
    {
        return $this->item_number;
    }

    /**
     * @return int
     */
    public function getArticleGtin()
    {
        return $this->article_gtin;
    }

    /**
     * @return string
     */
    public function getArticleIdSupplier()
    {
        return $this->article_id_supplier;
    }

    /**
     * @return string
     */
    public function getArticleName()
    {
        return $this->article_name;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return float
     */
    public function getVatRate()
    {
        return $this->vat_rate;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


}
