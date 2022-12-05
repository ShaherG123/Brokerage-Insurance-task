<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                @if(auth()->user()->type=='admin')
                    <li>
                        <a href="/users">
                            <i class="mdi mdi-shopping"></i>
                            <span> Users </span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="/customers">
                        <i class="mdi mdi-shape-outline"></i>
                        <span> Customers </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->