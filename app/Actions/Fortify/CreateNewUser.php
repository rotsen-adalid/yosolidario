<?php

namespace App\Actions\Fortify;

use App\Models\Agency;
use App\Models\Notice;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str as Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {

            $search_upper =  strtoupper($input['name'].' '.$input['email']);
            $search_lower = strtolower($search_upper);
            $search_all =  $search_upper.' '.$search_lower;

            $user = tap(User::create([
                'name' => $input['name'],
                'lastname' => $input['lastname'],
                'slug' => Str::slug($input['name']).'-'.time(),
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'search' => $search_all
            ]), function (User $user) {
                $this->createTeam($user);
            });
 
            //$user->assignRole('organizer');
            $user->sites()->attach(Site::where('name', 'yosolidario.com')->first());

            /*$extract = 'New user registration: '.$user->id;
            $user->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $user,
                'action' =>  'CREATE',
                'user_id' => $user->id,
                'site_id' => 1,
                ]);
            */
            $agencyBO = Agency::find(1);
            $notice = new Notice([
                'telegramid' => $agencyBO->telegram->çhat_id,    //Config::get('services.telegram_id')
                'notice' => 'Nuevo usuario registrado',
                'description' => $input['email']."\n".$input['name'].$input['lastname'],
                'action' => 'USER_REGISTER'
              
            ]);
            //$notice->notify(new TelegramNotification);
            return $user;
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
