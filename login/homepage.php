<?php
session_start();

$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "login"; // Your database name

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

// Fetch all reviews
$review_query = "SELECT * FROM reviews ORDER BY created_at DESC";
$reviews_result = $conn->query($review_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap">
    <title>Hind Historia - Discover & Book Your Stay</title>
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

<!-- 1. Website Logo and Name -->
<header>
    <div class="header-container">
        <a href="index.html">
            <img src="logo.png" alt="Hind Historia Logo" class="logo">
        </a>
        <h1 class="site-title">Hind-Historia</h1>
    </div>
</header>
<!-- CSS -->
<style>
    
    /* Header Styling */
    header {
        position: sticky;
        top: 0;
        width: 100%;
        height: 120px;
        background: #3E2723; /* Deep Brown Background */
        border-bottom: 3px solid #D4AF37; /* Gold Bottom Border */
        z-index: 1000;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
    }

    /* Header Container */
    .header-container {
        display: flex;
        align-items: center;
        justify-content: left;
        max-width: 100%;
        margin: auto;
        padding: 15px;
        }

    /* Logo Styling */
    .logo {
        height: 80px;
        margin-right: 20px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Clickable Logo Hover Effect */
    .logo:hover {
        transform: scale(1.1);
        box-shadow: 0px 0px 15px rgba(212, 175, 55, 0.8);
    }

    /* Site Title Styling (Historical Look) */
    .site-title {
        font-family: 'Cinzel', serif;
        font-size: 40px;
        color: #FFD700; /* Gold Text */
        text-shadow: 3px 3px 10px rgba(255, 255, 255, 0.5), 2px 2px 5px rgba(212, 175, 55, 0.8);
        font-weight: bold;
        padding: 10px 20px;
        transition: text-shadow 0.3s ease-in-out;
    }

    /* Glowing Text Effect on Hover */
    .site-title:hover {
        text-shadow: 0px 0px 15px rgba(255, 215, 0, 1);
    }
</style>

    <!-- 2. Navigation Bar -->
<nav>
    <ul>
        <li><a href="homepage.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="historia.php"><i class="fas fa-heart"></i> Historia</a></li>
        <li><a href="rooms.php"><i class="fas fa-bed"></i> Rooms </a></li>
        <li><a href="booking.php"><i class="fas fa-calendar-check"></i> Booking</a></li>
        <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
        <li><a href="user_profile.php"><i class="fas fa-user"></i> User</a></li>
    </ul>
</nav>
<!-- CSS -->
<style>
    nav {
        background: #4B2E1E; 
        border-bottom: 3px solid #D4AF37; 
        padding: 15px 0;
        text-align: center;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);
    }

    /* Navigation List */
    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
    }

    /* Navigation Items */
    nav ul li {
        margin: 0 15px;
        position: relative;
    }

    /* Navigation Links */
    nav ul li a {
        font-family: 'Cinzel', serif;
        font-size: 18px;
        color: #FFD700; 
        text-decoration: none;
        font-weight: bold;
        padding: 10px 15px;
        border-radius: 5px;
        transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Hover Effect */
    nav ul li a:hover {
        color: #fff;
        transform: scale(1.1);
        text-shadow: 0px 0px 8px rgba(255, 215, 0, 0.8);
    }

    /* Active Link Effect */
    nav ul li a:active {
        color: #FFA500; 
    }

    /* Icon Styling */
    nav ul li a i {
        color: #FFD700; 
        transition: transform 0.3s ease-in-out;
    }

    /* Icon Hover Effect */
    nav ul li a:hover i {
        transform: rotate(10deg);
    }
</style>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<!-- Image Carousel Section -->
<?php
if (!$result) {
    die("Database Error: " . $conn->error);
}
?>

<section class="carousel-section">

    <div style="
    display: flex; 
    justify-content: center; 
    align-items: center; 
    height: 200px;
">
    <h2 style="
        font-family: 'Cinzel', serif; 
        font-size: 36px; 
        font-weight: bold; 
        color: white; 
        text-align: center; 
        text-transform: uppercase; 
        padding: 20px 40px;
        background: linear-gradient(135deg, rgba(139,69,19,0.9), rgba(218,165,32,0.9)); 
        border-radius: 15px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 215, 0, 0.8);
    ">
        Explore the Beauty of History
    </h2>
</div>

<div class="carousel-container">
    <div class="carousel-wrapper">
        <div class="carousel-slides" id="carousel-slides">
            <?php
            // Fetch images from the database
            $conn = new mysqli("localhost", "root", "", "login");
            $result = $conn->query("SELECT * FROM homepage_carousel ORDER BY id DESC");

            while ($row = $result->fetch_assoc()) {
                echo '<div class="carousel-slide"><img src="' . $row["image_path"] . '" alt="Carousel Image"></div>';
            }
            ?>
        </div>
    </div>
    <!-- Pagination Dots -->
    <div class="carousel-pagination" id="carousel-pagination"></div>
</div>
</section>
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll(".carousel-slide");
    const paginationContainer = document.getElementById("carousel-pagination");
    const totalSlides = slides.length;

    function createPaginationDots() {
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement("span");
            dot.classList.add("dot");
            if (i === 0) dot.classList.add("active");
            dot.setAttribute("onclick", `goToSlide(${i})`);
            paginationContainer.appendChild(dot);
        }
    }

    function updateCarousel() {
        const slideWidth = slides[0].offsetWidth;
        document.getElementById("carousel-slides").style.transform = `translateX(-${currentIndex * slideWidth}px)`;

        document.querySelectorAll(".dot").forEach((dot, index) => {
            dot.classList.toggle("active", index === currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = index;
        updateCarousel();
    }

    function autoSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    }

    setInterval(autoSlide, 3000);

    document.addEventListener("DOMContentLoaded", function () {
        if (document.querySelectorAll(".carousel-slide").length > 0) {
        createPaginationDots();
        updateCarousel();
        }
    });
</script>
<style>
/* Carousel Container */
.carousel-container {
    position: relative;
    width: 1200px;
    height: 600px;
    margin: auto;
    overflow: hidden;
    border-radius: 10px;
    border: 3px solid #FFD700;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
}

/* Carousel Wrapper */
.carousel-wrapper {
    display: flex;
    overflow: hidden;
    height: 600px;
    width: 1200px;
}

/* Carousel Slides */
.carousel-slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-slide {
    min-width: 1200px;
    text-align: center;
}

.carousel-slide img {
    width: 1200px;
    height: 600px; 
    object-fit: cover;
    border-radius: 10px;
}

/* Pagination Dots */
.carousel-pagination {
    text-align: center;
    margin-top: 10px;
}

.dot {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin: 5px;
    background-color: #ddd;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease;
}

.dot.active {
    background-color: #FFD700;
    width: 15px;
    height: 15px;
}
</style>

<!-- 5. Wikipedia Search Section -->
<section class="wiki-search fade-in">
    <h2>Search for a Historical Site</h2>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Enter historical site name">
        <button onclick="searchWikipedia()">Search</button>
    </div>
    <div id="wiki-result"></div>
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
                        <img src="${data.thumbnail ? data.thumbnail.source : 'no-image.png'}" alt="Image of ${data.title}">
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
<style>
    /* Wikipedia Search Section */
.wiki-search {
    background: rgba(78, 52, 46, 0.9); /* Dark brown background */
    color: #FFD700; /* Gold text */
    padding: 30px;
    text-align: center;
    border-radius: 10px;
    border: 2px solid #D4AF37; /* Gold border */
    width: 80%;
    margin: 30px auto;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
}

/* Heading Styling */
.wiki-search h2 {
    font-family: 'Cinzel', serif;
    font-size: 28px;
    text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
    margin-bottom: 20px;
}

/* Search Bar Container */
.search-container {
    border: 2px solid #D4AF37;
    padding: 15px;
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    max-width: 500px;
    margin: auto;
}

/* Input Field */
.search-container input {
    width: 70%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 2px solid #D4AF37;
    background: #F5DEB3; /* Wheat color */
    color: #3E2723; /* Dark brown text */
    text-align: center;
}

/* Search Button */
.search-container button {
    background-color: #D4AF37;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    color: #3E2723;
}

/* Button Hover Effect */
.search-container button:hover {
    background-color: #FFD700;
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
}

/* Wikipedia Results */
#wiki-result {
    margin-top: 20px;
    padding: 15px;
    border: 2px solid #FFD700;
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    font-size: 16px;
    text-align: center;
}

/* Wikipedia Image */
#wiki-result img {
    max-width: 100%;
    border-radius: 8px;
    border: 2px solid #FFD700;
    margin-top: 10px;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply Fade-in Effect */
.fade-in {
    opacity: 0;
    animation: fadeIn 1s ease-in-out forwards;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-container {
        flex-direction: column;
    }

    .search-container input {
        width: 100%;
    }
}
</style>

<!-- 6. Top 30 Historical Sites Slider -->
<section>
<h3 style="
    font-family: 'Cinzel', serif; 
    font-size: 28px; 
    font-weight: bold; 
    color: white; 
    text-align: center; 
    text-transform: uppercase; 
    padding: 15px 30px;
    background: linear-gradient(135deg, rgba(165,42,42,0.9), rgba(218,165,32,0.9)); 
    border-radius: 10px;
    box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.8);
    display: inline-block;
">
    Top 30 Historical Sites in India
</h3>
    <div id="site-slider" style="display: flex; overflow-x: auto; width: 100%; border: 1px solid black; padding: 10px;">
        <div id="slides" style="display: flex; gap: 20px;">
            <!-- JavaScript will populate this section -->
        </div>
    </div>
</section>
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
<style>
    /* Style for the Historical Sites Section */
#site-slider {
    display: flex;
    overflow-x: auto;
    width: 100%;
    padding: 10px;
    border: 2px solid #8B4513; /* Brown border for historical look */
    border-radius: 10px;
    background: #FAF3E0; /* Light beige background */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    scroll-behavior: smooth;
}

/* Scrollbar Customization */
#site-slider::-webkit-scrollbar {
    height: 8px;
}

#site-slider::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#site-slider::-webkit-scrollbar-thumb {
    background: #8B4513;
    border-radius: 5px;
}

/* Styling the Slides */
#slides {
    display: flex;
    gap: 20px;
    padding: 10px;
}

#slides div {
    text-align: center;
    min-width: 200px;
    padding: 15px;
    border-radius: 10px;
    background: white;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
}

/* Hover Effect */
#slides div:hover {
    transform: scale(1.1);
}

/* Styling Images */
#slides img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #8B4513;
}

/* Styling Text */
#slides p {
    font-family: 'Cinzel', serif;
    font-size: 16px;
    color: #5D4037;
    margin-top: 5px;
}
</style>
 
<!-- 7. Testimonial Section -->
 <section>
 <h3 style="
    font-family: 'Cinzel', serif; 
    font-size: 28px; 
    font-weight: bold; 
    color: white; 
    text-align: center; 
    text-transform: uppercase; 
    padding: 15px 30px;
    background: linear-gradient(135deg, rgba(165,42,42,0.9), rgba(218,165,32,0.9)); 
    border-radius: 10px;
    box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.8);
    display: inline-block;
">
    User Testimonials
</h3>

  <div id="testimonial-slider" style="border: 1px solid black; padding: 15px; width: 400px; text-align: center; margin: auto;">
        <div id="testimonial-content">
        </div>
        <br>
        <button onclick="prevTestimonial()">Previous</button>
        <button onclick="nextTestimonial()">Next</button>
    </div>
</section>
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
<style>
    /* Testimonial Section */
#testimonial-slider {
    border: 2px solid #8B4513; /* Brown border for a historical look */
    padding: 20px;
    width: 500px;
    background: #FAF3E0; /* Light beige background */
    text-align: center;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

/* Testimonial Content */
#testimonial-content {
    font-family: 'Cinzel', serif;
    color: #5D4037; /* Dark brown text */
    font-size: 18px;
    padding: 15px;
    transition: opacity 0.5s ease-in-out;
}

/* Testimonial Rating */
#testimonial-content strong {
    color: #FFD700; /* Gold stars */
    font-size: 20px;
}

/* Buttons */
button {
    background-color: #8B4513; /* Brown */
    border: none;
    padding: 10px 15px;
    margin: 10px;
    font-size: 16px;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

button:hover {
    background-color: #A0522D; /* Lighter brown */
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
}

/* Responsive Design */
@media (max-width: 600px) {
    #testimonial-slider {
        width: 90%;
    }
}
</style>

<!--  User Review -->
<div class="reviews-container">
    <h2>What Our Users Say</h2>

    <!-- Display Reviews -->
    <div class="review-box">
        <?php if ($reviews_result->num_rows > 0) { ?>
            <?php while ($review = $reviews_result->fetch_assoc()) { ?>
                <div class="review-item">
                    <p><strong><?= htmlspecialchars($review['user_name']) ?></strong> (<?= $review['rating'] ?>/5 ★)</p>
                    <p>"<?= htmlspecialchars($review['review_text']) ?>"</p>
                    <small>Posted on: <?= date("d M Y", strtotime($review['created_at'])) ?></small>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="no-reviews">No reviews yet. Be the first to review!</p>
        <?php } ?>
</div>

    <!-- Write a Review (Only for Logged-in Users) -->
    <?php if (isset($_SESSION['email'])) { ?>
        <div class="write-review">
            <h3>Write a Review</h3>
            <form action="submit_review.php" method="POST">
            <input type="hidden" name="user_name" value="<?= isset($_SESSION['fname']) && isset($_SESSION['lname']) ? $_SESSION['fname'] . ' ' . $_SESSION['lname'] : 'Guest' ?>">
            <input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
                
                <label>Rate Hind Historia:</label>
                <select name="rating" required>
                    <option value="5">★★★★★ (5 - Excellent)</option>
                    <option value="4">★★★★☆ (4 - Good)</option>
                    <option value="3">★★★☆☆ (3 - Average)</option>
                    <option value="2">★★☆☆☆ (2 - Below Average)</option>
                    <option value="1">★☆☆☆☆ (1 - Poor)</option>
                </select>

                <label>Your Review:</label>
                <textarea name="review_text" required placeholder="Write your experience..."></textarea>

                <button type="submit">Submit Review</button>
            </form>
        </div>
    <?php } else { ?>
        <p class="login-message">Please <a href="login.php">log in</a> to write a review.</p>
    <?php } ?>
</div>
<style>
    /* Review Section */
.reviews-container {
    width: 80%;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.reviews-container h2 {
    color: #3E2723;
    font-size: 24px;
}

.review-box {
    margin-top: 20px;
    border-top: 2px solid #D4AF37;
    padding-top: 15px;
}

.review-item {
    background: #FFF3E0;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    border-left: 5px solid #D4AF37;
    text-align: left;
}

.review-item strong {
    color: #3E2723;
    font-size: 16px;
}

.review-item p {
    font-size: 14px;
    color: #555;
    margin: 5px 0;
}

.review-item small {
    font-size: 12px;
    color: #777;
}

.no-reviews {
    color: #777;
    font-style: italic;
}

.write-review {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #D4AF37;
}

.write-review h3 {
    font-size: 20px;
    color: #3E2723;
}

.write-review label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
    color: #3E2723;
}

.write-review select,
.write-review textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.write-review button {
    background: #D4AF37;
    color: #3E2723;
    padding: 10px;
    border: none;
    margin-top: 15px;
    cursor: pointer;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.write-review button:hover {
    background: #FFD700;
}

/* Login Message */
.login-message {
    font-size: 14px;
    color: #3E2723;
}

.login-message a {
    color: #D4AF37;
    text-decoration: none;
    font-weight: bold;
}
</style>

<!-- 8. Reach Us Section -->
<section class="reach-us">
    <h2>Reach Us</h2>
    <div class="contact-info">
        <div class="contact-details">
            <h3><strong>Contact Us</strong></h3>
            <div class="contact-box">
                <img src="phonelogo.png">Phone:<br>+91 9136809369
            </div>
            <div class="contact-box">
                📧 hind-historia@gmail.com
            </div>

            <h3><strong>Follow Us</strong></h3>
            <div class="contact-box">
                <img src="twitterlogo.png"> Twitter:<br> @hind-historia
            </div>
        </div>

        <!-- Google Maps -->
        <div class="google-maps">
            <iframe 
                frameborder="0" 
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBc__4ON7NhjXj5v5aLmvUc_x3AjsB3xzE&q=India" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>
  <style>
/* Reach Us Section - Unique Look */
.reach-us {
    background: linear-gradient(135deg, #4e342e, #3e2723); /* Rich brown gradient */
    color: #FFD700; /* Golden text */
    padding: 40px;
    text-align: center;
    border-radius: 15px;
    border: 3px solid #D4AF37;
    width: 90%;
    margin: 50px auto;
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.8);
    font-family: 'Cinzel', serif; /* Historical-looking font */
}

/* Title Styling */
.reach-us h2 {
    font-size: 30px;
    text-shadow: 3px 3px 6px rgba(255, 215, 0, 0.8);
    margin-bottom: 30px;
}

/* Contact Information Container */
.contact-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-radius: 15px;
}

/* Contact Details - Left Side */
.contact-details {
    width: 50%;
    text-align: left;
}

/* Contact Item Styling */
.contact-box {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 15px;
    border: 2px solid #FFD700;
    color: #FFD700;
    font-size: 20px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

/* Hover Effect for Contact Box */
.contact-box:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

/* Contact Icon Styling */
.contact-box img {
    margin-right: 15px;
    width: 15px;
}

/* Google Maps Styling */
.google-maps {
    width: 45%;
    height: 250px;
    border-radius: 15px;
    overflow: hidden;
    border: 3px solid #D4AF37;
    box-shadow: 0px 4px 10px rgba(255, 215, 0, 0.5);
}

/* Google Maps iframe */
.google-maps iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .contact-details {
        width: 100%;
    }

    .google-maps {
        width: 100%;
        margin-top: 20px;
    }
}
</style>

</body>
</html> 
