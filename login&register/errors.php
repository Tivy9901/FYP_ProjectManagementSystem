<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>

<?php if(isset($_SESSION['msg'])) {?> 
	<div class="error">
	<p><?php echo $_SESSION['msg'] ?></p>
	</div>
<?php 
  unset($_SESSION['msg']);
}; 
?>

<?php if(isset($_SESSION['error_msg'])) {?> 
	<div class="error">
	<p><?php echo $_SESSION['error_msg'] ?></p>
	</div>
<?php 
  unset($_SESSION['error_msg']);
}; 
?>
<?php if(isset($_SESSION['disable'])) {?> 
	<div class="error">
	<p><?php echo $_SESSION['disable'] ?></p>
	</div>
<?php 
  unset($_SESSION['disable']);
}; 
?>
