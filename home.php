<?php
include 'partials/header.php';

?>
<section class="SlideContainer">

    <div class="slideshow-container">

        <div class="mySlides fade">

            <img src="images/slcar1.jpg" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">

            <img src="images/slcar2.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">

            <img src="images/slcar3.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>


        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</section>



<?php
include 'partials/footer.php';

?>