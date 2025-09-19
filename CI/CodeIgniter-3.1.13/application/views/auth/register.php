<h1>Register</h1>
<form method="post" action="<?php echo site_url('auth/register'); ?>">
    <p><label>Username:</label><input type="text" name="username" required></p>
    <p><label>Email:</label><input type="email" name="email" required></p>
    <p><label>Password:</label><input type="password" name="password" required></p>
    <button type="submit">Register</button>
</form>
<p><a href="<?php echo site_url('auth/login'); ?>">Back to Login</a></p>
