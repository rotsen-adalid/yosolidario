<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\CampaignRecognition;

class Recognitions extends Component
{
    public $status_register;
    public $slug_next;
    // public $collection;
    public  $campaign_reward_id, $reward_id, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $recognition_currency_symbol;

    public $confirmingDeletion = false;
    public $addOrUpdateDialog = false;

    public $confirmingSendReview = false;

    public function mount($slug)
    {
        $this->slug_next = $slug;
        $campaigns = DB::table('campaigns')
        ->where('slug', $this->slug_next)
        ->where('status', 'DRAFT')
        ->get();

        if($campaigns->count() == 1) {
            $record = Campaign::find($campaigns[0]->id);
            $this->status_register = $record->status_register;
            $this->campaign_id = $campaigns[0]->id;
            // $this->collection = $record->campaignRewards;
            //$this->edit($record->campaignQuestion[0]->id);
        } else {
            return redirect()->route('campaign/create');
        }
    }
    
    public function render()
    {
        $collection = CampaignRecognition::
                    where('campaign_id', $this->campaign_id)
                    ->orderBy('amount', 'asc')->get();
            return view('livewire.campaigns.create.recognitions', ['collection' => $collection]);
    }

    public function addDialog() {
        $record = Campaign::find($this->campaign_id);
        $this->recognition_currency_symbol = $record->country->currency_symbol;
        $this->addOrUpdateDialog = true;
    }
    
    public function StoreOrUpdate() {

        if ($this->limiter == 'YES') {
            $this->validate([
                'amount' => 'required|numeric',
                'description' => 'required|min:30|max:400',
                'limiter' => 'required',
                'quantity' => 'required|numeric',
            ]);
        } else {    
            $this->validate([
                'amount' => 'required|numeric',
                'description' => 'required|min:30|max:400',
                'limiter' => 'required',
            ]);
            $this->quantity = 0;
        }

        if($this->campaign_reward_id <= 0) {
            // create
            $record = CampaignRecognition::create([
                'amount' => addslashes($this->amount),
                'description' => addslashes($this->description),
                'delivery_date' =>  $this->delivery_date,
                'limiter' => $this->limiter,
                'quantity' => $this->quantity,
                'campaign_id' => $this->campaign_id
            ]);
        } else {
            // we look for the record
            $record = CampaignRecognition::find($this->campaign_reward_id);
            // we update the info
            $record->update([
                'amount' => addslashes($this->amount),
                'description' => addslashes($this->description),
                'delivery_date' =>  $this->delivery_date,
                'limiter' => $this->limiter,
                'quantity' => $this->quantity,
            ]);
        }
        $this->resetInput();
        $this->addOrUpdateDialog = false;
    }

    public function resetInput() {
        $this->campaign_reward_id = "";
        $this->amount = "";
        $this->description = "";
        $this->limiter = "";
        $this->quantity = "";
    }

    public function editDialog($id) {
        $record = CampaignRecognition::find($id);
        $this->campaign_reward_id = $record->id;
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->country->currency_symbol;
        $this->delivery_date = $record->delivery_date;
        $this->limiter = $record->limiter;
        $this->quantity = $record->quantity;
        $this->addOrUpdateDialog = true;
    }

    public function update() {

    }

    public function deleteDialog($id) {
        $this->reward_id = $id;
        $record = CampaignRecognition::find($id);
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->country->currency_symbol;
        $this->confirmingDeletion = true;
    }

    public function delete($id) {
        if($id) {
            $record = CampaignRecognition::find($id);
            $record->delete();
        }
        $this->resetInput();
        $this->confirmingDeletion = false;
    }

    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

    public function sendReview() {
        $record = Campaign::find($this->campaign_id);
        // we update the info
        $record->update([
            'status' => 'IN_REVIEW'
        ]);
        $this->confirmingSendReview = false;
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('preview', ['slug' => $record->slug]);
    }
}
