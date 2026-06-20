<?php
namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class Login extends Component
{
    public $login_id; // Bisa berupa email atau username
    public $password;
    public $remember = false;

    public function authenticate()
    {
        $this->validate([
            'login_id' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input berupa email atau username
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $this->login_id, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin_kampus') {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            return redirect()->intended(route('ormawa.dashboard'));
        }

        $this->addError('login_id', 'Kredensial tidak valid.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
