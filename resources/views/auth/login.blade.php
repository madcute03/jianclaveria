<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #000;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .login-container {
      background: rgba(0, 0, 0, 0.7);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      border-radius: 20px;
      border: 2px solid transparent;
      background-clip: padding-box;
      position: relative;
      z-index: 1;
    }

    .login-container::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      z-index: -1;
      background: linear-gradient(135deg, red, orange, yellow, green, cyan, blue, violet, red);
      background-size: 400% 400%;
      border-radius: 22px;
      animation: rainbow 8s linear infinite;
      filter: blur(5px);
    }

    @keyframes rainbow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 12px;
    }

    p.description {
      text-align: center;
      font-size: 14px;
      color: #ccc;
      margin-bottom: 24px;
    }

    label {
      font-size: 14px;
      display: block;
      margin-bottom: 6px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border-radius: 12px;
      background-color: #111;
      border: 2px solid #333;
      color: #fff;
      margin-bottom: 16px;
      transition: 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-image: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet) 1;
      outline: none;
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }

    .checkbox-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-bottom: 20px;
    }

    .checkbox-container input[type="checkbox"] {
      margin-right: 6px;
    }

    .checkbox-container a {
      color: #88aaff;
      text-decoration: none;
    }

    .checkbox-container a:hover {
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      font-size: 15px;
      font-weight: bold;
      background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet);
      background-size: 300% 300%;
      color: #fff;
      cursor: pointer;
      transition: background 0.4s ease;
      animation: rainbow 8s linear infinite;
    }

    .submit-btn:hover {
      filter: brightness(1.2);
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
      color: #aaa;
    }

    .footer-text a {
      color: #7fdfff;
      text-decoration: none;
      font-weight: bold;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }

    .session-status, .error-message {
      font-size: 13px;
      text-align: center;
      margin-bottom: 14px;
    }

    .session-status {
      color: #00ffcc;
    }

    .error-message {
      color: #ff6b6b;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Welcome Back</h2>
    <p class="description">Please enter your credentials to sign in</p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="session-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
      @error('email')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="••••••••">
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <div class="checkbox-container">
        <label><input type="checkbox" name="remember"> Remember me</label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Forgot password?</a>
        @endif
      </div>

      <button type="submit" class="submit-btn">Log In</button>
    </form>

    <p class="footer-text">
      Don’t have an account?
      <a href="{{ route('register') }}">Sign up</a>
    </p>
  </div>

</body>
</html>
