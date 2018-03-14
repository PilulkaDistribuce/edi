<?php


namespace Pilulka\Edi\DesAdv;

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

    /**
     * @param int $item_number
     * @return Item
     */
    public function setItemNumber($item_number)
    {
        $this->item_number = $item_number;
        return $this;
    }

    /**
     * @param int $article_gtin
     * @return Item
     */
    public function setArticleGtin($article_gtin)
    {
        $this->article_gtin = $article_gtin;
        return $this;
    }

    /**
     * @param string $article_id_supplier
     * @return Item
     */
    public function setArticleIdSupplier($article_id_supplier)
    {
        $this->article_id_supplier = $article_id_supplier;
        return $this;
    }

    /**
     * @param string $article_name
     * @return Item
     */
    public function setArticleName($article_name)
    {
        $this->article_name = $article_name;
        return $this;
    }

    /**
     * @param float $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param string $unit
     * @return Item
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @param float $vat_rate
     * @return Item
     */
    public function setVatRate($vat_rate)
    {
        $this->vat_rate = $vat_rate;
        return $this;
    }

    /**
     * @param float $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
}
