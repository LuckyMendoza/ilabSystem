@extends('layouts.master')
@section('title', "Services")
@section('services', "active")
@section('specific-css')
@endsection

@section('main_content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0 semi-bold">Patients</h4>
            <!-- hidden logged role -->

            <div class="">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_add">
                    <i class="menu-icon tf-icons bx bx-plus"></i>
                    Add Patient
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Table -->
        <table class="table" id="table_list">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>First Last</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email Address</th>
                    <th>Birthdate</th>
                    <th>Date Created</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $index => $patient)
                <tr>
                    <td class="text-center"> {{ $patient->fname }} </td>
                    <td class="text-center"> {{ $patient->lname }} </td>
                    <td class="text-center"> {{ $patient->gender }} </td>
                    <td class="text-center"> {{ $patient->address }} </td>
                    <td class="text-center"> {{ $patient->contact }} </td>
                    <td class="text-center"> {{ $patient->email }} </td>
                    <td class="text-center"> {{ date("M d, Y", strtotime($patient->birthdate)) }} </td>
                    <td class="text-center"> {{ date("M d, Y", strtotime($patient->created_at)) }} </td>
                    <td class="text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $index }}"
                            class="edit btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></button>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $index }}"
                            class="edit btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add_appointment{{ $index }}"
                            <button type="button" data-bs-toggle="modal" data-bs-target="#add_appointment{{ $index }}"
                            class="edit btn btn-sm btn-primary"><i class="fa fa-calendar"></i></button>
                    </td>

                    {{-- update patient --}}
                    <div class="modal modal-top fade" data-bs-backdrop="static" id="modal_edit{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title bold text-primary" id="modalTopTitle">Update {{
                                        $patient->lname }} Patient Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('patient.update', $patient->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label for="email" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname"
                                                value="{{ $patient->fname }}" autofocus autocomplete="off"
                                                placeholder="Enter First name" required />
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname"
                                                value="{{ $patient->lname }}" autofocus autocomplete="off"
                                                placeholder="Enter Last name" required />
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $patient->address }}" autofocus autocomplete="off"
                                                placeholder="Enter Address" required />
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email" class="form-label">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact"
                                                value="{{ $patient->contact }}" autofocus autocomplete="off"
                                                placeholder="Enter Contact" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                                value="{{ $patient->birthdate }}" autofocus autocomplete="off"
                                                required />
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="{{ $patient->email }}" autofocus autocomplete="off"
                                                placeholder="Enter Email Address" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"
                                            aria-label="Close">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    {{-- Delete patient --}}
                    <div class="modal modal-top fade" data-bs-backdrop="static" id="modal_delete{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title bold text-primary" id="modalTopTitle">Deleting {{
                                        $patient->fname }} Patient Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('patient.destroy', $patient->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p class="text-center"> Do you want to delete this {{ $patient->fname }}
                                            patient?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"
                                            aria-label="Close">Close</button>
                                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- create patient --}}
<div class="modal modal-top fade" data-bs-backdrop="static" id="modal_add" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold text-primary" id="modalTopTitle">Patient Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('patient.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" autofocus autocomplete="off"
                            placeholder="Enter First name" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" autofocus autocomplete="off"
                            placeholder="Enter last name" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="gender" class="form-label">--Select gender--</label>
                        <select class="form-control" name="gender" required>
                            <option value="" selected disabled>--Select gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>

                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" autofocus autocomplete="off"
                            placeholder="Enter Address" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" autofocus autocomplete="off"
                            placeholder="Enter Contact" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" autofocus
                            autocomplete="off" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" autofocus autocomplete="off"
                            placeholder="Enter Email Address" required />
                    </div>
                    <div class="form-group mb-2 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="password" autocomplete="off"
                                placeholder="Enter Password" required />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('specific-js')
<script>
    $(document).ready( function () {
            $('#table_list').DataTable({
                responsive: true,
                columnDefs: [ { type: 'date', 'targets': [5] } ],
                order: [[ 5, 'desc' ]],
            });
        });
</script>

@if ($message = Session::get('success'))
<script type="text/javascript">
    Swal.fire({
                icon: 'success',
                title: 'System Notification!',
                text: "{{Session::get('success')}}",
            });
</script>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
    Swal.fire({
                icon: 'warning',
                title: 'System Notification!',
                text: "{{Session::get('error')}}",
            });
</script>
@endif

<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/parsley.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
@endsection