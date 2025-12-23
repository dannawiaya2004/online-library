<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Digital Library</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* General Page Styling */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
    }

    /* Hero Section */
    .hero-section {
      background-image: url('https://source.unsplash.com/1600x900/?library,books');
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
      padding: 5rem 2rem;
    }
    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .hero-section p {
      font-size: 1.2rem;
      margin-top: 1rem;
    }

    /* About Section */
    .about-section {
      padding: 3rem 2rem;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: -4rem;
      position: relative;
      z-index: 1;
    }
    .section-title {
      color: #0056b3;
      margin-bottom: 1.5rem;
    }

    /* Feature Cards */
    .features-section {
      padding: 3rem 1rem;
    }
    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 12px;
      background: #f9f9fc;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
    .feature-icon {
      font-size: 2.5rem;
      color: #17a2b8;
    }
    .feature-description {
      font-size: 1.1rem;
      margin-top: 1rem;
    }

    /* Footer Styling */
    footer {
      background-color: #343a40;
      color: #fff;
      padding: 1.5rem;
      text-align: center;
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <a class="navbar-brand" href="index.php">Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="home.php">home</a></li>
                <li class="nav-item"><a class="nav-link" href="popular_books.php">Popular Books</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">feedback</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">aboutus</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="hero-section">
  <h1 style="color: blue;">Welcome to Our Digital Library</h1>
  <p style="color: blue;">Where books meet technology, and stories come alive for everyone.</p>
</div>

<div class="container mt-5">
  <div class="about-section text-center">
    <h2 class="section-title">About Us</h2>
    <p class="feature-description">Our Digital Library platform aims to bridge the gap between readers and a world of literature. Through cutting-edge technology, we offer a seamless, enriching reading experience accessible to everyone.</p>
  </div>
</div>

<div class="container features-section">
  <h2 class="section-title text-center">What We Offer</h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-book"></i></div>
        <h5 class="mt-3">Expansive Book Collection</h5>
        <p class="feature-description">Browse a collection that spans genres, cultures, and eras, connecting you with stories that inspire, educate, and entertain.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-headphones"></i></div>
        <h5 class="mt-3">Audio Summaries</h5>
        <p class="feature-description">Short on time? Listen to audio summaries of popular books in multiple languages, including English and Arabic.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-users"></i></div>
        <h5 class="mt-3">Community Reviews</h5>
        <p class="feature-description">Join a thriving community of readers. Share your insights, rate books, and discover recommendations tailored for you.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
        <h5 class="mt-3">Secure Access</h5>
        <p class="feature-description">With secure registration and login, we ensure that your reading experience is private, safe, and personalized.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-cog"></i></div>
        <h5 class="mt-3">Admin Management</h5>
        <p class="feature-description">Our admins work tirelessly to update the library and curate content to ensure the best experience for every reader.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-comments"></i></div>
        <h5 class="mt-3">Feedback and Improvement</h5>
        <p class="feature-description">We value our readers' input. Your feedback shapes the way we grow and adapt to serve you better.</p>
      </div>
    </div>
  </div>
</div>



</body>
</html>
