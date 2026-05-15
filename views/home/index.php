<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قدرات - منصة التعليم الإلكتروني</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --text: #334155;
            --text-muted: #64748b;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --bg-navbar: rgba(255, 255, 255, 0.95);
            --shadow-color: rgba(0, 0, 0, 0.1);
        }
        
        [data-theme="dark"] {
            --dark: #e2e8f0;
            --light: #0f172a;
            --text: #e2e8f0;
            --text-muted: #94a3b8;
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --bg-navbar: rgba(15, 23, 42, 0.95);
            --shadow-color: rgba(0, 0, 0, 0.3);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg-body);
            color: var(--text);
            line-height: 1.8;
            transition: background 0.4s ease, color 0.4s ease;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes countUp {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .animate-fade-up {
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }
        
        .animate-fade-down {
            animation: fadeInDown 0.8s ease forwards;
            opacity: 0;
        }
        
        .animate-fade-left {
            animation: fadeInLeft 0.8s ease forwards;
            opacity: 0;
        }
        
        .animate-fade-right {
            animation: fadeInRight 0.8s ease forwards;
            opacity: 0;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-navbar);
            backdrop-filter: blur(20px);
            z-index: 1000;
            box-shadow: 0 2px 30px var(--shadow-color);
            transition: all 0.4s ease;
        }
        
        .navbar.scrolled {
            padding: 12px 5%;
            box-shadow: 0 4px 30px var(--shadow-color);
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: transform 0.3s;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .logo i {
            -webkit-text-fill-color: var(--primary);
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            padding: 5px 0;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transition: width 0.3s;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .nav-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        /* Theme Toggle */
        .theme-toggle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .theme-toggle:hover {
            background: var(--primary);
            color: white;
            transform: rotate(180deg);
        }
        
        .btn {
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.5);
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 5% 80px;
            background: linear-gradient(135deg, 
                var(--bg-body) 0%, 
                rgba(99, 102, 241, 0.05) 50%, 
                var(--bg-body) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
            top: -300px;
            right: -300px;
            animation: float 8s ease-in-out infinite;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            bottom: -200px;
            left: -200px;
            animation: float 10s ease-in-out infinite reverse;
        }
        
        .hero-content {
            max-width: 600px;
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--text), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero p {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 30px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .hero-visual {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-visual svg {
            filter: drop-shadow(0 30px 60px var(--shadow-color));
        }
        
        [data-theme="dark"] .hero-visual svg rect:first-child {
            fill: #1e293b;
        }
        
        [data-theme="dark"] .hero-visual svg rect:nth-child(5) {
            fill: #334155;
        }
        
        /* Floating Elements */
        .floating-shapes {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0.05));
            top: 20%;
            left: 10%;
        }
        
        .shape-2 {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.05));
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.05));
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        /* Stats */
        .stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-item h3 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-item p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        
        /* Features Section */
        .features {
            padding: 100px 5%;
            background: var(--bg-card);
            position: relative;
        }
        
        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 60px;
        }
        
        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--text);
        }
        
        .section-header p {
            color: var(--text-muted);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: var(--bg-body);
            padding: 40px 30px;
            border-radius: 20px;
            transition: all 0.4s ease;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px var(--shadow-color);
            border-color: rgba(99, 102, 241, 0.2);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            transition: transform 0.4s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .feature-card:nth-child(1) .feature-icon { background: rgba(99, 102, 241, 0.15); color: var(--primary); }
        .feature-card:nth-child(2) .feature-icon { background: rgba(16, 185, 129, 0.15); color: var(--secondary); }
        .feature-card:nth-child(3) .feature-icon { background: rgba(245, 158, 11, 0.15); color: var(--accent); }
        .feature-card:nth-child(4) .feature-icon { background: rgba(239, 68, 68, 0.15); color: #ef4444; }
        .feature-card:nth-child(5) .feature-icon { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
        .feature-card:nth-child(6) .feature-icon { background: rgba(6, 182, 212, 0.15); color: #06b6d4; }
        
        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--text);
        }
        
        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 5%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .cta::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            top: -200px;
            right: -200px;
        }
        
        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            position: relative;
        }
        
        .cta p {
            opacity: 0.9;
            max-width: 500px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .cta .btn {
            background: white;
            color: var(--primary);
            position: relative;
        }
        
        .cta .btn:hover {
            background: var(--light);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        /* Footer */
        footer {
            background: var(--darker);
            color: white;
            padding: 60px 5% 30px;
        }
        
        [data-theme="dark"] footer {
            background: #020617;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto 40px;
        }
        
        .footer-col h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-col ul {
            list-style: none;
        }
        
        .footer-col ul li {
            margin-bottom: 10px;
        }
        
        .footer-col ul li a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .footer-col ul li a:hover {
            color: white;
            transform: translateX(-5px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #334155;
            color: #64748b;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 100px;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .stats {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero-image {
                margin-top: 40px;
            }
            
            .hero-visual svg {
                width: 300px;
            }
        }
        
        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<!-- Floating Shapes -->
<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<!-- Navbar -->
<nav class="navbar">
    <a href="<?= APP_URL ?>/" class="logo animate-fade-down">
        <i class="fas fa-graduation-cap"></i>
        قدرات
    </a>
    
    <ul class="nav-links">
        <li><a href="#features" class="animate-fade-down delay-1">المميزات</a></li>
        <li><a href="#about" class="animate-fade-down delay-2">من نحن</a></li>
        <li><a href="#contact" class="animate-fade-down delay-3">تواصل معنا</a></li>
    </ul>
    
    <div class="nav-buttons">
        <button class="theme-toggle animate-fade-down delay-4" id="themeToggle" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
        <a href="<?= APP_URL ?>/login" class="btn btn-outline animate-fade-down delay-5">تسجيل الدخول</a>
        <a href="<?= APP_URL ?>/register" class="btn btn-primary animate-fade-down delay-6">إنشاء حساب</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="animate-fade-right">تعلم بلا حدود مع منصة قدرات</h1>
        <p class="animate-fade-right delay-2">منصة تعليمية متكاملة تربط بين المعلمين والطلاب، توفر أدوات احترافية لإدارة الكورسات، الواجبات، الاختبارات، والدرجات في مكان واحد.</p>
        <div class="hero-buttons animate-fade-right delay-3">
            <a href="<?= APP_URL ?>/register" class="btn btn-primary"><i class="fas fa-rocket"></i> ابدأ الآن مجاناً</a>
            <a href="#features" class="btn btn-outline">اكتشف المزيد</a>
        </div>
        
        <div class="stats animate-fade-up delay-4">
            <div class="stat-item">
                <h3>500+</h3>
                <p>طالب مسجل</p>
            </div>
            <div class="stat-item">
                <h3>50+</h3>
                <p>كورس متاح</p>
            </div>
            <div class="stat-item">
                <h3>20+</h3>
                <p>معلم متميز</p>
            </div>
        </div>
    </div>
    
    <div class="hero-image">
        <div class="hero-visual animate-fade-left delay-2">
            <svg width="500" height="400" viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="50" y="50" width="400" height="300" rx="20" fill="#e0e7ff"/>
                <rect x="70" y="80" width="120" height="80" rx="10" fill="#6366f1"/>
                <rect x="70" y="170" width="120" height="30" rx="5" fill="#c7d2fe"/>
                <rect x="70" y="210" width="80" height="20" rx="5" fill="#e0e7ff"/>
                <rect x="210" y="80" width="220" height="150" rx="10" fill="white"/>
                <circle cx="320" cy="155" r="40" fill="#10b981"/>
                <path d="M300 155 L315 170 L345 140" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="210" y="250" width="100" height="30" rx="15" fill="#6366f1"/>
                <rect x="320" y="250" width="100" height="30" rx="15" fill="#f59e0b"/>
            </svg>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="section-header reveal">
        <h2>كل ما تحتاجه في منصة واحدة</h2>
        <p>أدوات متكاملة لتجربة تعليمية فريدة ومميزة</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-book-open"></i></div>
            <h3>إدارة الكورسات</h3>
            <p>أنشئ وأدر كورساتك بسهولة مع إمكانية إضافة مواد تعليمية متنوعة ومحتوى غني.</p>
        </div>
        
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-tasks"></i></div>
            <h3>الواجبات والتسليمات</h3>
            <p>نظام متكامل للواجبات يتيح للطلاب تسليم أعمالهم وللمعلمين تقييمها بسهولة.</p>
        </div>
        
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-question-circle"></i></div>
            <h3>اختبارات تفاعلية</h3>
            <p>أنشئ اختبارات متنوعة مع مؤقت زمني وتصحيح آلي للأسئلة الموضوعية.</p>
        </div>
        
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
            <h3>تتبع الدرجات</h3>
            <p>نظام درجات شامل يتيح للطلاب متابعة أدائهم وللمعلمين إدارة التقييمات.</p>
        </div>
        
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
            <h3>إدارة الحضور</h3>
            <p>سجل حضور وغياب الطلاب بسهولة مع تقارير تفصيلية.</p>
        </div>
        
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-robot"></i></div>
            <h3>مساعد ذكي</h3>
            <p>شات بوت متطور يساعدك في الإجابة على أسئلتك واستفساراتك على مدار الساعة.</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <h2 class="reveal">جاهز لبدء رحلتك التعليمية؟</h2>
    <p class="reveal">انضم إلى آلاف الطلاب والمعلمين على منصة قدرات اليوم</p>
    <a href="<?= APP_URL ?>/register" class="btn reveal">إنشاء حساب مجاني</a>
</section>

<!-- Footer -->
<footer>
    <div class="footer-grid">
        <div class="footer-col">
            <h4>قدرات</h4>
            <p style="color: #94a3b8;">منصة تعليمية متكاملة تهدف لتطوير التعليم الإلكتروني في الوطن العربي.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-col">
            <h4>روابط سريعة</h4>
            <ul>
                <li><a href="<?= APP_URL ?>/login"><i class="fas fa-chevron-left"></i> تسجيل الدخول</a></li>
                <li><a href="<?= APP_URL ?>/register"><i class="fas fa-chevron-left"></i> إنشاء حساب</a></li>
                <li><a href="#features"><i class="fas fa-chevron-left"></i> المميزات</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>الدعم</h4>
            <ul>
                <li><a href="#"><i class="fas fa-chevron-left"></i> الأسئلة الشائعة</a></li>
                <li><a href="#"><i class="fas fa-chevron-left"></i> سياسة الخصوصية</a></li>
                <li><a href="#"><i class="fas fa-chevron-left"></i> الشروط والأحكام</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>تواصل معنا</h4>
            <ul>
                <li><a href="#"><i class="fas fa-envelope"></i> info@capacities.com</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> +20 123 456 7890</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> القاهرة، مصر</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 قدرات. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script>
    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    const icon = themeToggle.querySelector('i');
    
    // Check saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.setAttribute('data-theme', 'dark');
        icon.classList.replace('fa-moon', 'fa-sun');
    }
    
    themeToggle.addEventListener('click', () => {
        if (body.getAttribute('data-theme') === 'dark') {
            body.removeAttribute('data-theme');
            icon.classList.replace('fa-sun', 'fa-moon');
            localStorage.setItem('theme', 'light');
        } else {
            body.setAttribute('data-theme', 'dark');
            icon.classList.replace('fa-moon', 'fa-sun');
            localStorage.setItem('theme', 'dark');
        }
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Scroll Reveal Animation
    const reveals = document.querySelectorAll('.reveal');
    
    function revealOnScroll() {
        reveals.forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            const revealPoint = 150;
            
            if (elementTop < windowHeight - revealPoint) {
                element.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Run on load
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>

</body>
</html>
