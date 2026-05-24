<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #1e1e2d; 
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        .sidebar .brand-title {
            color: #ffffff;
            letter-spacing: 1px;
        }
        .nav-link {
            color: #b5b5c3; 
            font-weight: 500;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            transform: translateX(5px);
        }
        .nav-link.active {
            background-color: #0d6efd !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.1);
        }
        /* Làm đẹp thêm cho menu thả xuống */
        .dropdown-item {
            padding: 10px 20px;
            font-weight: 500;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
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

        <!-- MAIN CONTENT -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
            
            <!-- TOPBAR VỚI DROPDOWN MENU -->
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <h4 class="text-secondary fw-bold m-0">Hệ thống Quản trị</h4>
                
                <div class="dropdown">
                    <button class="btn btn-white bg-white shadow-sm border-0 dropdown-toggle rounded-pill px-4 py-2 d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Nếu có avatar thì hiện avatar, chưa có thì hiện icon mặc định -->
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="fw-semibold text-dark">Xin chào, <span class="text-success">{{ Auth::user()->name }}</span></span>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="userMenu">
                        <li>
                            <!-- Đường dẫn tới trang Hồ sơ -->
                            <a class="dropdown-item text-secondary" href="{{ route('profiles.index') }}">
                                👤 Hồ sơ cá nhân
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf 
                                <button type="submit" class="dropdown-item text-danger">🚪 Đăng xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- NỘI DUNG TRANG CON ĐƯỢC BƠM VÀO ĐÂY -->
            @yield('content')

        </main>
    </div>
</div>

<!-- Bắt buộc phải có file JS này thì menu Dropdown mới hoạt động -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>