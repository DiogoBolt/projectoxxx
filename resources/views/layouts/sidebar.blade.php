
{{-- $menulink --}}

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div style="color:white">
           {!! Auth::user()->name !!}
            <!-- Status -->
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <!-- Dashboard -->
        <li>
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-folder"></i> <span>Families</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="/families"><i class="fa fa-folder-open"></i>Families</a>
                </li>
                <li>
                    <a href="/families/new"><i class="fa fa-folder-open"></i>New Family</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-folder"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="/categories"><i class="fa fa-folder-open"></i>Categories</a>
                </li>
                <li>
                    <a href="/categories/new"><i class="fa fa-folder-open"></i>New Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-folder"></i> <span>Brands</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="/brands"><i class="fa fa-folder-open"></i>Brands</a>
                </li>
                <li>
                    <a href="/brands/new"><i class="fa fa-folder-open"></i>New Brand</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-folder"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="/products"><i class="fa fa-folder-open"></i>Products</a>
                </li>
                <li>
                    <a href="/products/new"><i class="fa fa-folder-open"></i>New Product</a>
                </li>
            </ul>
        </li>

                    </ul>


        <!-- Log out -->
        <li>
            <a href="/logout">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->

<script>
    function popup(mylink, windowname) {
        if (! window.focus)return true;
        var href;
        if (typeof(mylink) === 'string')
            href=mylink;
        else
            href=mylink.href;
        window.open(href, windowname, 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=280,height=500,scrollbars=yes');
        return false; }

</script>