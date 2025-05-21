<!DOCTYPE html>
<html lang="en">
<html lang="am_ET">
<html lang="or_ET">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
    .footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      text-align: center;
    }
    .scrollable-content {
      max-height: 400px;
      overflow-y: scroll;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Contact Us</h1>
    <div class="scrollable-content">
      <p>Please feel free to contact us for any inquiries or assistance.</p>
      <div class="row">
        <div class="col-md-6">
          <h3>Address</h3>
          <p>123 Vital Event Street, City Name, Country</p>
        </div>
        <div class="col-md-6">
          <h3>Contact Information</h3>
          <p>Email: info@example.com</p>
          <p>Phone: +251923814569</p>
        </div>
      </div>
      <hr>
      <h3>Additional Content</h3>
      <p>This is some additional content that you can add to the page.</p>
      <ul>
        <li>Upcoming Events</li>
        <li>Registration Information</li>
        <li>FAQs</li>
      </ul>
      <p>Stay updated with the latest news and announcements by subscribing to our newsletter.</p>
      <form>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </form>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <p>&copy; 2024 Vital Event Registration Office. All rights reserved.</p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>