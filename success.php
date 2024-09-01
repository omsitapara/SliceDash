<?php
include 'header.php';
if(!isset($_SESSION['ORDER_ID'])){
    redirect('shop');
}
?>
        <div class="about-us-area pt-50 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-7 d-flex align-items-center">
                        <div class="overview-content-2">
                            <h2>Order Received <span>#<?php echo $_SESSION['ORDER_ID']?></span></h2>
                            <p class="paragraph-blog">We have successfully received your order. Just some more moments before Hapiness gets delivered to your Home.</p>
                            <div class="overview-btn mt-45">
                                <a class="btn-style-2" href="order_history">My Orders</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

<?php
unset($_SESSION['ORDER_ID']);
include 'footer.php';
?>