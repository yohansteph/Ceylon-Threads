<?php
include("config/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Batik and Leather Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <!--Navbar-->
    <header>
        <a href="#" class="logo">
            <img src="img/logo.png" alt="">
        </a>
        <!--Menu Icon-->
        <i class='bx bx-menu' id="menu-icon"></i>
        <!--Links-->
        <u1 class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#customers">Customers</a></li>
        </u1>

        <!--Icons-->
        <div class="header-icon">
          <a href="cart.php">
            <i class='bx bx-cart-alt'></i>
          </a>
          <i class='bx bx-search-alt-2' id="search-icon"></i>
        </div>

        <!--Search Box-->
<div class="search-box">

<form method="GET" action="#products">

<input type="text"
       name="search"
       placeholder="Search Here..."
       value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

<button type="submit">Search</button>

<button type="button"
        onclick="window.location='index.php#products'">
    Clear
</button>

</form>

</div>
    </header>
    <!--Home-->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Bringing the Heart<br>Of Sri Lanka <br>To You</h1>
            <p>Welcome to our store, where Sri Lanka's rich heritage comes to life. Explore a curated collection of authentic batik, handcrafted leather goods, and traditional masks—each piece telling a story of timeless craftsmanship and culture.</p>
            <a href="login.php" class="login-btn">Login</a>
            <a href="#products" class="btn">Shop Now</a>
            
        </div>
        <div class="home-img">
            <img src="img/cover 7.png"alt="">
        </div>
    </section>
    <!--About-->
    <section class="about" id="about">
      <div class="about-img">
        <img src="img/about 2.png" alt="">
      </div>  
      <div class="about-text">
       <h2>Leather and Batik Industry</h2> 
       <p>Welcome to Ceylon Threads, where tradition meets craftsmanship. We take pride in showcasing the rich heritage of Sri Lankan batik and leather products, offering the world a taste of authentic artistry and superior quality.</p>
       <p> Sri Lankas leather industry is known for producing premium-quality, handcrafted goods. Using ethically sourced materials and traditional techniques, our leather artisans create durable, stylish, and functional products. Whether its bags, wallets, or accessories, our leather collections reflect the perfect blend of durability, elegance, and craftsmanship.</p>
       <p>At Ceylon Threads, we are dedicated to delivering products that are not only aesthetically beautiful but also crafted with the finest materials. Each batik and leather item undergoes meticulous quality checks to ensure superior craftsmanship and long-lasting durability. By supporting our brand, you are not only embracing Sri Lankas rich artistic heritage but also empowering local artisans to continue their craft.</p>
       <a href="javascript:void(0)" class="btn" onclick="showContact()">
       Learn More
        </a>

<p id="contact-info" style="display:none; margin-top:15px; font-weight:bold;">
    Please contact +94 75 369-2114
</p>
      </div>

    </section>


 <!--//products-->
 <section class="products" id="products">
<div class="heading">
    <h2>Our Products</h2>
</div>
<div class="product-container">
    <?php
    if(isset($_GET['search']) && $_GET['search'] != ''){

    $search = mysqli_real_escape_string(
                    $conn,
                    $_GET['search']
              );

    $result = mysqli_query(
                $conn,
                "SELECT * FROM products
                 WHERE product_name LIKE '%$search%'"
             );

}
else{

    $result = mysqli_query(
                $conn,
                "SELECT * FROM products"
             );

}
    while($product = mysqli_fetch_assoc($result)){
    ?>
    <div class="box">
        <img src="<?php echo $product['image_url']; ?>" alt="">
        <h3><?php echo $product['product_name']; ?></h3>
        <div class="content">
            <span>
                Rs.<?php echo $product['price']; ?>/=
            </span>
            <a href="add_to_cart.php?id=<?php echo $product['product_id']; ?>">
            Add To Cart
            </a>
        </div>
    </div>
    <?php } ?>
</div>
</section>

<!--Customers-->




<section class="customers" id="customers">
    <div class="heading">
        <h2>Our Customers</h2>
    </div>
    <!--container-->
    <div class="customers-container">

        <div class="box">
            <div class="stars">
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star-half' ></i>
            </div>
            <p>I absolutely love the batik dress I purchased from this store! The colors are so vibrant, and the craftsmanship is exceptional. You can really tell that a lot of effort went into making this piece. It fits perfectly, and the fabric is soft and comfortable. I’ve received so many compliments whenever I wear it. Highly recommend for anyone looking for unique, handmade fashion!</p>
            <h2>Sophia Patel</h2>
            <img src="img/person 1.png" alt="">
        </div>

        <div class="box">
            <div class="stars">
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bx-star' ></i>
            </div>
            <p>The batik scarf I ordered is stunning! The patterns are beautifully detailed, and the fabric feels luxurious. It adds a perfect pop of color to any outfit. The only reason I’m giving 4 stars instead of 5 is that the shipping took a bit longer than expected. However, the quality of the product makes up for it. Will be ordering again soon!</p>
            <h2>Olivia Bennett</h2>
            <img src="img/person 3.png" alt="">
        </div>

        <div class="box">
            <div class="stars">
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
            </div>
            <p>This leather wallet exceeded my expectations! The material is genuine and feels premium. It has a sleek design with enough space for cards and cash without feeling bulky. The stitching is top-notch, and the leather has a rich, elegant look. I’ve been using it daily for weeks, and it still looks brand new. Definitely worth the price!</p>
            <h2>Daniel Carter</h2>
            <img src="img/person 2.png" alt="">
        </div>
    </div>
</section>

<!--Footer Section-->
<section class="footer">
    <div class="footer-box">
        <h3>Batik and Leather Shop</h3>
        <p>We truly appreciate your support for Ceylon Threads, where tradition meets craftsmanship. Every batik and leather product in our collection is handcrafted with care, celebrating the rich heritage of Sri Lankan artistry. Your purchase not only brings you unique, high-quality fashion but also supports skilled artisans who keep these traditions alive.</p>

        <div class="social">
            <a href="#"><i class='bx bxl-facebook-circle'></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
            <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
            <a href="#"><i class='bx bxl-tiktok' ></i></a>
        </div>
    </div>

    <div class="footer-box">
        <h3>support</h3>
        <li><a href="#">Products</a></li>
        <li><a href="#">Help & support</a></li>
        <li><a href="#">Return Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
    </div>

    <div class="footer-box">
        <h3>View Guides</h3>
        <li><a href="#">Features</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Blog Post</a></li>
        <li><a href="#">Our Shops</a></li>
    </div>

    <div class="footer-box">
        <h3>Contact</h3>
        <div class="contact">
            <span><i class='bx bx-map' ></i>24/5, Mahavihara Road, Dematagoda</span>
            <span><i class='bx bx-phone-call' ></i>+94 75 369-2114</span>
            <span><i class='bx bx-envelope' ></i>Ceylonthreads@Shop.com</span>
        </div>
    </div>
</section>


    <script src="script.js"></script>

<script>
function showContact() {
    document.getElementById("contact-info").style.display = "block";
}
</script>
</body>
</html>