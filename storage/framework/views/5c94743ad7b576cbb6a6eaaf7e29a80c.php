

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>

<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 13px;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Animated Background */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
        animation: backgroundMove 20s ease-in-out infinite;
    }

    body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        background-position: bottom;
        pointer-events: none;
    }

    @keyframes backgroundMove {
        0%, 100% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(20px, 20px);
        }
    }

    /* Floating Shapes */
    .shape {
        position: absolute;
        opacity: 0.1;
        animation: float 15s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        top: 70%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    .shape-4 {
        width: 70px;
        height: 70px;
        background: white;
        transform: rotate(45deg);
        top: 30%;
        right: 25%;
        animation-delay: 1s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
        }
    }

    .login-container {
        max-width: 380px;
        width: 100%;
        padding: 12px;
        position: relative;
        z-index: 10;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideIn 0.6s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-header {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        padding: 35px 20px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .login-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: headerPulse 8s ease-in-out infinite;
    }

    @keyframes headerPulse {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        50% {
            transform: translate(-10%, -10%) scale(1.1);
        }
    }

    .login-header h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .login-header p {
        margin: 8px 0 0 0;
        font-size: 13px;
        opacity: 0.95;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .login-body {
        padding: 30px 25px;
        background: white;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e7ff;
        border-radius: 10px;
        font-size: 13px;
        transition: all 0.3s ease;
        background-color: #f8f9fb;
        color: #333333;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: #999999;
        font-size: 12px;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin: 16px 0;
        gap: 8px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .form-check-label {
        font-size: 12px;
        color: #555555;
        cursor: pointer;
        margin: 0;
    }

    .error-message {
        font-size: 11px;
        color: #e74c3c;
        margin-top: 5px;
        display: block;
        animation: shake 0.3s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .btn-login {
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.8px;
        cursor: pointer;
        transition: all 0.4s ease;
        margin-top: 10px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-login:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .divider {
        margin: 20px 0;
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
        background: linear-gradient(to right, transparent, #e0e0e0, transparent);
    }

    .divider span {
        background: white;
        padding: 0 12px;
        position: relative;
        font-size: 12px;
        color: #999999;
        font-weight: 600;
    }

    .footer-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
        line-height: 1.6;
    }

    .footer-links a {
        font-size: 12px;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .footer-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }

    .footer-links a:hover::after {
        width: 100%;
    }

    .footer-links a:hover {
        color: #764ba2;
    }

    .signup-text {
        font-size: 12px;
        color: #666666;
    }

    .signup-text a {
        color: #667eea;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .signup-text a:hover {
        color: #764ba2;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Particle Effects */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: white;
        border-radius: 50%;
        opacity: 0.6;
        animation: particleFloat 10s linear infinite;
    }

    @keyframes particleFloat {
        0% {
            transform: translateY(100vh) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.6;
        }
        90% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-100px) translateX(100px);
            opacity: 0;
        }
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 8px;
        }

        .login-header {
            padding: 25px 16px;
        }

        .login-header h2 {
            font-size: 22px;
        }

        .login-body {
            padding: 24px 18px;
        }
    }
</style>

<!-- Floating Shapes -->
<div class="shape shape-1"></div>
<div class="shape shape-2"></div>
<div class="shape shape-3"></div>
<div class="shape shape-4"></div>

<!-- Particles -->
<div class="particle" style="left: 10%; animation-delay: 0s;"></div>
<div class="particle" style="left: 20%; animation-delay: 2s;"></div>
<div class="particle" style="left: 30%; animation-delay: 4s;"></div>
<div class="particle" style="left: 40%; animation-delay: 1s;"></div>
<div class="particle" style="left: 50%; animation-delay: 3s;"></div>
<div class="particle" style="left: 60%; animation-delay: 5s;"></div>
<div class="particle" style="left: 70%; animation-delay: 2.5s;"></div>
<div class="particle" style="left: 80%; animation-delay: 4.5s;"></div>
<div class="particle" style="left: 90%; animation-delay: 1.5s;"></div>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>🔐 Welcome Back</h2>
            <p>Sign in to your account</p>
        </div>
        <div class="login-body">
            <form action="<?php echo e(route('auth.login.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email" class="form-label">📧 Email Address</label>
                    <input type="email"
                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           id="email"
                           name="email"
                           value="<?php echo e(old('email')); ?>"
                           placeholder="your.email@example.com"
                           required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">🔑 Password</label>
                    <input type="password"
                           class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           id="password"
                           name="password"
                           placeholder="Enter your password"
                           required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <div class="footer-links">
                <div class="signup-text">
                    Don't have account? <a href="<?php echo e(route('auth.register')); ?>">Sign up</a>
                </div>
                <a href="<?php echo e(route('auth.forgot-password')); ?>">Forgot password?</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>