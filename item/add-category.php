<!DOCTYPE html>
<?php
include_once ('../common-functions.php');
include_once ('../functions-manager.php');
connectDB();
$name = '';
$msg = '';


if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);

		$queryGetImagePath = "SELECT category_image FROM item_category WHERE category_id = $id";
		if ($res = mysqli_query($con, $queryGetImagePath)) {
			if (!empty($res) && $res->num_rows > 0) {
				$row = $res->fetch_assoc();
				$image = $row['category_image'];
				$image = str_replace("../item/", "", $image);
				unlink($image);
			} else {
				// echo "No rows found for item_id: $id";
			}
		} else {
			// echo "Error executing query: " . mysqli_error($con);
		}

		$queryDeleteCategory = "DELETE FROM item_category WHERE category_id = $id";
		$queryDeleteItemsFromCategory = "DELETE FROM menu_item WHERE category_id = $id";
		if (mysqli_query($con, $queryDeleteItemsFromCategory)) {
			// echo "Item deleted successfully";
			if (mysqli_query($con, $queryDeleteCategory)) {

			} else {
				// echo "Error deleting item: " . mysqli_error($con);
			}

		}
	} else {
		// echo "<h1>Nothing deleted</h1>";
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = get_safe_value($con, $_POST['categoryName']);

	// Check if category already exists
	$res = mysqli_query($con, "SELECT * FROM item_category WHERE category_name='$name'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		echo "<script>alert('Category already exists.');</script>";
	} else {
		$image = ''; // Initialize image variable

		// Check if image is uploaded
		if ($_FILES['catImage']['type'] != '') {
			// Check if image format is valid
			if ($_FILES['catImage']['type'] != 'image/png' && $_FILES['catImage']['type'] != 'image/jpg' && $_FILES['catImage']['type'] != 'image/jpeg') {
				$msg = "Please select only png, jpg, and jpeg image formats";
			} else {
				// Generate unique image name
				$image = rand(111111111, 999999999) . '_' . $_FILES['catImage']['name'];

				// Move uploaded image to destination directory
				move_uploaded_file($_FILES['catImage']['tmp_name'], '../item/item-image/' . $image);
			}
		}

		$image = '../item/item-image/' . $image;

		mysqli_query($con, "INSERT INTO item_category (category_name, category_image) VALUES ('$name', '$image')");
		echo '<script>alert("Category added successfully!")</script>';

	}
}
?>

<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>RMS HOME</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<style>
		.table {
			table-layout: auto;
		}
	</style>
	<!-- End Google Tag Manager -->
</head>

<body>
	<?php
	include_once "../sidebar.php";
	include_once "../header.php";
	include_once "../right-sidebar.php";

	?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Manage Category</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="#">Category</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Manage Category
									</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<?php
				if ($_SESSION['usertype'] == 'manager') {
					?>
					<!-- Default Basic Forms Start -->
					<div class="pd-20 card-box mb-5">
						<div class="h5 ">Add Category</div>

						<form method="post" action="#" enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-sm-12 col-md-2 col-form-label">Category Name</label>
								<div class="col-sm-12 col-md-10">
									<input class="form-control" type="text" placeholder="Enter name" name="categoryName"
										required value="<?php echo $name ?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-2 col-form-label">Image</label>
								<div class="col-sm-12 col-md-10">
									<input class="form-control" value="50" type="file" name="catImage">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-2 col-form-label"></label>
								<div class="col-sm-12 col-md-10">
									<input type="submit" class="btn btn-primary btn-sm scroll-click" value="Submit">
								</div>
							</div>

							<div class="field_error">
								<?php echo $msg ?>
							</div>
						</form>
					</div>
					<?php
				}
				?>
				<!-- Default Basic Forms End -->
				<div class="pd-20 mt-3 card-box">
					<!--table -->
					<div class="h4">Category List</div>

					<div class="row">
						<div class="table-responsive">
							<table class="data-table table table-auto nowrap dataTable no-footer dtr-inline"
								id="DataTables_Table_0" role="grid">
								<thead>
									<tr role="row">
										<th class="table-plus sorting_asc" tabindex="0"
											aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
											aria-sort="ascending">Image</th>
										<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
											colspan="1">Name</th>
										<th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
											aria-label="Actions">Actions</th>
									</tr>
								</thead>
								<tbody>

									<?php
									// $i = 1;
									// show menu
									$sql = "SELECT * FROM item_category";
									if ($res = mysqli_query($con, $sql)) {
										if (!empty($res) && $res->num_rows > 0) {
											while ($row = mysqli_fetch_assoc($res)) { ?>
												<tr role="row" class="odd">
													<td class="table-plus sorting_1 justify-content-left align-items-right"
														tabindex="0">
														<div class="name-avatar d-flex align-items-center">
															<div class="avatar mr-2 flex-shrink-0">
																<img style="width:70px;height:70px"
																	src="<?php echo $row['category_image'] ?>"
																	class="border-radius-100 shadow" alt="">
															</div>
														</div>
													</td>
													<td>
														<div class="txt">
															<div class="">
																<?php echo $row['category_name'] ?>
															</div>
														</div>
													</td>
													<td>
														<div class="table-actions">
															<?php echo "<a href='update-category.php?categoryId={$row['category_id']}' data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-edit2'></i></a>" ?>
															<?php echo "<a href='?type=delete&id=" . $row['category_id'] . "' data-color='#e95959' style='color: rgb(233, 89, 89);'><i class='icon-copy dw dw-delete-3'></i></a>" ?>
														</div>
													</td>
												</tr>

											<?php }
										} else {
											echo "<tr><td colspan='4'><center><h3>No categories are added.</h3></center></td></tr>";
										}
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					<!--table end-->
				</div>
			</div>
		</div>
	</div>

	<!-- welcome modal end -->
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="../vendors/scripts/datatable-setting.js"></script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
			style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
</body>

</html>