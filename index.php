    <?php 
        include 'components/navbar_index.php'; 
        require 'koneksi.php';
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!-- <nav class="navbaratas">
        <div class="logoatas">Wiki Character</div>
        
        <ul class="nav-linksatas">
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="galeri.html">Galeri</a></li>
            <li><a href="form.html">Form</a></li> 
            <li><a href="tabel.html">Card</a></li>
            <li><a href=".">Follow Me</a></li>
        </ul>
    </nav> -->
    <body class="light-mode">

    <header class="hero-banner">
        <div class="overlay">
            <div class="navbar">
                <h1 class="logo">Home</h1>
                <button id="theme-toggle" class="theme-toggle-btn">
                    <img src="img/hina.webp"  class="icon light-icon"></img>
                    <img  src="img/sayo.webp" class="icon dark-icon"></img>
                </button>
            </div>
            <div class="hero-text">
                <h2>BanG Dream Wiki</h2>
                <p>Bang Dream Wiki Fandom</p>
            </div>
        </div>
    </header>

    <main class="container">
        <h3 class="section-title">New</h3>
        
        <div class="news-grid">
            <article class="news-card">
                <div class="news-content">
                    <span class="category">Collab</span>
                    <h4>BanG Dream! Girls Band Party! (English) x 【OSHI NO KO】Collab is live now!</h4>
                    <p>anG Dream! Girls Band Party! (English version) is launching a collaboration with the Japanese TV anime【OSHI NO KO】from August 27, with five Collab Limited Members and various in-game campaigns running until September 27.</p>
                    <a href="#" class="read-more">Read-more &rarr;</a>
                </div>

            </article>

             <div class="news-grid">
            <article class="news-card">
                <div class="news-content">
                    <span class="category">Song</span>
                    <h4>The song ”I’m the Master”, a Synthesizer V 2 AI HALO collaboration produced by enon kawatani, is set to be released digitally!</h4>
                    <p>The song ”I’m the Master”, a Synthesizer V 2 AI HALO collaboration produced by enon kawatani, is set to be released digitally!
                        Have a great time listening to it♪

                     </p>
                    <a href="#" class="read-more">Read-more &rarr;</a>
                </div>

            </article> <div class="news-grid">
            <article class="news-card">
                <div class="news-content">
                    <span class="category">AI</span>
                    <h4>Synthesizer V 2 AI Yumenokessho AVER is coming soon!</h4>
                    <p>This product will be sold exclusively at Bushiroad Online Store and will be made-to-order only.</p>
                    <a href="#" class="read-more">Read-more &rarr;</a>
                </div>

            </article>
    </main>
    <script src="js/script.js"></script>
</body>
</html>