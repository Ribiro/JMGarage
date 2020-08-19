<?php
include 'db.php';
include 'includes/header.php';
include 'includes/nav.php';
?>


    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <div class="site-pagination">
                <a href="">Home</a> /
                <a href="">Services</a>
            </div>
        </div>
    </div>
    <!-- Page info end -->

    <!--Our services section-->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Our Services</h2>
                </div>
            </div>
            <div class="row">
                <?php
                $n = 0;
                $n++;
                $query = mysqli_query($con, "SELECT * FROM service") or die(mysqli_error());
                while ($fetch = mysqli_fetch_array($query)) {
                    ?>
                    <div class="col-md-4 services ftco-animate">
                        <div class="d-block d-flex">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span><?php echo $n++ ?></span>
                            </div>
                            <div class="media-body pl-3">
                                <h3 class="heading"><?php echo $fetch['name']?></h3>
                                <p><?php echo $fetch['info']?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>




<?php
include 'includes/footer.php';
include 'includes/scripts.php';
