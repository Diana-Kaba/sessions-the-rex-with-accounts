<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title lang="en">The Rex Cinema</title>
    <link rel="shortcut icon" href="./assets/images/icon-rex.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Diana's CSS File -->
    <link rel="stylesheet" href="style.css">

    <!--
    TemplateMo 589 lugx gaming
    https://templatemo.com/tm-589-lugx-gaming
    -->
</head>

<?php
include "db-actions.php";
echo '<body>';
// include "header.html";

$user_form = '<div class="contact-page section">
<div class="container">
  <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="left-text">
          <div class="section-heading">
            <h6 lang="en">Registration</h6>
            <h2 lang="en">Account</h2>
          </div>
          <p>Приєднайтесь до нашої спільноти, щоб отримати ексклюзивний доступ до контенту, спеціальних пропозицій та свіжих новин. Реєстрація відкриє перед вами світ захоплюючих можливостей, де ви зможете брати участь в унікальних заходах та акціях.</p>
        </div>
      </div>
    <div class="col-lg-6">
      <div class="right-content">
        <div class="row">
          <div class="col-lg-12">
            <form id="contact-form" action="' . $_SERVER['PHP_SELF'] . '" method="post" name="autoForm">
              <div class="row">
                <div class="col-lg-6">
                  <fieldset>
                    <input type="text" name="login" id="login" placeholder="Your login..." autocomplete="on" required>
                  </fieldset>
                </div>
                <div class="col-lg-6">
                  <fieldset>
                    <input type="password" name="pass" id="pass" placeholder="Your password..." autocomplete="on" required>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="orange-button" name="go">OK</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>';

if (!isset($_SESSION['authorized'])) {
    echo $user_form;
} else {
    echo '<div class="contact-page section">
    <div class="container">
      <div class="row">
          <div class="col-lg-6 align-self-center">
            <div class="left-text">
              <div class="section-heading">
                <h6 lang="en">Registration</h6>
                <h2 lang="en">OK</h2>
              </div>';
    echo "<p>Ви зареєстровані як " . $_SESSION['login'] . "...</p>";
    echo '<p>Раді бачити вас в нашому співтоваристві! Тепер у вас є доступ до ексклюзивного контенту, спеціальних пропозицій та свіжих новин. Приєднуйтесь до наших заходів та акцій, щоб долучитися до нашої захоплюючої спільноти і отримати більше унікальних можливостей.</p>
              <a href="index.php">На головну</a>
            </div>
          </div>
      </div>
    </div>
  </div>';
}

if (isset($_POST["go"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];

    if (add_user($login, $password)) {
        echo '<div class="contact-page section">
        <div class="container">
          <div class="row">
              <div class="col-lg-6 align-self-center">
                <div class="left-text">
                  <div class="section-heading">
                    <h6 lang="en">Registration</h6>
                    <h2 lang="en">OK</h2>
                  </div>';
        echo "<p>Ви успішно зареєстровані як $login...</p>";
        echo '<p>Раді бачити вас в нашому співтоваристві! Тепер у вас є доступ до ексклюзивного контенту, спеціальних пропозицій та свіжих новин. Приєднуйтесь до наших заходів та акцій, щоб долучитися до нашої захоплюючої спільноти і отримати більше унікальних можливостей.</p>
                  <a href="index.php">На головну</a>
                </div>
              </div>
          </div>
        </div>
      </div>';
    } else {
        echo '<div class="contact-page section">
        <div class="container">
          <div class="row">
              <div class="col-lg-6 align-self-center">
                <div class="left-text">
                  <div class="section-heading">
                    <h6 lang="en">Registration</h6>
                    <h2 lang="en">Error</h2>
                  </div>
                  <p>Ви <u>вже</u> зареєстровані!</p>
                </div>
              </div>
          </div>
        </div>
      </div>';
    }
}

include "footer.html";
?>