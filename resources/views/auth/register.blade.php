@extends('layouts.app')

@section('title', 'Register')

@section('content')

<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 13px;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-container {
        max-width: 420px;
        width: 100%;
        padding: 12px;
    }

    .register-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        animation: slideIn 0.4s ease;
    }

    .register-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        padding: 28px 20px;
        text-align: center;
        color: white;
    }

    .register-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .register-header p {
        margin: 6px 0 0 0;
        font-size: 12px;
        opacity: 0.9;
        font-weight: 400;
    }

    .register-body {
        padding: 22px 20px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #d1dce6;
        border-radius: 6px;
        font-size: 13px;
        transition: all 0.25s ease;
        background-color: #f8f9fb;
        color: #333333;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #f5576c;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
    }

    .form-control::placeholder {
        color: #999999;
        font-size: 12px;
    }

    .error-message {
        font-size: 11px;
        color: #e74c3c;
        margin-top: 4px;
        display: block;
    }

    .help-text {
        font-size: 11px;
        color: #888888;
        margin-top: 3px;
        display: block;
    }

    .btn-register {
        width: 100%;
        padding: 10px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 6px;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(245, 87, 108, 0.3);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .divider {
        margin: 14px 0;
        text-align: center;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e0e0e0;
    }

    .divider span {
        background: white;
        padding: 0 8px;
        position: relative;
        font-size: 12px;
        color: #999999;
        font-weight: 500;
    }

    .login-text {
        font-size: 12px;
        color: #666666;
        text-align: center;
    }

    .login-text a {
        color: #f5576c;
        text-decoration: none;
        font-weight: 600;
    }

    .login-text a:hover {
        text-decoration: underline;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 480px) {
        .register-container {
            padding: 8px;
        }

        .register-header {
            padding: 20px 16px;
        }

        .register-header h2 {
            font-size: 18px;
        }

        .register-body {
            padding: 16px 12px;
        }
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>✨ Create Account</h2>
            <p>Join us today</p>
        </div>
        <div class="register-body">
            <form action="{{ route('auth.register.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">👤 Username</label>
                    <input type="text"
                           class="form-control @error('username') is-invalid @enderror"
                           id="username"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="Choose a username"
                           required>
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="full_name" class="form-label">👨‍💼 Full Name</label>
                    <input type="text"
                           class="form-control @error('full_name') is-invalid @enderror"
                           id="full_name"
                           name="full_name"
                           value="{{ old('full_name') }}"
                           placeholder="Your full name"
                           required>
                    @error('full_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">📧 Email Address</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="your.email@example.com"
                           required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">📱 Phone (Optional)</label>
                    <input type="tel"
                           class="form-control @error('phone') is-invalid @enderror"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="+1 (555) 000-0000">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <span class="help-text">We'll use this to contact you when needed</span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">🔑 Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Create a strong password"
                           required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">🔐 Confirm Password</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Re-enter your password"
                           required>
                </div>

                <button type="submit" class="btn-register">Create Account</button>
            </form>

            <div class="divider">
                <span>ALREADY REGISTERED?</span>
            </div>

            <p class="login-text">
                Have an account? <a href="{{ route('auth.login') }}">Sign in</a>
            </p>
        </div>
    </div>
</div>

@endsection
