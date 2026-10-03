<?php
$id = $_GET['id'] ?? null;
$post = $id ? get_post_by_id($id) : null;

if (!$post) {
    setmessage("Post not found.", "danger");
    header("Location: index.php?page=home");
    exit;
}
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Edit Post</h1>
                    <span class="subheading">Update your post content</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                
                <?php showmessage(); ?>

                <div class="my-4">
                    <form id="editPostForm" method="POST" action="index.php?page=add_post&action=update&id=<?= $post['id'] ?>" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="title" name="title" type="text" placeholder="Enter post title..." value="<?= htmlspecialchars($post['title']) ?>" required />
                            <label for="title">Post Title</label>
                        </div>

                        <div class="mb-3">
                            <?php if (!empty($post['image'])): ?>
                                <div class="mb-2">
                                    <label class="form-label text-muted d-block">Current Image:</label>
                                    <?php 
                                        $imgSrc = (str_starts_with($post['image'], 'data:') || str_starts_with($post['image'], 'http')) 
                                            ? $post['image'] 
                                            : "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $post['image'];
                                    ?>
                                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="Post Image" style="max-height: 120px;" class="rounded border">
                                </div>
                            <?php endif; ?>
                            <label for="image" class="form-label text-muted ms-1 mb-1">Change Image (Optional)</label>
                            <input class="form-control py-3" id="image" name="image" type="file" accept="image/*" />
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="content" name="content" placeholder="Write your post content here..." style="height: 15rem" required><?= htmlspecialchars($post['content']) ?></textarea>
                            <label for="content">Post Content</label>
                        </div>
                        <br />
                        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Update Post</button>
                        <a href="index.php?page=home" class="btn btn-secondary text-uppercase ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
