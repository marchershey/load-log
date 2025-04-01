<?php

namespace App\Http\Pages\Auth;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Sign in')]
class Login extends Component
{
    #[Validate([
        'username' => 'required|string',
    ], message: [
        'required' => 'Your :attribute is required',
        'string' => 'That :attribute is invalid',
    ])]
    public string $username;
    #[Validate([
        'password' => 'required|string',
    ], message: [
        'required' => 'Your :attribute is required',
        'string' => 'That :attribute is invalid',
    ])]
    public string $password;


    public function render()
    {
        return view('pages.auth.login');
    }

    public function authenticate(): void
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], true)) {
            session()->regenerate();
            Flux::toast('Welcome back, ' . $this->username . '!', variant: 'success');
            $this->redirectIntended(route('dashboard.index'), navigate: true);
            return;
        }

        Flux::toast('Invalid credentials', variant: 'danger');
        return;
    }
}
