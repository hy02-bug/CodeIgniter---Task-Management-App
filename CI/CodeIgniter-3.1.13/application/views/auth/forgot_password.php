<h1>Forgot Password</h1>
<?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="<?php echo site_url('auth/forgot_password'); ?>">
    <p><label>Email:</label><input type="email" name="email" required></p>
    <button type="submit">Reset Password</button>
</form>
<p><a href="<?php echo site_url('auth/login'); ?>">Back to Login</a></p>
