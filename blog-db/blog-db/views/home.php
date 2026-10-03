 <?php
$posts = get_all_posts();
?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            <?php showmessage(); ?>

            <?php foreach ($posts as $post): ?>

                <!-- Post preview-->
                <div class="post-preview">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <?php if (!empty($post['image'])): ?>
                                <?php 
                                    $imgSrc = (str_starts_with($post['image'], 'data:') || str_starts_with($post['image'], 'http')) 
                                        ? $post['image'] 
                                        : "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $post['image'];
                                ?>
                                <img width="200" height="100" class="rounded mb-2" style="object-fit: cover;" src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                            <?php endif; ?>
                            <a href="#!">
                                <h2 class="post-title">
                                    <?= htmlspecialchars($post['title']); ?>
                                </h2>
                                <h3 class="post-subtitle">
                                    <?= htmlspecialchars($post['content']); ?>
                                </h3>
                            </a>
                            <p class="post-meta">
                                Posted on <?= !empty($post['created_at']) ? date('F j, Y', strtotime($post['created_at'])) : 'Recently' ?> //strtotime بتحول تاريخ ل نص
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 ms-3">
                            <a href="index.php?page=edit_post&id=<?= $post['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit Post">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?page=add_post&action=delete&id=<?= $post['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?');" title="Delete Post">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Divider-->
                <hr class="my-4" />

            <?php endforeach; ?>

            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary text-uppercase" href="#!">
                    Older Posts →
                </a>
            </div>

        </div>
    </div>
</div>