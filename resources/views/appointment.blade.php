@extends('layouts.master')
@section('title', "Services")
@section('services', "active")
@section('specific-css')
@endsection

@section('main_content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0 semi-bold">Appointments</h4>
            <!-- hidden logged role -->
            @if(Auth::user()->user_type != 'doctor')
            <div class="">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_add" id="new">
                    <i class="menu-icon tf-icons bx bx-plus"></i>
                    Book Appointment
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <!-- Table -->
        <table class="table" id="services_table">
            <thead>
                <tr>
                    <th>Patient</th>
					<th>Service</th>
                    <th>Price</th>
                    <th>Scheduled Date</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<!-- Create Modal -->
<div class="modal modal-top fade" data-bs-backdrop="static" id="modal_add" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold text-primary" id="modalTopTitle">Appointment Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="mb-3" data-parsley-validate>
              @csrf
              <div class="modal-body">
              <input type="hidden" id="data_id" name="data_id" value="0"/>
              <input type="hidden" id="user_type" name="user_type" value="{{Auth::user()->user_type}}"/>
              <div class="form-group mb-2">
                <label for="email" class="form-label">Service</label>
                <select class="form-select" id="service" name="service" required>
										<option selected disabled>Select Services</option>
                    @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->service_name}} - {{$service->price}}</option>
                    @endforeach
									</select>
              </div>
              <div class="form-group mb-2">
                <label for="email" class="form-label">Doctor</label>
                <select class="form-select" id="doctor" name="doctor" required>
                  <option selected disabled>Select Doctor</option>
                  @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->fname}} {{$doctor->lname}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-12 row">
                <div class="col-6 mb-2">
                    <label for="time_from" class="form-label">Time From</label>
                    <input type="time" class="form-control" id="time_from" name="time_from" autofocus autocomplete="off" required>
                </div>
                <div class="col-6 mb-2">
                    <label for="time_to" class="form-label">Time To</label>
                    <input type="time" class="form-control" id="time_to" name="time_to" autofocus autocomplete="off" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Schedule Date</label>
                <input type="date" class="form-control" id="schedule_date" name="schedule_date" autofocus autocomplete="off" required />
              </div>

            </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save_btn">Save</button>
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--approve modal-->
<div class="modal modal-top fade" data-bs-backdrop="static" id="modal_approve" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold text-primary" id="modalTopTitle">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

              @csrf
              <div class="modal-body">
              <input type="hidden" id="data_id" name="data_id" value="0"/>
              <input type="hidden" id="patient_id" name="patient_id"/>
              <div class="text-center">
                <h1><i class="fa fa-calendar"></i></h1>

                <h4>Are you sure?</h4>
                <span> Do you want to confirm </span><strong><span id="client_info"></span></strong> schedule?</span>
                <br/>
            </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="approve_btn">Approve</button>
                    <button type="button" class="btn btn-danger" id="cancel_btn">Disapprove</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
              </div>
        </div>
    </div>
</div>
</div>


<div class="modal modal-top fade" data-bs-backdrop="static" id="modal_prescription" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold text-primary" id="modalTopTitle">Medical Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @csrf
            <input type="hidden" id="patient_id" name="patient_id"/>
            <input type="hidden" id="service" name="service"/>
            <input type="hidden" id="data_id" name="appointment_id"/>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="result" class="form-label">Result/Prescription</label>
                    <textarea class="form-control" id="result" name="result"></textarea>
                </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="prescribe_btn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-top fade" data-bs-backdrop="static" id="modal_download" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold text-primary" id="modalTopTitle">Download Medical Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="GET" id="download-form">
                @csrf
                <input type="hidden" id="download_patient_id" name="patient_id"/>
                <input type="hidden" id="download_data_id" name="data_id"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="fw-bold">Are you sure?</h4>
                        </div>
                    </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="download-prescription">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
    @endsection

    @section('specific-js')
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/parsley.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('custom/js/appointment.js') }}" type="text/javascript"></script>
    @endsection
