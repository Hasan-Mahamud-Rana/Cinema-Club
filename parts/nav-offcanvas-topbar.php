<div class="row" data-equalizer data-equalize-on="medium" id="tbar">
	<div id="top-bar-menu" class="top-bar" >
		<div class="small-12 logo show-1024">
			<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
		</div>
		<div class="small-6 medium-2 large-5 top-bar-left float-left columns" data-equalizer-watch>
			<a class="menuText" data-open="menuModalMain">Menu</a>
		</div>
		<div class="small-12 medium-4 large-2 logo columns hide-1024" data-equalizer-watch>
			<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
		</div>
		<div class="small-6 medium-6 large-5 top-bar-right columns" data-equalizer-watch>
		<?php
			$customerid = get_customerid();
				if ($customerid == NULL || $customerid  == ' ') {
					joints_login_nav();
			} else {
			$userDetails = get_user_info($customerid);
			$firstname = $userDetails->firstname;
			$lastname = $userDetails->lastname;
			$lottery_tickets_amount_sum = $userDetails->lottery_tickets_amount_sum;
			$user_picture_url = $userDetails->user_picture_url;
		?>

			<ul class="dropdown menu float-right" data-dropdown-menu>
				<li><a class="topBarTicket" href="<?php echo site_url(); ?>/my-lottery-tickets/"></a></li>
				<li><a class="nav-message topBarMessage" href="<?php echo site_url(); ?>/messages/"></a></li>
				<li>
					<a class="headerUserNav" href="#">
						<img class="myImage" src="<?php echo $user_picture_url; ?>" alt="User Picture" />
						<?php
						echo '<p class="myName">' . $firstname . ' ' . $lastname . '</p>';
						?>
					</a>
					<ul class="menu headerUserSubNav">
						<li><a href="<?php echo site_url(); ?>/profile/personal-information/">Min profil</a></li>
						<li><a href="<?php echo site_url(); ?>/profile/notifications/">Skift indstillinger</a></li>
						<li><a href="<?php echo site_url(); ?>/logout/">Log ud</a></li>
					</ul>
				</li>
			</ul>
			<?php } ?>
		</div>
		<!--div class="top-bar-left float-left show-for-small-only">
			<ul class="menu">
				<li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li>
				<li><a data-toggle="off-canvas"><?php //_e( 'Menu', 'jointswp' ); ?></a></li>
			</ul>
		</div-->
	</div>
</div>