<?php
namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;
class PatientController extends Controller {
 public function index(Request $r){$patients=Patient::when($r->search,fn($q,$s)=>$q->where(fn($q)=>$q->where('name','like',"%$s%")->orWhere('patient_number','like',"%$s%")->orWhere('phone','like',"%$s%")))->latest()->paginate(12)->withQueryString();return view('patients.index',compact('patients'));}
 public function create(){return view('patients.form',['patient'=>new Patient]);}
 public function store(Request $r){$data=$r->validate(['name'=>'required|string|max:160','date_of_birth'=>'nullable|date|before_or_equal:today','sex'=>'nullable|in:Female,Male,Other','phone'=>'nullable|string|max:40','email'=>'nullable|email|max:160','address'=>'nullable|string|max:2000','emergency_contact'=>'nullable|string|max:160','notes'=>'nullable|string|max:5000']);$data['patient_number']='SC-'.now()->format('ymd').'-'.strtoupper(\Illuminate\Support\Str::random(5));$p=Patient::create($data);return redirect()->route('patients.show',$p)->with('success','Patient registered successfully.');}
 public function show(Patient $patient){$patient->load(['appointments.doctor','records.doctor','invoices.payments']);return view('patients.show',compact('patient'));}
 public function edit(Patient $patient){return view('patients.form',compact('patient'));}
 public function update(Request $r,Patient $patient){$data=$r->validate(['name'=>'required|string|max:160','date_of_birth'=>'nullable|date|before_or_equal:today','sex'=>'nullable|in:Female,Male,Other','phone'=>'nullable|string|max:40','email'=>'nullable|email|max:160','address'=>'nullable|string|max:2000','emergency_contact'=>'nullable|string|max:160','notes'=>'nullable|string|max:5000']);$patient->update($data);return redirect()->route('patients.show',$patient)->with('success','Patient information updated.');}
}
