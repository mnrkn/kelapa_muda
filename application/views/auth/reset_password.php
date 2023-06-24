<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo get_store_name(); ?></title>

    <link href="<?php echo get_theme_uri('custom/auth/reset_password/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_theme_uri('custom/auth/reset_password/css/fontawesome-all.css'); ?>" rel="stylesheet" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body>
    <h1>Reset Password untuk <?php echo get_store_name(); ?></h1>
    <div class="w3l-reset-password-form">
        <h2>Reset Password</h2>
        <?php if ($flash_message) : ?>
            <div class="flash-message">
                <?php echo $flash_message; ?>
            </div>
        <?php endif; ?>

        <?php echo form_open('auth/reset_password/update_password'); ?>

        <div class="w3l-form-group">
            <label>Password Baru:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
            </div>
            <?php echo form_error('password'); ?>
        </div>
        <div class="w3l-form-group">
            <label>Konfirmasi Password Baru:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password Baru" required>
            </div>
            <?php echo form_error('confirm_password'); ?>
        </div>
        <input type="hidden" name="resetToken" value="<?php echo $resetToken; ?>">
        <button type="submit">Reset Password</button>
        <?php echo form_close(); ?>
    </div>

    <footer>
        <p class="copyright-agileinfo">
            &copy; <?php echo date('Y'); ?> <?php echo anchor(base_url(), get_store_name()); ?>
        </p>
    </footer>
</body>
</html>
