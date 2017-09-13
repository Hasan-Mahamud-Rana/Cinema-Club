<?php
$basketCartNumber = $_COOKIE['basketCartNumber'];
$basketFlexCartNumber = $_COOKIE['basketFlexCartNumber'];
?>
<div id="cart-content" class="row">
		<div class="small-6 medium-6 large-6 columns text-left">
			<p class="cart"><a href="<?php echo site_url(); ?>/purchase/basket/"><span class="cartText">Indkøbskurv</span><span class="cartValue"><?php echo $basketFlexCartNumber . $basketCartNumber ;?></span></a></p>
		</div>
		<div class="small-6 medium-6 large-6 columns text-right">
       <form action="<?php echo site_url(); ?>/purchase/success/" method="POST">
       <input type="hidden" name="resetCart" value="1" />
       <input class="resetCart callSpin" type="submit" value="Tøm kurv">
       </form>
 		</div>
</div>