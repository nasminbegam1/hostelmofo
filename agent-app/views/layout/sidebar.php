		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<!--<li class="start <?php //echo $menu == 'dashboard'? 'active open':""; ?>">
						<a href="<?php //echo base_url('dashboard'); ?>">
						<i class="icon-home"></i>
						<span class="title">Dashboard</span>
						<?php //if($menu=='dashboard') {?>
						<span class="selected"></span>
						<span class="arrow open"></span>
						<?php //} ?>
						</a>
					</li>-->
					<li class="<?php echo $menu == 'property'? 'active open':""; ?>">
						<a href="<?php echo base_url('property/'); ?>">
						<i class="fa fa-wrench"></i>
						<span class="title">Property Setup</span>
						<?php if($menu=='property') {?>
						<span class="selected"></span>
						<span class="arrow open"></span>
						<?php } ?>
						</a>
					</li>
					<li class="<?php echo $menu == 'enquiry'? 'active open':""; ?>">
						<a href="<?php echo base_url('enquiry/'); ?>">
						<i class="icon-briefcase"></i>
						<span class="title">Enquiry</span>
						<?php if($menu=='enquiry') {?>
						<span class="selected"></span>
						<span class="arrow open"></span>
						<?php } ?>
						</a>
						
					</li>
					<!--<li class="<?php echo $menu == 'booking'? 'active open':""; ?>">
						<a href="<?php echo base_url('booking/'); ?>">
						<i class="fa fa-bookmark"></i>
						<span class="title">Booking</span>
						<?php if($menu=='booking') {?>
						<span class="selected"></span>
						<span class="arrow open"></span>
						<?php } ?>
						</a>
						
					</li>-->
					<!--<li class="<?php //echo $menu == 'room_type'? 'active open':""; ?>">
						<a href="<?php //echo base_url('room_type/'); ?>">
						<i class="fa fa-home"></i>
						<span class="title">Room Type</span>
						<?php //if($menu=='room_type') {?>
						<span class="selected"></span>
						<span class="arrow open"></span>
						<?php //} ?>
						</a>
						
					</li>-->
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
