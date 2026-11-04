<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model { protected $guarded=[]; public function patient(){return $this->belongsTo(Patient::class);} public function items(){return $this->hasMany(InvoiceItem::class);} public function payments(){return $this->hasMany(Payment::class);} public function getPaidAttribute(): float {return (float)$this->payments()->sum('amount');} public function getBalanceAttribute(): float {return max(0,(float)$this->total-$this->paid);} }
