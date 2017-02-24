 <?php if(count($breadcrumbs)){ ?>
 <div class="page-bar">
	<ul class="page-breadcrumb">
		<?php foreach($breadcrumbs as $brd){ ?>
		<li>
			<?php if(isset($brd['icon_class'])){ ?>
			<i class="fa <?php  echo $brd['icon_class'] ; ?>"></i>
			<?php } ?>
			<a href="<?php echo isset($brd['link'])? $brd['link']:""; ?>"><?php echo $brd['text']; ?></a>
			<?php if(end($breadcrumbs)!=$brd){ ?>
			<i class="fa fa-angle-right"></i>
			<?php } ?>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?>
