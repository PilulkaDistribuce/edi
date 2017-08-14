<?php

namespace Pilulka\Edi\Ordrsp;

class Summary
{
    /**
     * @var int
     */
    private $numberOfItems;

    /**
     * @param int $count
     */
    public function setNumberOfItems($count)
    {
        $this->numberOfItems = $count;
    }

    /**
     * @return int
     */
    public function getNumberOfItems()
    {
        return $this->numberOfItems;
    }


}

