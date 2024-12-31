<?php

include "includes/layout/header.php";

// var_dump($_GET);
if (isset($_GET['category'])) {
  $categoryId = $_GET['category'];
  // $posts = $connection->query("SELECT * FROM posts WHERE category_id=$categoryId ORDER BY id DESC");
  $posts = $connection->prepare("SELECT * FROM posts WHERE category_id=:catid ORDER BY id DESC ");
  $posts->execute(["catid" => $categoryId]);
} else
  $posts = $connection->query("SELECT * FROM posts ORDER BY id DESC LIMIT 20 ");


?>

<main>
  <!-- Slider Section -->
  <?php include "includes/layout/slider.php" ?>

  <!-- Content Section -->
  <section class="mt-4">
    <div class="row">
      <!-- Posts Content -->
      <div class="col-lg-8">
        <div class="row g-3">
          <?php foreach ($posts as $post): ?>
            <div class="col-sm-6">
              <div class="card">
                <img src="./assets/images/<?= $post['image'] ?>" class="card-img-top" alt="post-image" />
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h5 class="card-title fw-bold"><?= substr($post['title'], 0, 10) ?></h5>
                    <div>
                      <?php
                      $cat_id = $post['category_id'];
                      $category = $connection->query("SELECT * FROM categories WHERE id=$cat_id")->fetch();
                      ?>
                      <span class="badge text-bg-secondary"><?= $category['title'] ?></span>
                    </div>
                  </div>
                  <p class="card-text text-secondary pt-3">
                    <?= substr($post['body'], 0, 500) . "..." ?> </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a href="single.html" class="btn btn-sm btn-dark">مشاهده</a>

                    <p class="fs-7 mb-0">نویسنده :<?= $post['author'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>

      <!-- Sidebar Section -->
      <?php include "includes/layout/sidebar.php" ?>
    </div>
  </section>
</main>

<!-- Footer Section -->
<?php include "includes/layout/footer.php" ?>