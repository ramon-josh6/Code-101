<!DOCTYPE html>
<html>
  <head>
    <title> Josh's Portfolio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
    .w3-row-padding img {margin-bottom: 12px}
    /* Set the width of the sidebar to 120px */
    .w3-sidebar {width: 120px;background: #222;}
    /* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
    #main {margin-left: 120px}
    /* Remove margins from "page content" on small screens */
    @media only screen and (max-width: 600px) {#main {margin-left: 0}}

   
   
  /* Carousel Styling */
  .carousel-container {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
  }

  .carousel-image {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
  }

  .carousel-item {
    display: none;
  }

  /* Button Styling */
  .carousel-button, .view-button {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    font-size: 16px;
    padding: 8px 12px;
    cursor: pointer;
    user-select: none;
  }

  .view-button {
    margin-top: 10px;
    display: inline-block;
  }

  .carousel-button:hover, .view-button:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

  /* Modal Styling */
  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
  }

  .modal-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    padding: 20px;
  }

  .modal-content img {
    max-width: 750px;
    max-height: 750px;
    border-radius: 5px;
  }

  .close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover, .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }



    /* Notification styles */
    #notification {
      background-color: #28a745; /* Green for success */
      padding: 5px 10px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      font-size: 14px;
      display: none; /* Initially hidden */
    }

    #notification.error {
      background-color: #dc3545; /* Red for error */
    }
    </style>
  </head>
<body class="w3-black">

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$statusMessage = ''; // Initialize status message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['Name']);
    $email = htmlspecialchars($_POST['Email']);
    $subject = htmlspecialchars($_POST['Subject']);
    $message = htmlspecialchars($_POST['Message']);

    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ramonjosh17@gmail.com';
        $mail->Password   = 'ddov iese vbkb lxer';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('ramonjosh17@gmail.com', 'Ramon Joshua');
        $mail->addAddress('ramonjosh17@gmail.com'); // Add recipient email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message: $subject";
        $mail->Body    = "You have received a new message from the contact form.<br><br>" .
                         "Name: $name<br>" .
                         "Email: $email<br><br>" .
                         "Message:<br>" . nl2br($message);
        $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$message"; // Plain-text alternative

        // Send email
        if ($mail->send()) {
            $statusMessage = 'Your message has been sent successfully!';
        } else {
            $statusMessage = 'Message could not be sent.';
        }
    } catch (Exception $e) {
        $statusMessage = 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="web_port_dp.jpg" style="width:99%">
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ABOUT</p>
  </a>
  <a href="#photos" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>PHOTOS</p>
  </a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>CONTACT</p>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
    <a href="#photos" class="w3-bar-item w3-button" style="width:25% !important">PHOTOS</a>
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">I'm</span> Josh.</h1>
    <img src="web_port_dp.jpg" alt="boy" class="w3-image" width="496" height="554">
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">About Me</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>My name is Ramon Joshua C. Buado, but you can call me "Josh." I am currently a 
       Computer Science student at Cavite State University - Bacoor Campus. As I’m 
       still studying in this field, I consider myself a beginner, but I believe that 
       learning is a lifelong journey, and each day brings valuable lessons. Please 
       take a moment to observe my work, and thank you for your time and consideration!
    </p>
  </div>

  <!-- Skills Section -->
<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="skills">
  <h2 class="w3-text-light-grey">Skills</h2>
  <hr style="width:200px" class="w3-opacity">
  <p>Here are some of the skills I've acquired during my studies and projects:</p>

  <p>Java</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:60%">60%</div>
  </div>
  
  <p>HTML</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:80%">80%</div>
  </div>
  
  <p>CSS</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:50%">50%</div>
  </div>

  <p>JavaScript</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:50%">50%</div>
  </div>
  
  <p>PHP</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:40%">40%</div>
  </div>

  <p>MySQL</p>
  <div class="w3-light-grey w3-round-xlarge w3-small">
    <div class="w3-container w3-center w3-round-xlarge w3-dark-grey" style="width:85%">85%</div>
  </div>
  
<!-- End Skills Section -->
</div>


 <!-- Portfolio Section -->
<div class="w3-padding-64 w3-content" id="photos">
  <h2 class="w3-text-light-grey">My Works</h2>
  <hr style="width:200px" class="w3-opacity">

  <!-- Carousel Container -->
  <div class="carousel-container" style="position: relative; max-width: 100%; text-align: center;">
    <div class="carousel-item" style="display: block;">
      <img src="POS_images/POS_1.png" alt="Image 1" class="carousel-image">
      <button class="view-button" onclick="openGallery('POS')">View</button>
    </div>
    <div class="carousel-item" style="display: none;">
      <img src="Techno_images/Techno_1.png" alt="Image 2" class="carousel-image">
      <button class="view-button" onclick="openGallery('Techno')">View</button>
    </div>
    <div class="carousel-item" style="display: none;">
      <img src="checklist_images/checklist_1.png" alt="Image 3" class="carousel-image">
      <button class="view-button" onclick="openGallery('Checklist')">View</button>
    </div>
    <div class="carousel-item" style="display: none;">
      <img src="enrollment_images/enrollment_1.png" alt="Image 4" class="carousel-image">
      <button class="view-button" onclick="openGallery('Enrollment')">View</button>
    </div>

    <!-- Left and Right Controls -->
    <button class="carousel-button" onclick="changeSlide(-1)">❮</button>
    <button class="carousel-button" onclick="changeSlide(1)">❯</button>
  </div>
</div>

<!-- Modal for Image Gallery -->
<div id="imageModal" class="modal">
  <span class="close" onclick="closeGallery()">&times;</span>
  <div class="modal-content" id="modalImages"></div>
</div>

   <!-- Contact Section -->
   <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 class="w3-text-light-grey">Contact</h2>
    <hr style="width:200px" class="w3-opacity">

    <div class="w3-section">
      <p><i class="fa fa-map-marker fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Talaba I, Bacoor, Cavite</p>
      <p><i class="fa fa-phone fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Phone: +63 9638497450</p>
      <p><i class="fa fa-envelope fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Email: ramonjosh17@gmail.com</p>
    </div>

    <!-- Contact Form -->
<form method="post" action="" required autocomplete="off">
  <div class="w3-section">
    <label>Name</label>
    <input class="w3-input w3-border" type="text" name="Name" required autocomplete="off" required>
  </div>
  
  <div class="w3-section">
    <label>Email</label>
    <input class="w3-input w3-border" type="email" name="Email" required autocomplete="off" required>
  </div>
  
  <div class="w3-section">
    <label>Subject</label>
    <input class="w3-input w3-border" type="text" name="Subject" required autocomplete="off" required>
  </div>
  
  <div class="w3-section">
    <label>Message</label>
    <textarea class="w3-input w3-border" name="Message" rows="5" required autocomplete="off" required></textarea>
  </div>
        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
        <!-- Notification Container -->
        <span id="notification" class="w3-text-white" style="margin-left: 10px; display: none;"></span>
      </p>
    </form>
  </div>
</div>

<script>
  // Carousel Functionality
  let currentSlide = 0;
  const slides = document.getElementsByClassName("carousel-item");

  function changeSlide(direction) {
    slides[currentSlide].style.display = "none";
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    slides[currentSlide].style.display = "block";
  }
  slides[currentSlide].style.display = "block";

  // Open Gallery Modal with Images
  function openGallery(category) {
    const modal = document.getElementById("imageModal");
    const modalImages = document.getElementById("modalImages");

    // Clear previous images
    modalImages.innerHTML = '';

    // Load images based on category
    const images = {
      POS: ["POS_images/POS_1.png", "POS_images/POS_2.png"],
      Techno: ["Techno_images/Techno_1.png", "Techno_images/Techno_2.png","Techno_images/Techno_3.png","Techno_images/Techno_4.png","Techno_images/Techno_5.png","Techno_images/Techno_6.png"],
      Checklist: ["checklist_images/checklist_1.png", "checklist_images/checklist_2.png"],
      Enrollment: ["enrollment_images/enrollment_1.png", "enrollment_images/enrollment_2.png","enrollment_images/enrollment_3.png","enrollment_images/enrollment_4.png"]
    };

    images[category].forEach(src => {
      const img = document.createElement("img");
      img.src = src;
      modalImages.appendChild(img);
    });

    modal.style.display = "block"; // Show the modal
  }

  // Close the Modal
  function closeGallery() {
    document.getElementById("imageModal").style.display = "none";
  }

  // Close modal when clicking outside of content
  window.onclick = function(event) {
    const modal = document.getElementById("imageModal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
</script>

<script>
  // Store the PHP status message in a JavaScript variable
  var statusMessage = "<?php echo $statusMessage; ?>";

  // If there's a message, display the notification
  if (statusMessage !== '') {
    var notification = document.getElementById('notification');
    notification.innerText = statusMessage; // Set the message text
    notification.style.display = 'inline-block'; // Show the notification

    // Optionally, fade out the notification after a few seconds
    setTimeout(function() {
      notification.style.opacity = 0;
      setTimeout(function() {
        notification.style.display = 'none';
      }, 1000);
    }, 10000); // Hide after 5 seconds
  }
</script>

</body>
</html>
