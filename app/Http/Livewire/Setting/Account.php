<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class Account extends Component
{
    public $name, $slug, $logo, $identification, $identification_image, $type;
    public $country_id, $address, $longitude, $latigude, $locality;
    public $telephone, $telephone_movil, $email, $website, $references_contact;
    public $about, $note;
    public $status_organization;
    public $status_agreement;

    public $countries_collection;
    public $selected_id;
    public $message;

    protected $rules = [
        'name' => 'required',
        'slug' => ['required', 'alpha_dash'],
        //'logo' => 'image|max:1024',
        'identification' => 'required',
        //'identification_image' => 'image|max:1024',
        'type' => 'required',

        'country_id' => 'required',
        'address' => 'required',
        //'longitude' => 'required',
        //'latigude' => 'required',
        'locality' => 'required',

        //'telephone' => 'required',
        //'telephone_movil' => 'required',
        //'email' =>  ['string', 'email', 'max:255', 'unique:users'],
        //'website' => 'required',
        //'references_contact' => 'required',

        //'about' => 'required',
        //'note' => 'required',
        'status_organization' => 'required',
        'status_agreement' => 'required',
    ];
    public function render()
    {
        return view('livewire.setting.account');
    }

}
