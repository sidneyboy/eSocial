@extends('layouts.admin')

@section('main-content')
    <div class="row">

        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Payment History</h6>
                </div>
                <div class="card-body">
                    <form id="generate_payment_history">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="date_from" placeholder="Date From"
                                        value="2012-04-05">
                                    <input type="text" class="form-control" name="date_to" placeholder="Date To"
                                        value="2012-04-19">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="show_payment_history"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Enrolled Students</h6>
                </div>
                <div class="card-body">
                    <form id="generate_statistics">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="date_from" placeholder="Date From"
                                        value="2012-04-05">
                                    <input type="text" class="form-control" name="date_to" placeholder="Date To"
                                        value="2012-04-19">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="show_subscribers"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Course Rating</h6>
                </div>
                <div class="card-body">
                    <form id="generate_course_rating">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="date_from" placeholder="Date From"
                                        value="2012-04-05">
                                    <input type="text" class="form-control" name="date_to" placeholder="Date To"
                                        value="2012-04-19">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="show_course_rating"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 10px;">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Approved Instructor</h6>
                </div>
                <div class="card-body">
                    <form id="generate_approved_instructor">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="date_from" placeholder="Date From"
                                        value="2012-04-05">
                                    <input type="text" class="form-control" name="date_to" placeholder="Date To"
                                        value="2012-04-19">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="show_approved_instructor"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 10px;">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Approved students</h6>
                </div>
                <div class="card-body">
                    <form id="generate_approved_students">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="date_from" placeholder="Date From"
                                        value="2012-04-05">
                                    <input type="text" class="form-control" name="date_to" placeholder="Date To"
                                        value="2012-04-19">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="show_approved_students"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#generate_payment_history").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "generate_payment_history",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#show_payment_history').html(data);
                },
            });
        }));

        $("#generate_statistics").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "generate_statistics",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();

                    $('#show_subscribers').html(data);
                },
            });
        }));


        $("#generate_course_rating").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "generate_course_rating",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();

                    $('#show_course_rating').html(data);
                },
            });
        }));

        $("#generate_approved_instructor").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "generate_approved_instructor",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#show_approved_instructor').html(data);
                },
            });
        }));

        $("#generate_approved_students").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "generate_approved_students",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#show_approved_students').html(data);
                },
            });
        }));
    </script>
@endsection
