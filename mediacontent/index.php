<?php 
include('../database_connection.php');

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}
$query = "SELECT DISTINCT content_title FROM media_content ORDER BY content_title DESC ";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>

<html>
 <head>
  <title>Media Content</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
  <script src="js/bootstrap-select.min.js"></script>
  
  <style>
body {margin:0;font-family:Arial}



  .main_division
        {
            position: relative;
            width: 100%;
            height: auto;
            background-color: #FFF;
            border: 1px solid #CCC;
            border-radius: 3px;
        }
        #sub_division
        {
            width: 100%;
            height: auto;
            min-height: 80px;
            overflow: auto;
            padding:6px 24px 6px 12px;
        }
        .image_upload
        {
            position: absolute;
            top:0px;
            right:16px;
        }
        .image_upload > form > input
        {
            display: none;
        }

        .image_upload img
        {
            width: 24px;
            cursor: pointer;
        }
  
  
   #top{  
	   position:fixed;  
	   bottom:25px;  
	   right:10px;  
	   display:none;  
	   width:80px;
	   height:50px;
	   font-size:20px;
	} 
	
	 #down{  
	   position:fixed;  
	   bottom:25px; 
	   left:10px;  
	   display:none;  
	   width:80px;
	   height:50px;
	   font-size:20px;
	} 
	
.box
   {
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
   
      .box2
   {
	width: 100%;
	height: 70%;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }
   
     .list
   {
	   font-size:15px;
	   
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
 </head>
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
            <li class="active"><a href="../mediacontent/index.php">Media Content</a></li>
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
  <br/>
        <div align="center">
        <div class="container box">


                    <div class="panel panel-default">
                        <div class="panel-heading">
                    
                              
                                    <h3 class="panel-title">Upload a Content Here</h3>
                         
                                <div class="col-md-12">
                                    <div class="image_upload"> <!--set up class for uploading image-->
                                        <form id="uploadImage" method="post" action="upload.php">
                                            <label for="uploadFile"><img src="uploads.jpg" /></label>
									<input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .jpeg, .png, .gif, .mp4, .webm, .ogg, .mov" /> <!-- Accept specific file types -->
									</form>
                                    </div>
                                </div>
                          
                        </div>
                        <div class="panel-body"> <!--set up parameters to be used in javascript code -->
                            <form method="post" id="post_form">
                                <div class="form-group" id="dynamic_field">
                                    <textarea name="post_content" id="post_content" maxlength="160" class="form-control" placeholder="Upload File..."></textarea>
                                </div>
                                <div id="link_content"></div>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" value="insert" />
                                    <input type="hidden" name="post_type" id="post_type" value="text" />
                                    <input type="submit" name="share_post" id="share_post" class="btn btn-primary" value="Upload" />
                                </div>
                            </form>
                        </div>
                      </div>

 
	   <br/>
   <h1 align="center">Media Content</h1>
   <br />
   

  <select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker">
   <?php
   foreach($result as $row)
   {
    echo '<option class="list" value="'.$row["content_title"].'">'.$row["content_title"].'</option>'; 
   }
   ?>
   </select>
   <input type="hidden" name="hidden_number" id="hidden_number" />
   <div style="clear:both"></div>
    <br/>
   <div class="table-responsive">
    <br />
    <div align="right">
     
    </div>
    <br /><br />
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="5%">ID</th>
       <th width="5%">CodeBased Title</th>
       <th width="5%">Location Title</th>
       <th width="5%">Post Content</th>
       <th width="5%">Start</th>
       <th width="5%">End</th>
       <th width="5%">Update</th>
       <th width="5%">Delete</th>
      </tr>
	  </thead>
    </table>
	 <button type="button" class="btn btn-primary" id="top">Top</button> 
	 <button type="button" class="btn btn-danger" id="down">Down</button> 
   </div>
  </div>
  </div>
      <br><br>
	   <footer class="footer">
       	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
	<a href="../home/index.php" style="text-decoration: none; color:black;" >AFJCardiff</a>
    </footer>

 </body>
</html>

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
   <br/>
    <div class="col-lg-6">
     <h4 class="modal-title">Content Details</h4>
	 </div>
    </div>
    <div class="modal-body"  id="post_detail">
    <div class="col-md-6">
	 <label>Enter CodeBased Title</label>
     <input type="text" name="codebased_title" id="codebased_title" class="form-control" />
	</div>
	<div class="col-md-6">
	 <label>Enter Content Title</label>
     <input type="text" name="content_title" id="content_title" class="form-control" />
    </div>
	<div class="col-md-6">
	 <label>Enter Start Date</label>
     <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" />
    </div>
	<div class="col-md-6">
	 <label>Enter End Date</label>
     <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" />
    </div>
    </div>
	<br/>
	<br/>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
	  <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
   </div>
  </form>
 </div>
</div>
</div>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Add Content Title");
  $('#action').val("Add");
  $('#operation').val("Add");

 });
 
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[0],
    "orderable":false,
   },
  ],

 });

    load_data();
    
    function load_data(query='') {
        $.ajax({
            url:"find.php",
            method:"POST",
            data:{query:query},
            success:function(data) {
                $('tbody').html(data);
                $('#user_form')[0].reset();
            }
        });
    }

    // Response function for handling AJAX success
    function response(data) {
        // Reload data after each operation
        load_data();
        // Handle other actions if needed
        console.log(data); // Example: log the response data to the console
    }

 $('#multi_search_filter').change(function(){
  $('#hidden_number').val($('#multi_search_filter').val());
  var query = $('#hidden_number').val();
  load_data(query);
 });

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var codebased_title = $('#codebased_title').val();
  var content_title = $('#content_title').val();

  if(codebased_title != '' && content_title != '')
  {
   $.ajax({
    url:"insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#codebased_title').val(data.codebased_title);
    $('#content_title').val(data.content_title);
    $('#start_datetime').val(data.start_datetime);
    $('#end_datetime').val(data.end_datetime);
    $('.modal-title').text("Edit Content Details");
    $('#user_id').val(user_id);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
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
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   return false; 
  }
 });

 $('#post_form').on('submit', function(event){
        event.preventDefault();
        if($('#post_type').val() == 'upload')
        {
            $('#post_content').val($('#sub_division').html());
        }

        if($('#post_type').val() == 'link')
        {
            $('#post_content').val($('#link_content').html());
            $('#link_content').css('padding', '0');
            $('#link_content').css('background-color', '');
            $('#link_content').css('margin-bottom', '0');
        }

        if($('#post_content').val() == '') //prevent story from being posted if post content in empty  
        {
            alert('Enter Content'); 
        }
        else
        {
            var form_data = $(this).serialize(); //apply ajax method to disable share post button when content is sent
            $.ajax({
                url:"action.php",
                method:"POST",
                data:form_data,
                beforeSend:function()
                {
                    $('#share_post').attr('disabled', 'disabled');  
                },
                success:function(data)
                {
                    alert('Post has been shared');
                    $('#dynamic_field').html('<textarea name="post_content" id="post_content" maxlength="160" class="form-control" placeholder="post content here"></textarea>');
                    $('#post_type').val('text');
                    $('#post_form')[0].reset();
                    fetch_post();
                    $('#link_content').html('');
                    $('#share_post').attr('disabled', false);
                }
            })
        }
    });

    fetch_post();

    function fetch_post() //set up parameters for listing posted content
    {
       var action = 'fetch_post';
       $.ajax({
            url:'action.php',
            method:"POST",
            data:{action:action},
            success:function(data)
            {
                $('tbody').html(data); 
				dataTable.ajax.reload();
            }
       })
    }


$('#uploadFile').on('change', function(event) { 
    // Disable the submit button
    $('#share_post').prop('disabled', true);

    var html = '<div class="main_division">';
    html += '<div id="sub_division" contenteditable class="form-control"></div></div>';
    html += '<input type="hidden" name="post_content" id="post_content" />';
    $('#post_type').val('upload');
    $('#dynamic_field').html(html);

    $('#uploadImage').ajaxSubmit({
        target: '#sub_division',
        resetForm: true,
        complete: function(xhr) {
            // Enable the submit button once the upload is complete
            $('#share_post').prop('disabled', false);
        }
    });
});

$(document).on('keyup', '#post_content', function() { 
    var check_content = $('#post_content').val();
    var check_url = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig; // check validation of url link
    var if_url = check_content.match(check_url);

    if(if_url) {
        $('#link_content').css({
            'padding': '16px',
            'background-color': '#f9f9f9',
            'margin-bottom': '16px'
        }).html('<h3>Retrieving...</h3>');

        $('#post_type').val('link');
        var action = 'fetch_link_content';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { action: action, url: if_url },
            success: function(data) {
                var title = $(data).filter("meta[property='og:title']").attr('content') || $(data).filter("meta[name='twitter:title']").attr('content');
                var description = $(data).filter("meta[property='og:description']").attr('content') || $(data).filter("meta[name='twitter:description']").attr('content');
                var image = $(data).filter("meta[property='og:image']").attr('content') || $(data).filter("meta[name='twitter:image']").attr('content');
                
                var output = '<a href="' + if_url[0] + '" target="_blank" style="text-decoration: none; color: inherit;">';
                output += '<img src="' + image + '" class="img-responsive img-thumbnail" />';
                output += '<h3><b>' + title + '</b></h3>';
                output += '<p>' + description + '</p>';
                output += '</a>';
                
                $('#link_content').html(output);
            }
        });
    } else {
        $('#link_content').html('').css({
            'padding': '0',
            'background-color': '',
            'margin-bottom': ''
        });
        return false;
    }
});


});
 
 function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

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
		   
		   


		   

/*this code is for scrollDown function */
 $(document).ready(function(){  
                $('a[href^="#"]').on('click', function(a){  
                     a.preventDefault();  
                     var target = this.hash;  
                     var $target = $(target);  
                     $('html, body').animate({  
                          'scrollTop':$target.offset().down  
                     }, 1000, 'swing');  
                });  
           });  
           $(function(){  
                $(window).scroll(function(){  
                     if($(this).scrollTop() == 0)  
                     {  
                          $('#down').fadeIn();  
                     }  
                     else  
                     {  
                          $('#down').fadeOut();  
                     }  
					 
					
				
                });  
                $('#down').click(function(){  
                     $('body,html').animate({scrollTop:300000},500);  
                });  
           });

</script>
   