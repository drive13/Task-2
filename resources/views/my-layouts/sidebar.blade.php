<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="assets/images/logo.svg" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="/" class='sidebar-link'>
                        <i class="bi bi-house"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('product') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" class='sidebar-link'>
                        <i class="bi bi-box-seam"></i> 
                        <span>Product</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('customer') ? 'active' : '' }}">
                    <a href="{{ route('customer.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('orders') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class='sidebar-link'>
                        <i class="bi bi-bag-check"></i>
                        <span>Sales Orders</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>