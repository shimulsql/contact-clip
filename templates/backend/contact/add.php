<?php
  $pageActive = 'contact';
?>
<section class="admin-wrap d-flex justify-content-start">
      <!-- Sidebar -->
      <?php get_sidebar('contact') ?>
      <div class="admin-content-wrap">
        <div class="container">
          <div class="d-section-heading">
            <i class="far fa-ellipsis-v"></i> 
            Add Contact
          </div>
          <!-- Contents start -->
          <div class="custom-input-form-wrap ">
            <div class="container">
              <div class="admin-content bg-white">
                <form class="custom-input-form" id="form-contact-create" method="POST">
                  <div class="row">
                    <div class="col-md-8 col-sm-12 order-2 order-md-1">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile">
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="row form-group">
                        <div class="col-md-6">
                          <label for="group">Select Group</label>
                          <select class="custom-select form-control" id="group" name="group_id">
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                          <label for="blood-group">Select Blood Group</label>
                          <select name="blood_group" class="custom-select form-control" id="blood-group">
                            <option selected value="NULL">Blood group</option>
                            <option value="a+">A+</option>
                            <option value="b+">B+</option>
                            <option value="ab+">AB+</option>
                            <option value="o+">O+</option>
                            <option value="a-">A-</option>
                            <option value="b-">B-</option>
                            <option value="ab-">AB-</option>
                            <option value="o-">O-</option>
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="">
                        <input type="submit" value="Add to contact" class="btn btn-primary btn-block">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 order-1 order-md-2 user-avatar">
                      <div>Avatar</div>
                      <img id="avatar-show" class="avatar-image" src="<?= get_asset_path()?>images/avatar-blank.png" alt="">
                      <input type="file" name="image" id="avatar-contact" class="d-none">
                      <div class="invalid-feedback mb-3"></div>
                      <div class="upload-buttons-wrap">
                        <label for="avatar-contact" id="choose-contact-avatar" class="btn btn-primary">
                          <i class="fas fa-file-upload"></i>
                        </label>
                        <button class="btn btn-danger" id="remove-contact-avatar">
                          <i class="fas fa-file-times"></i>
                        </button>
                      </div>
                      <div class="display-response mt-4"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>