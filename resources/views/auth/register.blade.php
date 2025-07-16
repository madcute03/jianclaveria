<x-guest-layout>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background-color: #1e1e2f;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.05);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 0;
        }

        form::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(270deg, red, orange, yellow, green, blue, indigo, violet, red);
            background-size: 200% 200%;
            border-radius: inherit;
            z-index: -2;
            animation: glow-border 8s linear infinite;
        }

        form::after {
            content: "";
            position: absolute;
            inset: 0;
            background: #1e1e2f;
            border-radius: inherit;
            z-index: -1;
        }

        @keyframes glow-border {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #eee;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.25rem;
            background-color: #2c2c3a;
            color: #fff;
            border: 1px solid #555;
            border-radius: 0.6rem;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #fff;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
            outline: none;
        }

        .error {
            color: #ff4c4c;
            font-size: 0.85rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .form-footer a {
            font-size: 0.9rem;
            color: #bbb;
            text-decoration: none;
        }

        .form-footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        button {
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            background-size: 400%;
            color: white;
            padding: 0.7rem 1.4rem;
            border: none;
            border-radius: 0.6rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.3);
            animation: rainbowBtn 6s ease infinite;
            transition: transform 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.6);
        }

        @keyframes rainbowBtn {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                <div class="error">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <!-- Footer -->
        <div class="form-footer">
            <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            <button type="submit">{{ __('Register') }}</button>
        </div>
    </form>
</x-guest-layout>
