<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bodega de herramienta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
      :root {
            --primary-color: #0a6ebd;
            --secondary-color: #1eb980;
            --light-color: #e9f7ef;
            --dark-color: #1a3c40;
            --accent-color: #3498db;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5rem 0;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
        }
        
        .company-name {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 1rem;
        }
        
        .tagline {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-custom-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.6rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-custom-primary:hover {
            background-color: #085a9d;
            border-color: #085a9d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-custom-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
            padding: 0.6rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-custom-secondary:hover {
            background-color: #19a06e;
            border-color: #19a06e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .features-section {
            padding: 3rem 0;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .footer {
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            color: white;
            padding: 3rem 0;
            border-radius: 30px 30px 0 0;
            margin-top: 3rem;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            margin-top: 2rem;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .tool-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }
        
        .tool-1 {
            top: 10%;
            left: 5%;
            font-size: 5rem;
            transform: rotate(-15deg);
        }
        
        .tool-2 {
            bottom: 15%;
            right: 8%;
            font-size: 4rem;
            transform: rotate(20deg);
        }
        .footer {
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            color: white;
            padding: 3rem 0;
            border-radius: 30px 30px 0 0;
            margin-top: 3rem;
            text-align: center;
        }
    </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero-section text-center">
    <div class="container">
        <div class="company-name">Bodega de herramienta</div>
        <div class="tagline">Tu solución completa  </div>
            <div class="mt-5">
                @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-custom-primary btn-lg">Mi Cuenta</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom-primary btn-lg">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-custom-secondary btn-lg ml-3">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </section>
    

<section class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3>Amplio Catálogo</h3>
                    <p>Encuentra todas las herramientas que necesitas para tus proyectos profesionales y de bricolaje.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3>Envío Rápido</h3>
                    <p>Entregamos tus herramientas directamente a tu puerta con nuestro servicio de envío express.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3>Soporte </h3>
                    <p>Nuestro equipo de expertos está disponible para asesorarte en la elección de tus herramientas.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <h4>encuentranos en redes</h4>
        <div class="social-icons">
            <a href="#" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" aria-label="WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>
            <a href="#" aria-label="Email">
                <i class="bi bi-envelope"></i>
            </a>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} Bodega de herramienta.
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
