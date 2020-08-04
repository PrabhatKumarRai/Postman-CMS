<?php

session_start();

include_once __DIR__.'/includes/header.php';
include_once __DIR__.'/../../model/Users.class.php';

include_once __DIR__.'/includes/navbar.php';

include_once __DIR__.'/alert.php';

$userdata = new Users();
$result = $userdata->ReadSingleUser('u_id', 1);
$row = $result->fetch_assoc();
?>

<div class="about-container">
    <div class="about-inner text-center">
        <div>
          <?php if(!empty($row['u_image'])){ ?>
            <div class="about-image">
                  <img src="<?= $row['u_image']; ?>"  alt="profile-image">
            </div>
            <?php } ?>
            <div class="about-content">
                <!-- Name -->
                <div class="about-content-name mt-3">
                    <span class="text-capitalize font-weight-bold"><?= $row['u_name']; ?></span>
                </div>
                <!-- Designation -->
                <div class="about-content-designation mb-2">
                    <span class="text-capitalize font-weight-bold"><?= $row['u_designation']; ?></span>
                </div>
                <!-- Social -->
                <div class="about-content-social mb-3">
                    <?php if(!empty($row['u_facebook'])){ ?>
                    <a href="<?= $row['u_facebook']; ?>" target="_blank">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <?php } if(!empty($row['u_twitter'])){ ?>
                    <a href="<?= $row['u_twitter']; ?>" target="_blank">
                        <i class="fab fa-twitter-square"></i>
                    </a>
                    <?php } if(!empty($row['u_instagram'])){ ?>
                    <a href="<?= $row['u_instagram']; ?>" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php } if(!empty($row['u_email'])){ ?>
                    <a href="mailto:<?= $row['u_email']; ?>" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <?php } if(!empty($row['u_mobile'])){ ?>
                    <a href="tel:<?= $row['u_mobile']; ?>">
                        <i class="fas fa-phone-square"></i>
                    </a>
                    <?php } ?>
                </div>
                <!-- Detail -->
                <div class="contact-enquiry">
                    <h3 class="mb-4">Post an Enquiry..</h3>
                    <form action="../../controller/enquiry.inc.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="enquiry-name" placeholder="Name.." value="<?= (isset($_GET['name']))? $_GET['name']: ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="enquiry-email" placeholder="Email.." value="<?= (isset($_GET['email']))? $_GET['email']: ''; ?>">
                        </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="enquiry-subject" placeholder="Subject.." value="<?= (isset($_GET['subject']))? $_GET['subject']: ''; ?>">
                            </div>
                        <div class="form-group">
                            <textarea name="enquiry-detail" class="form-control" cols="30" rows="10" placeholder="Description.."><?= (isset($_GET['detail']))? $_GET['detail']: ''; ?></textarea>
                        </div>
                        <button class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__.'/includes/footer.php'; ?>

<?php session_unset(); ?>
