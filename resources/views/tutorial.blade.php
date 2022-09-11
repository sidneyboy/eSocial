@extends('layouts.admin')

@section('main-content')
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <h6>Add Tutorials</h6>
                </div>
                <form action="{{ route('tutorial_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <label>Tutorial Image</label>
                            <input type="file" class="form-control" required name="tutorial_image">
                            <label>Tutorial Note</label>
                            <textarea name="tutorial_note" id="tutorial_note" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <h6>Tutorial List</h6>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Tutorial Image</th>
                                    <th>Tutorial Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutorial as $data)
                                    <tr>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-block btn-sm"
                                                data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
                                                Show Image
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tutorial Image
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('/storage/' . $data->tutorial_image) }}"
                                                                class="img img-thumbnail" alt="">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-sm btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{ $data->tutorial_note }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
   
@endsection
