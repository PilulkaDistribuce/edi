<?php

namespace Pilulka\Edi\Ordrsp;

class Items
{

    private $items;

    public function __construct(\SimpleXMLElement $xml)
    {

        foreach ($xml as $article) {
            $this->items[] = new Item($article);
        }
    }


    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

}
