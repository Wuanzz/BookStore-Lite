<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar nền tối sang trọng */
        .sidebar {
            min-height: 100vh;
            background-color: #1e1e2d; 
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        /* Màu chữ tiêu đề hệ thống */
        .sidebar .brand-title {
            color: #ffffff;
            letter-spacing: 1px;
        }
        /* Làm đẹp các nút menu trên nền tối */
        .nav-link {
            color: #b5b5c3; 
            font-weight: 500;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        /* Hiệu ứng khi di chuột vào menu */
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            transform: translateX(5px);
        }
        /* Nút menu đang được chọn */
        .nav-link.active {
            background-color: #0d6efd !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
        /* Đổi màu dải phân cách cho hợp nền tối */
        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR TỐI MÀU -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar py-4">
            <div class="text-center mb-4">
                <h4 class="brand-title fw-bold mb-0">Bookstore Lite</h4>
                <p class="text-secondary small mt-1">Admin Dashboard</p>
            </div>
            
            <hr class="mx-3 mb-4">

            <div class="position-sticky">
                <ul class="nav flex-column px-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                            📚 Quản lý Sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            📑 Quản lý Thể loại
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('publishers.*') ? 'active' : '' }}" href="{{ route('publishers.index') }}">
                            🏢 Quản lý NXB
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- MAIN CONTENT (BÊN PHẢI) -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
            
            <!-- TOPBAR -->
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <h4 class="text-secondary fw-bold m-0">Hệ thống Quản trị</h4>
                <div class="d-flex align-items-center bg-white px-4 py-2 rounded-pill shadow-sm">
                    <span class="me-3 fw-semibold">Xin chào, <span class="text-success">{{ Auth::user()->name }}</span></span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf 
                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Đăng xuất</button>
                    </form>
                </div>
            </div>

            <!-- NỘI DUNG TRANG CON ĐƯỢC BƠM VÀO ĐÂY -->
            @yield('content')

        </main>
    </div>
</div>

</body>
</html>