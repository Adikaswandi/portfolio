<?php
define('POSTS_FILE', __DIR__ . '/blog_posts.json');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

// Load posts
$posts = [];
if (file_exists(POSTS_FILE)) {
    $posts = json_decode(file_get_contents(POSTS_FILE), true);
    if (!is_array($posts)) {
        $posts = [];
    }
}

$postId = isset($_GET['post_id']) ? intval($_GET['post_id']) : null;
$postToShow = null;
if ($postId !== null && isset($posts[$postId])) {
    $postToShow = $posts[$postId];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Blog<?php if ($postToShow) echo " - " . esc($postToShow['title']); ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
   <style>
        body {
            background-color: #f9fafb;
            padding-top: 3rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container#blog {
            max-width: 900px;
        }
        .blog-list .card {
            margin-bottom: 2rem;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
            display: flex;
            flex-direction: column;
        }
        .blog-list .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
        }
        .card-img-top {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            transition: transform 0.3s ease;
        }
        .blog-list .card:hover .card-img-top {
            transform: scale(1.05);
        }
        .card-body {
            padding: 1.8rem 2rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #222;
            letter-spacing: 0.02em;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
            flex-grow: 1;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        .read-more-btn {
            align-self: flex-start;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .read-more-btn:hover, .read-more-btn:focus {
            background-color: #0a58ca;
            color: #fff;
            text-decoration: none;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            font-weight: 600;
            color: #0d6efd;
            text-decoration: none;
        }
        .back-link:hover, .back-link:focus {
            text-decoration: underline;
        }
        .full-post img.featured-image {
            max-width: 100%;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .full-post img.featured-image:hover {
            transform: scale(1.03);
        }
        .full-post h2 {
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .full-post p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #333;
        }
        @media (max-width: 767px) {
            .card-img-top {
                height: 180px;
            }
        }
   </style>
</head>
<body>

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
          <a class="nav-link" href="index.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#tools" id="tools">Tools</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cv.php">CV</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5" id="blog">
    <!-- <h1 class="mb-5 mt-5 ">Blog</h1> -->

<?php if ($postToShow): ?>
    <a href="blog.php" class="back-link mt-5">&larr; Back to Blog List</a>
    <article class="full-post">
        <h2><?= esc($postToShow['title']) ?></h2>
        <?php if (!empty($postToShow['image']) && file_exists(UPLOAD_DIR . $postToShow['image'])): ?>
            <img src="uploads/<?= esc($postToShow['image']) ?>" alt="<?= esc($postToShow['title']) ?>" class="featured-image" />
        <?php endif; ?>
        <p>
            <?php
                // Show full content if exists, else show excerpt
                if (!empty($postToShow['content'])) {
                    echo nl2br(esc($postToShow['content']));
                } else {
                    echo nl2br(esc($postToShow['excerpt'] ?? ''));
                }
            ?>
        </p>
    </article>
<?php else: ?>
    <?php if (empty($posts)): ?>
        <p class="text-center fs-5">No blog posts available.</p>
    <?php else: ?>
        <div class="blog-list">
            <?php foreach ($posts as $index => $post): ?>
                <div class="card">
                    <?php if (!empty($post['image']) && file_exists(UPLOAD_DIR . $post['image'])): ?>
                        <img src="uploads/<?= esc($post['image']) ?>" class="card-img-top" alt="<?= esc($post['title']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title"><?= esc($post['title']) ?></h3>
                        <p class="card-text">
                            <?php
                                $desc = $post['excerpt'] ?? '';
                                $words = str_word_count($desc, 1);
                                if (count($words) > 25) {
                                    $desc = implode(' ', array_slice($words, 0, 25)) . '...';
                                }
                                echo esc($desc);
                            ?>
                        </p>
                        <a href="blog.php?post_id=<?= $index ?>" class="btn btn-secondary read-more-btn">Read More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>