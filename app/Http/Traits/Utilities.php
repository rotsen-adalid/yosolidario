<?php
namespace App\Http\Traits;

use App\Models\MoneyConvert;
use App\Models\Organization;
use Illuminate\Support\Str as Str;

trait Utilities {
    
    // convert
    public function cutLetter($letter, $number) 
    {

        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }

    public function cutLetterTwo($letterOne, $letterTwo, $number) 
    {

        $letter = $letterOne.', '.$letterTwo;
        
        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }

    public function convertCurrency($amount_collaborator, $agency_id, $agency_money_id) 
    {
        if ($amount_collaborator > 0) {
            $record = MoneyConvert:: 
                    where('money_id_of', '=', 2)
                    ->where('money_id_a', '=', $agency_money_id)
                    ->where('agency_id', '=', $agency_id)
                    ->get();
            $convert = $amount_collaborator / $record[0]->amount_buy;
            return $convert;
        } else {
            return $amount_collaborator;
        }
    }
    
    public function generateSearch($text) 
    {
        $search_upper =  strtoupper($text);

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;
        
        return $search_all;
    }
    
    public function generateSlug($text) 
    {
        $slug = Str::slug($text);
        return $slug;
    }

    public function ipapiData()
    {
        $ipapi = session()->get('ipapi');
        return $ipapi;
    }

    public function organizationData() {
        $organization = Organization::find(session()->get('organization_id'));
        return $organization;
    }
}