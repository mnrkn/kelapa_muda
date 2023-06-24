<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo get_store_name(); ?></title>

    <link href="<?php echo get_theme_uri('custom/auth/login/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_theme_uri('custom/auth/login/css/fontawesome-all.css'); ?>" rel="stylesheet" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body>
    <h1>Login ke <?php echo get_store_name(); ?></h1>
    <div class="w3l-login-form">
        <h2>Login Akun</h2>
        <?php if ($flash_message) : ?>
            <div class="flash-message">
                <?php echo $flash_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($redirection) : ?>
            <div class="flash-message">
                Silahkan login untuk melanjutkan...
            </div>
        <?php endif; ?>

        <?php echo form_open('auth/login/do_login'); ?>

        <div class="w3l-form-group">
            <label>Username:</label>
            <div class="group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" value="<?php echo set_value('username', $old_username); ?>" class="form-control" placeholder="Username" minlength="4" maxlength="16" required>
            </div>
            <?php echo form_error('username'); ?>
        </div>
        <div class="w3l-form-group">
            <label>Password:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <?php echo form_error('password'); ?>
        </div>
        <div class="forgot">
            <?php echo anchor('auth/forget_password', 'Lupa password?'); ?>
            <p><input type="checkbox" name="remember_me" value="1">Ingat saya</p>
        </div>
        <button type="submit">Login</button>
        <?php echo form_close(); ?>
    </div>

    <footer>
        <p class="copyright-agileinfo">
            &copy; <?php echo date('Y'); ?> <?php echo anchor(base_url(), get_store_name()); ?>
        </p>
    </footer>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Lupa Password</h2>
            <p>Masukkan alamat email Anda untuk mengatur ulang password.</p>
            <?php echo form_open('auth/reset-password'); ?>
            <div class="w3l-form-group">
                <label>Email:</label>
                <div class="group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <?php echo form_error('email'); ?>
            </div>
            <button type="submit">Kirim</button>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script>
        // Modal script
        var modal = document.getElementById('forgot-password-modal');
        var anchor = document.querySelector('a[href="auth/forget_password"]');
        var closeBtn = document.getElementsByClassName("close")[0];

        anchor.onclick = function() {
            modal.style.display = "block";
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
