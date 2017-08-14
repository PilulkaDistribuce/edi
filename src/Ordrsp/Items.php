<?php


namespace Pilulka\Edi\Orders;

class Items
{

    private $packageNumber;
    private $packageReference;
    private $items;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->packageNumber = (int)$xml->package_number;
        $this->packageReference = (string)$xml->package_reference;

        foreach ($xml->articles->article as $article) {
            $this->items[] = new Item($article);
        }
    }

    /**
     * @return int
     */
    public function getPackageNumber()
    {
        return $this->packageNumber;
    }

    /**
     * @return string
     */
    public function getPackageReference()
    {
        return $this->packageReference;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

}
