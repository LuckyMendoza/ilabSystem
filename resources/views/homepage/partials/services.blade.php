<!-- department area Start -->
<section class="department-area" id="departments">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="heading">
                    <h2>Services</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout The point of using.</p>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content clearfix" id="myTabContent">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($services as $key => $service)
                        <li class="col-lg-2 nav-item">
                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="tab{{ $key + 1 }}" data-toggle="tab" href="#service{{ $key + 1 }}" role="tab" aria-controls="service{{ $key + 1 }}" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                                <img src="/home/images/cardiology.png" alt="">
                                <h4>{{ $service->service_name }}</h4>
                                <p> Price:{{ $service->price }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach($services as $key => $service)
                        <div class="department-area single-department-details clearfix tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="service{{ $key + 1 }}" role="tabpanel" aria-labelledby="tab{{ $key + 1 }}">
                            <div class="single-department-item">
                                <div class="col-lg-5 department-col5">
                                    <img src="/home/images/cardiology-img.png" alt="{{ $service->service_name }}">
                                </div>
                                <div class="col-lg-7 department-col7">
                                    <div class="department-details">
                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout The point of using.</p>
                                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary</p>
                                        <h3>{{ $service->service_name }}</h3>
                                        <p>{{ $service->description }}</p>
                                        <p>Price: {{ $service->price }}</p>
                                        <div class="depatrment-btn">
                                            <a href="#" class="btn1">explore More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- department area End -->
