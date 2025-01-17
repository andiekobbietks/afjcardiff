<?php

function afj($connect)
{
    $query = "SELECT * FROM classes WHERE code_basedtitle = 'afjcardiff'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output = "../imageuploads/" . $row["class_image"];
    }
    return $output;
}


function afjcardifflogo($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'afjcardiff'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        if ($row["class_image"] != '') {
            $output .= '<img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/>';
        }
    }
    return $output;
}

function afjcardifflogonav($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'afjcardifflogonav'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
foreach ($result as $row) {
    if ($row["class_image"] != '') {
        $output .= '<img src="../imageuploads/'.$row["class_image"].'" class="logo-img"/>';
    }
}

    return $output;
}

function getallrecords($connect)
{
    $query = "SELECT * FROM classes";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount(); // Moved this line after executing the statement
    $output = '
        <div align="center">
            <h3><span class="label" style="
			background: linear-gradient(to bottom, #D99543, rgba(191, 59, 94, 0.8));color: white;">Available Results: ' . $total_row . '</span></h3>
        </div>
    ';
    return $output;
}

function videos($connect)
{
    $query = "SELECT * FROM videos order by video_id desc";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '<div class="container mt-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">';
    foreach ($result as $row) {
        $output .= '
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="video-container">
                                <video class="card-img-top" controls>
                                    <source src="../imageuploads/' . $row['file_name'] . '" type="video/mp4">
                                </video>
                            </div>
                            <div class="card-text">
                                <h5 class="card-title">' . $row['title'] . '</h5>
                            </div>
                    </div>
                </div>';
    }
    if (empty($result)) {
        $output .= "<p class='text-lg font-medium'>No videos found.</p>";
    }
    $output .= '
            </div>
        </div>
    </div>';
    return $output;
}


function upcomingevent($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'upcomingevent'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '<div class="col-md-12  order-lg-1" data-aos="fade-up">
            <h2 class="heading">Upcoming Event!</h2></div>';
            $output .= '<img src="../imageuploads/'.$row["class_image"].'" class="img-fluid rounded"/>';
        
    }
    return $output;
}

function video($connect)
{
    $query = "SELECT * FROM videos WHERE title = 'AFJ'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<div class="video-container">
    <video autoplay muted loop class="fillWidth">
        <source src="../imageuploads/' . $row['file_name'] . '" type="video/mp4">
    </video>
</div>
';
    }
    return $output;
}

function homepagevideo($connect)
{
    $query = "SELECT * FROM videos WHERE title != 'AFJ'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<div class="video-container">
    <video autoplay muted loop class="fillWidth">
        <source src="../imageuploads/' . $row['file_name'] . '" type="video/mp4">
    </video>
</div>
';
    }
    return $output;
}

function youtubevideo($connect) {
    $query = "SELECT * FROM videourl";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4 h-100">
                <a href="#" class="mb-4 d-block">
                    <div class="video-container">
                        <iframe src="' . $row['video_url'] . '" allowfullscreen></iframe>
                    </div>
                </a>
            </div>
        </div>';
    }
    return $output;
}

function youtubevideohome($connect)
{
    $query = "SELECT * FROM videourl order by url_id desc limit 3";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '
		
		      <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">

            <div class="media media-custom d-block mb-4 h-100">
              <a href="#" class="mb-4 d-block">
		<iframe width="560" height="500" src="' . $row['video_url'] . '" frameborder="0" allowfullscreen  class="img-fluid"></iframe><br></a>
            </div>

          </div>';
    }
    return $output;
}

function galleryimages($connect) {
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'gallery'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '
            <div class="slide-item" data-title="'.$row["class_title"].'" data-description="'.$row["class_description"].'" data-image="../imageuploads/'.$row["class_image"].'">
                <img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/>
                <div class="overlay">+</div>
            </div>
        ';
    }
    $output .= '
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="Image"/>
            <div class="modal-text">
              <h5 id="modalTitle"></h5>
              <p id="modalDescription"></p>
            </div>
          </div>
        </div>
    ';
    return $output;
}

function homepagegallery($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'gallery'
		ORDER BY class_id DESC
		LIMIT 3 
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
			<div class="slide-item"><img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/></div>
			'; 
    }
    return $output;
}

function homepageclassesgallery($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'classesgallery'
		ORDER BY class_id DESC
		LIMIT 3 
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
			
		<div class="slide-item">
		<a href="../classsession/index.php">
    <div class="text-overlay">
        <h4 style="color: white;">'.$row["class_title"].'</h4>
    </div>
    <img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/>
	</a>
</div>';
    }
    return $output;
}

function jointheteam_hompage_background($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'jointheteam_hompage_background'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

/* function combinedDisplay($connect) {
    // Query for events
    $query1 = "SELECT * FROM media_content WHERE codebased_title = 'eventcontent'";
    $statement1 = $connect->prepare($query1);
    $statement1->execute();
    $result1 = $statement1->fetchAll();

    // Query for features
    $query2 = "SELECT * FROM classes WHERE code_basedtitle = 'featuredisplay'";
    $statement2 = $connect->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();

    // Combine results
    $combinedResults = array_merge($result1, $result2);

    // Process combined results
    $output = '';
    foreach ($combinedResults as $row) {
        if (isset($row["class_title"])) {
            // This is a feature
            $output .= '
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4 h-100">
              <img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/>
              <div class="media-body">
                <h2 class="mt-0 mb-3" align="center">'.$row["class_title"].'</h2>
                <p>'.$row["class_description"].'</p>
              </div>
              </div>
            </div>
            ';
        } else {
            // This is an event
            $output .= '
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4 h-100">
              <h2 class="mt-0 mb-3" align="center">'.$row["content_title"].'</h2>
              <div class="mb-4">'.$row["post_content"].'</div>
              <div class="media-body">
              </div>
            </div>
          </div>
            ';
        }
    }

    return $output;
}
 */
 
function newsevents($connect)
{
    // CSS styles for media content
    $output = '
    ';

    $query = "SELECT * FROM media_content WHERE codebased_title = 'featurednews'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $output .= '
            <div class="col-sm-6 post mb-5" data-aos="fade-up" data-aos-delay="100" align="center">
                <div class="media media-custom d-block mb-4 h-100">
                    <h2 class="mt-0 mb-3" align="center">' . $row["content_title"] . '</h2>
                    <div class="mb-4">' . $row["post_content"] . '</div>
                    <div class="media-body">
                    </div>
                </div>
            </div>
        ';
    }
    return $output;
}

function featurednewstitle($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'featurednews'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= ''.$row["class_title"].''; 
    }
    return $output;
}

function featurednewsdescription($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'featurednews'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
                <p  data-aos="fade-up">'.$row["class_description"].'</p>
			
			'; 
    }
    return $output;
}

function joinusdescription($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'joinusdescription'
		limit 3
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
			<div style="color:white;">
			<h3 class="text-center" data-aos="fade-up">'.$row["class_title"].'</h3>
                <p class="text-center" data-aos="fade-up">'.$row["class_description"].'</p>
			</div>
			'; 
    }
    return $output;
}

function classespage($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'regular class'
        OR code_basedtitle = '1 to 1'
        ORDER BY class_id DESC
		LIMIT 3
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';

    // Include jQuery and Bootstrap JS here
    $output .= '
    ';

    foreach ($result as $row) {
        $output .= '
            <div class="col-md-6 col-lg-4 mb-5">
                <a href="../classsession/index.php" class="classdetails">
                    <figure class="img-wrap">
                        <img src="../imageuploads/'.$row["class_image"].'" class="img-fluid md-3"/>
                    </figure>
                    <div class="p-3 text-center">
                        <h2 class="classdetails-info">'.$row["class_title"].'</h2>
                        <span class="letter-spacing-1">'.$row["class_description"].'</span>
                    </div>
                    <div class=" text-center classdetails-info">
                        <span class="meta-post">Start: '.$row["expected_startdatetime"].'</span>
                    </div>
                    <div class=" text-center classdetails-info">
                        <span class="meta-post">Finish: '.$row["expected_enddatetime"].'</span>
						</div>
						<br/>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <button class="btn btn-outline-white-primary text-black">Learn More</button>
            </div>
                </a>
            </div>
        ';
    }
    return $output;
}

function classoffersdetails($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'classoffersdetails'
        ORDER BY class_title ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';

    // Include jQuery and Bootstrap JS here
    $output .= '
    ';

    foreach ($result as $row) {
	$output .= '
		<div class="p-3 text-center transparent-bg" data-aos="fade-up">
    <h2 class="classdetails-info" style="color: white;">'.$row["class_title"].'</h2>
    <span class="letter-spacing-1">'.$row["class_description"].'</span>
</div>

     ';
    }
    return $output;
}


function homepage_classes($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'classoffers'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
				<a href="../classsession/index.php">
			   <div class="classdetails">
              <figure class="img-wrap">
               <img src="../imageuploads/'.$row["class_image"].'" alt="" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center classdetails-info">
                <h2 style="color:white;">'.$row["class_title"].'</h2>
                <span class="text-uppercase letter-spacing-1" style="color:#D99543";>'.$row["class_description"].'</span>
              </div>
            </div>
			</a>
			';
        
    }
    return $output;
}

function homepage_workshops($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'workshop'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
				<a href="../classsession/index.php">
			   <div class="classdetails">
              <figure class="img-wrap">
               <img src="../imageuploads/'.$row["class_image"].'" alt="" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center classdetails-info">
                <h2 style="color:white;">'.$row["class_title"].'</h2>
                <span class="text-uppercase letter-spacing-1" style="color:#D99543";>'.$row["class_description"].'</span>
              </div>
            </div>
			</a>
			';
        
    }
    return $output;
}
function homepage_collabs($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = '1-1'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
				<a href="../classsession/index.php">
			   <div class="classdetails">
              <figure class="img-wrap">
               <img src="../imageuploads/'.$row["class_image"].'" alt="" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center classdetails-info">
                <h2 style="color:white;">'.$row["class_title"].'</h2>
                <span class="text-uppercase letter-spacing-1" style="color:#D99543";>'.$row["class_description"].'</span>
              </div>
            </div>
			</a>
			';
        
    }
    return $output;
}

function homepage_classestitle($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'CongoleseStyle'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= $row["class_title"];
        
    }
    return $output;
}

function eventspage($connect)
{
    $query = "SELECT * FROM media_content WHERE codebased_title = 'eventcontent'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
			     <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4 h-100">
              <div class="mb-4">'.$row["post_content"].'</div>
                <h2 class="mt-0 mb-3" align="center">'.$row["content_title"].'</h2>
              <div class="media-body">
                <span class="meta-post">Start: '.$row["start_datetime"].'</span>
                <span class="meta-post">Finish: '.$row["end_datetime"].'</span>
              </div>
            </div>
          </div>
		  '; 
    }
    return $output;
}

function book1to1($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'book1to1'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

function book1to1caption($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'book1to1'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result) {
        $output = $result["class_title"];
    }
    return $output;
}


function whatwecurrentlyoffer($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'whatwecurrentlyoffer'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

function classesbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'classesbackground'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

function videosbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'videosbackground'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

function aboutus($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutus'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '<img src="../imageuploads/'.$row["class_image"].'" alt="" class="img-fluid mb-3">
			';
    }
    return $output;
}

function aboutusdesciption($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutus'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
			    <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
           <h1><strong>'.$row["class_title"].'</strong></h1>
            <p class="mb-4">'.$row["class_description"].'</p>
          </div>
			';
        
    }
    return $output;
}

function aboutusmission($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutusmission'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
			    <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
           <h1><strong>'.$row["class_title"].'</strong></h1>
            <p class="mb-4">'.$row["class_description"].'</p>
          </div>
			';
        
    }
    return $output;
}

function aboutusmissionimage($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutusmission'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '<img src="../imageuploads/'.$row["class_image"].'" alt="" class="img-fluid mb-3">
			';
    }
    return $output;
}

function aboutusleadership($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutusleadership'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
			        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="block-2">
            <div class="flipper">
              <div class="front" style="background-image: url(../imageuploads/'.$row["class_image"].');">
                <div class="box">
                  <h2>'.$row["class_title"].'</h2>
                </div>
              </div>
              <div class="back">
                <!-- back content -->
                <blockquote>
                  <p style="color: black;">'.$row["class_description"].'</p>
                </blockquote>
                <div class="author d-flex">
                  <div class="image mr-3 align-self-center">
                    <img src="../imageuploads/'.$row["class_image"].'" alt="">
                  </div>
                  <div class="name align-self-center"  style="color: black;">'.$row["class_title"].'</div>
                </div>
              </div>
            </div>
          </div> <!-- .flip-container -->
        </div>
			    
			';
        
    }
    return $output;
}

function aboutusbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'aboutusbackground'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    if ($result && $result["class_image"] != '') {
        return '../imageuploads/' . $result["class_image"];
    } else {
        return ''; 
    }
}


function aboutushistory($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'aboutushistory'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
			
			 <div class="col-md-8">
            <div class="timeline-item" data-aos="fade">
              <h3>'.$row["class_title"].'</h3>
              <p>'.$row["class_description"].'</p>
            </div>
            </div>
			';
        
    }
    return $output;
}

function greatoffers($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'Special Event'
		order by class_title DESC
		LIMIT 3
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '
				<br/>
				<div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100">
				<a href="../classsession/index.php" class="image d-block bg-image-2" style="background-image: url(../imageuploads/'.$row["class_image"].');"></a>
				<div class="text">
				<h3 class="display text-primary">'.$row["class_title"].'</h3>
				<br/>
				<p style="color:black;">'.$row["class_description"].'</p>
				<p><a href="../classsession/index.php" class="btn btn-primary text-white">Book Now</a></p>
				</div>
				</div>
				'; 
    }
    return $output;
}

function jointheteambackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'jointheteambackground'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    if ($result && $result["class_image"] != '') {
        return '../imageuploads/' . $result["class_image"];
    } else {
        return ''; 
    }
}

function newsbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'newsbackground'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    if ($result && $result["class_image"] != '') {
        return '../imageuploads/' . $result["class_image"];
    } else {
        return ''; 
    }
}

function contactusbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'contactusbackground'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    if ($result && $result["class_image"] != '') {
        return '../imageuploads/' . $result["class_image"];
    } else {
        return ''; 
    }
}
function testimonialbackground($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'testimonialbackground'
        LIMIT 1
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch();

    if ($result && $result["class_image"] != '') {
        return '../imageuploads/' . $result["class_image"];
    } else {
        return ''; // Return an empty string if no image is available
    }
}



function reviews($connect)
{
    $query = "SELECT * FROM classes WHERE code_basedtitle = 'reviews'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= $row["class_title"];
    }
    return $output;
}

function reviewdetails($connect)
{
    $query = "SELECT * FROM reviews 
	ORDER BY review_id DESC
	LIMIT 7";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
		
  $profile_image = '';
    if($row['profile_image'] != '')
    {
     $profile_image = '<img src="../imageuploads/'.$row["profile_image"].'" class="rounded-circle mx-auto"/>';
    }
    else
    {
     $profile_image = '<img src="../userimage/user.jpg"  class="rounded-circle mx-auto" />';
    }
   $output .= '
<div class="testimonial-container mb-5" data-aos="fade-up" data-aos-delay="200">
    <div class="testimonial text-center slider-item">
        <div class="author-image mb-3">'.$profile_image.'
        </div>
        <blockquote>
            <p>'.$row['message'].'</p>
        </blockquote>
        <p><em>&mdash; '.$row['firstname'].' '.$row['lastname'].'</em></p>
    </div>
</div>';

    }
    return $output;
}


function dancestyle($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'dancestyle'
        ORDER BY class_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
    }
    return $output;
	
}

function danceexperience($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'danceexperience'
        ORDER BY class_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
    }
    return $output;
	
}

function admin_email($connect)
{
    $query = "
        SELECT * FROM login
		where position = 'foradmin'
        ORDER BY memberuser_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["email"] . '">' . $row["email"] . '</option>';
    }
    return $output;
	
}
function user_email($connect)
{
    $query = "
        SELECT * FROM login
		where position = 'foruser'
        ORDER BY memberuser_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["email"] . '">' . $row["email"] . '</option>';
    }
    return $output;
	
}

function jointypehomepage($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'joiningtype'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '
		<a href="jointheteam.php">
			<div class="col-md-3 col-sm-6 col-12">
		  <div class="classdetails-menu mb-5">
			<div>
			 <img src="../imageuploads/'.$row["class_image"].'" class="img-fluid"/>
				  </div>
                    <span class="d-block text-primary h4 mb-3">'.$row["class_title"].'</span>
                    <h3 class="text-white"><a href="jointheteam.php" class="text-white">'.$row["class_description"].'</a></h3>
			<p class="text-white text-opacity-7"></p>
		  </div>
		</div>
		</a>
        ';
    }
    return $output;
}

function payments($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'payments'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(); // Use fetch() since you are fetching only one row
    $output = '';
    if ($result && $result["class_image"] != '') {
        $output = '../imageuploads/' . $result["class_image"];
    }
    return $output;
}

function classprices($connect)
{
    $query = "
        SELECT * FROM classes
        WHERE code_basedtitle = 'classprice'
        OR code_basedtitle = '121s'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '
            <div class="col-md-6">
                <div class="classdetails-menu mb-5">
                    <span class="d-block text-primary h4 mb-3">'.$row["class_title"].'</span>
                    <h3 class="text-white">'.$row["class_description"].'</h3>
                    <p class="text-white text-opacity-7"></p>
                </div>
            </div>
        ';
    }
    return $output;
}

function workshopprices($connect)
{
    $query = "
	SELECT * FROM classes
		where code_basedtitle = 'workshopprice'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
                <div class="col-md-6">
                  <div class="classdetails-menu mb-5">
                    <span class="d-block text-primary h4 mb-3">'.$row["class_title"].'</span>
                    <h3 class="text-white">'.$row["class_description"].'</h3>
                    <p class="text-white text-opacity-7"></p>
                  </div>
                </div>
			';
        
    }
    return $output;
}

function events_hiringdancers_prices($connect)
{
    $query = "
	SELECT * FROM classes
		WHERE code_basedtitle = 'events'
		OR code_basedtitle = 'hiredancerpice'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
                <div class="col-md-6">
                  <div class="classdetails-menu mb-5">
                    <span class="d-block text-primary h4 mb-3">'.$row["class_title"].'</span>
                    <h3 class="text-white">'.$row["class_description"].'</h3>
                    <p class="text-white text-opacity-7"></p>
                  </div>
                </div>
			';
        
    }
    return $output;
}

function afjcardiffIntroduction($connect)
{
    $query = "
	SELECT * FROM classes
		WHERE code_basedtitle = 'afjcardiffIntroduction'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
            $output .= '';
            $output .= '
		<div class="col-md-12" data-aos="fade-up">
            <h2 class="heading">'.$row["class_title"].'</h2>
            <p class="mb-4">'.$row["class_description"].'</p>
            <p><a href="about.php" class="btn btn-primary text-white py-2 mr-3">Learn More</a>
        </div>
			';
        
    }
    return $output;
}

function jointheteam($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'joiningtype'
        ORDER BY class_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
    }
    return $output;
	
}

function hire_dancer($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'joiningtype'
        ORDER BY class_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
    }
    return $output;
	
}

function inquiry($connect)
{
    $query = "
        SELECT * FROM classes
		where code_basedtitle = 'inquiry'
        ORDER BY class_id ASC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
    }
    return $output;
	
}

function maindancestudio($connect)
{
    $query = "SELECT * FROM media_content WHERE codebased_title = 'maindancestudio'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= $row["post_content"];
    }
    return $output;
}

function seconddancestudio($connect)
{
    $query = "SELECT * FROM media_content WHERE codebased_title = 'seconddancestudio'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
        $output .= $row["post_content"];
    }
    return $output;
}

function tiktok($connect)
{
    $query = "SELECT * FROM classes 
where code_basedtitle = 'tiktok'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
   $output .= '
            <img src="../imageuploads/'.$row["class_image"].'" alt="Image placeholder" class="rounded-circle" style="max-width:20px">
        ';

    }
    return $output;
}

function linkedin($connect)
{
    $query = "SELECT * FROM classes 
where code_basedtitle = 'linkedin'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {
   $output .= '
            <img src="../imageuploads/'.$row["class_image"].'" alt="Image placeholder" class="rounded-circle" style="max-width:20px">
        ';

    }
    return $output;
}


function getSubscribersChartData($connect)
{
    // Fetch total count of subscribers from the database
    $query = "SELECT COUNT(*) AS total_count FROM newsletters";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $totalCount = $result['total_count'];

    // Format the data for the chart
    $labels = ["Subscribers"];
    $data = [$totalCount];

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}

function getjointeamChartData($connect)
{
	$query = "SELECT join_team, COUNT(*) AS count FROM jointheteam GROUP BY join_team ORDER BY join_team ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Extract dance styles and their counts from results
    $labels = [];
    $data = [];
    foreach ($results as $row) {
        $labels[] = $row['join_team']; // Store dance style names in labels
        $data[] = $row['count']; // Store counts in data
    }

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}


function dancetyleChartData($connect)
{
    // Fetch count of subscribers by dance styles from the database
    $query = "SELECT dancestyle, COUNT(*) AS count FROM jointheteam GROUP BY dancestyle ORDER BY dancestyle ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Extract dance styles and their counts from results
    $labels = [];
    $data = [];
    foreach ($results as $row) {
        $labels[] = $row['dancestyle']; // Store dance style names in labels
        $data[] = $row['count']; // Store counts in data
    }

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}

function hiredancersChartData($connect)
{
    // Fetch count of subscribers by email from the database
    $query = "SELECT email, COUNT(*) AS count FROM hiredancers GROUP BY email ORDER BY email ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Extract emails and their counts from results
    $labels = [];
    $data = [];
    foreach ($results as $row) {
        $labels[] = $row['email']; // Store emails in labels
        $data[] = $row['count']; // Store counts in data
    }

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}

function reviewsChartData($connect)
{
    // Fetch count of subscribers by email from the database
    $query = "SELECT recipient_email, COUNT(*) AS count FROM reviews GROUP BY recipient_email ORDER BY recipient_email ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Extract emails and their counts from results
    $labels = [];
    $data = [];
    foreach ($results as $row) {
        $labels[] = $row['recipient_email']; // Store emails in labels
        $data[] = $row['count']; // Store counts in data
    }

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}

function contactusChartData($connect)
{
    // Fetch count of contacts by firstname and lastname from the database
    $query = "SELECT firstname, lastname, COUNT(*) AS count FROM contactus GROUP BY firstname, lastname ORDER BY firstname ASC, lastname ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Extract names and their counts from results
    $labels = [];
    $data = [];
    foreach ($results as $row) {
        $fullname = $row['firstname'] . ' ' . $row['lastname']; // Combine first name and last name
        $labels[] = $fullname; // Store full names in labels
        $data[] = $row['count']; // Store counts in data
    }

    // JSON encode the data to be used in JavaScript
    $chartData = [
        'labels' => $labels,
        'data' => $data
    ];

    return json_encode($chartData);
}


?>