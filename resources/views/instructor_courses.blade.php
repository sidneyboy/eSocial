@extends('layouts.instructor')

@section('main-content')
    {{-- @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif --}}

    @foreach ($course as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;">
                    <div class="card-header" style="font-weight: bold;">{{ $data->course_title }}</div>
                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course_description }}</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($data->course_details as $details)
                                <li class="list-group-item">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                        data-target="#exampleModal{{ $details->id }}">
                                        {{ $details->file }}
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $details->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- <iframe src="https://docs.google.com/gview?url={{ asset('/storage/'. $details->file) }}"></iframe> --}}
                                                    <iframe src="{{ asset('/storage/'. $details->file) }}" frameborder="0"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $("#course_monitization").change(function() {
            if ($(this).val() == 'Monitize') {
                $('#course_amount').show();
            }
        });

        $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function() {
            setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
        });

        function removeLoader() {
            $("#loadingDiv").fadeOut(500, function() {
                // fadeOut complete. Remove the loading div
                $("#loadingDiv").remove(); //makes page more lightweight 
            });
        }
    </script>
@endsection
