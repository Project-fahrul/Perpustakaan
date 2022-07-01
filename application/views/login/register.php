<div class="register-box">
    <div class="register-logo">
        <a href="/">Register new admin Perpustakaan Bersama</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new admin</p>

            <form action="<?php echo $this->config->config['base_url'] . 'login/register'; ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Full name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nim" placeholder="NIM" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="kelas" placeholder="Kelas" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="prodi" placeholder="Prodi" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" required name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" required name="re-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" required name="terms" value="agree" required>
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <a href="<?php echo $this->config->config['base_url'] ?>" class="text-center">I already have a membership</a>
        </div>
    </div>