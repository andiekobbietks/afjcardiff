<?php
 include('start.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management</title>
		    <!-- Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

</head>
</head>
<body>
<style>
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgba(240, 240, 240, 0.5);
 color:black;
}
.emailbox {
    width: 100%;
    padding: 10px;
	background-color: rgba(207, 174, 8, 0.5);
    border: 1px solid #ccc;
    border-radius: 1px;
    margin-top: 0;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
}

#top {  
    position: fixed;  
    bottom: 50px;  
    right: 0px;  
    display: none;  
    width: 70px;
    height: 70px;
    font-size: 20px;
    border-radius: 50%;
    background: linear-gradient(to bottom, #F2A0AF, rgba(242, 242, 242, 0.8));
    z-index: 9999;
}
	
.tablebox {
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 0;
	color:black;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
}


.btn-show { background-color: #F2A0AF; color: white; }
.btn-hide { background-color: #F2F2F2; color: black; }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../contentmanagement/index.php">AFJCardiff</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../contentmanagement/index.php">Content Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../mediacontent/index.php">Media Content</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../videourl/index.php">YouTube Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../videos/index.php">Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../sendalerts/index.php">Send Email Alerts</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><span class="bi bi-box-arrow-right"></span> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


 <div class="container-fluid tablebox" align="center">
        <h1 class="mb-4">Content Management</h1>
		<hr/>
<select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker" data-live-search="true">
   <?php
	  foreach($result as $row)
   {
    echo '<option value="'.$row["class_title"].'">'.$row["class_title"].'</option>'; 
   }
   ?>
   </select>
   <input type="hidden" name="class_search" id="class_search" />
   <div style="clear:both"></div>
      <br />
	  
<div class="input-group mb-3">
    <span class="input-group-text">Search</span>
    <input type="text" name="search_text" id="search_text" placeholder="Search Details" class="form-control" />
</div>
<br/>
<hr/>
   <div align="right">
   <input type="file" name="multiple_files" id="multiple_files" multiple />
    <span class="text-muted">Only .jpg, png, .gif file allowed</span>
    <span id="error_multiple_files"></span>
</div>
<hr/>
 <div class="mb-4">
    <button type="button" name="add" id="add_button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#userModal_add">Add</button>
    <button class="btn btn-primary me-2" id="editMultipleObjects">Edit Selected</button>
    <button class="btn btn-danger" id="deleteMultipleObjects">Delete Selected</button>
</div>
<hr/>
<br/>
          <div class="table-responsive">
            <table  id="objectTableBody" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10%">Select</th>
                        <th width="10%">Class ID</th>
                        <th width="10%">Class Image</th>
                        <th width="10%">Class Title</th>
                        <th width="10%">Code Based Title</th>
						<th width="10%">Start DateTime</th>
						<th width="10%">End DateTime</th>
					   <th width="10%">Edit</th>
					   <th width="10%">Delete</th>
                    </tr>
              </thead> 
			<tbody>
                    <!-- Dynamic content goes here -->
        </tbody>
        </table>
    </div>
 </div>

    <!-- Modals -->
    <!-- Add/Edit Modal (Single) -->
    <div class="modal fade" id="objectModal" tabindex="-1" aria-labelledby="objectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="objectForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="objectModalLabel">Add New Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="class_id" id="class_id">
											
                        <div class="form-group">
                            <label for="class_image">Class Image</label>
                            <input type="file" name="class_image" id="class_image" class="form-control-file">
                            <img id="existingImage" src="" alt="Current Image" style="width:100%;" class="img-thumbnail">
                        </div>
						<br/>
						
                        <div class="form-group">
                            <label for="class_title">Class Title</label>
                            <input type="text" name="class_title" id="class_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code_basedtitle">Code BasedTitle</label>
                            <input type="text" name="code_basedtitle" id="code_basedtitle" class="form-control" required>
                        </div>	
                        <div class="form-group">
                            <label for="class_description">Class Description</label>
                            <textarea type="text" name="class_description" id="class_description" class="form-control">
							</textarea>		
                        </div>		
                        <div class="form-group">
                            <label for="expected_startdatetime">Start DateTime</label>
                            <input type="text" name="expected_startdatetime" id="expected_startdatetime" class="form-control">
                        </div>	
                        <div class="form-group">
                            <label for="expected_enddatetime">End DateTime</label>
                            <input type="text" name="expected_enddatetime" id="expected_enddatetime" class="form-control">
                        </div>	
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveObject">Save Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>

    <!-- Add Multiple Modal -->
    <div class="modal fade" id="addMultipleModal" tabindex="-1" aria-labelledby="addMultipleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addMultipleForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMultipleModalLabel">Edit Multiple Objects</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="addMultipleContainer">
                        <!-- Dynamic content for multiple edits will go here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
    <!-- Add Rows Modal -->
    <div id="userModal_add" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="user_form_add" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Class Details</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="class_form_rows">
                            <!-- This will be the container for each row of inputs -->
                        </div>
                        <br/>
                        <button type="button" name="addrows" id="addrows" class="btn btn-success btn-xs">Add Multi Rows+</button>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="operation" id="operation" />
                        <div align="center">
                            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php 
 include('script.php');
 ?>
</body>
</html>
