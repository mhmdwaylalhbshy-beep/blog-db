        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>Create Post</h1>
                            <span class="subheading">Share your story with the world</span>
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
                            <form id="createPostForm" method="POST" action="index.php?page=add_post&action=store" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="title" name="title" type="text" placeholder="Enter post title..." required />
                                    <label for="title">Post Title</label>
                                </div>
   
                                <div class="mb-3">
                                    <label for="image" class="form-label text-muted ms-1 mb-1">Post Image (Optional)</label>
                                    <input class="form-control py-3" id="image" name="image" type="file" accept="image/*" />
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="content" name="content" placeholder="Write your post content here..." style="height: 15rem" required></textarea>
                                    <label for="content">Post Content</label>
                                </div>
                                <br />
                                <!-- Submit Button-->
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Create Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
