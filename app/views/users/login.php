<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid" style="">
	<div class="row align-items-center" style="height: 100vh;">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-light mt-5">
				<h2>Create an account</h2>
				<p>Please fill out this form to register</p>
				<form action="<?php echo URLROOT; ?>/users/login" method="post">
					<div class="form-group"><label for="user_name">User name: <sup>*</sup></label>
						<input type="text" name="user_name" value="<?php echo $data['user_name']; ?>" class="form-control form-control-md <?php echo (!empty($data['user_name_err'])) ? 'is-invalid' : ''; ?>">
						<span class="invalid-feedback"><?php echo $data['user_name_err']; ?></span>
					</div>
					<div class="form-group"><label for="user_password">Password: <sup>*</sup></label>
						<input type="password" name="user_password" value="<?php echo $data['user_password']; ?>" class="form-control form-control-md <?php echo (!empty($data['user_password_err'])) ? 'is-invalid' : ''; ?>">
						<span class="invalid-feedback"><?php echo $data['user_password_err']; ?></span>
					</div>
					<div class="row">
						<div class="col">
							<input type="submit" value="Login" name="login" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">Have no account? Register</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>