<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Doctor extends Model { protected $guarded=[]; protected $casts=['active'=>'boolean','consultation_fee'=>'decimal:2']; public function department(){return $this->belongsTo(Department::class);} public function appointments(){return $this->hasMany(Appointment::class);} public function user(){return $this->belongsTo(User::class);} }
