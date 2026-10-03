        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>Register</h1>
                            <span class="subheading">Create a new account</span>
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
                        <p>Fill out the form below to create your account.</p>
                        
                        <?php showmessage(); ?>

                        <div class="my-5">
                            <form id="registerForm" method="POST" action="index.php?page=signup">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="name" type="text" placeholder="Enter your name..."  />
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control"  name="email" type="email" placeholder="Enter your email..."  />
                                    <label for="email">Email address</label>
                                </div>
                                 <div class="form-floating mb-3">
                                    <input class="form-control" name="phone" type="tel" placeholder="Enter your phone..."  />
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="password" type="password" placeholder="Enter your password..."  />
                                    <label for="password">Password</label>
                                </div>
                                <br />
                                <!-- Submit Button-->
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
