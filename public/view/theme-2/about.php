<?php

session_start();

include_once __DIR__.'/includes/header.php';
include_once __DIR__.'/../../model/Users.class.php';

include_once __DIR__.'/includes/navbar.php';

$userdata = new Users();
$result = $userdata->ReadSingleUser('u_id', 1);
$row = $result->fetch_assoc();
?>

<div class="about-container container mb-3">
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
                    <?php }  if(!empty($row['u_mobile'])){ ?>
                    <a href="tel:<?= $row['u_mobile']; ?>" class="index-social-link">
                        <i class="fas fa-phone-square"></i>
                    </a>
                    <?php } ?>
                </div>
                <!-- Description -->
                <div class="about-content-detail">
                    <?= $row['u_about']; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__.'/includes/footer.php'; ?>

<?php session_unset(); ?>
