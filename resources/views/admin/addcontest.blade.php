@extends('admin.master')

@section('style')
    .corner {
        border-radius: 5px;
        padding: 35px;
        box-shadow: 0px 0px 10px;
        margin: 0 auto;
        margin-top: 12%;
    }
    ::-webkit-input-placeholder {
        font-style: italic;
    }

@endsection

@section('content')

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i>notification</i></h4>
                </div>
                <div class="modal-body" style="font-style: italic;font-weight: bold;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        @if(session()->get('message') == "contest fetched")
            <script>
                var mymodal = $('#myModal');
                mymodal.find('.modal-body').text('Contest information has been fetched successfully.');

                mymodal.modal('show');
            </script>


        @elseif(session()->get('message') == "url exists")
            <script>
                var mymodal = $('#myModal');
                mymodal.find('.modal-body').text('This contest information already exists.');
                mymodal.modal('show');

            </script>

        @else
            <script>
                var mymodal = $('#myModal');
                mymodal.find('.modal-body').text('Wrong URL or Admin did not set the password of this contest in server PC.');
                mymodal.modal('show');

            </script>

        @endif
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 corner">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form method="post" action="{{action('AddContestController@systemCall')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="url" class="form-control" name="url" placeholder="Enter vjudge URL like (https://vjudge.net/contest/267792)"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection
