<?php
include 'header.php';
?>
<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="post">
                                <?php
                                    $cartArr=getUserFullCart();
                                    if(count($cartArr)>0){
                                ?>
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Until Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($cartArr as $key=>$list){
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="javascript:void(0)"><img width="100px" src="<?php echo SITE_DISH_IMAGE.$list['image']?>" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"><?php echo $list['dish']?></a></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo "₹".$list['price']?></span></td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="qty[<?php echo $key?>][]" value="<?php echo $list['qty']?>">
                                                </div>
                                            </td>
                                            <td class="product-subtotal"><?php echo "₹".$list['qty']*$list['price'] ?></td>
                                            <td class="product-remove">
                                            <a href="javascript:void(0)" onclick="delete_cart('<?php echo $key?>','load')"><i class="fa fa-times"></i></a>
                                           </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else{
                                echo "Your Cart is Empty. Go add something Tastyyyyyy.";
                            } ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="shop">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <button name="update_cart">Update Shopping Cart</button>
                                            <a href="checkout">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
include 'footer.php'?>