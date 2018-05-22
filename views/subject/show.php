<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="home-container">
	<div class="container">
		<div class="home-content">
			<?php foreach($this->data as $key => $value) { ?>
				<?php if($key % 2 == 0) { ?>
					<div class="row">
						<?php
							$quiz = $value;
						?>
							<?php include("examitem.php") ?>
						<?php if(isset($this->data[$key + 1])) {
							$quiz = $this->data[$key + 1];
						?>				
							<?php include("examitem.php") ?>			
						<?php } ?>
					</div>
					<br>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>