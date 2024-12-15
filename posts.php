<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ประชาสัมพันธ์</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>
<style>
     .hero {
          background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/random/1600x900/?announcement');
          background-size: cover;
          background-position: center;
          color: white;
          padding: 100px 0;
          margin-bottom: 50px;
     }

     .post-card {
          transition: all 0.3s ease;
          border: none;
          border-radius: 15px;
          overflow: hidden;
     }

     .post-card:hover {
          box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
          transform: translateY(-5px);
     }

     .post-image {
          height: 200px;
          object-fit: cover;
     }

     .add-post-btn {
          margin-bottom: 20px;
     }
</style>

<body>
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php' ?>
     </div>
     <div class="hero text-center">
          <h1 class="display-4 fw-bold">รายการประชาสัมพันธ์</h1>
          <p class="lead">ติดตามข่าวสารและกิจกรรมล่าสุดของเรา</p>
     </div>

     <div class="container">
          <div class="row mb-4">
               <div class="col-md-6">
                    <a href="index.php" class="btn btn-secondary">หน้าหลัก</a>
               </div>
               <?php if (isset($_SESSION['login']) && $_SESSION['role'] == 'admin') : ?>
                    <div class="col-md-6 text-md-end">

                         <a href="add_post.php" class="btn btn-primary add-post-btn">
                              &plus; เพิ่มโพสต์ประชาสัมพันธ์
                         </a>
                    </div>
               <?php endif; ?>
          </div>
          <?php
          // Simulated database of posts
          $stmt = $conn->query("SELECT * FROM posts p JOIN users u ON p.user_id = u.user_id ORDER BY p.created_at DESC");
          $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

          ?>
          <div class="row g-4">
               <?php foreach ($posts as $post) : ?>
                    <div class="col-md-4">
                         <div class="card post-card h-100">
                              <?php if (empty($post['image'])) : ?>
                              <?php else : ?>
                                   <img src="<?php echo $post['image']; ?>" class="card-img-top post-image" alt="<?php echo $post['title']; ?>">
                              <?php endif; ?>
                              <div class="card-body">
                                   <h2 class="card-title h4"><?php echo $post['title']; ?></h2>
                                   <p class="card-text">
                                        <?php echo mb_strimwidth($post['content'], 0, 100, '...'); ?>
                                   </p>
                                   <p class="text-muted"><small> วันที่โพสต์: <?php echo date('j/n/Y', strtotime($post['created_at'])); ?></small></p>

                                   <div class="d-flex justify-content-between align-items-center">

                                        <a href="posts_comments.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary">อ่านเพิ่มเติม</a>
                                        <span class="text-muted ms-2">ผู้เข้าชม <?php echo $post['view']; ?> คน</span>
                                   </div>


                              </div>

                         </div>
                    </div>
               <?php endforeach; ?>
          </div>
     </div>

     <script src="lib/jquery.js"></script>
     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>