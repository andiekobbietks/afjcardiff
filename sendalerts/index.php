<?php
include('../database_connection.php');
include('../category_details.php');
include('email.php');

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}

$query = "SELECT DISTINCT class_id, class_title, code_basedtitle FROM classes 
WHERE code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event'
ORDER BY class_id DESC";
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>


<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AFJCardiff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://smtpjs.com/v3/smtp.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/indexcss.css" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
	<link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<script src="js/bootstrap-select.min.js"></script> 
  </head>
  <style>
 /* Reset CSS */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

 
.emailbox {
    width: 100%;
    padding: 10px;
	background: linear-gradient(to bottom, #BF584E, rgba(217, 126, 74, 0.8));
    border: 1px solid #ccc;
    border-radius: 1px;
    margin-top: 0;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
}

.tablebox {
    width: 90%;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 15px;
    margin-top: 0;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
}

.tableboxuser  {
    width: 100%;
    padding: 20px;
    background: linear-gradient(to bottom, #D99543, rgba(191, 59, 94, 0.8));
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 0;
    color: black;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
}

.buttonselection{
background: linear-gradient(to bottom, #D99543, rgba(191, 59, 94, 0.8));color: white;
}

a {
	
    text-decoration: none; /* Remove underline effect */
  }

@media screen and (max-width: 650px) {
    .column {
        width: 100%;
        display: block;
    }
}

#top {
    position: fixed;
    bottom: 50px;
    right: 0;
    display: none;
    width: 70px;
    height: 50px;
    font-size: 20px;
    background-color: #ccc;
    color: #000;
    border: none;
    outline: none;
    cursor: pointer;
    border-radius: 5px;
}

#top:hover {
    background-color: #5f025c;
    color: #fff;
}

.column {
  float: left;
  width: 100%;
  margin-bottom: 16px;
  padding: 0 8px;
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
    background: linear-gradient(to top, #D99543, rgba(191, 59, 94, 0.8));
    z-index: 9999;
}
		
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
                <li><a href="../contentmanagement/index.php">Content Management</a></li>
                <li><a href="../mediacontent/index.php">Media Content</a></li>
                <li><a href="../videourl/index.php">YouTube Videos</a></li>
                <li><a href="../videos/index.php">Videos</a></li>
                <li class="active"><a href="../sendalerts/index.php">Send Email Alerts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

  <div class="container-fluid tableboxuser">
    <h2 align="center">Email Classes</h2>
</a>

<h3 class="text-success"><?php echo $complete; ?></h3>
   <br />
   <br />
    <select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker" data-live-search="true">
   <?php
   foreach($result as $row)
   {
    echo '<option class="list" value="'.$row["class_title"].'">'.$row["class_title"].' : '.$row["code_basedtitle"].'</option>'; 
   }
   ?>
   </select>
   <input type="hidden" name="profile_details" id="profile_details" />

   <div style="clear:both"></div>
    <br />
	<br/>
<div class="input-group">
  <span class="input-group-addon">Search</span>
  <input type="text" name="search_text" id="search_text" placeholder="Search Details" class="form-control" />
</div>
	<br/>

     <span id="message"> </span>
	   <span id="alert_action"></span>
     <div id="user_profile">
	
	 </div> 
  </div>
    
 <div id="userModal" class="modal fade"> <!--set up modal display for single selection -->
        

    <div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body emailbox">
	<div class="" align="center">
	<div class="card-header">
	<h3 class="text-center" >Dance Session Form</h3>
	</div>
                        <form id="registrationForm" method="post" enctype="multipart/form-data">
						
							<div class="col-md-6">
                            <div class="form-group">
							<label>Enter Email</label>
                                <input type="email" name="recipient_email"  class="form-control" placeholder="Recipient Email" required />
                            </div>
                            </div>
							<div class="col-md-6">
                            <div class="form-group">
							<label>Preselected Email</label>
                                <select name="sender_email"  class="form-control" required>
								<option><?php echo admin_email($connect); ?></option>
								</select>
                            </div>
                            </div>
						<div class="col-md-12">
                            <div class="form-group" style="height: 100px; overflow-y: auto;">
                                <label>
                                    <input type="checkbox" id="selectAll"> Select All
                                </label><br>
                                <?php
                                $query = "SELECT email FROM newsletters";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    echo '<label><input type="checkbox" name="email_bulk[]" class="email-checkbox" value="' . $row['email'] . '"> ' . $row['email'] . '</label><br>';
                                }
                                ?>
                            </div>
                        </div>
							<div class="col-md-6">
                            <div class="form-group">
							<label>Class Title</label>
                                <input type="text" name="class_title" id="class_title"  class="form-control" placeholder="Class Title" readonly />
                            </div>
                            </div>
							<div class="col-md-6">
                            <div class="form-group">
							<label>Class Type</label>
                                <input type="text" name="class_type" id="class_type"  class="form-control" placeholder="Class Type" readonly />
                            </div>
                            </div>
							<div class="col-md-6">
							<div class="form-group">
							<label>Expected Start Date and Time</label>
							<input type="text" name="expected_startdatetime" id="expected_startdatetime"  class="form-control" readonly />
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
							<label>Expected End Date and Time</label>
							<input type="text" name="expected_enddatetime" id="expected_enddatetime" class="form-control" readonly />
							</div>
							</div>
							<div class="col-md-12">
                            <div class="form-group">
                                <select name="subject" class="form-control" required>
                                    <option value="Class Session">Class Session</option>
                                </select>
                            </div>
                            </div>
							<div class="col-md-6">
                            <div class="form-group">
							<label>Enter First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" required />
                            </div>
                            </div>
							<div class="col-md-6">
                            <div class="form-group">
							<label>Enter Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" required />
                            </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit_session" class="btn btn-info" value="Send Alert" />
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
</div>
</div>
</div>

<button type="button" id="top"><i class="fa fa-arrow-up"></i></button>
      <br><br>
	   <footer class="footer">
       	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
	<a href="../home/index.php" style="text-decoration: none; color:black;" >AFJCardiff</a>
    </footer>
 </div>
 </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
$('#add_button').click(function(){ //set up parameters for adding data
$('#user_form')[0].reset();
$('#user_profile')[0].reset();
$('#action').val("Add");
$('#btn_action').val("Add");
});

load_data();
$('#multi_search_filter').selectpicker();
$('#sub_multi_search_filter').selectpicker();

function load_data(query='')
{
$.ajax({
url:"fetch.php",
method:"POST",
data:{query:query},
success:function(data)
{
$('#user_profile').html(data);
$('#user_profile')[0].reset();

var html = '';
for(var count = 0; count < data.length; count++)
{
  html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
}
if(type == '')
{
  $('#multi_search_filter').html(html);
  $('#multi_search_filter').selectpicker('refresh');
}	

}
})
}

$('#multi_search_filter').change(function(){
$('#profile_details').val($('#multi_search_filter').val());
var query = $('#profile_details').val();
load_data(query);
});

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var class_title = $('#class_title').val();

  if(class_title != '') {
    $.ajax({
      url: "insert.ph",
      method: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
        alert(data);
        $('#user_form')[0].reset();
        $('#userModal').modal('hide');
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
      $('#class_type').val(data.class_type);
      $('#expected_startdatetime').val(data.expected_startdatetime);
      $('#expected_enddatetime').val(data.expected_enddatetime);
      $('#class_description').val(data.class_description);
      $('.modal-title').text("Confirm Dance Session");
      $('#user_id').val(user_id);
      $('#action').val("Confirm");
      $('#operation').val("Confirm");
    },
    error: function(xhr, status, error) {
      console.error("Error fetching data:", error);
      // Handle the error as needed
    }
  });
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
    $('#user_profile').html(data);
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

    $(document).ready(function() {
        // jQuery Validation Plugin
        $('#registrationForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                firstname: "required",
                lastname: "required",
                phone_number: "required",
                inquiry: "required"
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                }
            },
            success: function(label, element) {
                // Add success class to the parent form-group
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        // Select All checkbox functionality
        $('#selectAll').click(function() {
            $('.email-checkbox').prop('checked', this.checked);
        });

        // Uncheck "Select All" if any individual checkbox is unchecked
        $('.email-checkbox').click(function() {
            if (!this.checked) {
                $('#selectAll').prop('checked', false);
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

  </body>
</html>