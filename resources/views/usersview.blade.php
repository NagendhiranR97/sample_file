<!DOCTYPE html>
<html>
<head>
    <title>Laravel Project</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <h1>Employee View </h1>

    <div class="col-md-12">

        <a href="{{ Url('register') }}" >
        <div class="col-md-6 mb-5">
            <button class="btn btn-success">Add Employee</button>
        </div></a>
    </div>
    <div id="notifDivremove"></div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Employee Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Gender</th>
                <th width="100px">Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "usersview",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fname', name: 'fname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'dob', name: 'dob'},
            {data: 'gender', name: 'gender'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
  });

  
</script>

<script>

    function deleteuser(id)
    {
        
            $.ajax({
                url:'usersview/'+id,
                type: 'DELETE',
                data:{
                    _token : $("input[name=_token").val()
                },
                success:function(response)
                {
                    $("#id"+id).remove();
                    window.location.reload();
                }
            });
    }
</script>
</html>