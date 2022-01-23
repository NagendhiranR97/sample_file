<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;


class RegisterController extends Controller
{
    //

    public function register()
    {
        return view('register');

    }
    public function save_user(Request $request)
    {
        $user = User::where('email',$request['email'])->first();

        if($user)
        {
            return response()->json(['exists' => 'Email already exists']);
        }
        else{
            $user = new User;
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->dob = $request['dob'];
            $user->gender = $request['gender'];
            $user->password = bcrypt($request['password']);
        }
        $user->save();

        // if($user != null){
        //     MailController::sendSignupEmail($user->fname, $user->email);
        //     return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check email for verification link.'));
        // }
        return response()->json(['success' => 'User Registered Successfully']);

    }

    public function usersview(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $x = '
                        <a href="{{route(\'project.edit\',$row->id)}}">
                        <i class="fas fa-cog"></i>
                        </a>
                        <form action="" method="POST">
                 '.csrf_field().'
                 '.method_field("DELETE").'
                 <button type="submit" class="btn btn-danger"
                     onclick="return confirm(\'Are You Sure Want to Delete?\')"
                     style="padding: .0em !important;font-size: xx-small;"><a href="javascript:void(0)" onclick="deleteuser('. $row->id .')" class="edit btn btn-danger btn-sm">Delete</a></a>
                 </form>
                       
                    ';
                        return $x;
                       
                                   })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('usersview');
    }

    

    public function deleteuser($id)
    {
        $product = User::find($id);
        $product->delete();

        return response()->json(['success' => 'User Deleted Successfully']);
        
    }
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $student  = Student::where($where)->first();
 
        return Response::json($student);
    }
    public function update(Request $request)
    {
        //
        $student = Student::find($request->post('hdnStudentId'));
        $student->first_name = $request->post('txtFirstName');
        $student->last_name = $request->post('txtLastName');
        $student->address = $request->post('txtAddress');
        $student->update();
 return Response::json($student);
 
    }

}
