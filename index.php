<?php
include'db.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

    <!-- Hero section -->
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/bg_1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 text-white">
                            <span>We are best car repair services</span>
                            <p>Make your car last longer </p>
                            <a href="#" class="site-btn sb-line">BOOK APPOINTMENT</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="hs-item set-bg" data-setbg="img/bg_2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 text-white">
                            <span>We care about your car</span>
                            <p>It's time to come to repair your car </p>
                            <a href="#" class="site-btn sb-line">BOOK APPOINTMENT</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

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

    <!-- letest product section -->
    <section class="top-letest-product-section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Featured Spare Parts</h2>
            </div>
            <div class="product-slider owl-carousel">
                <?php
                $query = mysqli_query($con, "SELECT * FROM parts") or die(mysqli_error());
                while($fetch = mysqli_fetch_array($query)){
                    $brand = $fetch['brand'];
                    ?>
                <div class="product-item">
                    <img src="img/<?php echo $fetch['p_image'] ?>" alt="">
                    <div class="pi-text">
                        <h6>Ksh <?php echo $fetch['price'] ?></h6>
                        <p> <?php echo $fetch['p_name'] ?><br>
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM car WHERE car_id='$brand'") or die(mysqli_error());
                            $row = mysqli_fetch_array($sql);

                            echo '<b>'.$row['car_name'].'</b>' ?>
                        </p>
                    </div>
                </div>
                    <?php
                }
                    ?>
            </div>
            <div class="text-center pt-5">
                <button class="site-btn sb-line sb-dark">LOAD MORE</button>
            </div>
        </div>
    </section>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
