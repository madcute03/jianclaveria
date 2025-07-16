<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl glowing-title">
            Notifications
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #0f0f0f;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .glowing-title {
            color: #fff;
            text-align: center;
            text-shadow: 0 0 5px #00f6ff, 0 0 10px #00f6ff, 0 0 20px #00f6ff;
            margin-bottom: 30px;
        }

        .glow-button {
            background-color: #ff0055;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 0 10px #ff0055, 0 0 20px #ff0055, 0 0 40px #ff0055;
            transition: 0.3s;
        }

        .glow-button:hover {
            background-color: #e6004c;
            box-shadow: 0 0 20px #ff0055, 0 0 30px #ff0055, 0 0 50px #ff0055;
        }

        .notification-card {
            background: linear-gradient(135deg, #003366, #000022);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            color: white;
            box-shadow: 0 0 10px #00bfff, 0 0 20px #1e90ff;
        }

        .notification-card h3 {
            font-size: 1.25rem;
            margin-bottom: 5px;
            text-shadow: 0 0 5px #00ffff;
        }

        .notification-card p {
            margin: 3px 0;
            color: #cceeff;
        }

        .action-buttons button {
            background: none;
            border: none;
            font-size: 0.9rem;
            color: #90ee90;
            cursor: pointer;
            text-decoration: underline;
            margin-right: 15px;
        }

        .action-buttons button:hover {
            color: #32cd32;
        }

        .delete-btn {
            color: #ff9999;
        }

        .delete-btn:hover {
            color: #ff4c4c;
        }

        .success-alert {
            background: #008000;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px #00ff88;
        }

        .no-notif {
            color: #aaaaff;
            text-align: center;
            margin-top: 30px;
            font-size: 1.1rem;
        }
    </style>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('notifications.clear') }}">
            @csrf
            <button type="submit" class="glow-button mb-6">
                Clear All Notifications
            </button>
        </form>

        @forelse ($notifications as $notification)
            <div class="notification-card">
                <h3>{{ $notification->data['title'] }}</h3>
                <p>📅 {{ $notification->data['booking_date'] }}</p>
                <p>📝 {{ $notification->data['notes'] }}</p>

                <div class="action-buttons mt-3">
                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="inline">
                        @csrf
                        <button>✔ Mark as Read</button>
                    </form>

                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="inline ml-2">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">🗑 Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="no-notif">No notifications found.</p>
        @endforelse
    </div>
</x-app-layout>
