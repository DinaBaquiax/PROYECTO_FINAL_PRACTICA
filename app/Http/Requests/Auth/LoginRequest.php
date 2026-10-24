<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Mensajes cuando los campos están vacíos.
     */
    public function messages(): array
    {
        return [
            'nombre_usuario.required' => 'Ingresa tu nombre de usuario.',
            'password.required' => 'Ingresa tu contraseña.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 1. Buscar al usuario por su nombre de usuario
        $usuario = User::where('nombre_usuario', $this->input('nombre_usuario'))->first();

        // 2. Si no existe o la contraseña no coincide, credenciales incorrectas
        if ($usuario === null || ! Hash::check($this->input('password'), $usuario->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nombre_usuario' => 'Usuario o contraseña incorrectos.',
            ]);
        }

        // 3. Si el usuario está inactivo, no puede entrar
        if ($usuario->estado !== 'Activo') {
            throw ValidationException::withMessages([
                'nombre_usuario' => 'Este usuario está inactivo. Contacta al encargado.',
            ]);
        }

        // 4. Todo correcto: iniciar sesión
        Auth::login($usuario, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'nombre_usuario' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('nombre_usuario')).'|'.$this->ip());
    }
}