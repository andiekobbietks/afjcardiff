  <script>
$(document).ready(function() {
      const recordsPerPage = 10;  // Number of records per page

function loadObjects(query = '', page = 1) {
	$.ajax({
		url: 'crud.php',
		type: 'POST',
		data: {
			action: 'fetch',
			query: query,
			page: page,
			records_per_page: recordsPerPage
		},
		success: function(response) {
			$('#objectTableBody tbody').html(response);
		}
	});
}

// Trigger search on input
$('#search_text').keyup(function() {
	var search = $(this).val();
	loadObjects(search);
});

// Handle pagination link clicks
$(document).on('click', '.pagination a', function(event) {
	event.preventDefault();
	var page = $(this).data('page');
	var query = $('#search_text').val();
	loadObjects(query, page);
});

$('#objectForm').submit(function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append('action', 'save');

	$.ajax({
		url: 'crud.php',
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		success: function() {
			$('#objectModal').modal('hide');
			loadObjects();
		}
	});
});

	
function loadObjects(query = '', page = 1) {
	$.ajax({
		url: 'process_data.php',
		type: 'POST',
		data: {
			action: 'fetch',
			query: query,
			page: page,
			records_per_page: recordsPerPage
		},
		success: function(response) {
			$('#objectTableBody').html(response);
		}
	});
}

// Initial load
loadObjects();

// Trigger search on input
$('#search_text').keyup(function() {
	var search = $(this).val();
	loadObjects(search);
});

// Handle pagination link clicks
$(document).on('click', '.pagination a', function(event) {
	event.preventDefault();
	var page = $(this).data('page');
	var query = $('#search_text').val();
	loadObjects(query, page);
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
	
	
// Load data with optional query and page parameters
load_data();

function load_data(query = '', page = 1) {
	$.ajax({
		url: "find.php",
		method: "POST",
		data: { query: query, page: page },
		success: function(data) {
			$('#objectTableBody').html(data);
		}
	});
}

// Trigger data loading on filter change
$('#multi_search_filter').change(function() {
	$('#class_search').val($('#multi_search_filter').val());
	var query = $('#class_search').val();
	load_data(query);  // Load data with the current query
});

// Handle pagination link clicks
$(document).on('click', '.pagination a', function(event) {
	event.preventDefault();  // Prevent default link behavior
	var page = $(this).data('page');  // Get the selected page number
	var query = $('#class_search').val();  // Get the current query
	load_data(query, page);  // Load data with the current query and selected page
});

    $('#objectTableBody').on('click', '.editObject', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'crud.php',
            type: 'POST',
            data: { action: 'fetch_single', id: id },
            success: function(response) {
                var object = JSON.parse(response);
                $('#class_id').val(object.class_id);
                $('#class_title').val(object.class_title);
                $('#code_basedtitle').val(object.code_basedtitle);
                $('#class_description').val(object.class_description);
                $('#expected_startdatetime').val(object.expected_startdatetime);
                $('#expected_enddatetime').val(object.expected_enddatetime);
				if (object.class_image) {
					$('#existingImage')
						.attr('src', '../imageuploads/' + object.class_image)
						.attr('style', 'width: 100%;') // Set the desired width here
						.addClass('img-thumbnail') // Add the Bootstrap thumbnail class
						.show();
				} else {
					$('#existingImage').hide();
				}
                $('#objectModalLabel').text('Edit Class');
                $('#objectModal').modal('show');
            }
        });
    });

        // Trigger Add Rows Modal
        $('#add_button').click(function(){
            $('#user_form_add')[0].reset(); // Reset the form inside the modal
            $('.modal-title').text("Add Class Details");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        // Adding multiple rows functionality
        var count = 1;

        $('#addrows').click(function() {
            var html_code = "<div id='row" + count + "' class='row'>";
            
            // Class Image
            html_code += "<div class='col-md-12'>";
            html_code += "<div class='form-group'>";
            html_code += "<label for='class_image'>Select Image</label>";
            html_code += "<input type='file' name='class_image[]' class='form-control-file' />";
            html_code += "</div></div>";

            // Class Title
            html_code += "<div class='col-md-6'>";
            html_code += "<div class='form-group'>";
            html_code += "<label>Class Title</label>";
            html_code += "<input type='text' name='class_title[]' id='class_title' class='form-control' />";
            html_code += "</div></div>";

            // Code BasedTitle ID
            html_code += "<div class='col-md-6'>";
            html_code += "<div class='form-group'>";
            html_code += "<label>Code BasedTitle</label>";
            html_code += "<input type='text' name='code_basedtitle[]' id='code_basedtitle' class='form-control' />";
            html_code += "</div></div>";   
			
			// Code BasedTitle ID
            html_code += "<div class='col-md-6'>";
            html_code += "<div class='form-group'>";
            html_code += "<label>Class Description</label>";
            html_code += "<input type='text' name='class_description[]' id='class_description' class='form-control' />";
            html_code += "</div></div>";

			// Code BasedTitle ID
            html_code += "<div class='col-md-6'>";
            html_code += "<div class='form-group'>";
            html_code += "<label>Start DateTime</label>";
            html_code += "<input type='text' name='expected_startdatetime[]' id='expected_startdatetime' class='form-control' />";
            html_code += "</div></div>";
			
			
			html_code += "<div class='col-md-6'>";
			html_code += "<div class='form-group'>";
			html_code += "<label>End DateTime</label>";
            html_code += "<input type='text' name='expected_enddatetime[]' id='expected_enddatetime' class='form-control' />";
			html_code += "</div></div>";

            // Remove button
            html_code += "<div class='col-md-12'>";
            html_code += "<br/><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs remove'>Remove Row</button>";
            html_code += "</div>";

            html_code += "</div>"; // End of row
            
            $('#class_form_rows').append(html_code);
            count++;
        });

        // Remove row functionality
        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });


$(document).on('submit', '#user_form_add', function(event) {
    event.preventDefault();

    // Gather all inputs
    var class_titles = $('input[name="class_title[]"]');
    var code_basedtitles = $('input[name="code_basedtitle[]"]');
    var valid = true;

    // Validate each row of input
    class_titles.each(function(index) {
        if ($(this).val() == '' || $(code_basedtitles[index]).val() == '') {
            valid = false;
        }
    });

    if(valid) {
        $.ajax({
            url: "insert.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data);
                $('#user_form_add')[0].reset();
                $('#userModal_add').modal('hide');
                loadObjects();
            }
        });
    } else {
        alert("All Sections Require Data");
    }
});

$('#deleteMultipleObjects').click(function() {
	var selected = [];
	$('input[name="object_ids[]"]:checked').each(function() {
		selected.push($(this).val());
	});

	if (selected.length > 0 && confirm('Are you sure you want to delete selected class?')) {
		$.ajax({
			url: 'crud.php',
			type: 'POST',
			data: { action: 'delete_multiple', ids: selected },
			success: function() {
				loadObjects();
			},
			error: function() {
				alert('An error occurred while trying to delete the classes.');
			}
		});
	} else {
		alert('Please select at least one class to delete.');
	}
});

$(document).on('click', '.delete', function() {
	var id = $(this).data('id');
	
	if (confirm('Are you sure you want to delete this class?')) {
		$.ajax({
			url: 'crud.php',
			type: 'POST',
			data: { action: 'delete_single', id: id },
			success: function() {
				loadObjects(); // Refresh the table after deletion
			},
			error: function() {
				alert('An error occurred while trying to delete the class.');
			}
		});
	}
});

    $('#editMultipleObjects').click(function() {
        var selectedIds = [];
        $('input[name="object_ids[]"]:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert('Please select at least one class.');
            return;
        }

        $.ajax({
            url: 'crud.php',
            type: 'POST',
            data: { action: 'fetch_multiple', ids: selectedIds },
            success: function(response) {
                var classes = JSON.parse(response);
                var html = '';

                classes.forEach(function(object, index) {
                    html += `<div class="object-edit-group">
                                <input type="hidden" name="object_ids[]" value="${object.class_id}">
								
                                <div class="form-group">
                                    <label for="class_image_${index}">Class Image</label>
                                    <input type="file" name="class_image[]" id="class_image_${index}" class="form-control-file">
                                    <img src="../imageuploads/${object.class_image}" alt="Current Image" style="width:100%;" class="img-thumbnail">
								</div>
								<br/>
                                <div class="form-group">
                                    <label for="class_title_${index}">Class Title</label>
                                    <input type="text" name="class_title[]" id="class_title_${index}" value="${object.class_title}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="code_basedtitle_${index}">Code BasedTitle</label>
                                    <input type="text" name="code_basedtitle[]" id="code_basedtitle_${index}" value="${object.code_basedtitle}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="class_description_${index}">Class Description</label>
                                    <textarea type="text" name="class_description[]" id="class_description_${index}" value="${object.class_description}" class="form-control">
                                </textarea>
                                </div>
								
                                <div class="form-group">
                                    <label for="expected_startdatetime_${index}">Start DateTime</label>
                                    <input type="text" name="expected_startdatetime[]" id="expected_startdatetime_${index}" value="${object.expected_startdatetime}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="expected_enddatetime_${index}">End DateTime</label>
                                    <input type="text" name="expected_enddatetime[]" id="expected_enddatetime_${index}" value="${object.expected_enddatetime}" class="form-control">
                                </div>
                            </div>`;
                });

                $('#addMultipleContainer').html(html);
                $('#addMultipleModal').modal('show');
            }
        });
    });

    $('#addMultipleForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'save_multiple');

        $.ajax({
            url: 'crud.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function() {
                $('#addMultipleModal').modal('hide');
                loadObjects();
            }
        });
    });
});
    </script>