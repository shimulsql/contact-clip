<section class="custom-input-form-wrap auth-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            <form action="" class="custom-input-form bg-white">
                <div class="d-flex justify-content-center">
                    <div class="left-icon-card">
                        <div class="icon">
                        <i class="fal fa-key"></i>
                        </div>
                        <div class="body">
                        <h4 class="title">Register</h4>
                        <p class="content">Fill out to register</p>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="text" name="name" id="" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                        </div>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="c-password" id="" placeholder="Confirm Password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Register">
                </div>
                <div class="form-group">
                    <i class="fal fa-smile-beam"></i> <a href="<?php _e(URLROOT); ?>login.php">Have an account? Login</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>