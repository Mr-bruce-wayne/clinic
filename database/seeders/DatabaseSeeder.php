<?php

namespace Database\Seeders;

use App\Models\{Department, Doctor, Patient, Service, User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@saacidclinic.test'], ['name' => 'Clinic Administrator', 'role' => 'administrator', 'active' => true, 'password' => 'Clinic123!']);
        User::firstOrCreate(['email' => 'reception@saacidclinic.test'], ['name' => 'Amina Yusuf', 'role' => 'receptionist', 'active' => true, 'password' => 'Clinic123!']);
        $doctorUser = User::firstOrCreate(['email' => 'doctor@saacidclinic.test'], ['name' => 'Dr. Omar Hassan', 'role' => 'doctor', 'active' => true, 'password' => 'Clinic123!']);
        $dept = Department::firstOrCreate(['name' => 'Family Medicine'], ['description' => 'Primary care and general consultations.']);
        Department::firstOrCreate(['name' => 'Pediatrics'], ['description' => 'Care for infants, children and adolescents.']);
        $doctor = Doctor::firstOrCreate(['email' => 'doctor@saacidclinic.test'], ['user_id' => $doctorUser->id, 'department_id' => $dept->id, 'name' => 'Dr. Omar Hassan', 'specialty' => 'Family Medicine', 'phone' => '+1 555 010 2450', 'consultation_fee' => 45, 'availability' => 'Mon–Fri · 9:00 AM–5:00 PM']);
        Service::firstOrCreate(['name' => 'General consultation'], ['category' => 'Consultation', 'price' => 45]);
        Service::firstOrCreate(['name' => 'Follow-up visit'], ['category' => 'Consultation', 'price' => 25]);
        foreach ([['Maya Patel','Female','+1 555 010 1201'],['Daniel Kim','Male','+1 555 010 1202'],['Sofia Alvarez','Female','+1 555 010 1203'],['Noah Williams','Male','+1 555 010 1204']] as $idx => [$name,$sex,$phone]) {
            Patient::firstOrCreate(['phone' => $phone], ['patient_number' => 'SC-DEMO-'.str_pad((string)($idx+1),4,'0',STR_PAD_LEFT), 'name' => $name, 'sex' => $sex, 'date_of_birth' => now()->subYears(23+$idx*8)->subDays(122), 'phone' => $phone, 'email' => strtolower(str_replace(' ','',$name)).'@example.test', 'address' => '12 Cedar Street', 'emergency_contact' => 'Family contact']);
        }
    }
}
