<?php
	session_start();
	// Redirect the user to login page if he is not logged in.
	if(!isset($_SESSION['loggedIn'])){
		header('Location: login.php');
		exit();
	}
	
	require_once('inc/config/constants.php');
	require_once('inc/config/db.php');
	require_once('inc/header.html');
?>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>

  <body>
<?php
	require 'inc/navigation.php';
?>
    <!-- Page Content -->
    <div class="container-fluid">
	  <div class="row">
		<div class="col-lg-2">
		<h1 class="my-4"></h1>
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
			  <a class="nav-link active" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="true" >Item</a>
			  <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase" role="tab" aria-controls="v-pills-purchase" aria-selected="false">Purchase</a>
			  <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab" aria-controls="v-pills-vendor" aria-selected="false">Vendor</a>
			  <a class="nav-link" id="v-pills-sale-tab" data-toggle="pill" href="#v-pills-sale" role="tab" aria-controls="v-pills-sale" aria-selected="false">Sale</a>
			  <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="false">Customer</a>
			  <a class="nav-link" id="v-pills-search-tab" data-toggle="pill" href="#v-pills-search" role="tab" aria-controls="v-pills-search" aria-selected="false">Search</a>
			  <a class="nav-link" id="v-pills-reports-tab" data-toggle="pill" href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false">Reports</a>
			</div>
		</div>
		 <div class="col-lg-10">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:pink;color:purple;font-weight:bold; font-family:'Russo One'; ">Item Details</div>
				  <div class="card-body">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemDetailsTab" style="font-weight:bold; font-family:'Russo One' ">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#itemImageTab"  style="font-weight:bold; ">Upload Image</a>
						</li>
					</ul>
					
					<!-- Tab panes for item details and image sections -->
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemDetailsMessage"></div>
							<form>
							  <div class="form-row">
								<div class="form-group col-md-3" style="display:inline-block">
								  <label for="itemDetailsItemNumber" style="font-weight:bold; color:black;">Item Number<span class="requiredIcon">*</span></label>
								  <input type="text" class="form-control" name="itemDetailsItemNumber" id="itemDetailsItemNumber" autocomplete="off" style="border:2px solid black;">
								  <div id="itemDetailsItemNumberSuggestionsDiv" class="customListDivWidth"></div>
								</div>
								<div class="form-group col-md-3">
								  <label for="itemDetailsProductID" style="font-weight:bold; color:black;">Product ID</label>
								  <input class="form-control invTooltip" type="number" readonly  id="itemDetailsProductID" name="itemDetailsProductID" title="This will be auto-generated when you add a new item"style="border:2px solid black;">
								</div>
							  </div>
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="itemDetailsItemName" style="font-weight:bold; color:black;">Item Name<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="itemDetailsItemName" id="itemDetailsItemName" autocomplete="off" style="border:2px solid black;">
									<div id="itemDetailsItemNameSuggestionsDiv" class="customListDivWidth"></div>
								  </div>
								  <div class="form-group col-md-2">
									<label for="itemDetailsStatus" style="font-weight:bold; color:black;">Status</label>
									<select id="itemDetailsStatus" name="itemDetailsStatus" class="form-control chosenSelect" style="border:2px solid black;">
										<?php include('inc/statusList.html'); ?>
									</select>
								  </div>
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-6" style="display:inline-block">
								  <!-- <label for="itemDetailsDescription">Description</label> -->
								  <textarea rows="3" class="form-control" placeholder="Description" name="itemDetailsDescription" id="itemDetailsDescription" style="border:2px solid black;"></textarea>
								</div>
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-3">
								  <label for="itemDetailsDiscount" style="font-weight:bold; color:black;">Discount %</label>
								  <input type="text" class="form-control" value="0" name="itemDetailsDiscount" id="itemDetailsDiscount" style="border:2px solid black;">
								</div>
								<div class="form-group col-md-3">
								  <label for="itemDetailsQuantity" style="font-weight:bold; color:black;">Quantity<span class="requiredIcon">*</span></label>
								  <input type="number" class="form-control" value="0" name="itemDetailsQuantity" id="itemDetailsQuantity" style="border:2px solid black;">
								</div>
								<div class="form-group col-md-3">
								  <label for="itemDetailsUnitPrice" style="font-weight:bold; color:black;">Unit Price<span class="requiredIcon">*</span></label>
								  <input type="text" class="form-control" value="0" name="itemDetailsUnitPrice" id="itemDetailsUnitPrice" style="border:2px solid black;">
								</div>
								<div class="form-group col-md-3">
								  <label for="itemDetailsTotalStock" style="font-weight:bold; color:black;">Total Stock</label>
								  <input type="text" class="form-control" name="itemDetailsTotalStock" id="itemDetailsTotalStock" readonly style="border:2px solid black;">
								</div>
								<div class="form-group col-md-3">
									<div id="imageContainer"></div>
								</div>
							  </div>
							  <button type="button" id="addItem" class="btn btn-success">Add Item</button>
							  <button type="button" id="updateItemDetailsButton" class="btn btn-primary">Update</button>
							  <button type="button" id="deleteItem" class="btn btn-danger">Delete</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
						
						
						<div id="itemImageTab" class="container-fluid tab-pane fade">
							<br>
							<div id="itemImageMessage"></div>
							<p>You can upload an image for a particular item using this section.</p> 
							<p>Please make sure the item is already added to database before uploading the image.</p>
							<br>							
							<form name="imageForm" id="imageForm" method="post">
							  <div class="form-row">
								<div class="form-group col-md-3" style="display:inline-block">
								  <label for="itemImageItemNumber" style="font-weight:bold; color:black;" >Item Number<span class="requiredIcon">*</span></label>
								  <input type="text" class="form-control" name="itemImageItemNumber" id="itemImageItemNumber" autocomplete="off" style="border:2px solid black;">
								  <div id="itemImageItemNumberSuggestionsDiv" class="customListDivWidth"></div>
								</div>
								<div class="form-group col-md-4">
									<label for="itemImageItemName" style="font-weight:bold; color:black;">Item Name</label>
									<input type="text" class="form-control" name="itemImageItemName" id="itemImageItemName" readonly style="border:2px solid black;">
								</div>
							  </div>
							  <br>
							  <div class="form-row">
								  <div class="form-group col-md-7">
									<label for="itemImageFile" style="font-weight:bold; color:black;">Select Image ( <span class="blueText">jpg</span>, <span class="blueText">jpeg</span>, <span class="blueText">gif</span>, <span class="blueText">png</span> only )</label>
									<input type="file" class="form-control-file btn btn-dark" id="itemImageFile" name="itemImageFile">
								  </div>
							  </div>
							  <br>
							  <button type="button" id="updateImageButton" class="btn btn-primary">Upload Image</button>
							  <button type="button" id="deleteImageButton" class="btn btn-danger">Delete Image</button>
							  <button type="reset" class="btn">Clear</button>
							</form>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
			  <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel" aria-labelledby="v-pills-purchase-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:#F4BB44;color:black;font-weight:bold; font-family:'Russo One';">Purchase Details</div>
				  <div class="card-body">
					<div id="purchaseDetailsMessage"></div>
					<form>
					  <div class="form-row">
						<div class="form-group col-md-3">
						  <label for="purchaseDetailsItemNumber" style="font-weight:bold; color:black;">Item Number<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="purchaseDetailsItemNumber" name="purchaseDetailsItemNumber" autocomplete="off" style="border:2px solid black;">
						  <div id="purchaseDetailsItemNumberSuggestionsDiv" class="customListDivWidth"></div>
						</div>
						<div class="form-group col-md-3">
						  <label for="purchaseDetailsPurchaseDate" style="font-weight:bold; color:black;">Purchase Date<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control datepicker" id="purchaseDetailsPurchaseDate" name="purchaseDetailsPurchaseDate" readonly value="2021-09-18" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsPurchaseID" style="font-weight:bold; color:black;">Purchase ID</label>
						  <input type="text" class="form-control invTooltip" id="purchaseDetailsPurchaseID" name="purchaseDetailsPurchaseID" title="This will be auto-generated when you add a new record" autocomplete="off" style="border:2px solid black;">
						  <div id="purchaseDetailsPurchaseIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
					  </div>
					  <div class="form-row"> 
						  <div class="form-group col-md-4">
							<label for="purchaseDetailsItemName" style="font-weight:bold; color:black;">Item Name<span class="requiredIcon">*</span></label>
							<input type="text" class="form-control invTooltip" id="purchaseDetailsItemName" name="purchaseDetailsItemName" readonly title="This will be auto-filled when you enter the item number above" style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-2">
							  <label for="purchaseDetailsCurrentStock" style="font-weight:bold; color:black;">Current Stock</label>
							  <input type="text" class="form-control" id="purchaseDetailsCurrentStock" name="purchaseDetailsCurrentStock" readonly style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-4">
							<label for="purchaseDetailsVendorName" style="font-weight:bold; color:black;">Vendor Name<span class="requiredIcon">*</span></label>
							<select id="purchaseDetailsVendorName" name="purchaseDetailsVendorName" class="form-control chosenSelect" style="border:2px solid black;">
								<?php 
									require('model/vendor/getVendorNames.php');
								?>
							</select>
						  </div>
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsQuantity" style="font-weight:bold; color:black;">Quantity<span class="requiredIcon">*</span></label>
						  <input type="number" class="form-control" id="purchaseDetailsQuantity" name="purchaseDetailsQuantity" value="0" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsUnitPrice" style="font-weight:bold; color:black;">Unit Price<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="purchaseDetailsUnitPrice" name="purchaseDetailsUnitPrice" value="0" style="border:2px solid black;">
						  
						</div>
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsTotal" style="font-weight:bold; color:black;">Total Cost</label>
						  <input type="text" class="form-control" id="purchaseDetailsTotal" name="purchaseDetailsTotal" readonly style="border:2px solid black;">
						</div>
					  </div>
					  <button type="button" id="addPurchase" class="btn btn-success">Add Purchase</button>
					  <button type="button" id="updatePurchaseDetailsButton" class="btn btn-primary">Update</button>
					  <button type="reset" class="btn">Clear</button>
					</form>
				  </div> 
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header"  style="text-align:center; background-color:#A3E4D7; color:#34495E ;font-weight:bold; font-family:'Russo One';">Vendor Details</div>
				  <div class="card-body">
				  <!-- Div to show the ajax message from validations/db submission -->
				  <div id="vendorDetailsMessage"></div>
					 <form> 
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="vendorDetailsVendorFullName" style="font-weight:bold; color:black;">Full Name<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="vendorDetailsVendorFullName" name="vendorDetailsVendorFullName" placeholder="" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
							<label for="vendorDetailsStatus" style="font-weight:bold; color:black;">Status</label>
							<select id="vendorDetailsStatus" name="vendorDetailsStatus" class="form-control chosenSelect">
								<?php include('inc/statusList.html'); ?>
							</select>
						</div>
						 <div class="form-group col-md-3">
							<label for="vendorDetailsVendorID" style="font-weight:bold; color:black;">Vendor ID</label>
							<input type="text" class="form-control invTooltip" id="vendorDetailsVendorID" name="vendorDetailsVendorID" title="This will be auto-generated when you add a new vendor" autocomplete="off" style="border:2px solid black;">
							<div id="vendorDetailsVendorIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-3">
							<label for="vendorDetailsVendorMobile" style="font-weight:bold; color:black;">Contact Number<span class="requiredIcon">*</span></label>
							<input type="text" class="form-control invTooltip" id="vendorDetailsVendorMobile" name="vendorDetailsVendorMobile" title="Do not enter leading 0" style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-3">
							<label for="vendorDetailsVendorPhone2" style="font-weight:bold; color:black;">Alternate Number</label>
							<input type="text" class="form-control invTooltip" id="vendorDetailsVendorPhone2" name="vendorDetailsVendorPhone2" title="Do not enter leading 0" style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-6">
							<label for="vendorDetailsVendorEmail" style="font-weight:bold; color:black;">Email</label>
							<input type="email" class="form-control" id="vendorDetailsVendorEmail" name="vendorDetailsVendorEmail" style="border:2px solid black;">
						</div>
					  </div>
					  <div class="form-group">
						<label for="vendorDetailsVendorAddress" style="font-weight:bold; color:black;">Address Line 1<span class="requiredIcon">*</span></label>
						<input type="text" class="form-control" id="vendorDetailsVendorAddress" name="vendorDetailsVendorAddress" style="border:2px solid black;">
					  </div>
					  <div class="form-group">
						<label for="vendorDetailsVendorAddress2" style="font-weight:bold; color:black;">Address Line 2</label>
						<input type="text" class="form-control" id="vendorDetailsVendorAddress2" name="vendorDetailsVendorAddress2" style="border:2px solid black;">
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="vendorDetailsVendorCity" style="font-weight:bold; color:black;">City</label>
						  <input type="text" class="form-control" id="vendorDetailsVendorCity" name="vendorDetailsVendorCity" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-4">
						  <label for="vendorDetailsVendorDistrict" style="font-weight:bold; color:black;">District</label>
						  <select id="vendorDetailsVendorDistrict" name="vendorDetailsVendorDistrict" class="form-control chosenSelect" style="border:2px solid black;">
							<?php include('inc/districtList.html'); ?>
						  </select>
						</div>
					  </div>					  
					  <button type="button" id="addVendor" name="addVendor" class="btn btn-success">Add Vendor</button>
					  <button type="button" id="updateVendorDetailsButton" class="btn btn-primary">Update</button>
					  <button type="button" id="deleteVendorButton" class="btn btn-danger">Delete</button>
					  <button type="reset" class="btn">Clear</button>
					 </form>
				  </div> 
				</div>
			  </div>
			    
			  <div class="tab-pane fade" id="v-pills-sale" role="tabpanel" aria-labelledby="v-pills-sale-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:pink;color:purple;font-weight:bold; font-family:'Russo One';">Sale Details</div>
				  <div class="card-body">
					<div id="saleDetailsMessage"></div>
					<form>
					  <div class="form-row">
						<div class="form-group col-md-3">
						  <label for="saleDetailsItemNumber" style="font-weight:bold; color:black;">Item Number<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="saleDetailsItemNumber" name="saleDetailsItemNumber" autocomplete="off" style="border:2px solid black;">
						  <div id="saleDetailsItemNumberSuggestionsDiv" class="customListDivWidth"></div>
						</div>
						<div class="form-group col-md-3">
							<label for="saleDetailsCustomerID" style="font-weight:bold; color:black;">Customer ID<span class="requiredIcon">*</span></label>
							<input type="text" class="form-control" id="saleDetailsCustomerID" name="saleDetailsCustomerID" autocomplete="off" style="border:2px solid black;">
							<div id="saleDetailsCustomerIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
						<div class="form-group col-md-4">
						  <label for="saleDetailsCustomerName" style="font-weight:bold; color:black;">Customer Name</label>
						  <input type="text" class="form-control" id="saleDetailsCustomerName" name="saleDetailsCustomerName" readonly style="border:2px solid black;">
						</div>
					 </div>
					  

					  <div class="form-row">
						  <div class="form-group col-md-5">
							<label for="saleDetailsItemName" style="font-weight:bold; color:black;">Item Name</label>
							<!--<select id="saleDetailsItemNames" name="saleDetailsItemNames" class="form-control chosenSelect"> -->
								<?php 
									//require('model/item/getItemDetails.php');
								?>
							<!-- </select> -->
							<input type="text" class="form-control invTooltip" id="saleDetailsItemName" name="saleDetailsItemName" readonly title="This will be auto-filled when you enter the item number above" style="border:2px solid black;">
						  </div>
						  
						  <div class="form-group col-md-2">
						  <label for="saleDetailsSaleID" style="font-weight:bold; color:black;">Sale ID</label>
						  <input type="text" class="form-control invTooltip" id="saleDetailsSaleID" name="saleDetailsSaleID" title="This will be auto-generated when you add a new record" autocomplete="off" style="border:2px solid black;">
						  <div id="saleDetailsSaleIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
						  
						  <div class="form-group col-md-3">
							  <label for="saleDetailsSaleDate" style="font-weight:bold; color:black;">Sale Date<span class="requiredIcon">*</span></label>
							  <input type="text" class="form-control datepicker" id="saleDetailsSaleDate" value="2021-09-12" name="saleDetailsSaleDate" readonly style="border:2px solid black;">
						  </div>
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-2">
								  <label for="saleDetailsTotalStock" style="font-weight:bold; color:black;">Total Stock</label>
								  <input type="text" class="form-control" name="saleDetailsTotalStock" id="saleDetailsTotalStock" readonly style="border:2px solid black;">
								</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsDiscount" style="font-weight:bold; color:black;">Discount %</label>
						  <input type="text" class="form-control" id="saleDetailsDiscount" name="saleDetailsDiscount" value="0" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsQuantity" style="font-weight:bold; color:black;">Quantity<span class="requiredIcon">*</span></label>
						  <input type="number" class="form-control" id="saleDetailsQuantity" name="saleDetailsQuantity" value="0"style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsUnitPrice" style="font-weight:bold; color:black;">Unit Price<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="saleDetailsUnitPrice" name="saleDetailsUnitPrice" value="0" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-3">
						  <label for="saleDetailsTotal" style="font-weight:bold; color:black;">Total</label>
						  <input type="text" class="form-control" id="saleDetailsTotal" name="saleDetailsTotal" style="border:2px solid black;">
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-3">
							<div id="saleDetailsImageContainer"></div>
						  </div>
					 </div>
					  <button type="button" id="addSaleButton" class="btn btn-success">Add Sale</button>
					  <button type="button" id="updateSaleDetailsButton" class="btn btn-primary">Update</button>
					  <button type="reset" id="saleClear" class="btn">Clear</button>
					</form>
				  </div> 
				</div>
			  </div>
			  <div class="tab-pane fade" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:#F4BB44;color:black;font-weight:bold; font-family:'Russo One';">Customer Details</div>
				  <div class="card-body">
				  <!-- Div to show the ajax message from validations/db submission -->
				  <div id="customerDetailsMessage"></div>
					 <form> 
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="customerDetailsCustomerFullName" style="font-weight:bold; color:black;">Full Name<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="customerDetailsCustomerFullName" name="customerDetailsCustomerFullName" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-2">
							<label for="customerDetailsStatus" style="font-weight:bold; color:black;">Status</label>
							<select id="customerDetailsStatus" name="customerDetailsStatus" class="form-control chosenSelect">
								<?php include('inc/statusList.html'); ?>
							</select>
						</div>
						 <div class="form-group col-md-3">
							<label for="customerDetailsCustomerID" style="font-weight:bold; color:black;">Customer ID</label>
							<input type="text" class="form-control invTooltip" id="customerDetailsCustomerID" name="customerDetailsCustomerID" title="This will be auto-generated when you add a new customer" autocomplete="off" style="border:2px solid black;">
							<div id="customerDetailsCustomerIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-3">
							<label for="customerDetailsCustomerMobile" style="font-weight:bold; color:black;">Contact Number<span class="requiredIcon">*</span></label>
							<input type="text" class="form-control invTooltip" id="customerDetailsCustomerMobile" name="customerDetailsCustomerMobile" title="Do not enter leading 0" style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-3">
							<label for="customerDetailsCustomerPhone2" style="font-weight:bold; color:black;">Alternate Number</label>
							<input type="text" class="form-control invTooltip" id="customerDetailsCustomerPhone2" name="customerDetailsCustomerPhone2" title="Do not enter leading 0" style="border:2px solid black;">
						  </div>
						  <div class="form-group col-md-6">
							<label for="customerDetailsCustomerEmail" style="font-weight:bold; color:black;">Email</label>
							<input type="email" class="form-control" id="customerDetailsCustomerEmail" name="customerDetailsCustomerEmail" style="border:2px solid black;">
						</div>
					  </div>
					  <div class="form-group">
						<label for="customerDetailsCustomerAddress" style="font-weight:bold; color:black;">Address Line 1<span class="requiredIcon">*</span></label>
						<input type="text" class="form-control" id="customerDetailsCustomerAddress" name="customerDetailsCustomerAddress" style="border:2px solid black;">
					  </div>
					  <div class="form-group">
						<label for="customerDetailsCustomerAddress2" style="font-weight:bold; color:black;">Address Line 2</label>
						<input type="text" class="form-control" id="customerDetailsCustomerAddress2" name="customerDetailsCustomerAddress2" style="border:2px solid black;">
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="customerDetailsCustomerCity" style="font-weight:bold; color:black;">City</label>
						  <input type="text" class="form-control" id="customerDetailsCustomerCity" name="customerDetailsCustomerCity" style="border:2px solid black;">
						</div>
						<div class="form-group col-md-4">
						  <label for="customerDetailsCustomerDistrict" style="font-weight:bold; color:black;">District</label>
						  <select id="customerDetailsCustomerDistrict" name="customerDetailsCustomerDistrict" class="form-control chosenSelect">
							<?php include('inc/districtList.html'); ?>
						  </select>
						</div>
					  </div>					  
					  <button type="button" id="addCustomer" name="addCustomer" class="btn btn-success">Add Customer</button>
					  <button type="button" id="updateCustomerDetailsButton" class="btn btn-primary">Update</button>
					  <button type="button" id="deleteCustomerButton" class="btn btn-danger">Delete</button>
					  <button type="reset" class="btn">Clear</button>
					 </form>
				  </div> 
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-search" role="tabpanel" aria-labelledby="v-pills-search-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:#A3E4D7; color:#34495E ;font-weight:bold; font-family:'Russo One';">Search Inventory<button id="searchTablesRefresh" name="searchTablesRefresh" class="btn float-right btn-sm">Refresh</button></div>
				  <div class="card-body">										
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item" >
							<a class="nav-link active" data-toggle="tab" href="#itemSearchTab">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#customerSearchTab">Customer</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleSearchTab">Sale</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#purchaseSearchTab">Purchase</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#vendorSearchTab">Vendor</a>
						</li>
					</ul>
  
					<!-- Tab panes -->
					<div class="tab-content">
						<div id="itemSearchTab" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemDetailsTableDiv"></div>
						</div>
						<div id="customerSearchTab" class="container-fluid tab-pane fade">
						  <br>
						  <p>Use the grid below to search all details of customers</p>
							<div class="table-responsive" id="customerDetailsTableDiv"></div>
						</div>
						<div id="saleSearchTab" class="container-fluid tab-pane fade">
							<br>
							<p>Use the grid below to search sale details</p>
							<div class="table-responsive" id="saleDetailsTableDiv"></div>
						</div>
						<div id="purchaseSearchTab" class="container-fluid tab-pane fade">
							<br>
							<p>Use the grid below to search purchase details</p>
							<div class="table-responsive" id="purchaseDetailsTableDiv"></div>
						</div>
						<div id="vendorSearchTab" class="container-fluid tab-pane fade">
							<br>
							<p>Use the grid below to search vendor details</p>
							<div class="table-responsive" id="vendorDetailsTableDiv"></div>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header" style="text-align:center; background-color:pink;color:purple;font-weight:bold; font-family:'Russo One';">Reports<button id="reportsTablesRefresh" name="reportsTablesRefresh" class="btn btn-default float-right btn-sm">Refresh</button></div>
				  <div class="card-body">										
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemReportsTab">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#customerReportsTab">Customer</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleReportsTab">Sale</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#purchaseReportsTab">Purchase</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#vendorReportsTab">Vendor</a>
						</li>
					</ul>
  
					<!-- Tab panes for reports sections -->
					<div class="tab-content">
						<div id="itemReportsTab" class="container-fluid tab-pane active">
							<br>
							<p>Use the grid below to get reports for items</p>
							<div class="table-responsive" id="itemReportsTableDiv"></div>
						</div>
						<div id="customerReportsTab" class="container-fluid tab-pane fade">
							<br>
							<p>Use the grid below to get reports for customers</p>
							<div class="table-responsive" id="customerReportsTableDiv"></div>
						</div>
						<div id="saleReportsTab" class="container-fluid tab-pane fade">
							<br>
							<!-- <p>Use the grid below to get reports for sales</p> -->
							<form> 
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="saleReportStartDate">Start Date</label>
									<input type="text" class="form-control datepicker" id="saleReportStartDate" value="2018-05-24" name="saleReportStartDate" readonly>
								  </div>
								  <div class="form-group col-md-3">
									<label for="saleReportEndDate">End Date</label>
									<input type="text" class="form-control datepicker" id="saleReportEndDate" value="2018-05-24" name="saleReportEndDate" readonly>
								  </div>
							  </div>
							  <button type="button" id="showSaleReport" class="btn btn-dark">Show Report</button>
							  <button type="reset" id="saleFilterClear" class="btn">Clear</button>
							</form>
							<br><br>
							<div class="table-responsive" id="saleReportsTableDiv"></div>
						</div>
						<div id="purchaseReportsTab" class="container-fluid tab-pane fade">
							<br>
							<!-- <p>Use the grid below to get reports for purchases</p> -->
							<form> 
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="purchaseReportStartDate">Start Date</label>
									<input type="text" class="form-control datepicker" id="purchaseReportStartDate" value="2018-05-24" name="purchaseReportStartDate" readonly>
								  </div>
								  <div class="form-group col-md-3">
									<label for="purchaseReportEndDate">End Date</label>
									<input type="text" class="form-control datepicker" id="purchaseReportEndDate" value="2018-05-24" name="purchaseReportEndDate" readonly>
								  </div>
							  </div>
							  <button type="button" id="showPurchaseReport" class="btn btn-dark">Show Report</button>
							  <button type="reset" id="purchaseFilterClear" class="btn">Clear</button>
							</form>
							<br><br>
							<div class="table-responsive" id="purchaseReportsTableDiv"></div>
						</div>
						<div id="vendorReportsTab" class="container-fluid tab-pane fade">
							<br>
							<p>Use the grid below to get reports for vendors</p>
							<div class="table-responsive" id="vendorReportsTableDiv"></div>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
			</div>
		 </div>
	  </div>
    </div>
<?php
	require 'inc/footer.php';
?>
  </body>
</html>
