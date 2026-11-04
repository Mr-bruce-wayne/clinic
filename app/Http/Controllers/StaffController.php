<?php
namespace App\Http\Controllers;
use App\Models\User;use Illuminate\Http\Request;use Illuminate\Support\Facades\Hash;use Illuminate\Validation\Rule;
class StaffController extends Controller {
 public function index(){ $staff=User::latest()->paginate(15);return view('staff.index',compact('staff'));}
 public function store(Request $r){$d=$r->validate(['name'=>'required|string|max:160','email'=>'required|email|unique:users,email','role'=>['required',Rule::in(['administrator','receptionist','doctor','nurse'])],'password'=>'required|string|min:10']);User::create([...$d,'password'=>Hash::make($d['password'])]);return back()->with('success','Staff account created.');}
 public function toggle(User $user){abort_if($user->id===auth()->id(),422,'You cannot deactivate your own account.');$user->update(['active'=>!$user->active]);return back()->with('success','Staff access updated.');}
}
