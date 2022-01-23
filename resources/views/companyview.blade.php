@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Company Details</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addModal">Add</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" id="companyTable">
		<thead>
			<tr>
				<th>id</th>
				<th>First Name</th>
				<th>email</th>
				<th>LOGO</th>
				<th width="280px">Action</th>
			</tr>
		</thead>	
		<tbody>
        @foreach ($companys as $company)
            <tr id="{{ $company->id }}">
                <td>{{ $company->id }}</td>
                <td>{{ $company->first_name }}</td>
                <td>{{ $company->last_name }}</td>
                <td>{{ $company->address }}</td>
                <td>
		     <a data-id="{{ $company->id }}" class="btn btn-primary btnEdit">Edit</a>
		     <a data-id="{{ $company->id }}" class="btn btn-danger btnDelete">Delete</button>
                </td>
            </tr>
        @endforeach
		</tbody>
    </table>
	

<!-- Add Student Modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Student Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New company</h4>
      </div>
	  <div class="modal-body">
		<form id="addcompany" name="addcompany" action="{{ route('company.store') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="companyname">Company Name:</label>
				<input type="text" class="form-control" id="companyname" placeholder="Enter First Name" name="companyname">
			</div>
			<div class="form-group">
				<label for="companyemail">Last Name:</label>
				<input type="text" class="form-control" id="companyemail" placeholder="Enter Last Name" name="companyemail">
			</div>
			<div class="form-group">
				<label for="companylogo">Address:</label>
				<input type="file" class="form-control" id="companylogo" name="companylogo">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<!-- Update Student Modal -->
<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Student Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Student</h4>
      </div>
	  <div class="modal-body">
		<form id="updatecompany" name="updatecompany" action="{{ route('company.update') }}" method="post">
			<input type="hidden" name="hdncompanyId" id="hdncompanyId"/>
			@csrf
			<div class="form-group">
				<label for="companyname">Company Name:</label>
				<input type="text" class="form-control" id="companyname" placeholder="Enter company Name" name="companyname">
			</div>
			<div class="form-group">
				<label for="companyemail">Last Name:</label>
				<input type="text" class="form-control" id="companyemail" placeholder="Enter company Email" name="companyemail">
			</div>
			<div class="form-group">
				<label for="companylogo">Address:</label>
				<input type="file" class="form-control" id="companylogo" name="companylogo">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	

<script>
  $(document).ready(function () {
	//Add the Student  
	$("#addStudent").validate({
		 rules: {
			companyname: "required",
			companyemail: "required",
				companylogo: "required"
			},
			messages: {
			},
 
		 submitHandler: function(form) {
		  var form_action = $("#addcompany").attr("action");
		  $.ajax({
			  data: $('#addcompany').serialize(),
			  url: form_action,
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  var student = '<tr id="'+data.id+'">';
				  student += '<td>' + data.id + '</td>';
				  student += '<td>' + data.name+ '</td>';
				  student += '<td>' + data.email + '</td>';
				  student += '<td>' + data.logo + '</td>';
				  student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
				  student += '</tr>';            
				  $('#companyTable tbody').prepend(student);
				  $('#addcompany')[0].reset();
				  $('#addModal').modal('hide');
			  },
			  error: function (data) {
			  }
		  });
		}
	});
  
 
    //When click edit student
    $('body').on('click', '.btnEdit', function () {
      var student_id = $(this).attr('data-id');
      $.get('student/' + student_id +'/edit', function (data) {
          $('#updateModal').modal('show');
          $('#updateStudent #hdnStudentId').val(data.id); 
          $('#updateStudent #txtFirstName').val(data.first_name);
          $('#updateStudent #txtLastName').val(data.last_name);
          $('#updateStudent #txtAddress').val(data.address);
      })
   });
    // Update the student
	$("#updateStudent").validate({
		 rules: {
				txtFirstName: "required",
				txtLastName: "required",
				txtAddress: "required"
				
			},
			messages: {
			},
 
		 submitHandler: function(form) {
		  var form_action = $("#updateStudent").attr("action");
		  $.ajax({
			  data: $('#updateStudent').serialize(),
			  url: form_action,
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  var student = '<td>' + data.id + '</td>';
				  student += '<td>' + data.first_name + '</td>';
				  student += '<td>' + data.last_name + '</td>';
				  student += '<td>' + data.address + '</td>';
				  student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
				  $('#studentTable tbody #'+ data.id).html(student);
				  $('#updateStudent')[0].reset();
				  $('#updateModal').modal('hide');
			  },
			  error: function (data) {
			  }
		  });
		}
	});		
		
   //delete student
	$('body').on('click', '.btnDelete', function () {
      var student_id = $(this).attr('data-id');
      $.get('student/' + student_id +'/delete', function (data) {
          $('#companyTable tbody #'+ student_id).remove();
      })
   });	
	
});	  
</script>
@endsection