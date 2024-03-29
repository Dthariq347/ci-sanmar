<section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Let's Ask!</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime earum fugiat corrupti molestiae cum mollitia</p>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="mb-3">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form action="/home/sendmail#contactForm" method="post" id="contactForm" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" name="name" value="<?= old('name'); ?>" type="text" placeholder="Enter your name..." autocomplete="off" required />
                        <label for="name">Full name</label>
                        <span class="text-danger">
                            <?= $validation->getError('name'); ?>
                        </span>
                        <!-- <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div> -->
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" value="<?= old('email'); ?>" type="email" placeholder="name@example.com" autocomplete="off" required />
                        <label for="email">Email address</label>
                        <div class="text-danger">
                            <?= $validation->getError('email'); ?>
                        </div>
                        <!-- <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div> -->
                    </div>
                    <!-- Phone number input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" name="phone" type="tel" value="<?= old('phone'); ?>" placeholder="(123) 456-7890" autocomplete="off" required />
                        <label for="phone">Phone number</label>
                        <div class="text-danger">
                            <?= $validation->getError('phone'); ?>
                        </div>
                        <!-- <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div> -->
                    </div>
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" name="message" type="text" placeholder="Enter your message here..." style="height: 10rem" autocomplete="off" required></textarea>
                        <label for="message">Message</label>
                        <div class="text-danger">
                            <?= $validation->getError('message'); ?>
                        </div>
                        <!-- <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div> -->
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <!-- <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div> -->
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <!-- <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">Error sending message!</div>
                    </div> -->
                    <!-- Google captcha -->
                    <div class="captcha_wrapper">
                        <!-- Data site-key bisa diisi untuk google recaptcha-->
                        <div class="g-recaptcha" data-sitekey=""></div>
                    </div>
                    <div class="text-danger">
                        <?= $validation->getError('g-recaptcha'); ?>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-success btn-xl mt-3" id="submitButton" type="submit">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
