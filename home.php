<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Chandan123$456', 'eventnest_by_chandan');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM registration WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
} else {
  echo "User not found";
  exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EventNest by Chandan - Events & Tickets</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="logo.jpg" />

</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="logo.jpg" alt="Logo" class="logo-img" />
      <div class="logo-text">EventNest by Chandan</div>
    </div>

    <div class="menu-toggle" id="menu-toggle">&#9776;</div>

    <ul class="nav-links" id="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#event">Concerts</a></li>
      <li><a href="#workshop">Workshops</a></li>
      <li><a href="tickets.php">Tickets</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li class="profile-dropdown">
        <img src="uploads/<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Photo" class="image" id="profile-image">
        <div class="dropdown-content" id="dropdown-content">
          <h3 class="name"><?php echo htmlspecialchars($user['username']); ?></h3>
          <a href="logout.php">Logout</a>
        </div>
      </li>
      <li>
        <!-- <h3 class="name"><?php echo htmlspecialchars($user['username']); ?></h3> -->
      </li>
    </ul>



  </nav>


  <!-- Hero -->
  <header class="hero">
    <h1>Discover Events For You</h1>
    <p>Book tickets for concerts, workshops, and more!</p>
  </header>

  <!-- Event Categories -->
  <section href="#events" id="event" class="event-section">
    <h2>Live Concerts</h2>

    <div class="event-card">
      <h3>🎵 Music Concert - Arijit Singh Live</h3>
      <p>Date: May 10, 2025</p>
      <p>4 Hours</p>
      <p>Age Limit - 5yrs +</p>
      <p>English</p>
      <p>Metal, Rock</p>
      <p>Time: 7:00 PM</p>
      <p>Venue: Wankhede Stadium Mumbai</p>
      <div class="price">₹6999 onwards</div>
      <div class="filling-fast">Filling Fast</div>

      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>💃 Dancing Concert - Street Dance Battle</h3>
      <p>Date: May 15, 2025</p>
      <p>Time: 6:00 PM</p>
      <p>Venue: Gandhi Maidan Gaya</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🎵 Music Concert - Arijit Singh Live</h3>
      <p>Date: May 10, 2025</p>
      <p>Time: 7:00 PM</p>
      <p>Venue: Wankhede Stadium Mumbai</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🎵 Music Concert - Arijit Singh Live</h3>
      <p>Date: May 10, 2025</p>
      <p>Time: 7:00 PM</p>
      <p>Venue: Wankhede Stadium Mumbai</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🎵 Music Concert - Arijit Singh Live</h3>
      <p>Date: May 10, 2025</p>
      <p>Time: 7:00 PM</p>
      <p>Venue: Wankhede Stadium Mumbai</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🎵 Music Concert - Arijit Singh Live</h3>
      <p>Date: May 10, 2025</p>
      <p>Time: 7:00 PM</p>
      <p>Venue: Wankhede Stadium Mumbai</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
  </section>

  <section href="#workshops" id="workshop" class="event-section">
    <h2>Workshops</h2>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🧑‍💻 Web Development Bootcamp</h3>
      <p>Date: May 18, 2025</p>
      <p>Time: 10:00 AM - 4:00 PM</p>
      <p>Venue: Shobhit University SIET building Lab No-05</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
    <div class="event-card">
      <h3>🎨 Painting & Creativity Workshop</h3>
      <p>Date: May 20, 2025</p>
      <p>Time: 11:00 AM - 2:00 PM</p>
      <p>Venue: Shobhit University Multipurpose Hall</p>
      <a class="btn" href="booking.php?event=Live%20Music%20Night">Book Now</a>
    </div>
  </section>

  <!-- Upcoming Events -->
  <section class="upcoming">
    <div>
      <h2>Upcoming Events</h2>
      <ul>
        <li>🎤 Stand-up Comedy Night – May 22</li>
        <li>🎻 Classical Music Eve – May 25</li>
        <li>🧘 Yoga & Mindfulness Workshop – May 27</li>
       <li class="event-info">
  Know about More Events Information  
  <a href="event.php" class="event-link">Click Here</a>
</li>

      </ul>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventNest by Chandan. All rights reserved.</p>
  </footer>


  <script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
      document.getElementById('nav-links').classList.toggle('active');
    });
    const profileImage = document.getElementById('profile-image');
    const dropdown = document.getElementById('dropdown-content');

    profileImage.addEventListener('click', () => {
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (e) => {
      if (!profileImage.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>

</body>

</html>