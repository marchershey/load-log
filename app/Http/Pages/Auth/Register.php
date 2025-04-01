<?php

namespace App\Http\Pages\Auth;

use App\Models\User;
use Flux\Flux;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Creating an account')]
class Register extends Component
{
    #[Validate([
        'username' => 'required|string|min:4|unique:users,username',
    ], message: [
        'required' => 'Your :attribute is required',
        'string' => 'That :attribute is invalid',
        'min' => 'That :attribute is too short (min 4 characters)',
        'unique' => 'That :attribute is taken',
    ])]
    public string $username;

    #[Validate([
        'password' => 'required|string|min:6',
    ], message: [
        'required' => 'A :attribute is required',
        'string' => 'That :attribute is invalid',
        'min' => 'That :attribute is too short (min 6 characters)',
    ])]
    public string $password;

    #[Validate([
        'password_confirmation' => 'required|string|min:6|same:password',
    ], message: [
        'required' => 'A :attribute is required',
        'string' => 'That :attribute is invalid',
        'min' => 'That :attribute is too short (min 6 characters)',
        'same' => 'This :attribute does not match the other :attribute',
    ], attribute: [
        'password_confirmation' => 'password',
    ])]
    public string $password_confirmation;


    public function render()
    {
        return view('pages.auth.register');
    }

    public function updated($field, $value): void
    {
        if ($value) {
            $this->validateOnly($field);
        } else {
            $this->resetValidation();
        }
    }

    public function authenticate(): void
    {
        $this->validate();

        $user = User::create([
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user, true);

        Flux::toast('Account created successfully!', variant: 'success');

        $this->redirect(route('dashboard.index'), navigate: true);
    }
}
