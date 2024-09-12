<?php 
include 'header.php';
$sweet_sql="select * from dish where status='1' and taste='sweet' order by dish";
$sweet_res=mysqli_query($con,$sweet_sql);
$sweet_count=mysqli_num_rows($sweet_res);
$sour_sql="select * from dish where status='1' and taste='sour' order by dish";
$sour_res=mysqli_query($con,$sour_sql);
$sour_count=mysqli_num_rows($sour_res);
$spicy_sql="select * from dish where status='1' and taste='spicy' order by dish";
$spicy_res=mysqli_query($con,$spicy_sql);
$spicy_count=mysqli_num_rows($spicy_res);
$bitter_sql="select * from dish where status='1' and taste='bitter' order by dish";
$bitter_res=mysqli_query($con,$bitter_sql);
$bitter_count=mysqli_num_rows($bitter_res);
$savoury_sql="select * from dish where status='1' and taste='savoury' order by dish";
$savoury_res=mysqli_query($con,$savoury_sql);
$savoury_count=mysqli_num_rows($savoury_res);
?>

<h4 style="color:red">Choose items according to your taste Pallette </h4>
<button type="button" class="collapsible" style="margin-top:16px">Sweet</button>
<div class="content">
<div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($sweet_count>0){?>
                                    <div class="row">
                                        <?php while($sweet_row=mysqli_fetch_assoc($sweet_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$sweet_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
                                                        <?php 
                                                        if($sweet_row['type']=='veg'){
                                                             echo"<img src = 'assets/img/vegmark.png' height = '10px'> &nbsp;";   
                                                        }
                                                        else{
                                                            echo"<img src = 'assets/img/nonvegmark.png' height='12px'> &nbsp;";
                                                        }
                                                        ?><a href="javascript:void(0)"><?php echo $sweet_row['dish']?> </a>
                                                    </h4>
                                                    <?php
                                                        $dish_attr_res=mysqli_query($con,"select * from dish_details where status=1 and dish_id='".$sweet_row['id']."' order by price asc")
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															echo "<input type='radio' class='dish_radio' id='radio_".$sweet_row['id']."' name='radio_".$sweet_row['id']."' value='".$dish_attr_row['id']."'/>";
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
                                                            $added_msg='';
															echo "<span class='price'>(₹ ".$dish_attr_row['price'].")</span>";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "<br>";
														}
														?>
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $sweet_row['id']?>">
                                                            <option value="0">Quantity</option>
                                                            <?php
                                                                for($i=1;$i<11;$i++){
                                                                    echo "<option>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $sweet_row['id']?>','add')"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
</div>
<button type="button" class="collapsible" style="margin-top:16px">Sour</button>
<div class="content">
<div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($sour_count>0){?>
                                    <div class="row">
                                        <?php while($sour_row=mysqli_fetch_assoc($sour_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$sour_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
                                                        <?php 
                                                        if($sour_row['type']=='veg'){
                                                             echo"<img src = 'assets/img/vegmark.png' height = '10px'> &nbsp;";   
                                                        }
                                                        else{
                                                            echo"<img src = 'assets/img/nonvegmark.png' height='12px'> &nbsp;";
                                                        }
                                                        ?><a href="javascript:void(0)"><?php echo $sour_row['dish']?> </a>
                                                    </h4>
                                                    <?php
                                                        $dish_attr_res=mysqli_query($con,"select * from dish_details where status=1 and dish_id='".$sour_row['id']."' order by price asc")
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															echo "<input type='radio' class='dish_radio' id='radio_".$sour_row['id']."' name='radio_".$sour_row['id']."' value='".$dish_attr_row['id']."'/>";
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
                                                            $added_msg='';
															echo "<span class='price'>(₹ ".$dish_attr_row['price'].")</span>";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "<br>";
														}
														?>
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $sour_row['id']?>">
                                                            <option value="0">Quantity</option>
                                                            <?php
                                                                for($i=1;$i<11;$i++){
                                                                    echo "<option>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $sour_row['id']?>','add')"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
</div>
<button type="button" class="collapsible" style="margin-top:16px">Spicy</button>
<div class="content">
<div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($spicy_count>0){?>
                                    <div class="row">
                                        <?php while($spicy_row=mysqli_fetch_assoc($spicy_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$spicy_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
                                                        <?php 
                                                        if($spicy_row['type']=='veg'){
                                                             echo"<img src = 'assets/img/vegmark.png' height = '10px'> &nbsp;";   
                                                        }
                                                        else{
                                                            echo"<img src = 'assets/img/nonvegmark.png' height='12px'> &nbsp;";
                                                        }
                                                        ?><a href="javascript:void(0)"><?php echo $spicy_row['dish']?> </a>
                                                    </h4>
                                                    <?php
                                                        $dish_attr_res=mysqli_query($con,"select * from dish_details where status=1 and dish_id='".$spicy_row['id']."' order by price asc")
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															echo "<input type='radio' class='dish_radio' id='radio_".$spicy_row['id']."' name='radio_".$spicy_row['id']."' value='".$dish_attr_row['id']."'/>";
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
                                                            $added_msg='';
															echo "<span class='price'>(₹ ".$dish_attr_row['price'].")</span>";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "<br>";
														}
														?>
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $spicy_row['id']?>">
                                                            <option value="0">Quantity</option>
                                                            <?php
                                                                for($i=1;$i<11;$i++){
                                                                    echo "<option>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $spicy_row['id']?>','add')"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
</div>
<button type="button" class="collapsible" style="margin-top:16px">Bitter</button>
<div class="content">
<div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($bitter_count>0){?>
                                    <div class="row">
                                        <?php while($bitter_row=mysqli_fetch_assoc($bitter_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$bitter_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
                                                        <?php 
                                                        if($bitter_row['type']=='veg'){
                                                             echo"<img src = 'assets/img/vegmark.png' height = '10px'> &nbsp;";   
                                                        }
                                                        else{
                                                            echo"<img src = 'assets/img/nonvegmark.png' height='12px'> &nbsp;";
                                                        }
                                                        ?><a href="javascript:void(0)"><?php echo $bitter_row['dish']?> </a>
                                                    </h4>
                                                    <?php
                                                        $dish_attr_res=mysqli_query($con,"select * from dish_details where status=1 and dish_id='".$bitter_row['id']."' order by price asc")
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															echo "<input type='radio' class='dish_radio' id='radio_".$bitter_row['id']."' name='radio_".$bitter_row['id']."' value='".$dish_attr_row['id']."'/>";
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
                                                            $added_msg='';
															echo "<span class='price'>(₹ ".$dish_attr_row['price'].")</span>";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "<br>";
														}
														?>
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $bitter_row['id']?>">
                                                            <option value="0">Quantity</option>
                                                            <?php
                                                                for($i=1;$i<11;$i++){
                                                                    echo "<option>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $bitter_row['id']?>','add')"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
</div>
<button type="button" class="collapsible" style="margin-top:16px">Savoury</button>
<div class="content">
<div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($savoury_count>0){?>
                                    <div class="row">
                                        <?php while($savoury_row=mysqli_fetch_assoc($savoury_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$savoury_row['image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
                                                        <?php 
                                                        if($savoury_row['type']=='veg'){
                                                             echo"<img src = 'assets/img/vegmark.png' height = '10px'> &nbsp;";   
                                                        }
                                                        else{
                                                            echo"<img src = 'assets/img/nonvegmark.png' height='12px'> &nbsp;";
                                                        }
                                                        ?><a href="javascript:void(0)"><?php echo $savoury_row['dish']?> </a>
                                                    </h4>
                                                    <?php
                                                        $dish_attr_res=mysqli_query($con,"select * from dish_details where status=1 and dish_id='".$savoury_row['id']."' order by price asc")
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															echo "<input type='radio' class='dish_radio' id='radio_".$savoury_row['id']."' name='radio_".$savoury_row['id']."' value='".$dish_attr_row['id']."'/>";
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
                                                            $added_msg='';
															echo "<span class='price'>(₹ ".$dish_attr_row['price'].")</span>";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "<br>";
														}
														?>
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $savoury_row['id']?>">
                                                            <option value="0">Quantity</option>
                                                            <?php
                                                                for($i=1;$i<11;$i++){
                                                                    echo "<option>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $savoury_row['id']?>','add')"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
</div>
<script>
    var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activee");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<?php include 'footer.php'?>