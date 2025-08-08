<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blood Donation</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: white;
            padding: 15px 0;
            border-bottom: 1px solid #ccc;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #000;
            font-weight: 500;
        }

        /* Hero */
        .hero {
            background: url('{{ asset('images/Front/mainimage.jpg') }}') no-repeat center center/cover;
            height: 400px;
            position: relative;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero-content {
            width: 100%;
        }

        .hero-content h1 {
            font-size: 30px;
            font-weight: 700;
        }

        .hero-content h1 span {
            color: #ff1e1e;
        }

        .hero-content p {
            margin: 15px 0;
            font-size: 14px;
        }

        .hero-content .red {
            color: red;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup {
            background: #2e4a5b;
            color: white;
        }

        .login {
            background: red;
            color: white;
        }

        /* For main and gallery */
        .main {
            display: flex;
            gap: 0px;
            /* space between gallery and camps */
            padding: 40px;
            background-color: #fff;
        }

        /* Gallery on the left */
        .gallery {
            flex: 2;
            /* takes 2 parts of the available width */
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Camps card on the right */
        .camps {
            /* flex: 1; */
      
            background-color: #e0f2f1;
         
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: fit-content;

        }

        /* Optional: style inside camps, like heading and list */
        .camps h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #00796b;
        }

        .camps ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .camps ul li a {
            color: #00796b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .camps ul li a:hover {
            color: #004d40;
            text-decoration: underline;
        }

        .gallery img {
            width: 250px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Grey strip */
        .grey-strip {
            height: 150px;
            background: #a5a5a5;
        }

        /* Footer */
       
    </style>
</head>

<body>

    <!-- Navbar -->
 
    <!-- Hero Section -->
    <section class="hero">
        <div class="overlay">
            <div class="container hero-content">
                <h1>There is not <br><span>Substitute for blood</span></h1>
                <p>Your blood can give someone a second chance at life.
                    Donate today and be a hero to those in need. <br>
                    Every donation saves lives, supports surgeries, and aids patients battling serious illnesses.
                    Join us in making a meaningful impact with just one simple act.</p>
                <div class="hero-buttons">
                    <button class="btn signup">Sign Up</button>
                    <button class="btn login">Login</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="main">
        <div class="gallery">
            <img src="{{ asset('images/Front/mainimage.jpg') }}" alt="Gallery 1">
            <img src="{{ asset('images/Front/mainimage.jpg') }}" alt="Gallery 2">
            <img src="{{ asset('images/Front/mainimage.jpg') }}" alt="Gallery 3">
        </div>
        <div class="camps">
            <h2>Upcoming Blood Donation Camps</h2>
            <ul>
                <li><a href="#">City Hospital - June 10, 2025</a></li>
                <li><a href="#">Community Center - June 15, 2025</a></li>
                <li><a href="#">Town Hall - June 20, 2025</a></li>
                <li><a href="#">University Campus - June 25, 2025</a></li>
            </ul>
        </div>
    </section>

    <!-- Grey Strip -->
    <div class="grey-strip">

    </div>

    <!-- Footer -->
 

</body>

</html>
