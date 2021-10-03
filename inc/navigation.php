	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color:black;">
      <div class="container-fluid">
		<img src="logo.jpg " style="width:40px; height:40px; border-radius:20px; ">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>" style="padding-left:10px; color:white;">Sales & Inventory System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
			<!-- <li class="nav-item">
				<form class="form-inline" action="/action_page.php">
					<input class="form-control col-md-8 mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-success" type="submit">Search</button>
				</form>
			</li> -->
			<li class="nav-item">
				<span class="nav-link" style="color:white;">Welcome <?php echo $_SESSION['fullName']; ?></span>
            </li>
			<li class="nav-item">
				<span class="nav-link"  style="color:white;"> | </span>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="model/login/logout.php"  style="color:white;">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>