<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmarexController extends Controller
{
    public function Create_shipment($commande){
        //formatage des donner pour l'envoie a l'api de amarex
        $data = [
            'reference1' => "",
            'reference2' => "",
            'AccountNumber' => "", //shipper account number
            'PartyAddress' => [
                'Line1' => "",
                'Line2' => "",
                'Line3' =>"",
                'City' => "",
                'PostCode' => "",
                'CountryCode' => "",
                'StateOrProvinceCode' => "",
            ],
            'contact' => [
                'Department' => "",
                'PersonName' => "",
                'Title' => "",
                'CompanyName' => "",
                'PhoneNumber1' => "",
                'PhoneNumber1Ext' => "",
                'PhoneNumber2' => "",
                'PhoneNumber2Ext' => "",
                'FaxNumber' => "",
                'CellPhone' => "",
                'EmailAdresse' => "michael@aramex.com",
                'tYpe' => ""
            ],
        ];
    }
}
