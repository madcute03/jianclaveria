<x-app-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f8fafc;
        }

        .dashboard-container {
            min-height: 100vh;
            padding: 3rem 1rem;
            max-width: 1200px;
            margin: auto;
        }

        .dashboard-header h1 {
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #f8fafc;
            text-shadow: 0 0 10px #fff;
        }

        .dashboard-header p {
            color: #cbd5e1;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .card {
            position: relative;
            background-color: #1f1f2f;
            border-radius: 1.5rem;
            padding: 2rem;
            overflow: hidden;
            z-index: 0;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
        }

        .card::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, red, orange, yellow, green, blue, indigo, violet);
            border-radius: inherit;
            z-index: -2;
            animation: rainbow 6s linear infinite;
        }

        .card::after {
            content: "";
            position: absolute;
            inset: 2px;
            background: #1f1f2f;
            border-radius: inherit;
            z-index: -1;
        }

        @keyframes rainbow {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }

        .card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 0.95rem;
            color: #cbd5e1;
        }

        .drawer-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: rgba(59, 130, 246, 0.8);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
            font-size: 1.5rem;
        }

        .drawer {
            position: fixed;
            top: 0;
            left: -260px;
            width: 240px;
            height: 100%;
            background-color: #1e293b;
            box-shadow: 0 0 20px rgba(14, 165, 233, 0.5);
            border-right: 2px solid #3b82f6;
            padding: 2rem 1rem;
            transition: left 0.3s ease;
            z-index: 99;
            display: flex;
            flex-direction: column;
        }

        .drawer.open {
            left: 0;
        }

        .drawer-links {
            margin-top: 35%;
            display: flex;
            flex-direction: column;
        }

        .drawer a {
            display: block;
            margin-bottom: 1rem;
            color: #e0f2fe;
            background: linear-gradient(to right, #0ea5e9, #6366f1);
            padding: 0.7rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.4);
            transition: all 0.3s ease;
        }

        .drawer a:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.8);
        }
    </style>

    <!-- ☰ Toggle Button -->
    <div class="drawer-toggle" onclick="document.querySelector('.drawer').classList.toggle('open')">☰</div>

    <!-- 🌈 Sidebar Drawer -->
    <div class="drawer">
        <div class="drawer-links">
            <a href="{{ url('/bookings/create') }}">➕ Create Booking</a>
            <a href="{{ url('/bookings') }}">📖 View Bookings</a>
            <a href="{{ url('/profile') }}">👥 User Management</a>
        </div>
    </div>

    <!-- 🔥 Main Dashboard -->
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>🌈 Booking Dashboard</h1>
            <p>Manage your platform with style!</p>
        </header>

        <section class="card-grid">
            <!-- Total Bookings -->
            <div class="card">
                <h2>📊 Total Bookings</h2>
                <p>You currently have <strong>{{ $totalBookings }}</strong> booking{{ $totalBookings !== 1 ? 's' : '' }}.</p>
            </div>

            <!-- Total Users -->
            <div class="card">
                <h2>👥 Total Users</h2>
                <p>There {{ $totalUsers === 1 ? 'is' : 'are' }} <strong>{{ $totalUsers }}</strong> registered user{{ $totalUsers !== 1 ? 's' : '' }}.</p>
            </div>
        </section>
    </div>

    <script>
        window.addEventListener('click', function (e) {
            const drawer = document.querySelector('.drawer');
            const toggle = document.querySelector('.drawer-toggle');
            if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
                drawer.classList.remove('open');
            }
        });
    </script>
</x-app-layout>
