<?php


namespace Pilulka\Edi\Notification;


class Delivery
{
    private $toReferenceID;
    private $toEdiid;
    private $fromReferenceID;
    private $fromEdiid;

    /**
     * Delivery constructor.
     * @param $toReferenceID
     * @param $toEdiid
     * @param $fromReferenceID
     * @param $fromEdiid
     */
    public function __construct($toReferenceID, $toEdiid, $fromReferenceID, $fromEdiid)
    {
        $this->toReferenceID = $toReferenceID;
        $this->toEdiid = $toEdiid;
        $this->fromReferenceID = $fromReferenceID;
        $this->fromEdiid = $fromEdiid;
    }

    /**
     * @return mixed
     */
    public function getToReferenceID()
    {
        return $this->toReferenceID;
    }

    /**
     * @return mixed
     */
    public function getToEdiid()
    {
        return $this->toEdiid;
    }

    /**
     * @return mixed
     */
    public function getFromReferenceID()
    {
        return $this->fromReferenceID;
    }

    /**
     * @return mixed
     */
    public function getFromEdiid()
    {
        return $this->fromEdiid;
    }


}