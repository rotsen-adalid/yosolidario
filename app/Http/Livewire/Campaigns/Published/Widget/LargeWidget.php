<?php

namespace App\Http\Livewire\Campaigns\Published\Widget;
use Livewire\Component;
use App\Models\Campaign;
use App\Http\Traits\Utilities;
use App\Models\Money;

class LargeWidget extends Component
{
    use Utilities;

    public $campaign;
    public $country_code, $currency;

    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign = Campaign::find($campaign[0]->id);
            } else {
                return redirect()->route('home');
            }
        }

        $currency = Money::find(2);
        $this->currency = $currency->currency_symbol;
        //
        $ipapi = $this->ipapiData();

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        //$this->country_code = 'US';
    } 

    public function render()
    {
        return view('livewire.campaigns.published.widget.large-widget');
    }
}
