<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;
class SettingsController extends Controller {
 public function edit(){return view('settings', ['settings'=>DB::table('clinic_settings')->pluck('value','key')]);}
 public function update(Request $r){$d=$r->validate(['name'=>'required|string|max:160','address'=>'nullable|string|max:1000','phone'=>'nullable|string|max:40','email'=>'nullable|email','currency'=>'required|in:USD,KES,EUR,GBP','opening_hours'=>'nullable|string|max:300']);foreach($d as $k=>$v)DB::table('clinic_settings')->updateOrInsert(['key'=>$k],['value'=>$v,'updated_at'=>now(),'created_at'=>now()]);return back()->with('success','Clinic settings saved.');}
}
