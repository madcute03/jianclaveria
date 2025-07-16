<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #1f2937, #111827);
            color: #e5e7eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            max-width: 400px;
            margin: 3rem auto;
        }

        .glow-label {
            font-weight: 600;
            color: #38bdf8;
            text-shadow: 0 0 5px rgba(56, 189, 248, 0.8);
        }

        input[type="email"] {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #38bdf8;
            border-radius: 0.5rem;
            padding: 0.75rem;
            width: 100%;
            color: #fff;
            outline: none;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.3);
        }

        input[type="email"]:focus {
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.6);
            border-color: #7dd3fc;
        }

        .btn-glow {
            background: #38bdf8;
            color: #0f172a;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.6);
            transition: all 0.3s ease-in-out;
        }

        .btn-glow:hover {
            background: #0ea5e9;
            box-shadow: 0 0 30px rgba(14, 165, 233, 0.8);
        }

        .description {
            margin-bottom: 1rem;
            color: #d1d5db;
            text-align: center;
        }
    </style>

    <div class="form-container">
        <div class="description text-sm">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="glow-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn-glow">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
