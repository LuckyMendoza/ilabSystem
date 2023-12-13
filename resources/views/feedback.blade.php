@extends('layouts.master')
@section('title', "LeaveNotes")

@section('feedback', "active")
@section('specific-css')

@endsection
@section('main_content')

<!-- Sa resources/views/feedback.blade.php -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Feedback Form</div>

                <div class="card-body">
                    <!-- Display validation errors here, if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('createFeedback') }}" method="post">
                        @csrf <!-- Blade directive para sa CSRF protection -->

                        <!-- Input field for comments -->
                        <div class="form-group">
                            <label for="comments">Comments:</label>
                            <textarea name="comments" id="comments" class="form-control" required>{{ old('comments') }}</textarea>
                        </div>

                        <!-- Input field for star rating -->
                        <div class="form-group">
                            <label for="star_rating">Star Rating:</label>
                            <!-- Dito mo ilagay ang iyong HTML para sa star rating -->
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function setRating(event) {
        const star = event.target;
        const rating = star.dataset.rating;

        // Set hidden field value
        $('#star_rating').val(rating);

        // Update star colors
        $('.fa-star').removeClass('checked');
        $(star).prevAll('.fa-star').addBack().addClass('checked');
    }
</script>



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