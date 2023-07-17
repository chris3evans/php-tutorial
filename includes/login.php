<?php include "db.php";?>

<?php
  if (isset($_POST['login'])) {
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    echo $login_password . $login_username;
  }
?>

<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter Username">
        </div>
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </span>
        </div>
    </form>
</div>

<!-- Blog Categories Well -->
<?php
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($db_connection, $query);
?>

<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                $category_title = $row['category_title'];
                $category_id = $row['category_id'];
            ?>
                <li>
                    <a href='category.php?category=<?php echo $category_id; ?>'>
                        <?php echo $category_title; ?>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>