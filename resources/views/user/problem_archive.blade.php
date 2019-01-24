@extends('user.master')

@section('style')
    #searchBox{
        background-image: url("https://www.w3schools.com/howto/searchicon.png");
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 2px solid #ddd;
        margin-bottom: 12px;
    }
@endsection

@section('content')
    <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <input type="text" id="searchBox" onkeyup="myFunction()" name="search" placeholder="Search Problem..." autofocus>
            <table class="table table-hover" id="myTable">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Online Judge</th>
                    <th>Problem Name</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $problems = App\Problem::select('oj','problem_name')->orderBy('problem_name','asc')->distinct()->get();
                    $serial = 0;
                @endphp
                @foreach($problems as $problem)
                    <tr>
                        <td>{{ ++$serial}}</td>
                        <td>{{ $problem->oj}}</td>
                        <td>{{ $problem->problem_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
    <script>
        function myFunction() {
            var input = document.getElementById("searchBox");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("myTable");
            var tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[2];

                if(td) {
                    var txtValue = td.textContent || td.innerText;
                    if(txtValue.toUpperCase().indexOf(filter)> -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }

                }
            }

        }
    </script>
@endsection

