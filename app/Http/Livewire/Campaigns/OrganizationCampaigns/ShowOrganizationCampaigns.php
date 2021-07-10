<?php

namespace App\Http\Livewire\Campaigns\OrganizationCampaigns;

use Livewire\Component;
use App\Models\Campaign;
use App\Http\Traits\InteractsWithBanner;

class ShowOrganizationCampaigns extends Component
{
    use InteractsWithBanner;
    public $host;

    public function mount() {

        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-adm.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://admin.yosolidario.com';
        }
    }

    public function render()
    {
        $collection = Campaign::
                            select('campaigns.*')
                            ->where(function ($query) {
                                $query
                                    ->where('organization_id', auth()->user()->organizationSession->organization->id);
                                    //->where('campaigns.type_campaign', 'ORGANIZATION');
                            })
                            ->where(function ($query) {
                                $query->where('campaigns.type', '<>' , 'SHARING');
                            })
                            ->latest('id')
                            ->paginate(8);

                    return view('livewire.campaigns.organization-campaigns.show-organization-campaigns',[
                    'collection' => $collection
                    ]);
    }

    public function editCampaign($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/update', ['campaign' => $record]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        if($record->status == 'DRAFT') {
            return redirect()->route('campaign/preview', ['slug' => $record->slug]);
        } elseif($record->status == 'IN_REVIEW') {
            return redirect()->route('campaign/published', ['slug' => $record->slug]);
        } else if($record->status == 'PUBLISHED') {
            return redirect()->route('campaign/published', ['slug' => $record->slug]);
        }
    }

    public function createCampaign() {
       return redirect()->route('campaign/create');
    }
    
    public function manage($id) {
        $record = Campaign::find($id);
        return redirect()->route('campaign/manage', ['campaign' => $record]);
    }

    public function viewOrganization($id)
    {
        
    }
}
