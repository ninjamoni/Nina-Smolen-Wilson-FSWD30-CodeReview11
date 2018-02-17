<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';

?>

<!-- HTML================================= -->

<!-- html/head/<body> -->
<?php include('navbar.php'); ?>

  <!-- CONTACT (form and address) -->

    <!-- FORM -->
    <div class="form row"> 

      <div class="col col-lg-8 col-md-10 col-sm-12 m-auto pt-2">
        <h1>Contact us</h1>
       
        <form class="contact-form w-80" accept-charset="utf-8" onsubmit="return false">
          <div class="input-group mt-4">
            <span class="input-group-addon"><i class="far fa-address-book"></i></span>
            <input required counterue="" id="name" class="form-control" type="text" placeholder="Enter Your Name*">
          </div>
          <div class="input-group mt-4">
            <span class="input-group-addon"><i class="far fa-envelope"></i></span>
            <input required counterue="" class="form-control" type="text" placeholder="Email*">
          </div>
          <div class="input-group mt-4">
            <span class="input-group-addon">
              <i class="fa fa-phone" aria-hidden="true"></i>
            </span>
            <input class="form-control" type="text" placeholder="Phone Number">
          </div>
          <small class="form-text text-muted text-end">Your email will not be shared with anyone*</small>
          <div class="form-group mt-4">
            
          </div>
          <div class="form-group mt-4">
            <label for="message">Message*</label>
            <textarea required counterue="" id="message" rows="3" class="form-control"></textarea>
          </div>

          <!-- SELECT LIST -->
          <fieldset class="form-group">
            <legend>How can we help you?</legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="Comments">Comments and Questions
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="Appointment"> Appointment
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="Aplication"> Reservation
              </label>
          </div>
          </fieldset>

          <button class="btn btn-secondary" type="submit"><i class="fa fa-paper-plane mr-1"></i> Submit</button>
        </form>
      </div>
    </div> 

    <hr>

        <!-- CONTACT -->
  <!--   <div class="row contact" id="contact">

      <div class="col col-lg-5 col-md-5 col-sm-10 m-auto">
        <p><strong>Kettenbrüchengasse 12, 1010, Wien</strong></p>
        <p>Direct Number: 0676562345</p>
        <p>Contact Center: 900 600 600</p>
        <p>Email: judendcollege@gov.at</p>
      </div>

      <div id="map" class="col col-lg-5 col-md-5 col-sm-10 m-auto"></div>
    </div> -->



  <!-- google maps API script -->

  <script src="api-script.js" type="text/javascript" charset="utf-8"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlFyccKuNfTbMX15qdgVbxoqLg__6OOCM&callback=myMap" type="text/javascript"></script>

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>