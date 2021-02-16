<?php

namespace App\Http\Livewire\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str as Str;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user_id, $name, $slug, $profile_photo_path,  $email, $country_id, $telephone_country_id, $telephone;
    public $facebook, $twitter, $instagram, $biography, $status_profile;
    public $whatsapp_country_id, $whatsapp, $telegram, $website;
    public $countries_collection;
    public $user;
    public $message;
    public $photo;
    public $url;

    public $photo_upload = false;
    
    protected $rules = [
        //'photo' => 'image|max:1024', // 1MB Max
        'name' => 'required',
        // 'slug' => ['required', 'unique:users','alpha_dash', 'slug', '$this->user_id'],
        'email'=> 'required',
        'country_id' => 'required',
        'telephone' => 'required',
        'status_profile' => 'required'
    ];

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->edit($this->user_id);
        $this->user = User::findOrFail($this->user_id);
        $this->profile_photo_path = $this->user->profile_photo_path;
        $this->countries_collection = DB::table('countries')->orderBy('name', 'asc')->get();

        return view('livewire.setting.edit-profile');
    }
    // show the info of the record to edit
    public function edit($id) {
        $record = User::findOrFail($id);
        $this->name = $record->name;
        $this->slug = $record->slug;
        $this->email = $record->email;

        if($record->profile->count() > 0) {
            $data = $record->profile[0];
            $this->country_id = $data->country_id;
            $this->telephone_country_id = $data->telephone_country_id;
            $this->telephone = $data->telephone;

            $this->facebook = $data->facebook;
            $this->twitter = $data->twitter;
            $this->instagram = $data->instagram;
            $this->whatsapp_country_id = $data->whatsapp_country_id;
            $this->whatsapp = $data->whatsapp;
            $this->telegram = $data->telegram;
            $this->website = $data->website;

            $this->biography = $data->biography;
            $this->status_profile = $data->status;
        } else {
            $this->slug = Str::slug($this->name);
        } 
    }

    public function StoreOrUpdate() {
        
        //$this->validate();
        $this->validate([
            'name' => 'required|min:3|max:55',
            'slug' => "required|alpha_dash|unique:users,slug,$this->user_id",//['required', 'unique:users','alpha_dash', 'slug', $this->user_id],
            'email'=> "required|email|unique:users,email,$this->user_id",
            'telephone_country_id' => 'required',
            'telephone' => 'required|digits_between:7,15',
            'status_profile' => 'required'
        ]);

        if($this->whatsapp) {
            $this->validate([
                'whatsapp_country_id' => 'required',
                'whatsapp' => 'required|digits_between:7,15',
            ]);
        } else {
            $this->whatsapp_country_id = null;
            $this->whatsapp = null;
        }

        if($this->website) {
            $this->validate([
                'website' => 'required|url',
            ]);
        }

        $search_upper =  strtoupper(
            $this->name.' '.
            Str::slug($this->name). ' '.
            $this->email
            );

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;

        $record = User::findOrFail($this->user_id);

        $this->country_id = $this->telephone_country_id;

        if($record->profile->count() > 0) {

            // user update
            $record = User::findOrFail($this->user_id);;
            $record->update([
                 'name' =>  addslashes($this->name),
                 'slug' =>  addslashes($this->slug),
                 'email' =>  addslashes($this->email),
                 'country_id' => $this->country_id,
                 'search' =>  addslashes($search_all)
            ]);
            // profile update
            $data = $record->profile[0];
            $record = Profile::find($data->id);
            $record->update([
                'country_id' => $this->country_id,
                'telephone_country_id' => $this->telephone_country_id,
                'telephone' =>  addslashes($this->telephone),
                'facebook' =>  addslashes($this->facebook),
                'twitter'=>  addslashes($this->twitter),
                'instagram' =>  addslashes($this->instagram),
                'whatsapp_country_id' => $this->whatsapp_country_id,
                'whatsapp' =>  addslashes($this->whatsapp),
                'telegram' =>  addslashes($this->telegram),
                'website' =>  addslashes($this->website),
                'biography' =>  addslashes($this->biography),
                'status' => $this->status_profile
            ]);   
        } else {
            // user update
            $record = User::findOrFail($this->user_id);
            $record->update([
                'slug' =>  addslashes($this->slug),
                'name' => addslashes($this->name),
                'email' => addslashes($this->email),
                'country_id' => $this->country_id,
                'search' => addslashes($search_all)
            ]);
            // create profile
            $record = Profile::create([
                'user_id' => auth()->user()->id,
                'telephone_country_id' => $this->telephone_country_id,
                'telephone' =>  addslashes($this->telephone),
                'facebook' =>  addslashes($this->facebook),
                'twitter'=>  addslashes($this->twitter),
                'instagram' =>  addslashes($this->instagram),
                'whatsapp_country_id' => $this->whatsapp_country_id,
                'whatsapp' =>  addslashes($this->whatsapp),
                'telegram' =>  addslashes($this->telegram),
                'website' =>  addslashes($this->website),
                'biography' =>  addslashes($this->biography),
                'status' => $this->status_profile
            ]);
        }
        $this->emit('message');
        $this->message = "Saved correctly";
    }

    public function photoClick() {
        $this->photo_upload = true;
    }

    public function StoreOrUpdatePhoto() {

        if($this->photo_upload) {
            $this->validate([
                'photo' => 'image|max:2048', // 2MB Max
            ]);
            $record = User::findOrFail($this->user_id);
            $this->url = str_replace('storage', 'public', $record->profile_photo_path);
            Storage::delete($this->url);
            
            $photo = $this->photo->store('public/profile-photos');
            $profile_photo_path = Storage::url($photo);

            // user update
            $record = User::findOrFail($this->user_id);;
            $record->update([
                'profile_photo_path' => $profile_photo_path
            ]);

            $this->emit('messagePhoto');
            $this->message = "Was saved successfully";
            //return redirect()->route('setting/profile');
        }
    }

    public function deleteProfilePhoto() {
        $record = User::findOrFail($this->user_id);
        $this->url = str_replace('storage', 'public', $record->profile_photo_path);
        Storage::delete($this->url);
        $record->update([
            'profile_photo_path' => null
        ]);
        $this->profile_photo_path = null;
        $this->photo = null;
        $this->photo_upload = false;
        $this->emit('messagePhoto');
        $this->message = "Was removed successfully";
        //return redirect()->route('setting/profile');
    }

    public function slug() {
        $this->slug = Str::slug($this->name);
    }
}
