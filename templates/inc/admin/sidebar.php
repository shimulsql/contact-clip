<div class="admin-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand animate__animated animate__rubberBand">
            <img src="<?php get_asset_path() ?>/images/polygon-sidebar.png" alt="" class="src">
        </div>
        <div class="sidebar-toggle">
            <i class="fal fa-arrow-alt-left"></i>
        </div>
    </div>
    <div class="sidebar-items">
        <ul class="menu-items" id="sidebar-menu">
            <li class="item <?php echo $pageActive == 'dashboard' ? 'active-pg' : '' ?>">
                <a class="title" href="<?php get_dir_url(); ?>admin/">
                <i class="fad fa-tachometer-alt-fast"></i> 
                <span>
                    Dashboard
                </span>
                </a>
            </li>
            <li class="item <?php echo $pageActive == 'contact' ? 'active-pg' : '' ?>">
                <a class="title" href="#">
                <i class="fad fa-address-card"></i> 
                <span>
                    Contact
                </span>
                </a>
                <div class="sub-menu-wrap">
                    <ul class="sub-menu">
                        <li>
                        <a href="<?php get_dir_url(); ?>admin/add-contact.php">Add Contact</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="item <?php echo $pageActive == 'group' ? 'active-pg' : '' ?>">
                <a class="title" href="#">
                <i class="fad fa-user-friends"></i> 
                <span>
                    Groups
                </span>
                </a>
                <div class="sub-menu-wrap">
                <ul class="sub-menu">
                    <li>
                        <a href="<?php get_dir_url(); ?>admin/add-group.php">Add Group</a>
                    </li>
                    <li>
                        <a href="<?php get_dir_url(); ?>admin/list-groups.php">Groups</a>
                    </li>
                </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">

    </div>
</div>