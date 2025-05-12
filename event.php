<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Event List - Event Nest</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #ffffff;
      line-height: 1.6;
      overflow-x: hidden;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      position: sticky;
      top: 0;
      z-index: 10;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar h1 {
      font-size: 28px;
      font-weight: 700;
      color: #00ffc3;
    }

    .nav-links {
      display: flex;
      gap: 25px;
      list-style: none;
    }

    .nav-links a {
      color: #eee;
      text-decoration: none;
      padding: 10px;
      border-radius: 8px;
      transition: 0.3s;
    }

    .nav-links a:hover {
      background: #00ffc3;
      color: #000;
      transform: scale(1.05);
    }

    .events-section {
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
    }

    .event-card {
      background: rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 8px 20px rgba(0, 255, 195, 0.1);
      transition: all 0.3s ease;
      border-left: 4px solid #00ffc3;
    }

    .event-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 10px 30px rgba(0, 255, 195, 0.3);
    }

    .event-title {
      font-size: 20px;
      font-weight: 600;
      color: #00ffc3;
      margin-bottom: 8px;
    }

    .event-details {
      font-size: 14px;
      color: #ddd;
    }

    .book-btn {
      margin-top: 10px;
      padding: 8px 20px;
      background-color: #00ffc3;
      color: #000;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s;
      text-decoration: none;
      display: inline-block;
    }

    .book-btn:hover {
      background-color: #00cfa0;
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 12px;
      border: 2px solid #00ffc3;
    }

    .logo-text {
      font-size: 1.8rem;
      font-weight: 700;
      color: #00ffc3;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
      }

      .nav-links {
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
      }

      .events-section {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo-container">
      <img src="logo.jpg" alt="Logo" class="logo-img" />
      <div class="logo-text">EventNest by Chandan</div>
    </div>
    <div class="nav-links">
      <a href="home.php">Home</a>
      <a href="#">Concerts</a>
      <a href="#">Workshops</a>
      <a href="contact.html">Contact</a>
    </div>
  </div>

  <div class="events-section">
    <!-- EVENT TEMPLATE -->
    <div class="event-card">
      <div class="event-title">Rock Night</div>
      <div class="event-details">Date: May 15, 2025 | Time: 7:00 PM | Venue: Arena 1 | Artist: DJ Blaze | Price: ₹799</div>
      <a href="booking.php?event=Rock%20Night" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Sufi Fusion</div>
      <div class="event-details">Date: May 16, 2025 | Time: 6:30 PM | Venue: Harmony Hall | Artist: Rahman Ali | Price: ₹699</div>
      <a href="booking.php?event=Sufi%20Fusion" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Bollywood Beats</div>
      <div class="event-details">Date: May 17, 2025 | Time: 8:00 PM | Venue: Open Grounds | Artist: Neha Bhasin | Price: ₹999</div>
      <a href="booking.php?event=Bollywood%20Beats" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Dance Blast</div>
      <div class="event-details">Date: May 18, 2025 | Time: 5:00 PM | Venue: Club Stage | Artist: Team Naach | Price: ₹599</div>
      <a href="booking.php?event=Dance%20Blast" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Coding Bootcamp</div>
      <div class="event-details">Date: May 19, 2025 | Time: 10:00 AM | Venue: Tech Room | Speaker: Rohan Kumar | Price: ₹499</div>
      <a href="booking.php?event=Coding%20Bootcamp" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Photography Masterclass</div>
      <div class="event-details">Date: May 20, 2025 | Time: 11:00 AM | Venue: Studio 2 | Artist: Priya Mehta | Price: ₹399</div>
      <a href="booking.php?event=Photography%20Masterclass" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Jazz Vibes</div>
      <div class="event-details">Date: May 21, 2025 | Time: 7:30 PM | Venue: Jazz Lounge | Artist: John Matthews | Price: ₹649</div>
      <a href="booking.php?event=Jazz%20Vibes" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Comedy Central</div>
      <div class="event-details">Date: May 22, 2025 | Time: 9:00 PM | Venue: Theater Hall | Artist: Kunal Roy | Price: ₹549</div>
      <a href="booking.php?event=Comedy%20Central" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Drama Nights</div>
      <div class="event-details">Date: May 23, 2025 | Time: 6:00 PM | Venue: Art House | Artist: Drama Club | Price: ₹499</div>
      <a href="booking.php?event=Drama%20Nights" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Indie Fest</div>
      <div class="event-details">Date: May 24, 2025 | Time: 4:00 PM | Venue: Amphitheatre | Artist: The Vibes | Price: ₹899</div>
      <a href="booking.php?event=Indie%20Fest" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Workshop: AI & Future</div>
      <div class="event-details">Date: May 25, 2025 | Time: 2:00 PM | Venue: Lab 3 | Speaker: Dr. Tanvi Singh | Price: ₹799</div>
      <a href="booking.php?event=AI%20Workshop" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Fitness Challenge</div>
      <div class="event-details">Date: May 26, 2025 | Time: 9:00 AM | Venue: Gym Grounds | Artist: Coach Aryan | Price: ₹299</div>
      <a href="booking.php?event=Fitness%20Challenge" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Gaming Tournament</div>
      <div class="event-details">Date: May 27, 2025 | Time: 3:00 PM | Venue: Gaming Arena | Artist: GameOn Crew | Price: ₹899</div>
      <a href="booking.php?event=Gaming%20Tournament" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Poetry Slam</div>
      <div class="event-details">Date: May 28, 2025 | Time: 5:00 PM | Venue: Lit Café | Artist: Kavya Joshi | Price: ₹399</div>
      <a href="booking.php?event=Poetry%20Slam" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Folk Night</div>
      <div class="event-details">Date: May 29, 2025 | Time: 6:00 PM | Venue: Cultural Stage | Artist: Desi Troupe | Price: ₹449</div>
      <a href="booking.php?event=Folk%20Night" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Workshop: UI/UX</div>
      <div class="event-details">Date: May 30, 2025 | Time: 11:30 AM | Venue: Design Lab | Speaker: Sagar Shah | Price: ₹599</div>
      <a href="booking.php?event=UIUX%20Workshop" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Startup Pitch Day</div>
      <div class="event-details">Date: June 1, 2025 | Time: 1:00 PM | Venue: Innovation Hub | Artist: Startup Gurus | Price: ₹999</div>
      <a href="booking.php?event=Startup%20Pitch%20Day" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Fashion Parade</div>
      <div class="event-details">Date: June 2, 2025 | Time: 7:00 PM | Venue: Grand Hall | Artist: Fashionistas | Price: ₹699</div>
      <a href="booking.php?event=Fashion%20Parade" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Food Fest</div>
      <div class="event-details">Date: June 3, 2025 | Time: 12:00 PM | Venue: Food Street | Artist: MasterChef India | Price: ₹399</div>
      <a href="booking.php?event=Food%20Fest" class="book-btn">Book Now</a>
    </div>

    <div class="event-card">
      <div class="event-title">Farewell Bash</div>
      <div class="event-details">Date: June 4, 2025 | Time: 8:00 PM | Venue: Central Lawn | Artist: DJ Spark | Price: ₹899</div>
      <a href="booking.php?event=Farewell%20Bash" class="book-btn">Book Now</a>
    </div>
  </div>

</body>
</html>
