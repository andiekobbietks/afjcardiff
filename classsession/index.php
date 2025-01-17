<?php
//index.php
include('../database_connection.php');
include('../category_details.php');

$query = "SELECT DISTINCT class_id, class_title, code_basedtitle FROM classes 
WHERE code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event'
ORDER BY class_id DESC";
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


$message = '';
$complete = '';

if(isset($_POST["submit_session"])) {
    // Handle form fields
    $recipient_email = trim($_POST["recipient_email"]);
    $sender_email = trim($_POST["sender_email"]);
    $subject = trim($_POST["subject"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $class_title = trim($_POST["class_title"]);
    $class_type = trim($_POST["class_type"]);
    $expected_startdatetime = trim($_POST["expected_startdatetime"]);
    $expected_enddatetime = trim($_POST["expected_enddatetime"]);

    // Email body for recipient
    $recipient_message = "<p>Hi $firstname,</p><p>Thank you for joining our $class_title class.</p><p>This is a $class_type Session.<p>This is the class's date and time.<br/>Start: $expected_startdatetime.</p><p>End: $expected_enddatetime.</p>We look forward to seeing you there!</p><p>Kind Regards,<br/>AFJCardiff</p>";

    // Email body for admin
    $admin_message = "<p>Hi Admin,</p><p>$firstname $lastname has applied for the following class:</p><p>Class Title: $class_title.</p><p>Class Type: $class_type.</p>";

    // Simulated sending of emails using SMTP.js
    // Email to recipient
    echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
    echo '<script>
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "deziremambule@outlook.com",
                Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                To : "'.$recipient_email.'",
                From : "'.$sender_email.'",
                Subject : "'.$subject.'",
                Body : "'.$recipient_message.'",
                Secure: "tls",
                Port: 587
            }).then(function(messagebox) {
                alert("Email sent successfully! ");
            });
        </script>';    

    // Email to admin
    echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
    echo '<script>
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "deziremambule@outlook.com",
                Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                To : "deziremambule@outlook.com",
                From : "deziremambule@outlook.com",
                Subject : "'.$subject.'",
                Body : "'.$admin_message.'",
                Secure: "tls",
                Port: 587
            }).then(function(messagebox) {
                alert("Please Check you Junk Box just incase!");
            });
        </script>';
}
?>

<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dance Session</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
	<link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<script src="js/bootstrap-select.min.js"></script>
	<script src="../usernotifications.js"></script>
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
 <div class="bg">
  <br />
 <div class="container-fluid tableboxuser">
<a href="../home/classes.php" style="text-decoration: none; color:black; background-color:purple;" align="center">
    <h2>&larr; Back to Classes</h2>
</a>

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
   <br />
   <div class="input-group">
  <span class="input-group-addon">Search</span>
  <input type="text" name="search_text" id="search_text" placeholder="Search Details" class="form-control" />
	</div>
   <br />

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
	<h3 class="text-danger"><?php echo $message; ?></h3>
	<h3 class="text-success"><?php echo $complete; ?></h3>
                        <form id="registrationForm" method="post" enctype="multipart/form-data">
						
							<div class="col-md-6">
                            <div class="form-group">
							<label>Enter Email</label>
                                <input type="email" name="recipient_email"  class="form-control" placeholder="Your Email" required />
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
                                <input type="submit" name="submit_session" class="btn btn-info" value="Submit Form" />
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