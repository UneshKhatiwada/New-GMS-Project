
<?php include('header.php') ?>
<!--Main Navigation-->
<header>
    <nav class="navbar navbar-expand-lg navbar-light default-color">
        <a class="navbar-brand ps-4 " href="#"><img src="assets/logo.png" alt="" style="height: 50px; "></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ps-5 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto nav-flex-icons">

            <li class="nav-item dropdown">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user mr-2"></i>Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="/gms-project/admin/dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                <?php } else { ?>
                    <a href="login.php"class="btn btn-primary me-3" style="background:#428f9d;">
                    <div class="shadow-sm mb-0 bg-white rounded">
                        <i class="fa fa-user me-1"></i>User login</a>
                    
                    </div>
                <?php } ?>
            </li>
        </ul>

        </div>
        </div>
    </nav>
</header>

<!-- Hero Section -->
<div class="d-flex  shadow mt-2 ">
    <div class="container-fluid my-auto ">
        <div class="row">
            <div class="col-lg-6  my-auto ps-4 ">
                <h1 class="display-1 fw-bold">Vyayamlaya</h1>
                <p class=" display-6 fw-normal ">Shape Yourself!</p>
                <p class="fw-light"> Unleash your potential and embark on a journey towards a stronger,fitter,
                    <br> and more confident you. Sign up for 'Make Your Body Shape'now and witness
                    <br> the incredible transformation your body is capable of!
                </p>
                <a href="" class="btn btn-lg btn-primary" style="background:#428f9d;">Join us</a>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-11" >
                    <div class="card-body">
                        <img src="assets/fphoto.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About us section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-5 ">
                <h2 class="fw-bold mb-3 ">About Vyayamlaya</h2>
                <div class="pr-4">
                    <p>Welcome to Vyayamlaya Gym Center, a haven for fitness enthusiasts nestled in the heart of Maitidevi, Kathmandu. 
                       At Vyayamlaya, we pride ourselves on offering more than just a place to work out; 
                       we provide a holistic approach to wellness that encompasses physical fitness, mental well-being, 
                       and spiritual rejuvenation.</p>
                    <p>The architecture of Vyayamlaya blends modern aesthetics with traditional Nepali motifs,
                         creating a unique ambiance that reflects the rich cultural heritage of the region.
                         The entrance is adorned with intricate wood carvings and vibrant prayer flags, 
                         invoking a sense of tranquility and spirituality.
                    </p>
                    <p>
                    Upon entering, you're greeted by the welcoming staff, 
                    who are not just fitness enthusiasts but also knowledgeable guides on the journey to a healthier 
                    lifestyle. The reception area exudes warmth with its earthy tones and comfortable seating, 
                    providing a space for members to unwind before and after their workouts.
                    </p>
                </div>
                <a href="about-us.php" class="btn btn-primary " style="background:#428f9d; ">Know More</a>
            </div>
            <div class="col-lg-6 custom-push-left" style="background: url(assets/abtimg.png); background-size: cover;">

            </div>
        </div>
    </div>
</section>

<!-- Classess Section-->
<section class="py-5 text-white " style="background:#4eaebf;">
    <div class="text-center">
        <h2 class="text-decoration-underline ">Our Classes</h2>
        <p class="mb-5 text-white">Discover a diverse range of exhilarating classes at our gym designed to cater to all fitness levels and interests.
            <br>Whether you're a seasoned athlete or just starting your fitness journey, our classes offer something for everyone.
        </p>
    </div>
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div>
                        <img src="assets/cycl.jpeg" alt="" class="img-fluid rounded-top">
                    </div>
                    <div class="card-body">
                        <b>Cardio & Dance Rhythms</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter"> Focus on improving cardiovascular fitness through
                            dance-based workouts 
                            (e.g., Zumba, dance aerobics).</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div>
                        <img src="assets/cyoga.jpg" alt="" class="img-fluid rounded-top">
                    </div>
                    <div class="card-body">
                        <b>Yoga and Meditation</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter">Focus on improving flexibility
                             and mental well-being through a series of poses and breathing exercises.</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div>
                        <img src="assets/strech.jpg" alt="" class="img-fluid rounded-top">
                    </div>
                    <div class="card-body">
                        <b>Recovery and Stretching </b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter"> Exercises to target specific muscle groups and improve 
                            strength and endurance and help to recover body.</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div>
                        <img src="assets/strength.jpg" alt="" class="img-fluid rounded-top">
                    </div>
                    <div class="card-body">
                        <b>Strength Training</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter">Aim to build muscular strength and bodyweight exercises, and functional movements.</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Team Section-->
<section class="py-5">
    <div class="text-center">
        <h2 class="text-decoration-underline text-dark fw-bold ">Our Team</h2>
        <p class="mb-5 text-dark fw-lighter">Our team at Vyayamlaya is the backbone of the entire establishment, 
            embodying the values of dedication,expertise, and <br>passion for health and fitness.
            Comprised of experienced trainers, knowledgeable staff, and dedicated professionals, <br>
            Our team is committed to providing exceptional service and support to every member who walks 
            through the doors.</p>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div style="height: 261px;">
                    <img src="assets/pasa.png" alt="" class="img-fluid h-100">
                    </div>
                    <div class="card-body">
                        <b>Ajay Shrestha</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter"> Fitness Trainer </p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div style="height: 261px;">
                        <img src="assets/nabin.png" alt="" class="img-fluid h-100">
                    </div>
                    <div class="card-body">
                        <b>Nabin Pulami</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter">Personal Trainer</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div style="height: 261px;">
                        <img src="assets/bijuli.jpg" alt="" class="img-fluid h-100">
                    </div>
                    <div class="card-body">
                        <b>Bishal Bishwokarma</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter">Group Fitness Instructor</p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div style="height: 261px;">
                    <img src="assets/nikhil.jpg" alt="" class="img-fluid h-100">
                    </div>
                    <div class="card-body">
                        <b>Nikhil Thapa</b>
                        <p class="card-text fw-bold ">
                        <p class="fw-lighter"> Nutritionists and Dietitians </p>
                        </p>
                        <button class="btn btn-primary btn-sm" style="background:#428f9d;">Join Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Testimonials-->
<section class="py-5 text-white " style="background:#4eaebf">
    <div class="text-center mb-5">
        <h2 class="fw-bold">What People Says</h2>
        <p>These testimonials serve as a testament to our commitment to helpingindividuals achieve their fitness
            <br>goals, and fostering a supportive environment for everyone who walks through our doors
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="shadow rounded position-relative">
                    <div class="p-4 text-center">
                    The trainers here customized a plan that balanced
                    my work-life demands, and I've seen remarkable 
                     progress in my fitness journey.It's not just a gym;
                    it's my sanctuary for self-care.
                    </div>
                    <i class=" fa fa-quote-left fa-3x position-absolute" style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                    </div>
                    <div class="mt-n2 text-center">
                        <img src="assets/roman.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                        <h4 class="mb-0 fw-bold">Roman Raut</h4>
                        <p class="fw-light"> <i>Marketing Manager</i></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="shadow rounded position-relative">
                        <div class="p-4 text-center">
                            The trainers' expertise and the gym's commitment to cleanliness
                            during these times have made it a safe haven for me to maintain
                            my health and de-stress..............
                        </div>
                        <i class="fa fa-quote-left fa-3x position-absolute" style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                    </div>
                    <div class="mt-n2 text-center">
                        <img src="assets/pra.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                        <h4 class="mb-0 fw-bold">Pratikshya Basyal</h4>
                        <p class="fw-light"> <i>Registered Nurse</i></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="shadow rounded position-relative">
                        <div class="p-4 text-center">
                            The variety of classes and the supportive community have kept me
                            motivated. I've shed pounds, gained confidence, and found a new
                            level of energy to inspire my students.
                        </div>
                        <i class="fa fa-quote-left fa-3x position-absolute" style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                    </div>
                    <div class="mt-n2 text-center">
                        <img src="assets/rosh.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                        <h4 class="mb-0 fw-bold">Roshan Balati</h4>
                        <p class="fw-light"> <i>Teacher</i></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="shadow rounded position-relative">
                        <div class="p-4 text-center">
                            This gym's 24/7 access has been a lifesaver. Whether it's a
                            late-night workout or an early morning session, the convenience
                            here is unbeatable...........................................
                        </div>
                        <i class="fa fa-quote-left fa-3x position-absolute" style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                    </div>
                    <div class="mt-n2 text-center">
                        <img src="assets/ashfaq.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                        <h4 class="mb-0 fw-bold">Ashfaq Raza</h4>
                        <p class="fw-light"> <i>Entrepreneur</i></p>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Footer-->
<section id="contact" class="page contact">
    <div class="container py-4">
        <div class="row py-5 px-5 box">
            <div class="col-md-3 box1">
                <h5>Vyayamlaya</h5>
                <p class="py-4">
                    IT STARTS FROM YOU! MAKE A FIRST MOVE AND PROMISE YOURSELF:<br />"THAT'S IT, WATCH ME!"
                </p>
                <a href="" target="_blank" class="icon" title="Google"><i class="bi bi-google"></i></a>
                <a href="" target="_blank" class="icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="" target="_blank" class="icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="" target="_blank" class="icon" title="Whatsapp"><i class="bi bi-whatsapp"></i></a>
            </div>

            <div class="col-md-3 box1">
                <h5 class="pb-4">OPENING HOURS</h5>
                <p>Sunday to Friday :</p>
                <p class="pb-2"><span>06:00 am - 11:00 pm</span></p>
                <p>Sunday :</p>
                <p><span>12:00 pm - 06:00 pm</span></p>
                <p class="py-3"><span>Closed on Holidays</span></p>
            </div>

            <div class="col-md-3 box1">
                <h5 class="pb-4">HOME LOCATION</h5>
                <p>Thapathali-10, Kathmandu, Nepal</p>
                <p class="link pt-3">+977-9818268002</p>
                <p class="link">info@vyayamlaya.com</p>
            </div>

            <div class="col-md-3 box1">
                <h5 class="pb-4">Newsletter</h5>
                <p class="pb-2"><b>Subscribe For Latest Updates</b></p>
                <span><input name="eid" id="eid" type="email" name="email" size="30" placeholder="example@xyz.com"></span>
                <button class="btn mt-4 btn-primary" style="background:#4eaebf;" onclick="btnSubscribe()">Subscribe</button>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6 px-5 py-2">
                <h3>Please Fill The Form To Contact</h3>
                <form action="#" method="post" onsubmit="btnSave()">
                    <div class="mb-3 pt-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control"  placeholder="Your Email" required />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name" required />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div><br />

                    <button type="submit" class="btn btn-lg btn-primary" style="background:#4eaebf;" >Register Now</button>
                </form>
            </div>
        </div>
        <div class="text-center shadow text-white" style="background:#428f9d;" >
            <footer class="main-footer">
                <strong>Copyright &copy;2024<a  class="text-white";>Vyayamlaya</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b>1.0
                </div>
            </footer>
        </div>
    </div>
</section>

<?php include('footer.php') ?>