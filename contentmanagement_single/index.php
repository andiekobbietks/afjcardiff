<?php
 include('../database_connection.php');
 include('../category_details.php');
 //include('emails.php');

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}
$query = "SELECT DISTINCT code_basedtitle, class_title FROM classes ORDER BY code_basedtitle DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
?>
<html>
 <head>
  <title>Content Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
  
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script src="https://smtpjs.com/v3/smtp.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/indexcss.css" />
<link href="../css/bootstrap-select.min.css" rel="stylesheet" />
<script src="../js/bootstrap-select.min.js"></script>
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
 #top{  
	   position:fixed;  
	   bottom:50px;  
	   right:0px;  
	   display:none;  
	   width:70px;
	   height:50px;
	   font-size:20px;
	   background-color: #ccc;
	   color: black;
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

td[contenteditable="true"]:empty:before {
    content: attr(data-placeholder);
    color: #888; /* Placeholder text color */
    pointer-events: none; /* Make sure the placeholder text is not selectable */
    display: block;
    height: 100%;
}

td[contenteditable="true"]:empty:focus:before {
    content: '';
}


.btn-show { background-color: #D99543; color: white; }
.btn-hide { background-color: rgba(191, 59, 94, 0.8); color: black; }

		
.footer {
   padding: 10px;
   font-size: 20px;
   width: 100%;
   background-color: rgba(192, 192, 192, 0.5);
   color: black;
   text-align: left;
   flex-shrink: 0; /* Prevents footer from shrinking */
}
</style>
 <body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="../contentmanagement/index.php">AFJCardiff</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
            <li class="active"><a href="../contentmanagement/index.php">Content Management</a></li>
            <li><a href="../mediacontent/index.php">Media Content</a></li>
            <li><a href="../videourl/index.php">YouTube Videos</a></li>
            <li><a href="../videos/index.php">Videos</a></li>
            <li><a href="../sendalerts/index.php">Send Email Alerts</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
   <br>
 <div class="container-fluid tablebox" align="center">
   <h1 align="center">Content Management</h1>
   <br />
   <hr />
		<div class="container mt-4">
		 <!-- Toggle Button -->
        <button id="toggle_button" class="btn btn-show">Show Multiple Delete-Table</button>
        <br/>
        <br/>
        <!-- Table -->
        <div class="table-responsive" id="table_container">
             <table id="content_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th width="5%"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button></th>
                            <th width="10%">Class Image</th>
                            <th width="10%">Code Based Title</th>
                            <th width="15%">Class Title</th>
                            <th width="20%">Class Description</th>
                            <th width="10%">Start Date Time</th>
							<th width="10%">End Date Time</th>
                        </tr>
                    </thead>
                </table>
    </div>
  </div>
   <hr />
   <div align="right">
   <input type="file" name="multiple_files" id="multiple_files" multiple />
    <span class="text-muted">Only .jpg, png, .gif file allowed</span>
    <span id="error_multiple_files"></span>
</div>
    <div align="left">
  <button type="button" name="add" id="add_button" class="btn btn-success"   data-toggle="modal" data-target="#userModal_add">Add</button>
    </div>
   <br />
   <select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker" data-live-search="true">
   <?php
   foreach($result as $row)
   {
    echo '<option value="'.$row["code_basedtitle"].'">'.$row["code_basedtitle"].' : '.$row["class_title"].'</option>'; 
   }
   ?>
   </select>
   <input type="hidden" name="hidden_number" id="hidden_number" />
   <div style="clear:both"></div>
      <br />
	<br/>
<div class="input-group">
  <span class="input-group-addon">Search</span>
  <input type="text" name="search_text" id="search_text" placeholder="Search Details" class="form-control" />
</div>

	<br/>
	<span><?php echo getallrecords($connect); ?></span>
	<br/>
<div id="userModal_add" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form_add" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Class Details</h4>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="userModal" class="modal fade">
<div class="modal-dialog">
	<form method="post" id="user_form" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Class Details</h4>
			</div>
<div class="modal-body">
<br/>
<br/>
<div class="form-group">
<label for="class_image">Select Image</label>
<input type="file" class="form-control-file" id="class_image" name="class_image">
<span id="class_uploaded_image"></span>
</div>
<div class="form-group">
<label>Class Title</label>
<input type="text" name="class_title" id="class_title" class="form-control" /> 
</div>

<div class="form-group">
<label>Code Based Title</label>
<input name="code_basedtitle" id="code_basedtitle" class="form-control" />
</div>

<div class="form-group">
<label>Class Description</label>
<textarea type="text" name="class_description" id="class_description" class="form-control">
</textarea>
</div>
<div class="form-group">
<label>Expected Start Date</label>
<input type="text" name="expected_startdatetime" id="expected_startdatetime" class="form-control" />
</div> 
<div class="form-group">
<label>Expected End Date</label>
<input type="text" name="expected_enddatetime" id="expected_enddatetime" class="form-control" />
</div>

</div>
<div class="modal-footer">
<input type="hidden" name="user_id" id="user_id" />
<input type="hidden" name="operation_edit" id="operation_edit" />
<div align="center">
<input type="submit" name="action_edit" id="action_edit" class="btn btn-success" value="Add" />
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</form>
</div>


<div class="table-responsive">
    <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="10%">Class Image</th>
                            <th width="10%">Code Based Title</th>
                            <th width="15%">Class Title</th>
                            <th width="20%">Class Description</th>
                            <th width="10%">Start Date Time</th>
							<th width="10%">End Date Time</th>
						   <th width="10%">Edit</th>
						   <th width="10%">Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
    </div>
		
<button type="button" class="btn" id="top">Top</button> 
<br><br>
	   <footer class="footer">
       	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
	<a href="../home/index.php" style="text-decoration: none; color:black;" >AFJCardiff</a>
    </footer>
</body>
</html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 $('#add_button').click(function(){
  $('#user_form_add')[0].reset();
  $('.modal-title').text("Add Class Details");
  $('#action').val("Add");
  $('#operation').val("Add");
 });
 
 
var dataTable = $('#content_data').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
        url: "fetch.php",
        type: "POST"
    },
    "columnDefs": [
        {
            "targets": [0],
            "orderable": false
        }
    ]
});


$(document).ready(function(){
		// Initially hide the table
		$('#table_container').hide();
		
		// Toggle button click event
		$('#toggle_button').click(function(){
			$('#table_container').toggle(); // Toggle the visibility of the table
			
			// Update button text and color based on visibility
			if ($('#table_container').is(':visible')) {
				$(this).text('Hide Multiple Delete-Table').removeClass('btn-show').addClass('btn-hide');
			} else {
				$(this).text('Show Multiple Delete-Table').removeClass('btn-hide').addClass('btn-show');
			}
		});
	});
	
 
 
$('.delete_checkbox').click(function(){
	if($(this).is(':checked'))
	{
		$(this).closest('tr').addClass('removeRow');
	}
	else
	{
		$(this).closest('tr').removeClass('removeRow');
	}
});

$('#delete_all').click(function(){
	var checkbox = $('.delete_checkbox:checked');
	if(checkbox.length > 0)
	{
		var checkbox_value = [];
		$(checkbox).each(function(){
			checkbox_value.push($(this).val());
		});

		$.ajax({
			url:"deletemulti.php",
			method:"POST",
			data:{checkbox_value:checkbox_value},
			success:function()
			{
				$('.removeRow').fadeOut(1500);
				 dataTable.ajax.reload();
				 load_data();
			}
		});
	}
	else
	{
		alert("Select at least one records");
	}
}); 

 
	
 $('#multiple_files').change(function(){
  var error_images = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;
  if(files.length > 25)
  {
   error_images += 'You can not select more than 25 files';
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','m4a','mp4']) == -1) 
    {
     error_images += '<p>Invalid '+i+' File</p>';
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
	var fsize = f.size || f.fileSize;

	// Set this to a very large value; for example, 500 MB (500 * 1024 * 1024 bytes)
	var maxFileSize = 500 * 1024 * 1024; 

	if (fsize > maxFileSize) {
		error_images += '<p>' + i + ' File Size is very big. Maximum allowed size is ' + (maxFileSize / (1024 * 1024)) + ' MB.</p>';
	}
    else
    {
     form_data.append("file[]", document.getElementById('multiple_files').files[i]);
    }
   }
  }
  if(error_images == '')
  {
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
    },   
    success:function(data)
    {
     $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
	 dataTable.ajax.reload();
	 load_data();
    }
   });
  }
  else
  {
   $('#multiple_files').val('');
   $('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
   return false;
  }
  
 }); 

 load_data();
 
 function load_data(query='')
 {
  $.ajax({
   url:"find.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#user_data').html(data);
   }
  })
 }

 $('#multi_search_filter').change(function(){
  $('#hidden_number').val($('#multi_search_filter').val());
  var query = $('#hidden_number').val();
  load_data(query);
 });

//multiple inserting data
    var count = 1;

    $('#addrows').click(function(){
        var html_code = "<div id='row"+count+"' class='row'>";
        
        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label for='class_image'>Select Image</label>";
        html_code += "<input type='file' name='class_image[]' class='form-control-file' />";
        html_code += "</div></div>";

        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label>Class Title</label>";
        html_code += "<input type='text' name='class_title[]' id='class_title' class='form-control' />";
        html_code += "</div></div>";

        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label>Code Based Title</label>";
        html_code += "<input type='text' name='code_basedtitle[]' id='code_basedtitle' class='form-control' />";
        html_code += "</div></div>";

        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label>Class Description</label>";
        html_code += "<textarea name='class_description[]' id='class_description' class='form-control'></textarea>";
        html_code += "</div></div>";

        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label>Expected Start Date</label>";
        html_code += "<input type='text' name='expected_startdatetime[]' class='form-control' />";
        html_code += "</div></div>";

        html_code += "<div class='col-md-6'>";
        html_code += "<div class='form-group'>";
        html_code += "<label>Expected End Date</label>";
        html_code += "<input type='text' name='expected_enddatetime[]' class='form-control' />";
        html_code += "</div></div>";

        html_code += "<div class='col-md-12'>";
        html_code += "<button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Remove Row</button>";
        html_code += "</div>";

        html_code += "</div>"; // End of row
        
        $('#class_form_rows').append(html_code);
        count++;
    });

    $(document).on('click', '.remove', function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

 $(document).on('submit', '#user_form_add', function(event){
  event.preventDefault();
  var class_title = $('#class_title').val();
  var code_basedtitle = $('#code_basedtitle').val();
   var class_image = $('#class_image').val();

  if(class_title != '' && code_basedtitle != '') {
    $.ajax({
      url: "insert.php",
      method: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
        alert(data);
        $('#user_form_add')[0].reset();
        $('#user_form')[0].reset();
        $('#userModal_add').modal('hide');
         load_data();
 
      }
    });
  } else {
    alert("All Sections Require Data");
  }
});

//for updating details
 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var class_title = $('#class_title').val();
  var code_basedtitle = $('#code_basedtitle').val();
   var class_image = $('#class_image').val();
    var extension = class_image.split('.').pop().toLowerCase();
    
    if (extension !== '' && $.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
        alert("Invalid Image File");
        $('#class_image').val('');
        return false;
    }
	
  if(class_title != '' && code_basedtitle != '') {
    $.ajax({
      url: "insert.php",
      method: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
        alert(data);
        $('#user_form')[0].reset();
        $('#userModal').modal('hide');
         load_data(); 
		 dataTable.ajax.reload();
 
      }
    });
  } else {
    alert("All Sections Require Data");
  }
});

$(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
    url: "fetch_single.php",
    method: "POST",
    data: {user_id: user_id},
    dataType: "json",
    success: function(data) {
      $('#userModal').modal('show');
      $('#class_title').val(data.class_title);
      $('#code_basedtitle').val(data.code_basedtitle);
      $('#class_description').val(data.class_description);
      $('#expected_startdatetime').val(data.expected_startdatetime);
      $('#expected_enddatetime').val(data.expected_enddatetime);
	  $('.modal-title').text("Edit Dance Session");
	  $('#user_id').val(user_id);
	  $('#class_uploaded_image').html(data.class_image);
	  $('#action_edit').val("Edit");
	  $('#operation_edit').val("Edit");
    },
    error: function(xhr, status, error) {
      console.error("Error fetching data:", error);
      // Handle the error as needed
    }
  });
});

 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
     alert(data);
     load_data();
	 dataTable.ajax.reload();
 
    }
   });
  }
  else
  {
   return false; 
  }
 });

});
 
 $(document).ready(function(){

 load_data_search();

 function load_data_search(query)
 {
  $.ajax({
   url:"process_data.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#user_data').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data_search(search);
  }
  else
  {
   load_data_search();
  }
 });
});

/*this code is for scrollTop function */
$(document).ready(function(){  
	$('a[href^="#"]').on('click', function(e){  
		 e.preventDefault();  
		 var target = this.hash;  
		 var $target = $(target);  
		 $('html, body').animate({  
			  'scrollTop':$target.offset().top  
		 }, 1000, 'swing');  
	});  
});  
$(function(){  
	$(window).scroll(function(){  
		 if($(this).scrollTop() != 0)  
		 {  
			  $('#top').fadeIn();  
		 }  
		 else  
		 {  
			  $('#top').fadeOut();  
		 }  
	});  
	$('#top').click(function(){  
		 $('body,html').animate({scrollTop:0},500);  
	});  
});
</script>  