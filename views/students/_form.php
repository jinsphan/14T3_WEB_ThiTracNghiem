<?php 
$params = (isset($this->record))? array('id'=>$this->record['id']):'';
?>
<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo html_helpers::url(
		array('ctl'=>'students', 
			  'act'=>$this->action, 
			  'params'=>$params
)); ?>">
  <div class="form-group">
    <label for="fullname" class="col-sm-2 control-label">Full Name</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][fullname]" type="text" class="form-control" id="fullname" placeholder="fullname" <?php echo (isset($this->record))? "value='".$this->record['fullname']."'":""; ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][address]" type="text" class="form-control" id="address" placeholder="address" <?php echo (isset($this->record))? "value='".$this->record['address']."'":""; ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][phone]" type="text" class="form-control" id="phone" placeholder="phone" <?php echo (isset($this->record))? "value='".$this->record['phone']."'":""; ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="class" class="col-sm-2 control-label">Class</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][classname]" type="text" class="form-control" id="class" placeholder="class" <?php echo (isset($this->record))? "value='".$this->record['classname']."'":""; ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="photo" class="col-sm-2 control-label">Photo</label>
    <div class="col-sm-10 image-upload">
      <input name="image" type="file" class="form-control" id="photo" placeholder="photo">
	  <?php if (isset($this->record)): ?>
		<img src="<?php echo "media/upload/" .$this->controller.'/'.$this->record['photo']; ?>" alt="<?php echo $this->record['fullname']; ?>" class="img-thumbnail">
	  <?php endif; ?>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button name="btn_submit" type="submit" class="btn btn-default"><?php echo ucwords($this->action); ?></button>
    </div>
  </div>
</form>
<script src="media/js/form.js"></script>