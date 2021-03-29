
<section class="admin-wrap d-flex justify-content-start">
      <!-- Sidebar -->
      <?php get_sidebar('dashboard'); ?>
      <div class="admin-content-wrap">
        <div class="container">
          <div class="d-section-heading">
            <i class="far fa-ellipsis-v"></i> 
            Contact List - <?php echo auth()->user()->name; ?>
          </div>
          <!-- Contents start -->
          <?php view('backend.dashboard.list'); ?>
        </div>
      </div>
    </section>