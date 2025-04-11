<div class="left-side-bar">
	<div class="brand-logo">
		<a href="#">
			<!-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" /> -->
			<h4>DineWise RMS</h4>
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<!-- Accordian Type Menu -->

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-house"></span>
						<span class="mtext">Home</span>
					</a>
					<ul class="submenu">
						<li><a href="../dashboard/dashboard.php">Dashboard</a></li>
						<?php
						if ($_SESSION['usertype'] == 'admin') {
							echo '<li><a href="../registration/approval.php">Request Approval</a></li>';
						}
						?>
					</ul>

				</li>
				<!-- Management navigation -->
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-journal-check"></span>
						<span class="mtext">Manage</span>
					</a>
					<ul class="submenu">
						<li><a href="../table/view-tables.php">Tables</a></li>
						<li><a href="../item/add-category.php">Category</a></li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon dw dw-tea-cup"></span>
								<span class="mtext">Items</span>
							</a>
							<ul class="submenu child">
								<?php
								if ($_SESSION['usertype'] == 'manager') {
									echo "<li><a href='../item/add-item.php'>Add Items</a></li>";
								}
								?>
								<li><a href="../item/items.php">Items Details</a></li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon  dw dw-clipboard1"></span>
						<span class="mtext">Order</span>
					</a>
					<ul class="submenu">
						<li><a href="../order/view-order.php">View order</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-bar-chart-steps"></span>
						<span class="mtext">Reports</span>
					</a>
					<ul class="submenu">
						<li><a href="../report/view-reports.php">View reports</a></li>
					</ul>
				</li>

				<!-- Single Click Naviation
				<li>
					<a href="sitemap.html" class="dropdown-toggle no-arrow">
						<span class="micon bi bi-diagram-3"></span><span class="mtext">Sitemap</span>
					</a>
				</li> -->
				<!-- Small heading for category -->
				<!-- <li>
					<div class="sidebar-small-cap">Extra</div>
				</li>

				<li>
					<a href="sitemap.html" class="dropdown-toggle no-arrow">
						<span class="micon bi bi-diagram-3"></span><span class="mtext">Nothing</span>
					</a>
				</li> -->
			</ul>
		</div>
	</div>
</div>