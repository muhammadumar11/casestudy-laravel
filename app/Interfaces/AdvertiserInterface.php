<?php


namespace App\Interfaces;


interface AdvertiserInterface extends TaxableInterface
{
    public function unqiueCodeOfAdvertiser();

    public function calculateTotalPrice();

    public function mappingFileds();

}
