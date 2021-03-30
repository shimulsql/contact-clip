<!-- Navigation end -->
<section class="custom-input-form-wrap auth-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            <form action="" id="login-form" class="custom-input-form bg-white animate__animated">
                <div class="d-flex justify-content-center">
                <div class="left-icon-card">
                    <div class="icon">
                        <i class="fal fa-key"></i>
                    </div>
                    <div class="body">
                        <h4 class="title">Login</h4>
                        <p class="content">Enter your credenticals</p>
                    </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="text" name="email" id="login-email" placeholder="Email" class="form-control"> 
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password" id="login-password" placeholder="Password" class="form-control">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i style="cursor: pointer;" id="show-password" class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-check form-check-inline mb-2">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>
                <div class="form-group">
                    <input type="submit" id="login-button" class="btn btn-primary btn-block" value="Login">
                </div>

                <div class="form-group">
                    <i class="fal fa-sad-tear"></i> <a href="<?php _e(URLROOT); ?>register.php">No account? Register</a>
                </div>
            </form>
            <div class="display-response alert mt-2"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .display-response{
        display: none;
    }
</style>