@extends('admin.master')

@section('style')
    #searchBox {
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-weight: bold;"><i>confirmation</i></h4>

                </div>
                <div class="modal-body" style="font-style: italic;font-weight: bold;">
                    Do you really want to make him admin?<br><br>
                    <form method="post" action="/home/permit/admin/confirm">
                        @csrf
                        <input type="hidden" id="formId" name="mail" value="">

                        <button type="submit" class="btn btn-success">confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="afterAdmin" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: bold;"><i>notification</i></h4>
                </div>
                <div class="modal-body" style="font-style: italic;font-weight: bold;">
                    Added as a admin.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <script>
            $('#afterAdmin').modal('show');
        </script>
    @endif



    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="text" id="searchBox" onkeyup="myFunction()" name="search" placeholder="Search by name..." autofocus>
                <br>
                <br>
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Confirmation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $users = DB::table('users')->select('name','email')->where('admin',false)->distinct()->orderby('name')->get();


                    @endphp
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            <td> <button type="button" class="btn btn-success" onclick="callModal('{{$user->email}}')" style="text-align: center;">permit as admin</button> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script>
        function myFunction() {
            var input = document.getElementById("searchBox");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("myTable");
            var tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[0];

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

        function callModal(email) {
            var modal = $('#myModal');
            document.getElementById("formId").value = email;
            modal.modal('show');
        }

    </script>
@endsection
