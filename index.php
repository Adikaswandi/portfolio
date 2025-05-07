<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Portfolio</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            color: #212529;
            scroll-behavior: smooth;
            padding-top: 70px; /* space for fixed navbar */
        }
        .intro-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
        .intro-text {
            max-width: 600px;
        }
        .profile-pic {
            max-width: 280px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .tools-section {
            padding: 4rem 1rem;
            background-color: #ffffff;
            text-align: center;
        }
        .tools-section h2 {
            margin-bottom: 2rem;
            font-weight: 600;
            color: #333;
        }
        .tool-icon {
            font-size: 3rem;
            margin: 1rem;
            color: #0d6efd;
            transition: color 0.3s ease;
            cursor: default;
        }
        .tool-icon:hover {
            color: #0a58ca;
        }
        .projects-section {
            padding: 4rem 1rem;
            background-color: #f1f3f5;
        }
        .projects-section h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 3rem;
            color: #444;
        }
        .card-project {
            box-shadow: 0 4px 12px rgba(0,0,0,0.07);
            border-radius: 12px;
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-project:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.12);
        }
        .card-img-top {
            border-radius: 12px 12px 0 0;
            object-fit: cover;
            height: 180px;
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-weight: 600;
        }
        .card-text {
            flex-grow: 1;
            margin-bottom: 1rem;
            color: #555;
        }
        .contact-section {
            padding: 4rem 1rem;
            background-color: #ffffff;
            text-align: center;
        }
        .contact-section h2 {
            font-weight: 600;
            margin-bottom: 2rem;
            color: #333;
        }
        .blog-section {
            padding: 4rem 1rem;
            background-color: #e9ecef;
        }
        .blog-section h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 3rem;
            color: #222;
        }
        .blog-article {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.07);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: box-shadow 0.3s ease;
        }
        .blog-article:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .blog-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #0d6efd;
        }
        .blog-excerpt {
            color: #555;
        }
        @media (max-width: 767px) {
            .intro-section {
                flex-direction: column;
                text-align: center;
            }
            .profile-pic {
                margin-top: 2rem;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>

<?php
// $tools = [
//     ['name' => 'HTML5', 'icon' => 'bi-file-code-fill'],
//     ['name' => 'CSS3', 'icon' => 'bi-palette-fill'],
//     ['name' => 'JavaScript', 'icon' => 'bi-code-slash'],
//     ['name' => 'PHP', 'icon' => 'bi-file-earmark-code-fill'],
//     ['name' => 'Bootstrap', 'icon' => 'bi-bootstrap-fill'],
//     ['name' => 'Wordpress', 'icon' => 'bi-wordpress'],
//     ['name' => 'Python', 'icon' => 'bi-filetype-py'],
//     ['name' => 'Tableau', 'icon' => 'bi-file-earmark-bar-graph'],
//     ['name' => 'Microsoft', 'icon' => 'bi-file-earmark-excel'],
// ];

$tools = [
    ['name' => 'Microsoft Office', 'img' => 'asset/office.svg'],
    ['name' => 'Tableau', 'img' => 'asset/tableau.svg'],
    ['name' => 'Figma', 'img' => 'asset/figma.svg'],
    ['name' => 'Wordpress', 'img' => 'asset/wordpress.svg'],
    ['name' => 'Python', 'img' => 'asset/py.svg'],
    ['name' => 'HTML5', 'img' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg'],
    ['name' => 'CSS3', 'img' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg'],
    ['name' => 'PHP', 'img' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg'],
    ['name' => 'JavaScript', 'img' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg'],
    //['name' => 'Git', 'img' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg'],
];

$projects = [
    [
        'title' => 'Analisis Customer Bank BTPN Syariah',
        'desc' => 'A data analysis dashboard project using Tableau with source dataset in SQL database.',
        'img' => 'asset/btpn.png',
        'link' => 'https://drive.google.com/file/d/13JNFhaRIkoJdm6rpWGp6e4SAC4OvEHTh/view?usp=sharing'
    ],
    [
        'title' => 'UI/UX Design of Photo Studio Reservation App',
        'desc' => 'A UX design for the Photo Studio Reservation app that allows users to book a venue with easy customization.',
        'img' => 'asset/ux.png',
        'link' => 'https://docs.google.com/presentation/d/1ueix2zTih5GysObPniuXaRytKXvhZ8ROQE-VNcRIrzM/edit#slide=id.gd800de29cc_0_80'
    ],
    // [
    //     'title' => 'Machine Learning',
    //     'desc' => 'An e-commerce platform powered by Bootstrap and custom scripts.',
    //     'img' => 'https://images.pexels.com/photos/256657/pexels-photo-256657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=180',
    //     'link' => 'https://colab.research.google.com/drive/1PVX2hUA845jj_slIA5LIAiapoYx4BI9y?usp=sharing'
    // ],

    
 
];

// $blogs = [
//     [
//         'title' => 'Getting Started with Bootstrap 5',
//         'excerpt' => 'Learn the basics of Bootstrap 5 and how to build responsive websites with minimal effort.'
//     ],
//     [
//         'title' => 'PHP Tips and Tricks for Beginners',
//         'excerpt' => 'Explore essential tips to write cleaner and more efficient PHP code.'
//     ],
//     [
//         'title' => 'JavaScript ES6 Features You Should Know',
//         'excerpt' => 'An overview of modern JavaScript features that enhance your coding experience.'
//     ],
// ];
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Adi K Portfolio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav fw-semibold">
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tools">Tools</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cv.php">CV</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Section 1: Introduction -->
<section id="about" class="container intro-section">
    <div class="row w-100 align-items-center">
        <div class="col-md-6 intro-text">
            <h1 class="display-4 fw-bold mb-3">Hello, I'm Adi Kaswandi</h1>
            <p class="lead mb-4">
                Welcome to my portfolio website! I am a passionate person with skills in data management. I specialize in data management, data visualization, and data analysis. Let me show you what I can do.
            </p>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <!-- <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=280" alt="Profile Picture" class="profile-pic" /> -->
            <img src="asset/FFbiru.jpg" alt="Profile Picture" class="profile-pic" />
        </div>
    </div>
</section>

<!-- Section 2: Tools -->
<!-- <section id="tools" class="tools-section">
    <h2>Skills & Tools</h2>
    <div class="d-flex justify-content-center flex-wrap">
        <?php foreach ($tools as $tool): ?>
            <div class="mx-3 tool-icon" title="<?php echo htmlspecialchars($tool['name']); ?>">
                <i class="<?php echo $tool['icon']; ?>"></i>
                <div style="font-size: 0.9rem; margin-top: 0.3rem;"><?php echo htmlspecialchars($tool['name']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section> -->

<!-- Section 2: Tools -->
<section id="tools" class="tools-section">
    <h2>My Tools & Skills</h2>
    <div class="d-flex justify-content-center flex-wrap">
        <?php foreach ($tools as $tool): ?>
            <div class="mx-3 tool-icon" title="<?= htmlspecialchars($tool['name']); ?>" style="text-align:center;">
                <img src="<?= htmlspecialchars($tool['img']); ?>" alt="<?= htmlspecialchars($tool['name']); ?>" style="width:64px; height:64px; object-fit: contain; margin-bottom: 0.3rem; transition: transform 0.3s ease; cursor: default;" />
                <div style="font-size: 0.9rem; color:#0d0d0d;"><?= htmlspecialchars($tool['name']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<style>
    .tool-icon img:hover {
        transform: scale(1.15);
    }
</style>

<!-- Section 3: Projects -->
<section id="projects" class="projects-section">
    <h2>Projects</h2>
    <div class="container">
        <div class="row g-4 justify-content-center">
            <?php foreach ($projects as $proj): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                    <div class="card card-project">
                        <img src="<?php echo $proj['img']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($proj['title']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($proj['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($proj['desc']); ?></p>
                            <a href="<?php echo $proj['link']; ?>" class="btn btn-secondary mt-auto w-100" target="_blank" rel="noopener noreferrer">Show Project</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Section 5: Contact -->
<section id="contact" class="contact-section">
    <h2>Contact Me</h2>
    <p class="mb-4">Feel free to contact me via email or social media!</p>
    <p>Email: <a href="mailto:adikaswandi@gmail.com">adikaswandi1@gmail.com</a></p>
    <p>
        <a href="https://instagram.com/adyy.id" target="_blank" rel="noopener" class="me-3">
            <i class="bi bi-instagram fs-3 text-secondary"></i>
        </a>
        <a href="https://linkedin.com/in/adi-kaswandi" target="_blank" rel="noopener" class="me-3">
            <i class="bi bi-linkedin fs-3 text-secondary"></i>
        </a>
        <a href="https://github.com/yourprofile" target="_blank" rel="noopener">
            <i class="bi bi-github fs-3 text-dark"></i>
        </a>
    </p>
</section>

<!-- Bootstrap JS CDN Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>