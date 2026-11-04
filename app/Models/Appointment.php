<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model { protected $guarded=[]; protected $casts=['scheduled_at'=>'datetime']; public function patient(){return $this->belongsTo(Patient::class);} public function doctor(){return $this->belongsTo(Doctor::class);} public function queue(){return $this->hasOne(Queue::class);} public function record(){return $this->hasOne(MedicalRecord::class);} }
