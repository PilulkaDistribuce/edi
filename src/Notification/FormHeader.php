<?php


namespace Pilulka\Edi\Notification;


class FormHeader
{
    private $cis_zpr_aper;
    private $kod_potvrz;
    private $dat_vyst_zpr;
    private $cas_vyst_zpr;
    private $druh_dok;
    private $cis_dkl_edi;
    private $ref_cis_dok;
    private $dat_ref_cis_dok;
    private $ean_kup;
    private $jmeno_kup;
    private $ean_dod;
    private $jmeno_dod;

    /**
     * FormHeader constructor.
     * @param $cis_zpr_aper
     * @param $kod_potvrz
     * @param $dat_vyst_zpr
     * @param $cas_vyst_zpr
     * @param $druh_dok
     * @param $cis_dkl_edi
     * @param $ref_cis_dok
     * @param $dat_ref_cis_dok
     * @param $ean_kup
     * @param $jmeno_kup
     * @param $ean_dod
     * @param $jmeno_dod
     */
    public function __construct($cis_zpr_aper, $kod_potvrz, $dat_vyst_zpr, $cas_vyst_zpr, $druh_dok, $cis_dkl_edi, $ref_cis_dok, $dat_ref_cis_dok, $ean_kup, $jmeno_kup, $ean_dod, $jmeno_dod)
    {
        $this->cis_zpr_aper = $cis_zpr_aper;
        $this->kod_potvrz = $kod_potvrz;
        $this->dat_vyst_zpr = $dat_vyst_zpr;
        $this->cas_vyst_zpr = $cas_vyst_zpr;
        $this->druh_dok = $druh_dok;
        $this->cis_dkl_edi = $cis_dkl_edi;
        $this->ref_cis_dok = $ref_cis_dok;
        $this->dat_ref_cis_dok = $dat_ref_cis_dok;
        $this->ean_kup = $ean_kup;
        $this->jmeno_kup = $jmeno_kup;
        $this->ean_dod = $ean_dod;
        $this->jmeno_dod = $jmeno_dod;
    }

    /**
     * @return mixed
     */
    public function getCisZprAper()
    {
        return $this->cis_zpr_aper;
    }

    /**
     * @return mixed
     */
    public function getKodPotvrz()
    {
        return $this->kod_potvrz;
    }

    /**
     * @return mixed
     */
    public function getDatVystZpr()
    {
        return $this->dat_vyst_zpr;
    }

    /**
     * @return mixed
     */
    public function getCasVystZpr()
    {
        return $this->cas_vyst_zpr;
    }

    /**
     * @return mixed
     */
    public function getDruhDok()
    {
        return $this->druh_dok;
    }

    /**
     * @return mixed
     */
    public function getCisDklEdi()
    {
        return $this->cis_dkl_edi;
    }

    /**
     * @return mixed
     */
    public function getRefCisDok()
    {
        return $this->ref_cis_dok;
    }

    /**
     * @return mixed
     */
    public function getDatRefCisDok()
    {
        return $this->dat_ref_cis_dok;
    }

    /**
     * @return mixed
     */
    public function getEanKup()
    {
        return $this->ean_kup;
    }

    /**
     * @return mixed
     */
    public function getJmenoKup()
    {
        return $this->jmeno_kup;
    }

    /**
     * @return mixed
     */
    public function getEanDod()
    {
        return $this->ean_dod;
    }

    /**
     * @return mixed
     */
    public function getJmenoDod()
    {
        return $this->jmeno_dod;
    }


}