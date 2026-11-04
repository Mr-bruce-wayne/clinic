<?php
namespace App\Http\Controllers;
use App\Models\{Department,Doctor};use Illuminate\Http\Request;
class DoctorController extends Controller {
 public function index(){ $doctors=Doctor::with('department')->latest()->paginate(12);return view('doctors.index',compact('doctors'));}
 public function create(){return view('doctors.form',['doctor'=>new Doctor,'departments'=>Department::where('active',true)->get()]);}
 public function store(Request $r){$d=$r->validate(['name'=>'required|string|max:160','specialty'=>'required|string|max:120','department_id'=>'nullable|exists:departments,id','phone'=>'nullable|string|max:40','email'=>'nullable|email','consultation_fee'=>'required|numeric|min:0','availability'=>'nullable|string|max:1000']);Doctor::create($d);return redirect()->route('doctors.index')->with('success','Doctor added.');}
 public function edit(Doctor $doctor){return view('doctors.form',['doctor'=>$doctor,'departments'=>Department::where('active',true)->get()]);}
 public function update(Request $r,Doctor $doctor){$d=$r->validate(['name'=>'required|string|max:160','specialty'=>'required|string|max:120','department_id'=>'nullable|exists:departments,id','phone'=>'nullable|string|max:40','email'=>'nullable|email','consultation_fee'=>'required|numeric|min:0','availability'=>'nullable|string|max:1000']);$doctor->update($d);return back()->with('success','Doctor details updated.');}
 public function toggle(Doctor $doctor){$doctor->update(['active'=>!$doctor->active]);return back()->with('success','Doctor availability updated.');}
}
