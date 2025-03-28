<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'nama'  => ['required', 'string', 'max:255'],
            'nip' =>  ['required', 'string', 'max:255',  Rule::unique('users')->ignore($user->id)],
            'jabatan' =>  ['required', 'string', 'max:255'],
            'unit_organisasi' =>  ['required', 'string', 'max:255'],
            'no_hp' =>  ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            if(Auth::user()->status_sinkronisasi == 'N') {
                $user->forceFill([
                    'nama' => $input['nama'],
                    'nip' => $input['nip'],
                    'jabatan' => $input['jabatan'],
                    'no_hp' => $input['no_hp'],
                    'email' => $input['email'],
                ])->save();
            }else {
                $user->forceFill([
                    'no_hp' => $input['no_hp'],
                    'email' => $input['email'],
                    'unit_organisasi' => $input['opd_organisasi'],
                ])->save();
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
