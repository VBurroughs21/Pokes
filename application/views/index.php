<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/welcome.css') ?>"/>
        
        <title>Login/Registration</title>

    </head>
    <body>
        <h1>Welcome!</h1>
        <div>
            <form method="post" action="/users/create">
                <fieldset>
                    <legend>Register</legend>
<?php       if ($this->session->flashdata('reg_error')) {
                echo $this->session->flashdata('reg_error'). "<br>";
            }
?>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    <label for="alias">Alias:</label>
                    <input type="text" id="alias" name="alias">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <label for="con_password">Password Confirmation:</label>
                    <input type="password" id="con_password" name="con_password">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob">
                    <button type="submit" class="btn btn-success">Register</button>
                </fieldset>
            </form>
        </div>



        <div>
            <form method="post" action="/sessions/get_user">
                <fieldset>
                    <legend>Login</legend>
<?php       if ($this->session->flashdata('login_error')) {
                echo $this->session->flashdata('login_error');
            }
?>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <button type="submit" class="btn btn-primary">Login</button>
                </fieldset>
            </form>
        </div>
    </body>
</html>