<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "login"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$carousel_images = [];
$result = $conn->query("SELECT * FROM homepage_carousel ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {
    $carousel_images[] = $row["image_path"];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hind Historia - Discover & Book Your Stay</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }
    
        .background-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 5px; 
            z-index: -1; 
            padding: 10px;
        }
    
        /* Background Images */
        .background-grid div {
            background-size: cover;
            background-position: center;
            border-radius: 20px; 
            transition: transform 0.4s ease-in-out, filter 0.4s ease-in-out;
        }
    
        .background-grid div:hover {
            transform: scale(1.05);
            filter: brightness(90%);
        }

        .hp1 { background-image: url('hp1.jpg'); }
        .hp2 { background-image: url('hp2.jpg'); }
        .hp3 { background-image: url('hp3.jpg'); }
        .hp4 { background-image: url('hp4.jpg'); }
        .hp5 { background-image: url('hp5.jpg'); }
        .hp6 { background-image: url('hp6.jpg'); }
        .hp7 { background-image: url('hp7.jpg'); }
        .hp8 { background-image: url('hp8.jpg'); }
    </style>
</head>
<body> 
    <?php
        if(isset($_SESSION['email'])){
            $email=$_SESSION['email'];
            $query=mysqli_query($conn, "SELECT users.* FROM users WHERE users.email='$email'");
            while($row=mysqli_fetch_array($query)){
                echo $row['fname'].''.$row['lname'];
            }
        }
    ?>

<div class="background-grid">
    <div class="hp1"></div>
    <div class="hp2"></div>
    <div class="hp3"></div>
    <div class="hp4"></div>
    <div class="hp5"></div>
    <div class="hp6"></div>
    <div class="hp7"></div>
    <div class="hp8"></div>
</div>

    <!-- 1. Website Logo and Name -->
    <header>
        <img src="logo.png" alt="Hind Historia Logo">
        <h1>Hind-Historia</h1>
    </header>

    <!-- 2. Navigation Bar -->
    <nav>
        <ul>
            <li><a href="login.html">Login</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="site_details.html">Site Details</a></li>
            <li><a href="booking.html">Booking</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="user.html">User Details</a></li>
        </ul>
    </nav>


    <!-- Image Carousel Section -->
    <section class="carousel-section">
        <h2>Explore the Beauty of History</h2>
        <div class="carousel-container">
            <button class="carousel-btn prev" onclick="prevSlide()">&#10094;</button>
            <div class="carousel">
                <?php foreach ($carousel_images as $img) { ?>
                    <img src="<?php echo $img; ?>" class="carousel-image">
                <?php } ?>
            </div>
            <button class="carousel-btn next" onclick="nextSlide()">&#10095;</button>
        </div>
    </section>

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll(".carousel-image");

        function updateCarousel() {
            images.forEach((img, index) => {
                img.style.display = (index === currentIndex) ? "block" : "none";
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % images.length;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateCarousel();
        }

        // Initialize Carousel
        updateCarousel();
    </script>
    
    <!-- 3. Booking Section -->
    <section>
        <h2>Book Your Stay</h2>
        <div style="border: 1px solid black; padding: 15px; width: 300px; text-align: center; margin: auto;">
            <form id="bookingForm">
                <label for="checkin-date">Select Date:</label>
                <input type="date" id="checkin-date" name="checkin-date" required>
                <br><br>
                <button type="button" onclick="showHotels()">Check Availability</button>
            </form>
            <div id="available-hotels"></div>
        </div>
    </section>

    <!-- 4. Room Cards -->
    <section>
        <h2>Available Rooms</h2>
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <!-- Room Card 1 -->
            <div style="border: 1px solid black; padding: 15px; width: 250px; text-align: center;">
                <img src="hotel1.jpg" alt="Hotel 1" width="200">
                <h3>Taj Palace</h3>
                <p><strong>Features:</strong> Free WiFi, Breakfast Included</p>
                <p><strong>Facilities:</strong> Pool, Gym, Spa</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐</p>
                <button>Book Now</button>
            </div>

            <!-- Room Card 2 -->
            <div style="border: 1px solid black; padding: 15px; width: 250px; text-align: center;">
                <img src="hotel2.jpg" alt="Hotel 2" width="200">
                <h3>Grand Heritage</h3>
                <p><strong>Features:</strong> City View, Free Parking</p>
                <p><strong>Facilities:</strong> Rooftop Bar, Gym</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐</p>
                <button>Book Now</button>
            </div>

            <!-- Room Card 3 -->
            <div style="border: 1px solid black; padding: 15px; width: 250px; text-align: center;">
                <img src="hotel3.jpg" alt="Hotel 3" width="200">
                <h3>Royal Retreat</h3>
                <p><strong>Features:</strong> Luxury Rooms, Complimentary Drinks</p>
                <p><strong>Facilities:</strong> Spa, Pool, Business Lounge</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐</p>
                <button>Book Now</button>
            </div>

            <!-- Room Card 4 -->
            <div style="border: 1px solid black; padding: 15px; width: 250px; text-align: center;">
                <img src="hotel4.jpg" alt="Hotel 4" width="200">
                <h3>Sunrise Residency</h3>
                <p><strong>Features:</strong> Ocean View, 24/7 Room Service</p>
                <p><strong>Facilities:</strong> Private Beach, Yoga Studio</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐</p>
                <button>Book Now</button>
            </div>

            <!-- Room Card 5 -->
            <div style="border: 1px solid black; padding: 15px; width: 250px; text-align: center;">
                <img src="hotel5.jpg" alt="Hotel 5" width="200">
                <h3>Historic Inn</h3>
                <p><strong>Features:</strong> Antique Furnishings, Library</p>
                <p><strong>Facilities:</strong> Museum Tour, Restaurant</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐</p>
                <button>Book Now</button>
            </div>
        </div>
    </section>

    <script>
        function showHotels() {
            var date = document.getElementById("checkin-date").value;
            if (date) {
                document.getElementById("available-hotels").innerHTML = 
                    "<p>Hotels available on " + date + ":</p>" +
                    "<ul>" +
                    "<li>Hotel Taj Palace</li>" +
                    "<li>Grand Heritage Hotel</li>" +
                    "<li>Royal Retreat</li>" +
                    "<li>Sunrise Residency</li>" +
                    "<li>Historic Inn</li>" +
                    "</ul>";
            } else {
                alert("Please select a date.");
            }
        }
    </script> 

<!-- 5. Wikipedia Search Section -->
<section>
    <h2>Search for a Historical Site</h2>
    <div style="border: 1px solid black; padding: 15px; width: 400px; text-align: center; margin: auto;">
        <input type="text" id="searchInput" placeholder="Enter historical site name">
        <button onclick="searchWikipedia()">Search</button>
        <div id="wiki-result"></div>
    </div>
</section>

<!-- JavaScript for Wikipedia API -->
<script>
    function searchWikipedia() {
        var query = document.getElementById("searchInput").value;
        if (query) {
            fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.type === "standard") {
                    document.getElementById("wiki-result").innerHTML = `
                        <h3>${data.title}</h3>
                        <p>${data.extract}</p>
                        <img src="${data.thumbnail ? data.thumbnail.source : 'no-image.png'}" alt="Image of ${data.title}" width="300">
                        <br>
                        <a href="${data.content_urls.desktop.page}" target="_blank">Read More on Wikipedia</a>
                    `;
                } else {
                    document.getElementById("wiki-result").innerHTML = "<p>No results found. Try another historical site.</p>";
                }
            })
            .catch(error => {
                document.getElementById("wiki-result").innerHTML = "<p>Error fetching data. Try again.</p>";
            });
        } else {
            alert("Please enter a historical site name.");
        }
    }
</script>

<!-- 6. Top 30 Historical Sites Slider -->
<section>
    <h2>Top 30 Historical Sites in India</h2>
    <div id="site-slider" style="display: flex; overflow-x: auto; width: 100%; border: 1px solid black; padding: 10px;">
        <div id="slides" style="display: flex; gap: 20px;">
            <!-- JavaScript will populate this section -->
        </div>
    </div>
</section>

<!-- JavaScript for Wikipedia API -->
<script>
    function searchWikipedia() {
        var query = document.getElementById("searchInput").value;
        if (query) {
            fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.type === "standard") {
                    document.getElementById("wiki-result").innerHTML = `
                        <h3>${data.title}</h3>
                        <p>${data.extract}</p>
                        <img src="${data.thumbnail ? data.thumbnail.source : 'no-image.png'}" alt="Image of ${data.title}" width="300">
                        <br>
                        <a href="${data.content_urls.desktop.page}" target="_blank">Read More on Wikipedia</a>
                    `;
                } else {
                    document.getElementById("wiki-result").innerHTML = "<p>No results found. Try another historical site.</p>";
                }
            })
            .catch(error => {
                document.getElementById("wiki-result").innerHTML = "<p>Error fetching data. Try again.</p>";
            });
        } else {
            alert("Please enter a historical site name.");
        }
    }

    // List of Top 30 Historical Sites in India
    const historicalSites = [
        { name: "Taj Mahal", img: "taj_mahal.jpg" },
        { name: "Red Fort", img: "red_fort.jpg" },
        { name: "Qutub Minar", img: "qutub_minar.jpg" },
        { name: "Gateway of India", img: "gateway_of_india.jpg" },
        { name: "Hawa Mahal", img: "hawa_mahal.jpg" },
        { name: "Mysore Palace", img: "mysore_palace.jpg" },
        { name: "Victoria Memorial", img: "victoria_memorial.jpg" },
        { name: "Sun Temple", img: "sun_temple.jpg" },
        { name: "Khajuraho Temples", img: "khajuraho_temple.jpg" },
        { name: "Charminar", img: "charminar.jpg" },
        { name: "Fatehpur Sikri", img: "fatehpur_sikri.jpg" },
        { name: "Sanchi Stupa", img: "sanchi_stupa.jpg" },
        { name: "Meenakshi Temple", img: "meenakshi_temple.jpg" },
        { name: "Chittorgarh Fort", img: "chittorgarh_fort.jpg" },
        { name: "Ellora Caves", img: "ellora_caves.jpg" },
        { name: "Ajanta Caves", img: "ajanta_caves.jpg" },
        { name: "Jaisalmer Fort", img: "jaisalmer_fort.jpg" },
        { name: "Amer Fort", img: "amer_fort.jpg" },
        { name: "Lotus Temple", img: "lotus_temple.jpg" },
        { name: "Golconda Fort", img: "golconda_fort.jpg" },
        { name: "Brihadeshwara Temple", img: "brihadeshwara_temple.jpg" },
        { name: "Mahabalipuram", img: "mahabalipuram.jpg" },
        { name: "Rani ki Vav", img: "rani_ki_vav.jpg" },
        { name: "Gwalior Fort", img: "gwalior_fort.jpg" },
        { name: "Kumbhalgarh Fort", img: "kumbhalgarh_fort.jpg" },
        { name: "Jantar Mantar", img: "jantar_mantar.jpg" },
        { name: "Shaniwar Wada", img: "shaniwar_wada.jpg" },
        { name: "Rashtrapati Bhavan", img: "rashtrapati_bhavan.jpg" },
        { name: "Basilica of Bom Jesus", img: "basilica_bom_jesus.jpg" }
    ];

    // Populate the slider with images
    function loadHistoricalSites() {
        const slidesContainer = document.getElementById("slides");
        historicalSites.forEach(site => {
            const slide = document.createElement("div");
            slide.style.border = "1px solid black";
            slide.style.padding = "10px";
            slide.innerHTML = `
                <img src="${site.img}" alt="${site.name}" width="150">
                <p>${site.name}</p>
            `;
            slidesContainer.appendChild(slide);
        });
    }

    // Load sites on page load
    window.onload = loadHistoricalSites;
</script>

 <!-- 7. Testimonial Section -->
 <section>
    <h2>User Testimonials</h2>
    <div id="testimonial-slider" style="border: 1px solid black; padding: 15px; width: 400px; text-align: center; margin: auto;">
        <div id="testimonial-content">
            <!-- Testimonials will be inserted here by JavaScript -->
        </div>
        <br>
        <button onclick="prevTestimonial()">Previous</button>
        <button onclick="nextTestimonial()">Next</button>
    </div>
</section>

<!-- JavaScript for Testimonial Slider -->
<script>
    const testimonials = [
        { name: "Rahul Sharma", review: "Amazing experience! The website helped me find the best historic places.", rating: "⭐⭐⭐⭐⭐" },
        { name: "Priya Mehta", review: "Loved the smooth booking process and detailed information.", rating: "⭐⭐⭐⭐" },
        { name: "Amit Gupta", review: "A fantastic way to explore Indian heritage! Highly recommended.", rating: "⭐⭐⭐⭐⭐" },
        { name: "Neha Verma", review: "Easy to use and very informative!", rating: "⭐⭐⭐⭐" },
        { name: "Vikram Singh", review: "One of the best historical travel guides online!", rating: "⭐⭐⭐⭐⭐" }
    ];

    let currentTestimonial = 0;

    function showTestimonial(index) {
        document.getElementById("testimonial-content").innerHTML = `
            <h3>${testimonials[index].name}</h3>
            <p>"${testimonials[index].review}"</p>
            <p><strong>Rating:</strong> ${testimonials[index].rating}</p>
        `;
    }

    function nextTestimonial() {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    }

    function prevTestimonial() {
        currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
        showTestimonial(currentTestimonial);
    }

    document.addEventListener("DOMContentLoaded", function () {
    showTestimonial(currentTestimonial);
});

</script>

<!-- 8. Reach Us Section -->
    <section>
        <h2>Reach Us</h2>
        <div style="display: flex; justify-content: space-between; align-items: center; border: 1px solid black; padding: 20px; width: 80%; margin: auto;">
            <!-- Contact Info -->
            <div style="width: 50%;">
                <h3><strong>Contact Us</strong></h3>
                <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
                    <img src="phonelogo.png" alt="Phone" width="20"> +91 36809369
                </div>
                <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
                    📧 hind-historia@gmail.com
                </div>

                <h3><strong>Follow Us</strong></h3>
                <div style="border: 1px solid black; padding: 10px;">
                    <img src="twitterlogo.png" alt="Twitter" width="20"> @hind-historia
                </div>
            </div>

            <!-- Google Maps -->
            <div style="width: 40%;">
                <iframe 
                    width="100%" 
                    height="200" 
                    frameborder="0" 
                    style="border: 1px solid black;"
                    src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=India" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>
    <?php
$conn->close();
?>
</body>
</html>
