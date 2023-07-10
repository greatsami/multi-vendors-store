<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Starter</li>

            <li class="dropdown {{ setActive([
                'admin.categories.*',
                'admin.sub-categories.*',
                'admin.child-categories.*',
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.categories.*']) }}"><a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li class="{{ setActive(['admin.sub-categories.*']) }}"><a class="nav-link" href="{{ route('admin.sub-categories.index') }}">Sub Categories</a></li>
                    <li class="{{ setActive(['admin.child-categories.*']) }}"><a class="nav-link" href="{{ route('admin.child-categories.index') }}">Child Categories</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
                'admin.vendors.*',
                'admin.flash-sale.*',
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendors.*']) }}"><a class="nav-link" href="{{ route('admin.vendors.index') }}">Vendor Profile</a></li>
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
                'admin.brands.*',
                'admin.products.*',
                'admin.product-galleries.*',
                'admin.product-variants.*',
                'admin.product-variant-items.*',
                'admin.seller-products.*',
                'admin.seller-pending-products.*',
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brands.*']) }}"><a class="nav-link" href="{{ route('admin.brands.index') }}">Brands</a></li>
                    <li class="{{ setActive(['admin.products.*']) }}"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link" href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link" href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.sliders.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.sliders.*']) }}"><a class="nav-link" href="{{ route('admin.sliders.index') }}">Slider</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
