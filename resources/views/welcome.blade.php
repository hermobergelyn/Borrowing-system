<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Sports Equipment Borrowing Logbook System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    html, body {
      min-height: 100vh;
      width: 100%;
      position: relative;
      overflow-x: hidden;
      color: #f8fafc;
      background-color: #0f172a;
    }

    /* Sharp Background Image Layer (No Blur) */
    .bg-layer {
      position: fixed;
      inset: 0;
      z-index: 0;
      background-image: url("{{ asset('images/gym-bg.png') }}");
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      filter: none;
      -webkit-filter: none;
      backdrop-filter: none;
      -webkit-backdrop-filter: none;
      image-rendering: -webkit-optimize-contrast;
      pointer-events: none;
    }

    /* Navigation Bar */
    .navbar {
      position: sticky;
      top: 0;
      z-index: 20;
      width: 100%;
      padding: 16px 48px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: rgba(15, 23, 42, 0.78);
      border-bottom: 1px solid rgba(255, 255, 255, 0.16);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: #ffffff;
      font-weight: 700;
      font-size: 16px;
      letter-spacing: -0.01em;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.65);
    }

    .brand-badge {
      background: linear-gradient(135deg, #2563eb, #0284c7);
      color: #ffffff;
      font-weight: 800;
      font-size: 13px;
      padding: 7px 9px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.45);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 28px;
    }

    .nav-links a {
      text-decoration: none;
      color: #e2e8f0;
      font-size: 14px;
      font-weight: 500;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
      transition: color 0.2s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: #ffffff;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-left: 8px;
    }

    .btn-login {
      padding: 8px 18px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      background-color: rgba(15, 23, 42, 0.55);
      color: #ffffff !important;
      font-weight: 600;
      transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .btn-login:hover {
      background-color: rgba(15, 23, 42, 0.8);
      border-color: rgba(255, 255, 255, 0.55);
    }

    .btn-register {
      padding: 8px 20px;
      border-radius: 999px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff !important;
      font-weight: 600;
      box-shadow: 0 4px 14px rgba(37, 99, 235, 0.5);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-register:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(37, 99, 235, 0.65);
    }

    /* Main Hero Section */
    .main-wrapper {
      position: relative;
      z-index: 10;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px 24px;
    }

    .hero-card {
      width: 100%;
      max-width: 1120px;
      background-color: rgba(15, 23, 42, 0.56);
      border: 1px solid rgba(255, 255, 255, 0.22);
      border-radius: 24px;
      padding: 48px;
      display: grid;
      grid-template-columns: 1.15fr 1fr;
      gap: 40px;
      align-items: center;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    /* Left Hero Content */
    .pill-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      border-radius: 999px;
      background-color: rgba(16, 185, 129, 0.22);
      border: 1px solid rgba(110, 231, 183, 0.45);
      color: #a7f3d0;
      font-size: 12.5px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .pill-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: #10b981;
    }

    .hero-title {
      font-size: 42px;
      font-weight: 800;
      line-height: 1.14;
      letter-spacing: -0.025em;
      color: #ffffff;
      margin-bottom: 18px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
    }

    .hero-subtitle {
      font-size: 16px;
      line-height: 1.6;
      color: #f1f5f9;
      margin-bottom: 30px;
      max-width: 460px;
      text-shadow: 0 1px 6px rgba(0, 0, 0, 0.75);
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      border-radius: 999px;
      background: linear-gradient(135deg, #2563eb, #0284c7);
      color: #ffffff;
      text-decoration: none;
      font-size: 15px;
      font-weight: 600;
      box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.6);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 14px 30px -5px rgba(37, 99, 235, 0.8);
    }

    .secondary-links {
      margin-top: 18px;
      font-size: 13.5px;
      color: #e2e8f0;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.75);
    }

    .secondary-links a {
      color: #ffffff;
      text-decoration: underline;
      text-underline-offset: 3px;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .secondary-links a:hover {
      color: #7dd3fc;
    }

    /* Right Dashboard Preview Widget */
    .dashboard-preview {
      background-color: rgba(30, 41, 59, 0.75);
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 20px;
      padding: 20px;
      display: grid;
      grid-template-columns: 1fr 1.05fr;
      gap: 16px;
    }

    .inventory-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .inv-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 14px;
      background-color: rgba(15, 23, 42, 0.82);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 14px;
      transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .inv-item:hover {
      transform: translateX(3px);
      border-color: rgba(255, 255, 255, 0.28);
    }

    .inv-badge {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 800;
      flex-shrink: 0;
    }

    .badge-bb {
      background-color: rgba(249, 115, 22, 0.22);
      color: #fb923c;
      border: 1px solid rgba(249, 115, 22, 0.4);
    }

    .badge-vb {
      background-color: rgba(56, 189, 248, 0.22);
      color: #38bdf8;
      border: 1px solid rgba(56, 189, 248, 0.4);
    }

    .badge-bd {
      background-color: rgba(16, 185, 129, 0.22);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.4);
    }

    .badge-tg {
      background-color: rgba(234, 179, 8, 0.22);
      color: #facc15;
      border: 1px solid rgba(234, 179, 8, 0.4);
    }

    .inv-info h4 {
      font-size: 13.5px;
      font-weight: 600;
      color: #ffffff;
      margin-bottom: 2px;
    }

    .status-available {
      font-size: 12px;
      font-weight: 600;
      color: #34d399;
    }

    .status-borrowed {
      font-size: 12px;
      font-weight: 600;
      color: #fbbf24;
    }

    /* Logbook Panel */
    .logbook-panel {
      background-color: rgba(15, 23, 42, 0.88);
      border: 1px solid rgba(255, 255, 255, 0.16);
      border-radius: 16px;
      padding: 16px;
      display: flex;
      flex-direction: column;
    }

    .logbook-header {
      background: linear-gradient(135deg, #0284c7, #2563eb);
      padding: 10px 14px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12.5px;
      font-weight: 600;
      color: #ffffff;
      margin-bottom: 14px;
    }

    .status-pill {
      background-color: rgba(16, 185, 129, 0.28);
      border: 1px solid rgba(255, 255, 255, 0.35);
      padding: 3px 10px;
      border-radius: 999px;
      font-size: 11px;
    }

    .logbook-subtitle {
      font-size: 12px;
      font-weight: 600;
      color: #cbd5e1;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      margin-bottom: 10px;
    }

    .log-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 4px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 13px;
      color: #f1f5f9;
    }

    .log-row:last-child {
      border-bottom: none;
    }

    .check-icon {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
    }

    .check-green {
      background-color: rgba(16, 185, 129, 0.24);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.45);
    }

    .check-amber {
      background-color: rgba(245, 158, 11, 0.24);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.45);
    }

    /* Footer Prompt */
    .footer-prompt {
      margin-top: 24px;
      padding: 10px 22px;
      border-radius: 999px;
      background-color: rgba(15, 23, 42, 0.82);
      border: 1px solid rgba(255, 255, 255, 0.2);
      font-size: 14px;
      color: #f8fafc;
    }

    .footer-prompt a {
      color: #7dd3fc;
      font-weight: 700;
      text-decoration: none;
      margin-left: 6px;
    }

    .footer-prompt a:hover {
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 960px) {
      .hero-card {
        grid-template-columns: 1fr;
        padding: 32px 24px;
      }

      .navbar {
        padding: 14px 20px;
      }

      .hero-title {
        font-size: 32px;
      }
    }

    @media (max-width: 640px) {
      .dashboard-preview {
        grid-template-columns: 1fr;
      }

      .nav-links > a {
        display: none;
      }
    }
  </style>
</head>
<body>

  <!-- Background Layer -->
  <div class="bg-layer" aria-hidden="true"></div>

  <!-- Top Navigation -->
  <header class="navbar">
    <a href="{{ url('/') }}" class="brand">
      <span class="brand-badge">SE</span>
      <span>School Sports Equipment Borrowing Logbook System</span>
    </a>

    <nav class="nav-links">
      <a href="{{ url('/') }}" class="active">Home</a>
      <a href="#gear">Sports Gear</a>
      <a href="#help">Help</a>
      <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-login">Log in</a>
        <a href="{{ route('register') }}" class="btn-register">Register</a>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="main-wrapper">
    <section class="hero-card">
      <!-- Left Side -->
      <div>
        <div class="pill-tag">
          <span class="pill-dot"></span>
          <span>Campus Sports Inventory & Logbook</span>
        </div>

        <h1 class="hero-title">School Sports Equipment Borrowing Logbook System</h1>

        <p class="hero-subtitle">
          Easily track, request, and borrow sports gear for your school activities
        </p>

        <a href="{{ route('login') }}" class="btn-primary">
          <span>Borrow Sports Gear</span>
          <span>›</span>
        </a>

        <p class="secondary-links">
          Explore <a href="#equipment">Equipment</a> or <a href="#features">Learn More</a>
        </p>
      </div>

      <!-- Right Side Preview -->
      <div class="dashboard-preview">
        <div class="inventory-list">
          <div class="inv-item">
            <div class="inv-badge badge-bb">BB</div>
            <div class="inv-info">
              <h4>Basketballs</h4>
              <span class="status-available">Available</span>
            </div>
          </div>

          <div class="inv-item">
            <div class="inv-badge badge-vb">VB</div>
            <div class="inv-info">
              <h4>Volleyballs</h4>
              <span class="status-available">Available</span>
            </div>
          </div>

          <div class="inv-item">
            <div class="inv-badge badge-bd">BD</div>
            <div class="inv-info">
              <h4>Badminton Set</h4>
              <span class="status-borrowed">3 Borrowed</span>
            </div>
          </div>

          <div class="inv-item">
            <div class="inv-badge badge-tg">00</div>
            <div class="inv-info">
              <h4>Timer & Gear</h4>
              <span class="status-available">Ready</span>
            </div>
          </div>
        </div>

        <div class="logbook-panel">
          <div class="logbook-header">
            <span>‹ Borrow Log</span>
            <span class="status-pill">Status</span>
          </div>

          <div class="logbook-subtitle">Logbook</div>

          <div class="log-row">
            <span>Spalding Ball #02</span>
            <span class="check-icon check-green">✓</span>
          </div>
          <div class="log-row">
            <span>Mikasa Volleyball</span>
            <span class="check-icon check-green">✓</span>
          </div>
          <div class="log-row">
            <span>Yonex Rackets</span>
            <span class="check-icon check-amber">!</span>
          </div>
          <div class="log-row">
            <span>Training Cones</span>
            <span class="check-icon check-green">✓</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom Prompt -->
    <div class="footer-prompt">
      Already registered? <a href="{{ route('login') }}">Log in</a>
    </div>
  </main>

</body>
</html>