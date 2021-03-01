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

    public $user_id, $name, $slug, $profile_photo_path,  $email, $country_id, $telephone;
    public $facebook, $twitter, $instagram, $biography, $status_profile;
    public $whatsapp, $telegram, $website;
    public $countries_collection;
    public $user;
    public $message;
    public $photoOne;
    
    protected $rules = [
        //'photo' => 'image|max:1024', // 1MB Max
        'name' => 'required',
        // 'slug' => ['required', 'unique:users','alpha_dash', 'slug', '$this->user_id'],
        'email'=> 'required',
        'country_id' => 'required',
        'telephone' => 'required',
        'status_profile' => 'required'
    ];

    public function mount()
    {
        $this->photoOne = "";
    }
    public function render()
    {
        $this->StoreOrUpdatePhoto();
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
        $this->country_id = $record->country_id;

        if($record->profile) {
            $data = $record->profile;
            $this->telephone = $data->telephone;

            $this->facebook = $data->facebook;
            $this->twitter = $data->twitter;
            $this->instagram = $data->instagram;
            $this->whatsapp = $data->whatsapp;
            $this->telegram = $data->telegram;
            $this->website = $data->website;

            $this->biography = $data->biography;
            $this->status_profile = $data->status;
        } else {
            // $this->slug = Str::slug($this->name);
        } 
    }

    public function StoreOrUpdate() {
        
        //$this->validate();
        $this->validate([
            'name' => 'required|min:3|max:55',
            'slug' => "required|alpha_dash|unique:users,slug,$this->user_id",//['required', 'unique:users','alpha_dash', 'slug', $this->user_id],
            'email'=> "required|email|unique:users,email,$this->user_id",
            //'telephone' => 'required|digits_between:7,15',
            'status_profile' => 'required'
        ]);
        
        if($this->country_id or $this->whatsapp) {
            $this->validate([
                'country_id' => 'required',
                //'telephone' => 'required|digits_between:7,15',
                'whatsapp' => 'required|digits_between:7,15',
            ]);
        } else {
            $this->country_id = null;
            $this->telephone = null;
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

        if($record->profile) {

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
            $data = $record->profile;
            $record = Profile::find($data->id);
            $record->update([
                'telephone' =>  addslashes($this->telephone),
                'facebook' =>  addslashes($this->facebook),
                'twitter'=>  addslashes($this->twitter),
                'instagram' =>  addslashes($this->instagram),
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
                'telephone' =>  addslashes($this->telephone),
                'facebook' =>  addslashes($this->facebook),
                'twitter'=>  addslashes($this->twitter),
                'instagram' =>  addslashes($this->instagram),
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

    public function StoreOrUpdatePhoto() {

        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048', // 2MB Max
            ]);

            $record = User::findOrFail($this->user_id);
            $photo = str_replace('storage', 'public', $record->profile_photo_path);
            Storage::delete($photo);
            
            $photo = $this->photoOne->store('public/profile-photos');
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
        $photo = str_replace('storage', 'public', $record->profile_photo_path);
        Storage::delete($photo);
        $record->update([
            'profile_photo_path' => null
        ]);
        $this->profile_photo_path = null;
        $this->photoOne = null;
        $this->emit('messagePhoto');
        $this->message = "Was removed successfully";
        $this->user = User::findOrFail($this->user_id);
        //return redirect()->route('setting/profile');
    }

    public function slug() {
        $this->slug = Str::slug($this->name);
    }

 }
