<?php


namespace App\Interfaces;


interface TaxableInterface
{
    public function filedTax();

    public function fieldTaxType();

    public function fieldTaxCurrency();

    public function fieldTaxAmount();
}
