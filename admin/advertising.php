<?php 
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Реклама</title>
<div class="container">
	<div class="row mb-5">
		<div class="col-12">
			<a href="add_advertising.php"><i class="fas fa-plus"></i> Добавить рекламный баннер</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<ul class="event-list">
				<?php 
					$rez=mysqli_query($con,"SELECT * FROM advertising");
					while($row=mysqli_fetch_assoc($rez)){					
				?>
					<li>						
						<img alt="<?php echo shorten_text($row['name'],20,'',true); ?>" src="<?php echo $row['banner']; ?>" />
						<div class="info">
							<h2 class="title"><a href="edit_advertising.php?id=<?php echo $row['id'];?>"><?php echo shorten_text($row['name'],50,'',true); ?></a></h2>
							<p class="desc"><?php echo shorten_text(strip_tags($row['text']),200,'',true); ?></p>
							<p class="partner_link"> Ссылка на партнера <a target="_blank" href="<?php echo $row['link']; ?>"><?php echo $row['link']; ?></a></p>
						</div>					
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>