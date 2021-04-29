<div class="sl-logo"><a href="{{ route('main.home.page') }}"><i class="icon ion-android-star-outline"></i>
        starlight</a></div>
<div class="sl-sideleft">
    <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
    </div><!-- input-group -->

    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link active">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        @php
            $admin = App\Models\Admin::where('id', auth()->user()->id)->first();
        @endphp
        @if ($admin->data == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Data</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.cat') }}" class="nav-link">Category</a></li>
                <li class="nav-item"><a href="{{ route('admin.subcat') }}" class="nav-link">SubCategory</a></li>
                <li class="nav-item"><a href="{{ route('admin.brand') }}" class="nav-link">Brand</a></li>
            </ul>
        @endif

        @if ($admin->coupon == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Coupon</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.coupon') }}" class="nav-link">Coupon</a></li>
            </ul>

        @endif

        @if ($admin->newsletters == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Subscribers</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.newsletter') }}" class="nav-link">NewsLetter</a></li>
            </ul>
        @endif
        @if ($admin->product == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                    <span class="menu-item-label">Product</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('all.product') }}" class="nav-link">All Products</a></li>
                <li class="nav-item"><a href="{{ route('add.product') }}" class="nav-link">Add Product</a></li>
            </ul>
        @endif
        @if ($admin->blog == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                    <span class="menu-item-label">Blog</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('all.blogCats') }}" class="nav-link">Blog Category</a></li>
                <li class="nav-item"><a href="{{ route('add.blogPost') }}" class="nav-link">Add Post</a></li>
                <li class="nav-item"><a href="{{ route('all.blogPost') }}" class="nav-link">Post List</a></li>
            </ul>
        @endif

        @if ($admin->orders == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="fas fa-truck"></i>
                    <span class="menu-item-label">Orders</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('pending.orders') }}" class="nav-link">New Orders</a></li>
                <li class="nav-item"><a href="{{ route('accepted.orders') }}" class="nav-link">Accepted Orders</a>
                </li>
                <li class="nav-item"><a href="{{ route('cancelled.orders') }}" class="nav-link">Cancelled Orders</a>
                </li>
                <li class="nav-item"><a href="{{ route('indelivery.orders') }}" class="nav-link">In Delivery
                        Orders</a>
                </li>
                <li class="nav-item"><a href="{{ route('success.orders') }}" class="nav-link">Deliveryied Orders</a>
                </li>
            </ul>
        @endif
        @if ($admin->report == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="fas fa-copy"></i>
                    <span class="menu-item-label">Reports</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">Today Order</a></li>
                <li class="nav-item"><a href="{{ route('today.delivery') }}" class="nav-link">Today Delivery</a></li>
                <li class="nav-item"><a href="{{ route('this.month') }}" class="nav-link">This Month</a></li>
                <li class="nav-item"><a href="{{ route('search.oredr') }}" class="nav-link">Search </a></li>
            </ul>
        @endif

        @if ($admin->others == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Others</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('view.seo') }}" class="nav-link">Seo</a></li>
            </ul>
        @endif

        @if ($admin->roleName->name == 'superadmin')
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Admins</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('all.admin') }}" class="nav-link">All Admins</a></li>
                <li class="nav-item"><a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a></li>
            </ul>
        @endif

        @if ($admin->return == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Return Order</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('return.request') }}" class="nav-link">Return Request</a></li>
                <li class="nav-item"><a href="{{ route('all.requests') }}" class="nav-link">All Request</a></li>
            </ul>
        @endif

        @if ($admin->contact == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Contact Messages</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('all.message') }}" class="nav-link">Messages</a></li>
            </ul>
        @endif

        @if ($admin->comment == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Product Comments</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('view.seo') }}" class="nav-link">Seo</a></li>
            </ul>
        @endif

        @if ($admin->setting == 1)
            <a href="" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Site Setting</span>

                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('edit.setting') }}" class="nav-link">Setting</a></li>
            </ul>
        @endif

        @if ($admin->stock == 1)
        <a href="" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Stock</span>

                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('product.stock') }}" class="nav-link">Stock</a></li>
        </ul>
    @endif

    </div><!-- sl-sideleft-menu -->

    <br>
</div>
