<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Curriculum Vitae</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
            color: #212529;
            padding-top: 70px; /* space for fixed navbar */
        }
        .cv-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            font-weight: 700;
            margin-bottom: 1rem;
            color:rgb(70, 70, 70);
        }
        h3 {
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #333;
        }
        .section-desc {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: #444;
            line-height: 1.5;
        }
        .address {
            font-size: 1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        .experience-item, .education-item {
            margin-bottom: 1.75rem;
        }
        .job-title, .degree {
            font-weight: 600;
            font-size: 1.1rem;
            color: #222;
        }
        .company, .institution {
            font-style: italic;
            color: #555;
        }
        .duration {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
        }
        .description {
            color: #555;
            line-height: 1.4;
        }
        @media (max-width: 576px) {
            .cv-container {
                padding: 1.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="portfolio.php">My Portfolio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav fw-semibold">
        <li class="nav-item">
          <a class="nav-link" href="index.php#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#tools">Tools</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cv.php">CV</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CV Content -->
<div class="cv-container mt-5">
    <h1>Curriculum Vitae</h1>

    <section id="introduction">
        <p class="section-desc">
            Welcome to my portfolio website! I am a passionate person with skills in data management. I specialize in data management, data visualization, and data analysis. Let me show you what I can do.
        </p>
        <p class="address">
            <strong>Address:</strong> Jatitujuh, Majalengka, West Java <br>
            <strong>Email:</strong> adikaswandi1@gmail.com
        </p>
        
    </section>

    <section id="work-experience">
        <h3>Work Experience</h3>
        <hr>

        <div class="experience-item">
            <div class="job-title">Management Data Analysis</div>
            <div class="company">Diskominfo Cirebon Regancy</div>
            <div class="duration">June 2023 - September 2023</div>
            <p class="description">
                <ul>
                    <li>Manage and input regional apparatus data and ensure data accuracy and integrity.</li>
                    <li>Analyzing the data of Cirebon Regency regional apparatus to ensure the suitability and accuracy of the data.</li>
                    <li>Designing data visualizations to develop information systems for the Cirebon Regency Open Data website.</li>
                </ul>
                </p>
            </div>
            
            <div class="experience-item">
                <div class="job-title">Content Writer</div>
                <div class="company">Radar Cirebon</div>
                <div class="duration">February 2024 - Present</div>
                <p class="description">
                <ul>
                    <li>Produce quality content that suits the needs and target audience of the company.
                    <li>Conduct effective keyword analysis to improve content performance.</li>
                    <li>Create a daily content creation plan to achieve the desired target.</li>
                    </li>
                </ul>
            </p>
        </div>
    </section>

    <section id="education">
        <h3>Education</h3>
        <hr>

        <div class="education-item">
            <div class="degree">Diploma III of management informatics</div>
            <div class="institution">STMIK IKMI Cirebon</div>
            <div class="duration">2021 - 2024</div>
            <p class="description"> GPA: 3.85/4.00 </p>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>