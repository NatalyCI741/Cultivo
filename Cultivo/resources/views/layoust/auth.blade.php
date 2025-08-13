<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Sistema de Cultivos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-container {
            margin-bottom: 1rem;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .auth-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .auth-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .auth-card-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .auth-card-header h3 {
            color: #495057;
            font-weight: 600;
        }

        .auth-card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
            display: block;
        }

        .input-group {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            color: #6c757d;
            padding: 0.75rem 1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-left: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            background-color: #fff;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .btn-auth {
            padding: 0.875rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            text-transform: none;
            letter-spacing: 0.5px;
        }

        .btn-success.btn-auth {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-primary.btn-auth {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        .btn-ripple {
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

        .btn-auth:active .btn-ripple {
            width: 300px;
            height: 300px;
        }

        .custom-checkbox .form-check-input {
            border-radius: 4px;
            border: 2px solid #e9ecef;
            width: 1.2em;
            height: 1.2em;
        }

        .custom-checkbox .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .custom-checkbox .form-check-label {
            margin-left: 0.5rem;
            color: #6c757d;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .auth-link {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-link:hover {
            color: #20c997;
            text-decoration: underline;
        }

        .auth-link-small {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .auth-link-small:hover {
            color: #28a745;
        }

        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .alert-modern.alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-modern.alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .alert-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            margin-top: 0.25rem;
        }

        .alert-content {
            flex: 1;
        }

        .alert-content ul {
            margin-top: 0.5rem;
            padding-left: 1rem;
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
        }

        .auth-footer p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; }
        .strength-fair { background: #ffc107; }
        .strength-good { background: #28a745; }
        .strength-strong { background: #20c997; }

        /* Toggle password button */
        .btn-outline-secondary {
            border-left: none;
            border: 2px solid #e9ecef;
            background: #f8f9fa;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #e9ecef;
            border-color: #e9ecef;
            color: #495057;
        }

        /* Responsive */
        @media (max-width: 576px) {
            body {
                padding: 0.5rem;
            }
            
            .auth-title {
                font-size: 2rem;
            }
            
            .auth-card-body {
                padding: 1.5rem;
            }
            
            .logo-circle {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* Animation for invalid fields */
        .is-invalid {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Loading state */
        .btn-auth.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-auth.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('[id^="toggle"]');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.id.replace('toggle', '').toLowerCase();
                    const targetInput = document.getElementById(targetId) || 
                                      document.getElementById(targetId.replace('passwordconfirm', 'password_confirmation'));
                    
                    if (targetInput) {
                        const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        targetInput.setAttribute('type', type);
                        
                        const icon = this.querySelector('i');
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    }
                });
            });
            
            // Password strength indicator
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strengthFill = document.getElementById('strengthFill');
                    const strengthText = document.getElementById('strengthText');
                    
                    if (strengthFill && strengthText) {
                        let strength = 0;
                        let text = '';
                        let className = '';
                        
                        if (password.length >= 8) strength++;
                        if (password.match(/[a-z]/)) strength++;
                        if (password.match(/[A-Z]/)) strength++;
                        if (password.match(/[0-9]/)) strength++;
                        if (password.match(/[^a-zA-Z0-9]/)) strength++;
                        
                        switch (strength) {
                            case 0:
                            case 1:
                                text = 'Muy débil';
                                className = 'strength-weak';
                                strengthFill.style.width = '20%';
                                break;
                            case 2:
                                text = 'Débil';
                                className = 'strength-weak';
                                strengthFill.style.width = '40%';
                                break;
                            case 3:
                                text = 'Regular';
                                className = 'strength-fair';
                                strengthFill.style.width = '60%';
                                break;
                            case 4:
                                text = 'Buena';
                                className = 'strength-good';
                                strengthFill.style.width = '80%';
                                break;
                            case 5:
                                text = 'Excelente';
                                className = 'strength-strong';
                                strengthFill.style.width = '100%';
                                break;
                        }
                        
                        strengthFill.className = 'strength-fill ' + className;
                        strengthText.textContent = text;
                    }
                });
            }
            
            // Form submission loading state
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('.btn-auth');
                    if (submitBtn) {
                        submitBtn.classList.add('loading');
                        submitBtn.disabled = true;
                    }
                });
            });
            
            // Auto-dismiss alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert && alert.parentNode) {
                        alert.style.opacity = '0';
                        setTimeout(() => {
                            if (alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 300);
                    }
                }, 5000);
            });
        });
    </script>
</body>
</html>
