<?php

class CategoryDetails
{
    private $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    // Function to get AFJ image path
    public function afj()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'afjcardiff'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output = "../imageuploads/" . $row["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get AFJ Cardiff logo
    public function afjcardifflogo()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'afjcardiff'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                if ($row["class_image"] != '') {
                    $output .= '<img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid"/>';
                }
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get AFJ Cardiff logo for navigation
    public function afjcardifflogonav()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'afjcardifflogonav'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                if ($row["class_image"] != '') {
                    $output .= '<img src="../imageuploads/' . $row["class_image"] . '" class="logo-img"/>';
                }
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get all records
    public function getallrecords()
    {
        try {
            $query = "SELECT * FROM classes";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
            $output = '
                <div align="center">
                    <h3><span class="label" style="background: linear-gradient(to bottom, #D99543, rgba(191, 59, 94, 0.8));color: white;">Available Results: ' . $total_row . '</span></h3>
                </div>
            ';
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get videos
    public function videos()
    {
        try {
            $query = "SELECT * FROM videos ORDER BY video_id DESC";
            $statement = $this->connect->prepare($query);
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get upcoming event
    public function upcomingevent()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'upcomingevent'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<div class="col-md-12  order-lg-1" data-aos="fade-up">
                <h2 class="heading">Upcoming Event!</h2></div>';
                $output .= '<img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid rounded"/>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get video
    public function video()
    {
        try {
            $query = "SELECT * FROM videos WHERE title = 'AFJ'";
            $statement = $this->connect->prepare($query);
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage video
    public function homepagevideo()
    {
        try {
            $query = "SELECT * FROM videos WHERE title != 'AFJ'";
            $statement = $this->connect->prepare($query);
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get YouTube videos
    public function youtubevideo()
    {
        try {
            $query = "SELECT * FROM videourl";
            $statement = $this->connect->prepare($query);
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get YouTube videos for homepage
    public function youtubevideohome()
    {
        try {
            $query = "SELECT * FROM videourl ORDER BY url_id DESC LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="media media-custom d-block mb-4 h-100">
                        <a href="#" class="mb-4 d-block">
                            <iframe width="560" height="500" src="' . $row['video_url'] . '" frameborder="0" allowfullscreen class="img-fluid"></iframe><br></a>
                    </div>
                </div>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get gallery images
    public function galleryimages()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'gallery'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="slide-item" data-title="' . $row["class_title"] . '" data-description="' . $row["class_description"] . '" data-image="../imageuploads/' . $row["class_image"] . '">
                    <img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid"/>
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage gallery
    public function homepagegallery()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'gallery' ORDER BY class_id DESC LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="slide-item"><img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid"/></div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage classes gallery
    public function homepageclassesgallery()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'classesgallery' ORDER BY class_id DESC LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="slide-item">
                    <a href="../classsession/index.php">
                        <div class="text-overlay">
                            <h4 style="color: white;">' . $row["class_title"] . '</h4>
                        </div>
                        <img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid"/>
                    </a>
                </div>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join the team homepage background
    public function jointheteam_hompage_background()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'jointheteam_hompage_background'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get news events
    public function newsevents()
    {
        try {
            $query = "SELECT * FROM media_content WHERE codebased_title = 'featurednews'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get featured news title
    public function featurednewstitle()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'featurednews'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '' . $row["class_title"] . '';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get featured news description
    public function featurednewsdescription()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'featurednews'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <p  data-aos="fade-up">' . $row["class_description"] . '</p>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join us description
    public function joinusdescription()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'joinusdescription' LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div style="color:white;">
                    <h3 class="text-center" data-aos="fade-up">' . $row["class_title"] . '</h3>
                    <p class="text-center" data-aos="fade-up">' . $row["class_description"] . '</p>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get classes page
    public function classespage()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' ORDER BY class_id DESC LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-6 col-lg-4 mb-5">
                    <a href="../classsession/index.php" class="classdetails">
                        <figure class="img-wrap">
                            <img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid md-3"/>
                        </figure>
                        <div class="p-3 text-center">
                            <h2 class="classdetails-info">' . $row["class_title"] . '</h2>
                            <span class="letter-spacing-1">' . $row["class_description"] . '</span>
                        </div>
                        <div class=" text-center classdetails-info">
                            <span class="meta-post">Start: ' . $row["expected_startdatetime"] . '</span>
                        </div>
                        <div class=" text-center classdetails-info">
                            <span class="meta-post">Finish: ' . $row["expected_enddatetime"] . '</span>
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
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get class offers details
    public function classoffersdetails()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'classoffersdetails' ORDER BY class_title ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="p-3 text-center transparent-bg" data-aos="fade-up">
                    <h2 class="classdetails-info" style="color: white;">' . $row["class_title"] . '</h2>
                    <span class="letter-spacing-1">' . $row["class_description"] . '</span>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage classes
    public function homepage_classes()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'classoffers'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <a href="../classsession/index.php">
                    <div class="classdetails">
                        <figure class="img-wrap">
                            <img src="../imageuploads/' . $row["class_image"] . '" alt="" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center classdetails-info">
                            <h2 style="color:white;">' . $row["class_title"] . '</h2>
                            <span class="text-uppercase letter-spacing-1" style="color:#D99543";>' . $row["class_description"] . '</span>
                        </div>
                    </div>
                </a>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage workshops
    public function homepage_workshops()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'workshop'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <a href="../classsession/index.php">
                    <div class="classdetails">
                        <figure class="img-wrap">
                            <img src="../imageuploads/' . $row["class_image"] . '" alt="" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center classdetails-info">
                            <h2 style="color:white;">' . $row["class_title"] . '</h2>
                            <span class="text-uppercase letter-spacing-1" style="color:#D99543";>' . $row["class_description"] . '</span>
                        </div>
                    </div>
                </a>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage collaborations
    public function homepage_collabs()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = '1-1'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <a href="../classsession/index.php">
                    <div class="classdetails">
                        <figure class="img-wrap">
                            <img src="../imageuploads/' . $row["class_image"] . '" alt="" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center classdetails-info">
                            <h2 style="color:white;">' . $row["class_title"] . '</h2>
                            <span class="text-uppercase letter-spacing-1" style="color:#D99543";>' . $row["class_description"] . '</span>
                        </div>
                    </div>
                </a>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get homepage classes title
    public function homepage_classestitle()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'CongoleseStyle'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= $row["class_title"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get events page
    public function eventspage()
    {
        try {
            $query = "SELECT * FROM media_content WHERE codebased_title = 'eventcontent'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 post mb-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="media media-custom d-block mb-4 h-100">
                        <div class="mb-4">' . $row["post_content"] . '</div>
                        <h2 class="mt-0 mb-3" align="center">' . $row["content_title"] . '</h2>
                        <div class="media-body">
                            <span class="meta-post">Start: ' . $row["start_datetime"] . '</span>
                            <span class="meta-post">Finish: ' . $row["end_datetime"] . '</span>
                        </div>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get book 1 to 1 image
    public function book1to1()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'book1to1' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get book 1 to 1 caption
    public function book1to1caption()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'book1to1' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result) {
                $output = $result["class_title"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get what we currently offer image
    public function whatwecurrentlyoffer()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'whatwecurrentlyoffer' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get classes background image
    public function classesbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'classesbackground'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get videos background image
    public function videosbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'videosbackground'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us image
    public function aboutus()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutus'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<img src="../imageuploads/' . $row["class_image"] . '" alt="" class="img-fluid mb-3">';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us description
    public function aboutusdesciption()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutus'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
                    <h1><strong>' . $row["class_title"] . '</strong></h1>
                    <p class="mb-4">' . $row["class_description"] . '</p>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us mission
    public function aboutusmission()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutusmission'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
                    <h1><strong>' . $row["class_title"] . '</strong></h1>
                    <p class="mb-4">' . $row["class_description"] . '</p>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us mission image
    public function aboutusmissionimage()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutusmission'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<img src="../imageuploads/' . $row["class_image"] . '" alt="" class="img-fluid mb-3">';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us leadership
    public function aboutusleadership()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutusleadership'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="block-2">
                        <div class="flipper">
                            <div class="front" style="background-image: url(../imageuploads/' . $row["class_image"] . ');">
                                <div class="box">
                                    <h2>' . $row["class_title"] . '</h2>
                                </div>
                            </div>
                            <div class="back">
                                <blockquote>
                                    <p style="color: black;">' . $row["class_description"] . '</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image mr-3 align-self-center">
                                        <img src="../imageuploads/' . $row["class_image"] . '" alt="">
                                    </div>
                                    <div class="name align-self-center" style="color: black;">' . $row["class_title"] . '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us background image
    public function aboutusbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutusbackground' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && $result["class_image"] != '') {
                return '../imageuploads/' . $result["class_image"];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get about us history
    public function aboutushistory()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'aboutushistory'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-8">
                    <div class="timeline-item" data-aos="fade">
                        <h3>' . $row["class_title"] . '</h3>
                        <p>' . $row["class_description"] . '</p>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get great offers
    public function greatoffers()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'Special Event' ORDER BY class_title DESC LIMIT 3";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <br/>
                <div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100">
                    <a href="../classsession/index.php" class="image d-block bg-image-2" style="background-image: url(../imageuploads/' . $row["class_image"] . ');"></a>
                    <div class="text">
                        <h3 class="display text-primary">' . $row["class_title"] . '</h3>
                        <br/>
                        <p style="color:black;">' . $row["class_description"] . '</p>
                        <p><a href="../classsession/index.php" class="btn btn-primary text-white">Book Now</a></p>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join the team background image
    public function jointheteambackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'jointheteambackground' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && $result["class_image"] != '') {
                return '../imageuploads/' . $result["class_image"];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get news background image
    public function newsbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'newsbackground' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && $result["class_image"] != '') {
                return '../imageuploads/' . $result["class_image"];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get contact us background image
    public function contactusbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'contactusbackground' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && $result["class_image"] != '') {
                return '../imageuploads/' . $result["class_image"];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get testimonial background image
    public function testimonialbackground()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'testimonialbackground' LIMIT 1";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            if ($result && $result["class_image"] != '') {
                return '../imageuploads/' . $result["class_image"];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get reviews
    public function reviews()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'reviews'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= $row["class_title"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get review details
    public function reviewdetails()
    {
        try {
            $query = "SELECT * FROM reviews ORDER BY review_id DESC LIMIT 7";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $profile_image = '';
                if ($row['profile_image'] != '') {
                    $profile_image = '<img src="../imageuploads/' . $row["profile_image"] . '" class="rounded-circle mx-auto"/>';
                } else {
                    $profile_image = '<img src="../userimage/user.jpg" class="rounded-circle mx-auto" />';
                }
                $output .= '
                <div class="testimonial-container mb-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">' . $profile_image . '
                        </div>
                        <blockquote>
                            <p>' . $row['message'] . '</p>
                        </blockquote>
                        <p><em>&mdash; ' . $row['firstname'] . ' ' . $row['lastname'] . '</em></p>
                    </div>
                </div>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get dance styles
    public function dancestyle()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'dancestyle' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get dance experience
    public function danceexperience()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'danceexperience' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get admin email
    public function admin_email()
    {
        try {
            $query = "SELECT * FROM login WHERE position = 'foradmin' ORDER BY memberuser_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["email"] . '">' . $row["email"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get user email
    public function user_email()
    {
        try {
            $query = "SELECT * FROM login WHERE position = 'foruser' ORDER BY memberuser_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["email"] . '">' . $row["email"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join type homepage
    public function jointypehomepage()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'joiningtype' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <a href="jointheteam.php">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="classdetails-menu mb-5">
                            <div>
                                <img src="../imageuploads/' . $row["class_image"] . '" class="img-fluid"/>
                            </div>
                            <span class="d-block text-primary h4 mb-3">' . $row["class_title"] . '</span>
                            <h3 class="text-white"><a href="jointheteam.php" class="text-white">' . $row["class_description"] . '</a></h3>
                            <p class="text-white text-opacity-7"></p>
                        </div>
                    </div>
                </a>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get payments image
    public function payments()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'payments'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $output = '';
            if ($result && $result["class_image"] != '') {
                $output = '../imageuploads/' . $result["class_image"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get class prices
    public function classprices()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'classprice' OR code_basedtitle = '121s'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-6">
                    <div class="classdetails-menu mb-5">
                        <span class="d-block text-primary h4 mb-3">' . $row["class_title"] . '</span>
                        <h3 class="text-white">' . $row["class_description"] . '</h3>
                        <p class="text-white text-opacity-7"></p>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get workshop prices
    public function workshopprices()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'workshopprice'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-6">
                    <div class="classdetails-menu mb-5">
                        <span class="d-block text-primary h4 mb-3">' . $row["class_title"] . '</span>
                        <h3 class="text-white">' . $row["class_description"] . '</h3>
                        <p class="text-white text-opacity-7"></p>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get events and hiring dancers prices
    public function events_hiringdancers_prices()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'events' OR code_basedtitle = 'hiredancerpice'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-6">
                    <div class="classdetails-menu mb-5">
                        <span class="d-block text-primary h4 mb-3">' . $row["class_title"] . '</span>
                        <h3 class="text-white">' . $row["class_description"] . '</h3>
                        <p class="text-white text-opacity-7"></p>
                    </div>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get AFJ Cardiff introduction
    public function afjcardiffIntroduction()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'afjcardiffIntroduction'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <div class="col-md-12" data-aos="fade-up">
                    <h2 class="heading">' . $row["class_title"] . '</h2>
                    <p class="mb-4">' . $row["class_description"] . '</p>
                    <p><a href="about.php" class="btn btn-primary text-white py-2 mr-3">Learn More</a>
                </div>
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join the team options
    public function jointheteam()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'joiningtype' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get hire dancer options
    public function hire_dancer()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'joiningtype' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get inquiry options
    public function inquiry()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'inquiry' ORDER BY class_id ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '<option value="' . $row["class_title"] . '">' . $row["class_title"] . '</option>';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get main dance studio content
    public function maindancestudio()
    {
        try {
            $query = "SELECT * FROM media_content WHERE codebased_title = 'maindancestudio'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= $row["post_content"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get second dance studio content
    public function seconddancestudio()
    {
        try {
            $query = "SELECT * FROM media_content WHERE codebased_title = 'seconddancestudio'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= $row["post_content"];
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get TikTok image
    public function tiktok()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'tiktok'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <img src="../imageuploads/' . $row["class_image"] . '" alt="Image placeholder" class="rounded-circle" style="max-width:20px">
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get LinkedIn image
    public function linkedin()
    {
        try {
            $query = "SELECT * FROM classes WHERE code_basedtitle = 'linkedin'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
                <img src="../imageuploads/' . $row["class_image"] . '" alt="Image placeholder" class="rounded-circle" style="max-width:20px">
            ';
            }
            return $output;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get subscribers chart data
    public function getSubscribersChartData()
    {
        try {
            $query = "SELECT COUNT(*) AS total_count FROM newsletters";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $totalCount = $result['total_count'];
            $labels = ["Subscribers"];
            $data = [$totalCount];
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get join team chart data
    public function getjointeamChartData()
    {
        try {
            $query = "SELECT join_team, COUNT(*) AS count FROM jointheteam GROUP BY join_team ORDER BY join_team ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($results as $row) {
                $labels[] = $row['join_team'];
                $data[] = $row['count'];
            }
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get dance style chart data
    public function dancetyleChartData()
    {
        try {
            $query = "SELECT dancestyle, COUNT(*) AS count FROM jointheteam GROUP BY dancestyle ORDER BY dancestyle ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($results as $row) {
                $labels[] = $row['dancestyle'];
                $data[] = $row['count'];
            }
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get hire dancers chart data
    public function hiredancersChartData()
    {
        try {
            $query = "SELECT email, COUNT(*) AS count FROM hiredancers GROUP BY email ORDER BY email ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($results as $row) {
                $labels[] = $row['email'];
                $data[] = $row['count'];
            }
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get reviews chart data
    public function reviewsChartData()
    {
        try {
            $query = "SELECT recipient_email, COUNT(*) AS count FROM reviews GROUP BY recipient_email ORDER BY recipient_email ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($results as $row) {
                $labels[] = $row['recipient_email'];
                $data[] = $row['count'];
            }
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Function to get contact us chart data
    public function contactusChartData()
    {
        try {
            $query = "SELECT firstname, lastname, COUNT(*) AS count FROM contactus GROUP BY firstname, lastname ORDER BY firstname ASC, lastname ASC";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $labels = [];
            $data = [];
            foreach ($results as $row) {
                $fullname = $row['firstname'] . ' ' . $row['lastname'];
                $labels[] = $fullname;
                $data[] = $row['count'];
            }
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
            return json_encode($chartData);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
