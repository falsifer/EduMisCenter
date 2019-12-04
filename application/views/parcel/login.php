<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Book2018 | Shopping">
	<meta name="author" content="Book2018 | Shopping">

	<!-- App Favicon -->

	<link rel="icon" type="image/png" href="<?php echo base_url(''); ?>assets/images/logo22.png" />
	<!-- App title -->
	<title>โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0</title>

	<!-- App CSS -->
	<link href="<?php echo base_url(''); ?>assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url(''); ?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="<?php echo base_url(''); ?>https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(''); ?>assets/js/modernizr.min.js"></script>

</head>


<body>

	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">

		<div class="account-bg">
			<div class="card-box m-b-0">
				<div class="text-xs-center m-t-20">
					<a href="index.html" class="logo">
						<img src="<?php echo base_url(''); ?>assets/images/logo22.png">

					</a>
				</div>
				<div class="m-t-30 m-b-20">
					<div class="col-xs-12 text-xs-center">
						<h6 class="text-muted text-uppercase m-b-0 m-t-0">Admin Sign In</h6>
					</div>
					<?php 
					$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'myform');
					echo form_open('home/login', $attributes);
					?>

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="username" placeholder="Username">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" name="password" placeholder="Password">
							</div>
						</div>



						<div class="form-group text-center m-t-30">
							<div class="col-xs-12">
								<button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
							</div>
						</div>
					</form>
					<div class="form-group m-t-30 m-b-0">
						<div class="col-sm-12">
							<a href="" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
						</div>
					</div>

					<div class="form-group m-t-30 m-b-0">
						<div class="col-sm-12 text-xs-center">
							<h5 class="text-muted"><b>Sign in with</b></h5>
						</div>
					</div>

					<div class="form-group m-b-0 text-xs-center">
						<div class="col-sm-12">
							<button type="button" class="btn btn-facebook waves-effect waves-light m-t-20">
								<i class="fa fa-facebook m-r-5"></i> Facebook
							</button>

							<button type="button" class="btn btn-twitter waves-effect waves-light m-t-20">
								<i class="fa fa-twitter m-r-5"></i> Twitter
							</button>

							<button type="button" class="btn btn-googleplus waves-effect waves-light m-t-20">
								<i class="fa fa-google-plus m-r-5"></i> Google+
							</button>
						</div>
					</div>



				</div>
			</div>
		</div>
		<!-- end card-box-->

		<div class="m-t-20">
			<div class="text-xs-center">
				<p class="text-white">Don't have an account? <a href="pages-register.html" class="text-white m-l-5"><b>Sign Up</b></a></p>
			</div>
		</div>

	</div>
	<!-- end wrapper page -->


	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<!-- jQuery  -->
	<script src="<?php echo base_url(''); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(''); ?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
	<script src="<?php echo base_url(''); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(''); ?>assets/js/waves.js"></script>
	<script src="<?php echo base_url(''); ?>assets/js/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url(''); ?>assets/plugins/switchery/switchery.min.js"></script>

	<!-- App js -->
	<script src="<?php echo base_url(''); ?>assets/js/jquery.core.js"></script>
	<script src="<?php echo base_url(''); ?>assets/js/jquery.app.js"></script>

</body>
</html>