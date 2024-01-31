

<!-- Patients area start -->
<section class="patients-area" id="patients">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 patient-col-12">
                <div class="patients-details">
                    <h2>Thoughts From <br>Our Best Patients </h2>
                    @if (isset($feedback['feedback']))
                      
                        @foreach ($feedback['feedback'] as $feedbacks)
                            <p>{{ $feedbacks->comments }}</p>
                            <p>Rating: {{ $feedbacks->star_rating }}/5</p>
                        @endforeach
                    @else
                        <p>No feedback available</p>
                    @endif
                    <div class="patient-btn">
                        <a href="#" class="btn1">view more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Patients area End -->
