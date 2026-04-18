<!-- sidebar menu -->
<?php 
	$admin_sql = "SELECT * From admin WHERE loginname = '".$_SESSION['login']."'";
// 	echo $admin_sql;exit;
	$admin_result = mysqli_query($con, $admin_sql);
	$admin_row = mysqli_fetch_array($admin_result);
	// echo $admin_row['admintype'].' - '.$admin_row['username']; exit;
	?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>
		<ul class="nav side-menu">
			<!--<li><a href="dashboard"><i class="fa fa-home"></i> Dashboard</a></li>-->
			<li><a href="author"><i class="fa fa-user"></i> Author</a></li>
			<li><a href="books"><i class="fa fa-book"></i> Books</a></li>
			<li><a href="articles"><i class="fa fa-inbox"></i> Articles</a></li>
			<li><a href="book-lunch"><i class="fa fa-calendar"></i> Book Launch Event</a></li>
			<li><a href="book-reviews"><i class="fa fa-thumbs-up"></i> Book Reviews</a></li>
			
				<li><a><i class="fa fa-image"></i> Gallery <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="gallery.php?p=photos">Photos</a></li>
					<li><a href="gallery?p=videos">Videos</a></li>
				</ul>
			</li>

			
			<li><a><i class="fa fa-table"></i> Conatct Us Queries <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="unread-queries">Unread Query</a></li>
					<li><a href="read-query">Read Query</a></li>
				</ul>
			</li>
			
			<li><a href="user-logs"><i class="fa fa-line-chart"></i> User Session Logs</a></li>
			
			<!--<li><a href="patient-search"><i class="fa fa-hospital-o"></i> Search</a></li>-->
			

		</ul>
	</div>
	<div class="menu_section">
		<h3>User</h3>
		<ul class="nav side-menu">
			<li><a href="change-password"><i class="fa fa-key"></i> Change Password</a></li>
			<li><a href="logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
		</ul>
	</div>
</div>