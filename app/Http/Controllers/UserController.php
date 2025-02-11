<?php

namespace App\Http\Controllers;

use App\Mail\userSignUpMail;
use App\Mail\userResetPasswordMail;
use App\Role;
use App\User;
use App\verificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


    class UserController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $logged_in =  Auth::user();
        $user_email = $logged_in->email;
        $region_code=$logged_in->region_code;
        
        if($logged_in->type ==='Admin'){

        
        $users = User::where('region_code',$region_code)->paginate(5);
        }
        else{
            $users =User::all();
        }

            // ->where('email', '!=', $user_email)
            // ->where('corporate_id', '!=', '')
            
    //    dd($users);
        trail('View user', 'User listing');
        return view('users.index', compact('users'));
        
    }

    public function create()
    {
        // abort_if(Gate::denies('create_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $branches = DB::table('Branch')->get();
        // $roles = $this->permitted_roles();
        $regions=DB::table('regions')->get();
        $roles = DB::table('roles')->where('type', 'portal')->get();
        return view('users.create', compact('roles', 'regions'));
      
    }

    public function permitted_roles()
    {
        if (user()->role === 'super-admin') {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'super-admin')->where('name', '!=', 'Admin')->get();
        }

        return $roles;
      }



    
     public function store(Request $request)
    {

        $authenticatedUser=Auth::user();
        //dd($authenticatedUser);
    
// dd($request);
        //dd($request);
        $data = $request->all();
        // dd($data);
        // $this->validate($request, [
        //     'employee_number'=>'required',
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'phonenumber' => 'required',
        //      'idnumber'=>'required',
        //      'active',
        //      'status',
        //      'address'=> 'required',
        //       'region_code'=> 'required',
        //      'employee_number' => 'required',
        //     'email' => 'required|email|unique:users,email',
  
        //     // 'branch' => 'required',
        // ]);


            $employee_number=$request->get('employee_number');
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $phonenumber = $request->get('phonenumber');
            $idnumber = $request->get('idnumber');
            $active = $request->get('active');
            $status = $request->get('status');
            $address = $request->get('address');
            $email = $request->get('email');
			
             $confirmEmail = User::where('email', $email)->first();
			 $employee_number = User::where('employee_number', $employee_number)->first();

        if ($confirmEmail || $employee_number) {
            flash()->error('The Email  or Employee number given already belong to a another user');
            return redirect()->back();
        }
		else{
			

            if(Auth::user()->type ==='Admin'){

            
            $region_code=$authenticatedUser->region_code;
        }
            else{
                $region_code = $request->get('region_code');

            }
            if(Auth::user()->type ==='Admin'){
                $role=$request->get('role');

            }
            else{
                $role = 'Admin';
            }
      

            // dd($role);
            $corporate_id = $request->get('corporate_id');

        $user = user();
    // dd($role);
    //dd($region_code);

            $user = User::create([
            'employee_number'=>$employee_number,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'phonenumber'  => $phonenumber,
            'idnumber'  => $idnumber,
            'active'  => $active,
            'status'  => $status,
            'address'  => $address,
            'email' => $email,
            'type' => $role,
            'region_code' => $region_code,
            'username'  => $email,
            'corporate_id'  => $corporate_id,
            'password' => uniqid()
            ]);

            $roles = $request->input('type') ? $request->input('type') : [];
            // dd($roles);
            $user->assignRole($roles);

        $code = Str::random(60) . uuid();
        VerificationCode::create([
            'code' => $code,
            'user_id' => $user->id,
            'expires_at' => Carbon::now()->addHours(config('admintemplate.new_user_token_validity'))->toDateTimeString(),
            'intent' => 'account creation'
        ]);

        Mail::to($email, $user->name)->send(new userSignUpMail($user, $code));


        flash()->info("User created. They can check their email address  $email to allow them login");
        return redirect()->route('users.index');
    }
	}

    public function edit(User $user)
    {
        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Edit user', 'Initiate user edit');
        $roles = $this->permitted_roles();

        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {

        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'role' => 'required|exists:roles,name'
        ]);

        trail('Update user', 'User update');

        $email = $request->get('email');
        $confirmEmail = User::where('email', $email)->where('uuid', '!=', $user->uuid)->count();

        if ($confirmEmail) {
            flash()->info($email . ' belongs to another user');
            return redirect()->back();
        }

        $role = $request->get('role');
        $roles = $this->permitted_roles()->pluck('name')->toArray();

        if (!in_array($role, $roles)) {
            flash()->info('Permission denied');
            return redirect()->route('logout');
        }

        $user->update([
            'phonenumber' => $request->get('phonenumber'),
            'email' => $request->get('email'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'status' => $request->get('status'),
            'type' => $request->get('role'),
            'active' => $request->get('status')
        ]);

        // dd($user);

        $user->syncRoles([$role]);

        flash('User updated successfully')->important();
        return redirect()->route('users.index');
    }
	

    public function show(User $user)
    {
        abort_if(Gate::denies('show_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('users.show', compact('user'));
    }

    public function logs(User $user)
    {
        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sheets = new SheetCollection([
            'ActivityLog' => $this->auditGenerator($user),
        ]);

        $name = $user->first_name . ' '. $user->last_name . ' - Activity-Log-As-At' . now()->format('M j, Y g:i A');;
        return (new FastExcel($sheets))->download($name . '.xlsx');

    }

    function auditGenerator($user)
    {
        foreach (Activity::where(function ($q) use ($user) {
            $q->where('subject_id', '!=', $user->id)->where('subject_type', '!=', 'App\User')->orWhere('log_name', '!=', 'default');
        })->where('causer_id', $user->id)->where('causer_type', get_class($user))->select('description as Activity', 'subject_type as Subject', 'subject_id as SubjectID', 'created_at as Timestamp')->latest()->cursor() as $user) {
            yield $user;
        }
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        flash('User deleted successfully (soft deleted).')->important();
        return redirect()->route('users.index');
    }

    public function resetPassword(){
        abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::paginate();

        //dd($users);
        trail('View user', 'User listing');
        return view('users.reset', compact('users'));

    }

    public function customers(){
        return view('customer.customer');

    }
    public function expiry(){
        return view('expiry.expiry');
    }

    public function sendResetPasswordLink(Request $request, $response){
        
        $users = User::paginate();
       // dd($users);
        $response =['message' => "Password reset email sent"];
        //dd($response);
        if($response == Password::RESET_LINK_SENT){
            return view('users.reset', compact('users'));

        } else {
        }

    }


    public function passreset(User $user)
    {
        $user_id = $user->id;
        $user_status = $user->status;

        $query = DB::table('users')
            ->where('id', $user_id)
            ->update(['status' => 0 ]);

         $code = Str::random(60) . uuid();
         VerificationCode::create([
             'code' => $code,
             'user_id' => $user->id,
             'expires_at' => Carbon::now()->addHours(config('admintemplate.new_user_token_validity'))->toDateTimeString(),
             'intent' => 'account creation'
         ]);

         $email = $user->email;

         Mail::to($email, $user->firstname)->send(new userResetPasswordMail($user, $code));

         flash()->info("Password reset successful. Inform the user to check their emails");
         return redirect()->route('users.index');

    }


}
