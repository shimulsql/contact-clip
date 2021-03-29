 <!-- Navigation start -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php get_dir_url() ?>">CC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php get_dir_url() ?>">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <div class="navbar-nav">
          <div class="dropdown custom-nav-admin">
            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fal fa-user"></i>
            </a>
          
            <div class="dropdown-menu dropdown-menu-lg-right p-2" aria-labelledby="dropdownMenuLink">

            <?php if(!is_auth()):?>

              <a class="dropdown-item btn btn-primary" href="<?php get_dir_url() ?>login.php">Login</a>
              <a class="dropdown-item btn btn-primary" href="<?php get_dir_url() ?>register.php">Register</a>

            <?php elseif(is_auth()): ?>

              <a class="dropdown-item btn btn-primary" href="#" id="logout-button"><i class="fad fa-sign-out"></i> Logout</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php _e(URLROOT); ?>admin/index.php">
                <div class="left-icon-card">
                  <div class="icon">
                    <i class="fas fa-tachometer-slowest"></i>
                  </div>
                  <div class="body">
                    <h4 class="title">Dashboard</h4>
                  </div>
                </div>
              </a>

            <?php endif;?>

            </div>
          </div>
        </div>
      </div>
</nav>
    <!-- Navigation end -->