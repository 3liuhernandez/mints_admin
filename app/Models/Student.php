<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'dni',
    ];

    // handle insert new student
    static public function store( array $data ) :? Student {
        try {
            $student = new Student;
            $student->dni = $data['fns_dni'];
            $student->name = $data['fns_name'];
            $student->last_name = $data['fns_last_name'];
            if ( !empty($data['fns_email']) ) $student->email = $data['fns_email'];
            if ( !empty($data['fns_phone']) ) $student->phone = $data['fns_phone'];
            if ( !empty($data['fns_address']) ) $student->address = $data['fns_address'];

            $student->save();
            return $student->refresh();
        } catch (\Throwable $th) {
            Log::error("Student create => {$th->getMessage()}");
            return null;
        }
    }
}
