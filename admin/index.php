<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM posts";
                        $all_posts_query = mysqli_query($db_connection, $query);
                        $number_posts = mysqli_num_rows($all_posts_query);
                    ?>
                                    <div class='huge'><?php echo $number_posts;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Posts</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM comments";
                        $all_comments_query = mysqli_query($db_connection, $query);
                        $number_comments = mysqli_num_rows($all_comments_query);
                    ?>
                                    <div class='huge'><?php echo $number_comments;?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM users";
                        $all_users_query = mysqli_query($db_connection, $query);
                        $number_users = mysqli_num_rows($all_users_query);
                    ?>
                                    <div class='huge'><?php echo $number_users;?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM categories";
                        $all_categories_query = mysqli_query($db_connection, $query);
                        $number_categories = mysqli_num_rows($all_categories_query);
                    ?>
                                        <div class='huge'><?php echo $number_categories;?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Categories</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $all_published_posts_query = mysqli_query($db_connection, $query);
                    $number_published_posts = mysqli_num_rows($all_published_posts_query);
                ?>

                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_drafts_query = mysqli_query($db_connection, $query);
                    $number_draft_posts = mysqli_num_rows($select_all_drafts_query);
                ?>

                <?php
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $select_unapproved_comments_query = mysqli_query($db_connection, $query);
                    $number_unapproved_comments_count = mysqli_num_rows($select_unapproved_comments_query);
                ?>

                <?php
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_all_subscribers_query = mysqli_query($db_connection, $query);
                    $number_subscribers = mysqli_num_rows($select_all_subscribers_query);
                ?>

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                    $element_text = [
                                        'All Posts',
                                        'Active Posts',
                                        'Draft Posts',
                                        'Comments',
                                        'Pending Comments',
                                        'Users',
                                        'Subscribers',
                                        'Categories'
                                    ];

                                    $element_count = [
                                        $number_posts,
                                        $number_published_posts,
                                        $number_draft_posts,
                                        $number_comments, $number_unapproved_comments_count,
                                        $number_users,
                                        $number_subscribers,
                                        $number_categories
                                    ];

                                    for ($i = 0; $i < 8; $i++) {
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                                    // is dynamically creating:
                                    // ['Posts', 4]
                                    // ['Categories', 9] ...
                                ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>