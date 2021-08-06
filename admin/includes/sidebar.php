<div class="sidebar">
    <div class="logo-details">
        <div style="height:30px; width:30px">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.01 512.01" style="enable-background:new 0 0 512.01 512.01;" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <path d="M405.338,64.01h-21.333V41.968c0-23.469-19.506-42.464-42.663-41.958c-3.125,0.068-6.316,0.53-9.535,1.344L104.386,64.24     c-22.452,1.216-40.382,19.688-40.382,42.436v362.667c0,23.531,19.135,42.667,42.667,42.667h298.667     c23.531,0,42.667-19.135,42.667-42.667V106.676C448.005,83.145,428.87,64.01,405.338,64.01z M337.286,21.968     c12.427-3.229,25.385,6.896,25.385,20V64.01H185.263L337.286,21.968z M426.672,469.343c0,11.76-9.573,21.333-21.333,21.333     H106.672c-11.76,0-21.333-9.573-21.333-21.333V106.676c0-11.76,9.573-21.333,21.333-21.333h298.667     c11.76,0,21.333,9.573,21.333,21.333V469.343z" />
                                <path d="M325.338,285.708c-6.031,1.573-11.115,2.302-16,2.302c-35.292,0-64-28.708-64-64c0-4.885,0.729-9.969,2.302-16     c0.948-3.656-0.104-7.552-2.781-10.229c-2.677-2.667-6.583-3.729-10.219-2.781c-37.667,9.76-63.969,43.625-63.969,82.344     c0,47.052,38.281,85.333,85.333,85.333c38.719,0,72.583-26.302,82.344-63.969c0.948-3.656-0.104-7.552-2.781-10.219     C332.89,285.802,329.005,284.781,325.338,285.708z M256.005,341.343c-35.292,0-64-28.708-64-64     c0-23.146,12.573-43.99,32.021-55.177c-0.01,0.615-0.021,1.229-0.021,1.844c0,47.667,39.687,86.5,87.177,85.313     C299.994,328.77,279.151,341.343,256.005,341.343z" />
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
        <div class="logo_name">A4R Bookstore</div>
        <i class='fas fa-bars' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="dashboard">
                <i class="fas fa-th-large"></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="user">
                <i class="fas fa-user"></i>
                <span class="links_name">User</span>
            </a>
            <span class="tooltip">User</span>
        </li>
        <li>
            <a href="book-list">
                <i class="fas fa-book"></i>
                <span class="links_name">Book List</span>
            </a>
            <span class="tooltip">Book List</span>
        </li>
        <li>
            <a href="order">
                <i class="fas fa-list"></i>
                <span class="links_name">Order List</span>
            </a>
            <span class="tooltip">Order List</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <div class="name_job">
                    <div class="name"><?php echo $_SESSION['name'] ?></div>
                    <div class="job"><?php echo $_SESSION['role'] ?></div>
                </div>
            </div>
            <a href="/auth/logout"><i class="fas fa-sign-out-alt" id="log_out"></i></a>
        </li>
    </ul>
</div>

<style>
    svg {
  -webkit-filter: invert(100%); /* safari 6.0 - 9.0 */
          filter: invert(100%);
}
</style>