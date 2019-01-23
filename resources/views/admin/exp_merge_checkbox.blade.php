@extends('admin.master')

@section('style')
    .corner {
        border-radius: 5px;
        padding: 35px;
        box-shadow: 0px 0px 10px;
        text-align: center;
    }
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 corner">
                @php
                    $contests = DB::table('problems')->select('contest_id','contest_title')->distinct()->orderby('contest_id','desc')->get();
                @endphp
                <form method="post" action="">
                    @csrf
                    @foreach($contests as $contest)
                        <div class="form-group row">
                            <input class="form-check-input" style="margin-right: 20px" type="checkbox" name="{{ $contest->contest_id }}" value="{{ $contest->contest_id }}">
                            <label class="form-check-label">
                                {{ $contest->contest_title }}
                            </label>
                        </div>
                    @endforeach
                    <div class="form-group row">
                        <button type="submit" class="btn btn-success">Merge Contest</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
