<!-- resources/views/admin/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #fff;
        }

        .sidebar .nav-link:hover {
            background: #495057;
        }

        .sidebar .nav-link.active {
            background: #007bff;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 20px;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            min-width: 80px;
            max-width: 80px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i {
            font-size: 1.5em;
            text-align: center;
        }

        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <nav class="nav flex-column">
            <a href="#" class="toggle-btn" id="toggleBtn"><i class="fas fa-bars"></i></a>
            <a href="{{ route('products.index') }}" class="nav-link"><i class="fas fa-boxes"></i>
                <span>Products</span></a>
            <a href="{{ route('orders.index') }}" class="nav-link"><i class="fas fa-shopping-cart"></i>
                <span>Orders</span></a>
        </nav>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- custom js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.getElementById('toggleBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
</body>

</html>
