<?php
namespace App\Http\Controllers;
use App\Models\{Appointment,Doctor,Invoice,Patient,Payment,Queue};
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
 public function __invoke(){ $today=now()->toDateString(); return view('dashboard',[
 'patients'=>Patient::count(),'todayAppointments'=>Appointment::whereDate('scheduled_at',$today)->count(),'waiting'=>Queue::whereDate('queue_date',$today)->where('status','Waiting')->count(),'doctors'=>Doctor::where('active',true)->count(),'completed'=>Appointment::whereDate('scheduled_at',$today)->where('status','Completed')->count(),'revenue'=>Payment::whereDate('paid_at',$today)->sum('amount'),
 'appointments'=>Appointment::with(['patient','doctor'])->whereDate('scheduled_at',$today)->orderBy('scheduled_at')->limit(8)->get(), 'recentPatients'=>Patient::latest()->limit(5)->get(),
 'chart'=>Appointment::selectRaw('DATE(scheduled_at) as day, count(*) as total')->where('scheduled_at','>=',now()->subDays(6)->startOfDay())->groupBy('day')->orderBy('day')->get(),
 'revenueChart'=>Payment::selectRaw('DATE(paid_at) as day, sum(amount) as total')->where('paid_at','>=',now()->subDays(6)->startOfDay())->groupBy('day')->orderBy('day')->get(),
 'clinic'=>DB::table('clinic_settings')->pluck('value','key')]); }
}
