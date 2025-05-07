<?php
// Basic blog post management in PHP using JSON file to store posts

// Setup
define('POSTS_FILE', __DIR__ . '/blog_posts.json');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Load existing posts
$posts = [];
if (file_exists(POSTS_FILE)) {
    $posts = json_decode(file_get_contents(POSTS_FILE), true);
    if (!is_array($posts)) {
        $posts = [];
    }
}

// Initialize variables
$errors = [];
$success = '';
$editingPost = null;
$action = $_POST['action'] ?? $_GET['action'] ?? null;
$postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : (isset($_GET['post_id']) ? intval($_GET['post_id']) : null);

// Function to save posts to file
function savePosts($posts) {
    file_put_contents(POSTS_FILE, json_encode($posts, JSON_PRETTY_PRINT));
}

// Function to sanitize input
function cleanInput($input) {
    return trim(htmlspecialchars($input, ENT_QUOTES));
}

// Handle delete
if ($action === 'delete' && $postId !== null) {
    if (isset($posts[$postId])) {
        // Delete image file if exists
        if (!empty($posts[$postId]['image']) && file_exists(UPLOAD_DIR . $posts[$postId]['image'])) {
            unlink(UPLOAD_DIR . $posts[$postId]['image']);
        }
        unset($posts[$postId]);
        savePosts($posts);
        header("Location: " . $_SERVER['PHP_SELF'] . "?msg=deleted");
        exit;
    } else {
        $errors[] = "Post not found.";
    }
}

// Load post for editing
if ($action === 'edit' && $postId !== null) {
    if (isset($posts[$postId])) {
        $editingPost = $posts[$postId];
        $editingPost['id'] = $postId;
    } else {
        $errors[] = "Post not found.";
    }
}

// Handle create/update form submission
if ($action === 'save') {
    $title = cleanInput($_POST['title'] ?? '');
    $excerpt = cleanInput($_POST['excerpt'] ?? '');

    if ($title === '') {
        $errors[] = "Title is required.";
    }

    if ($excerpt === '') {
        $errors[] = "Excerpt is required.";
    }

    // Handle image upload (optional)
    $imageName = $editingPost['image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['image']['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = "Only JPG, PNG, and GIF images are allowed for featured image.";
            } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                $errors[] = "Image size must be less than 5MB.";
            } else {
                // Save uploaded image
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $basename = bin2hex(random_bytes(8));
                $newFileName = $basename . '.' . $ext;
                $destPath = UPLOAD_DIR . $newFileName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $destPath)) {
                    $errors[] = "Failed to upload image.";
                } else {
                    // Delete old image if updating
                    if ($editingPost && !empty($editingPost['image']) && file_exists(UPLOAD_DIR . $editingPost['image'])) {
                        unlink(UPLOAD_DIR . $editingPost['image']);
                    }
                    $imageName = $newFileName;
                }
            }
        } else {
            $errors[] = "Error uploading image.";
        }
    }

    if (empty($errors)) {
        $postData = [
            'title' => $title,
            'excerpt' => $excerpt,
            'image' => $imageName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($editingPost !== null && isset($editingPost['id'])) {
            // Update existing post
            $posts[$editingPost['id']] = $postData;
            $success = "Post updated successfully.";
        } else {
            // Create new post
            $posts[] = $postData;
            $success = "Post created successfully.";
        }
        savePosts($posts);
        // Reset form after save
        $editingPost = null;
    }
}

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

$msg = $_GET['msg'] ?? null;
if ($msg === 'deleted') {
    $success = "Post deleted successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blog Admin - Manage Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        body {
            background-color: #f7f9fc;
            padding-top: 3rem;
        }
        .container {
            max-width: 900px;
        }
        .post-list img {
            max-width: 120px;
            max-height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .form-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .error-msg {
            color: #dc3545;
        }
        .success-msg {
            color: #198754;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">My Portfolio</a>
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
          <a class="nav-link" href="blog.php">Blog</a>
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


<div class="container">
    <h1 class="mb-4">Blog Post Management</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error):?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h2><?= $editingPost ? "Edit Post" : "Create New Post" ?></h2>
        <form method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="action" value="save" />
            <?php if ($editingPost && isset($editingPost['id'])): ?>
                <input type="hidden" name="post_id" value="<?= esc($editingPost['id']) ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required value="<?= esc($editingPost['title'] ?? '') ?>" >
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt / Description <span class="text-danger">*</span></label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="4" required><?= esc($editingPost['excerpt'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Featured Image <?= $editingPost ? '(leave empty to keep current image)' : '' ?></label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" <?= $editingPost ? '' : 'required' ?>>
                <?php if ($editingPost && !empty($editingPost['image'])): ?>
                    <div class="mt-2">
                        <img src="uploads/<?= esc($editingPost['image']) ?>" alt="Current Image" />
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary"><?= $editingPost ? "Update Post" : "Create Post" ?></button>
            <?php if ($editingPost): ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <h2>Existing Blog Posts</h2>
    <?php if (empty($posts)): ?>
        <p>No blog posts found.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle post-list">
                <thead>
                <tr>
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Last Updated</th>
                    <th style="width:120px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $index => $post): ?>
                    <tr>
                        <td>
                            <?php if (!empty($post['image']) && file_exists(UPLOAD_DIR . $post['image'])): ?>
                                <img src="uploads/<?= esc($post['image']) ?>" alt="<?= esc($post['title']) ?>" />
                            <?php else: ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($post['title']) ?></td>
                        <td><?= esc(mb_strimwidth($post['excerpt'], 0, 80, '...')) ?></td>
                        <td><?= esc($post['updated_at'] ?? '') ?></td>
                        <td>
                            <a href="?action=edit&post_id=<?= $index ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="?action=delete&post_id=<?= $index ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
