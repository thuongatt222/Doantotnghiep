<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
        <div class="sidebar-brand-icon">
            <img src="../../images/admin/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Danh mục quản lý
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-users"></i>
            <span>Nhân sự</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh mục quản lý</h6>
                <a class="collapse-item" href="{{route('admin.admin')}}">Nhân sự</a>
                <a class="collapse-item" href="{{route('admin.customer')}}">Khách hàng</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-archive"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh mục quản lý</h6>
                <a class="collapse-item" href="{{route('admin.category')}}">Danh mục</a>
                <a class="collapse-item" href="{{route('admin.color')}}">Màu</a>
                <a class="collapse-item" href="{{route('admin.voucher')}}">Mã giảm giá</a>
                <a class="collapse-item" href="{{route('admin.discount')}}">Sản phẩm khuyến mãi</a>
                <a class="collapse-item" href="{{route('admin.brand')}}">Thương hiệu</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
           aria-expanded="true" aria-controls="collapseMethod">
            <i class="fas fa-tasks"></i>
            <span>Hóa đơn</span>
        </a>
        <div id="collapseOrder" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh mục quản lý</h6>
                <a class="collapse-item" href="{{route('admin.order')}}">Hóa đơn</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMethod"
           aria-expanded="true" aria-controls="collapseMethod">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Phương thức</span>
        </a>
        <div id="collapseMethod" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh mục phương thức</h6>
                <a class="collapse-item" href="{{route('admin.payment')}}">Thanh toán</a>
                <a class="collapse-item" href="{{route('admin.shipping')}}">Vận chuyển</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Thống kê
    </div>
</ul>
