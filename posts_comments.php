<?php
include 'db.php';
session_start();
if (!isset($_SESSION['login']) ) {
     header('Location: index.php');
     exit();
}

$post_id = $_GET['id'] ? $_GET['id'] : null;


$stmt = $conn->query(
     "SELECT * FROM posts 
     JOIN users 
     ON posts.user_id = users.user_id 
     WHERE post_id = $post_id"

);

$post = $stmt->fetch(PDO::FETCH_ASSOC);
// Get comments
$stmt = $conn->query("SELECT * FROM comments c 
     JOIN users u ON c.user_id = u.user_id     
     WHERE c.post_id = '$post_id'
     ORDER BY c.created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$view = $conn->query("update posts set view = view + 1 where post_id = $post_id");
?>
<!DOCTYPE html>

<html lang="th">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>รายละเอียดประชาสัมพันธ์</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">

     <style>
          .post-image {
               max-height: 400px;
               object-fit: cover;
          }

          .comment-card {
               border-left: 4px solid #007bff;
               background-color: #f8f9fa;
          }
     </style>
</head>

<body>

     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php'; ?>
     </div>

     <div class="container mt-5">
          <div class="card mb-4">
               <?php if (empty($post['image'])) : ?>
               <?php else : ?>
                    <img src="<?php echo $post['image']; ?>" class="card-img-top  post-image"
                         alt="<?php echo $post['title']; ?>">
               <?php endif; ?>
               <div class="card-body">
                    <h1 class="card-title"><?php echo $post['title']; ?></h1>
                    <p class="text-muted"><small> วันที่โพสต์:
                              <?php echo date('j/n/Y', strtotime($post['created_at'])); ?></p>
                    <p class="card-text"><?php echo $post['content']; ?></p>
               </div>
          </div>
          <div class="card mt-4">
               <div class="card-body">
                    <h3 class="card-title">แสดงความคิดเห็น</h3>
                    <form action="api/comments/create.php" method="post">
                         <input type="hidden" name="pid" value="<?php echo $post['post_id']; ?>">
                         <div class="mb-3">
                              <label for="comment" class="form-label">ความคิดเห็น</label>
                              <textarea class="form-control" id="comment" name="content" rows="3" required></textarea>
                         </div>
                         <button type="submit" class="btn btn-primary">ส่งความคิดเห็น</button>
                    </form>
               </div>
          </div>
          <?php
          ?>
          <h2 class="mb-4">ความคิดเห็น</h2>
          <?php foreach ($comments as $row) { ?>
               <div class="card comment-card mb-3">
                    <div class="card-body">
                         <h5 class="card-title"><i class="bi bi-person-circle"></i> <?= $row['username']; ?></h5>
                         <p class="card-text"><?= $row['content']; ?></p>
                    </div>
               </div>
          <?php } ?>


     </div>




     <script src="lib/bootstrap.bundle.js"></script>
     <script src="lib/jquery.js"></script>
</body>

</html>