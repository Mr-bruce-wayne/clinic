<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MedicalRecord extends Model { protected $guarded=[]; protected $casts=['visit_date'=>'date','follow_up_date'=>'date']; public function patient(){return $this->belongsTo(Patient::class);} public function doctor(){return $this->belongsTo(Doctor::class);} public function prescription(){return $this->hasOne(Prescription::class);} }
