<?php include('include/header.php'); ?>
<?php include 'esewa/dbconfig.php'; ?>

<style>

.card img {
    width: 100%;
    height: auto; /* Keep aspect ratio */
    max-height: 500px; /* Set a maximum height */
    object-fit: contain; /* Fit the image within the container */
}

.image-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* Aspect Ratio 16:9 */
}

.image-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cover the entire container */
}



</style>

<!-- Home Section -->
<div class="d-flex shadow mt-2 ">
    <div class="container-fluid my-auto ">
        <div class="row">
            <div class="col-lg-6 my-auto ps-4 ">
                <h1 class="display-1 fw-bold">Vyayamlaya</h1>
                <p class="display-6 fw-normal">Shape Yourself!</p>
                <p class="fw-light">Unleash your potential and embark on a journey towards a stronger, fitter,
                    <br> and more confident you. Sign up for 'Make Your Body Shape' now and witness
                    <br> the incredible transformation your body is capable of!
                </p>
                <a href="" class="btn btn-primary" id="btn1">Join us</a>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-11">
                    <div class="card-body">
                        <img src="img/fphoto.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About us section -->
<section class="py-5" id="About">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-5 ">
                <h2 class="fw-bold mb-3">About Vyayamlaya</h2>
                <div class="pr-4">
                    <p>Welcome to Vyayamlaya Gym Center, a haven for fitness enthusiasts nestled in the heart of
                        Maitidevi, Kathmandu.
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
                <a href="about-us.php" class="btn btn-primary" style="background:#428f9d; border:none;">Know More</a>
            </div>
            <div class="col-lg-6 custom-push-left" style="background: url(./img/abtimg.png); background-size: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Classes Section -->
<section id="Classes" class="py-5 text-white" style="background:#4eaebf;">
    <div class="text-center">
        <h2 class="text-decoration-underline">Our Classes</h2>
        <p class="mb-5 text-white">Discover a diverse range of exhilarating classes at our gym designed to cater to all
            fitness levels and interests.
            <br>Whether you're a seasoned athlete or just starting your fitness journey, our classes offer something for
            everyone.
        </p>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php
            $sql = "SELECT * FROM tblclasses";
            $result = mysqli_query($conn, $sql);
            while ($class = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3">
                    <div class="card">
                        <div class=>
                        <img src="./admin/uploads/<?php echo htmlentities($class['image']); ?>" alt="" class="img-thumbnail">
                        </div>
                        <div class="card-body">
                            <b><?php echo $class['title']; ?></b>
                            <p class="card-text fw-bold">
                                <p class="fw-lighter"><?php echo $class['description']; ?></p>
                            </p>
                            <a href="registration.php" class="btn btn-primary" style="background:#428f9d; color:white; border-bottom:none;">Join Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section id="Team" class="py-5 " style="background:white;">
    <div class="text-center">
        <h2 class="text-decoration-underline">Our Team</h2>
        <p class="mb-5 ">Our team at Vyayamlaya is the backbone of the entire establishment,
            embodying the values of dedication, expertise, and <br>passion for health and fitness.
            Comprised of experienced trainers, knowledgeable staff, and dedicated professionals, <br>
            Our team is committed to providing exceptional service and support to every member who walks
            through the doors.</p>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php 
            $sql = "SELECT * FROM trainers";
            $result = mysqli_query($conn, $sql);            
            while ($team_member = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3">
                    <div class="card">
                        <div >
                            <img src="./admin/uploads/<?php echo htmlentities($team_member['image']); ?>" alt="<?php echo htmlentities($team_member['name']); ?>" class="img-thumbnail">
                        </div>
                        <div class="card-body">
                            <b><?php echo htmlentities($team_member['name']); ?></b>
                            <p class="card-text fw-bold">
                                <p class="fw-lighter"><?php echo htmlentities($team_member['specialization']); ?></p>
                            </p>
                            <a href="registration.php" class="btn btn-primary" style="background:#428f9d; color:white; border-bottom:none;">Join Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Testimonials -->
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
                    <i class=" fa fa-quote-left fa-3x position-absolute"
                        style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                </div>
                <div class="mt-n2 text-center">
                    <img src="img/roman.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                    <h4 class="mb-0 fw-bold">Roman Raut</h4>
                    <p class="fw-light"> <i>Marketing Manager</i></p>
                </div>
            </div>
            <div class="col-6">
                <div class="shadow rounded position-relative">
                    <div class="p-4 text-center">
                    "The trainers' expertise and the gym's unwavering commitment to cleanliness and safety during these challenging times have made it a safe haven for me to maintain my health and de-stress effectively."
                    </div>
                    <i class="fa fa-quote-left fa-3x position-absolute"
                        style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                </div>
                <div class="mt-n2 text-center">
                    <img src="img/pra.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
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
                    <i class="fa fa-quote-left fa-3x position-absolute"
                        style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                </div>
                <div class="mt-n2 text-center">
                    <img src="img/rosh.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                    <h4 class="mb-0 fw-bold">Roshan Balati</h4>
                    <p class="fw-light"> <i>Teacher</i></p>
                </div>
            </div>
            <div class="col-6">
                <div class="shadow rounded position-relative">
                    <div class="p-4 text-center">
                    "This gym's 24/7 access has been a lifesaver. Whether it's a late-night workout or an early morning session, the unparalleled convenience and flexibility here make it possible to fit exercise into any schedule."
                    </div>
                    <i class="fa fa-quote-left fa-3x position-absolute"
                        style="top: 0.5rem; left: 0.5rem; opacity:0.2;"></i>
                </div>
                <div class="mt-n2 text-center">
                    <img src="img/ashfaq.jpg" alt="" class="rounded-circle border" width="100px" height="100px">
                    <h4 class="mb-0 fw-bold">Ashfaq Raza</h4>
                    <p class="fw-light"> <i>Entrepreneur</i></p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<section id="contact" class="page contact">
    <div class="container-fluid py-4">
        <div class="row py-5 px-5 box">
            <div class="col-md-3 box1">
                <h5>VYAYAMLAYA</h5>
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
                <div class="find-border">
                    <h5 class="pb-4">FIND US</h5>
                </div>
                <div class="find-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.797669039277!2d85.31501907453516!3d27.69264772614142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b26c5a3df7%3A0xd49ea11f56ff8ac5!2z4KSP4KSt4KSw4KWH4KS34KWN4KSfIOCkleCksuClh-CknA!5e0!3m2!1sne!2snp!4v1719115677090!5m2!1sne!2snp"
                        width="380" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
