<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Patient extends Model { protected $guarded=[]; protected $casts=['date_of_birth'=>'date']; public function appointments(){return $this->hasMany(Appointment::class);} public function records(){return $this->hasMany(MedicalRecord::class);} public function invoices(){return $this->hasMany(Invoice::class);} }
