<!-- Include Font Awesome CSS for star icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


 <!-- Patients area start -->
<section class="patients-area" id="patients">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-5 patient-col5">
                <div class="patients-details">
                    <h2>Thoughts From <br>Our Best Patients </h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <div class="patient-btn">
                        <a href="#" class="btn1">view more</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 patient-col7 owl-carousel patient-carousel">
                @foreach ($feedback as $key => $feedbacks)
                <div class="single-patient-item">
                    <div class="patient-img">
                        <img src="images/patient">
                    </div>
                    <div class="patient-details">
                        <h4>{{ $feedbacks->user->fname }} {{ $feedbacks->user->lname }}</h4>
                        <p>Comments: {{ $feedbacks->comments }}</p>
                        <p>Rating: 
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedbacks->star_rating)
                                    <i class="fas fa-star" style="color: #87c150;"></i> <!-- Light green color -->
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Patients area End -->


<!--effec coursel-->

    <!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>ss
    $(document).ready(function(){
        $(".patient-carousel").owlCarousel({
            items: 3,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 5000, // Change as needed
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: true
                },
                600:{
                    items: 2,
                    nav: true
                },
                1000:{
                    items: 3,
                    nav: true
                }
            }
        });
    });
</script>

