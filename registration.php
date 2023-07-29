<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
    if (isset($_POST['submit'])) {
        $registration_username = $_POST['username'];
        $registration_email = $_POST['email'];
        $registration_password = $_POST['password'];

        if (!empty($registration_username) &&
            !empty($registration_email) &&
            !empty($registration_password)) {

            $registration_username = mysqli_escape_string($db_connection, $registration_username);
            $registration_email = mysqli_escape_string($db_connection, $registration_email);
            $registration_password = mysqli_escape_string($db_connection, $registration_password);

            $query = "SELECT rand_salt FROM users";
            $select_salt_query = mysqli_query($db_connection, $query);

            if (!$select_salt_query) {
                die("Failed to fetch salt" . mysqli_error($db_connection));
            }

            $row = mysqli_fetch_assoc($select_salt_query);

            $salt = $row['rand_salt'];
            $password = crypt($registration_password, $salt);

            $query = "INSERT INTO users (
                user_name,
                user_email,
                user_password,
                user_role) VALUES (
                '{$registration_username}',
                '{$registration_email}',
                '{$password}',
                'subscriber')";
            $create_user_query = mysqli_query($db_connection, $query);

            if (!$create_user_query) {
                die("Failed to create new user" . mysqli_error($db_connection));
            }
            $message = "Registration has been submitted";

        } else {
            $message = "Fields cannot be empty";
        }
    }
?>


    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center">
                            <?php if(!empty($message)) { echo $message; }?>
                        </h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
