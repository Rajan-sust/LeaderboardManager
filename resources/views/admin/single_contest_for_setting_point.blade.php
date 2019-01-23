@extends('admin.master')

@section('style')
    .corner {
        border-radius: 5px;
        padding: 35px;
        box-shadow: 0px 0px 10px;
    }
@endsection

@section('content')

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: bold"><i>Notification</i></h4>
                </div>
                <div class="modal-body" style="font-style: italic;font-weight: bold;">
                    Points have been set successfully.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <script>
            $('#myModal').modal('show');
        </script>
    @endif




    @php
        $problems = DB::table('problems')->select('problem_num','problem_name')->where('contest_id',$id)->distinct()->orderBy('problem_num')->get();
        $title = DB::table('problems')->select('contest_title')->where('contest_id',$id)->distinct()->first();
    @endphp


    <h3 style="text-align: center">{{$title->contest_title}}</h3>

    <br><br>
    <div class="container">
        <div class="col-md-4"></div>
        <div class="col-md-4 corner">
            <form method="post" action="/home/set/point/submit">
                @csrf
                @foreach($problems as $problem)
                    <div class="form-group">
                        <label>{{$problem->problem_name}}</label>
                        <select class="form-control" name="weight[]" required autofocus>
                            @for ($i = 1; $i <= 10; $i += 1)
                                <option>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                @endforeach
                <input type="hidden" name="id" value="{{$id}}">
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection
