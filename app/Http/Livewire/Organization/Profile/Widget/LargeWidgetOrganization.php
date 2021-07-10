<?php

namespace App\Http\Livewire\Organization\Profile\Widget;

use Livewire\Component;
use App\Http\Traits\Utilities;
use App\Models\Organization;

class LargeWidgetOrganization extends Component
{
    use Utilities;

    public $organization;
    public $country_code, $currency;
    public $host;

    public function mount($slug = null)
    {
        if($slug != null) {
            $organization = Organization::
                        where('slug', '=' ,$slug)
                        ->get();
            if($organization->count() == 1) {
                $this->organization = Organization::find($organization[0]->id);
            } else {
                return redirect()->route('home');
            }
        }

        //
        $ipapi = $this->ipapiData();

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        //$this->country_code = 'US';

        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-adm.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://admin.yosolidario.com';
        }
    } 

    public function render()
    {
        return view('livewire.organization.profile.widget.large-widget-organization');
    }
}
