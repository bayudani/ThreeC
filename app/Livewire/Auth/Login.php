<?php
namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class Login extends Component
{
    public $login_id; // Bisa berupa email atau username
    public $password;
    public $remember = false;

    /**
     * Kunci rate limiter berbasis identifier + IP.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower((string) $this->login_id) . '|' . request()->ip());
    }

    /**
     * Cegah percobaan login berulang (brute-force).
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login_id' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.',
        ]);
    }

    public function authenticate()
    {
        $this->validate([
            'login_id' => 'required',
            'password' => 'required',
        ]);

        $this->ensureIsNotRateLimited();

        // Cek apakah input berupa email atau username
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $this->login_id, 'password' => $this->password], $this->remember)) {
            RateLimiter::clear($this->throttleKey());
            session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin_kampus') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('ormawa.dashboard'));
        }

        RateLimiter::hit($this->throttleKey(), 300);
        $this->addError('login_id', 'Kredensial tidak valid.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
