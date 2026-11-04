<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Queue extends Model { protected $guarded=[]; protected $casts=['queue_date'=>'date','checked_in_at'=>'datetime']; public function appointment(){return $this->belongsTo(Appointment::class);} }
