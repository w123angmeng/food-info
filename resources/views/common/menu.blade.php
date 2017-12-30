<div class="side-content">
    @if(session('user')['role'] == "admin")
        <ul class="nav-main">
        <li class="header" id="shop">
            <span class="sidebar-mini-hide">首页</span>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/nav"}}">
                <span class="sidebar-mini-hide">幻灯片管理</span>
            </a>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/articlecate"}}">
                <span class="sidebar-mini-hide">文章分类管理</span>
            </a>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/article"}}">
                <span class="sidebar-mini-hide">文章管理</span>
            </a>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/web/user"}}">
                <span class="sidebar-mini-hide">用户管理</span>
            </a>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/web/goods"}}">
                <span class="sidebar-mini-hide">商品管理</span>
            </a>
        </li>
        <li class="open" id="shop">
            <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/web/order"}}">
                <span class="sidebar-mini-hide">订单管理</span>
            </a>
        </li>
    </ul>
    @else
        <ul class="nav-main">
            <li class="header" id="shop">
                <span class="sidebar-mini-hide">首页</span>
            </li>
            <li class="open" id="shop">
                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/goods"}}">
                    <span class="sidebar-mini-hide">商品列表</span>
                </a>
            </li>
            <li class="open" id="shop">
                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/order/list"}}">
                    <span class="sidebar-mini-hide">我的订单</span>
                </a>
            </li>
            <li class="open" id="shop">
                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/cart"}}">
                    <span class="sidebar-mini-hide">我的购物车</span>
                </a>
            </li>
        </ul>
    @endif
</div>
