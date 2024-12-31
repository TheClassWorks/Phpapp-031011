<?php
$categories = $connection->query("SELECT * FROM categories");

$invalidName = '';
$invalidEmail = '';
$successSubscriberInsert = '';

// var_dump($_POST);
if (isset($_POST['btn'])) {

  if (empty(trim($_POST['lname']))) {
    $invalidName = 'فیلد نام را وارد کنید';
  } else if (empty(trim($_POST['email']))) {
    $invalidEmail = 'فیلد ایمیل را وارد کنید';
  } else {
    $name = $_POST['lname'];
    $email = $_POST['email'];
    $newSubscriber = $connection->prepare("INSERT INTO subscribers (name,email) VALUES (:name,:email)");
    $newSubscriber->execute(['name' => $name, 'email' => $email]);
    $successSubscriberInsert = 'عضویت شما با موفقیت انجام شد';
  }
}



?>
<div class="col-lg-4">
  <!-- Sesrch Section -->
  <div class="card">
    <p class="fw-bold fs-6 card-header text-center">جستجو در سایت</p>
    <div class="card-body">
      <form action="search.html">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="جستجو ..." />
          <button class="btn btn-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Categories Section -->
  <div class="card mt-4">
    <div class="fw-bold fs-6 card-header text-center">دسته بندی ها</div>
    <ul class="list-group list-group-flush p-0">
      <?php foreach ($categories as $category): ?>
        <li class="list-group-item">
          <a class="link-body-emphasis text-decoration-none" href="index.php?category=<?= $category['id'] ?>&kelid=11"><?= $category['title'] ?></a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

  <!-- Subscribue Section -->
  <div class="card mt-4">
    <p class="fw-bold fs-6 card-header text-center">عضویت در خبرنامه</p>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3">
          <label class="form-label">نام</label>
          <input type="text" class="form-control" name="lname" />
          <div class="text-danger"><?= $invalidName ?></div>
        </div>
        <div class="mb-3">
          <label class="form-label">رایانامه</label>
          <input type="email" class="form-control" name="email" />
          <div class="text-danger"><?= $invalidEmail ?></div>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-secondary" name="btn">ارسال</button>
        </div>
        <div class="text-success"><?= $successSubscriberInsert ?></div>
      </form>
    </div>
  </div>

  <!-- About Section -->
  <div class="card mt-4">
    <p class="fw-bold fs-6 card-header text-center">درباره ما</p>
    <div class="card-body">
      <p class="text-justify">
        وظیفه اصلی یک مدرس در حوزه فناوری، کاهش زمان و انرژی لازم برای موفق شدن دانش پذیرانش است. برای رسیدن به این مهم باید از مشاور و مدرسی آموزش دید که یک متخصص
        واقعی با تجربه‌های بزرگ در شرکت‌های مطرح باشد و چالش‌های متفاوتی را در نرم افزارهای سطح بالا به صورت واقعی تجربه کرده باشد. افتخار می‌کنیم با مدرسینی همکاری
        داریم که متخصص و به شدت با تجربه هستند و در بزرگترین شرکت‌های نرم افزاری ایران تجربه کار جدی داشته اشته اند.
      </p>
    </div>
  </div>
</div>