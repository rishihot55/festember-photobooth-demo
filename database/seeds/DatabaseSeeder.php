<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Student;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call(StudentTableSeeder::class);
        
        Model::reguard();
    }
}

class StudentTableSeeder extends Seeder {
    public function run() {
        DB::table('students')->delete();

        Student::create(['festember_id' => '1', 'card' => 'aXnfhFSsfds', 'name' => 'Rishi Rajasekaran', 'roll_no' => '106113078']);
        Student::create(['festember_id' => '2', 'card' => 'bFDDhfqFdxs', 'name' => 'Suyash Behera', 'roll_no' => '106113096']);
        Student::create(['festember_id' => '3', 'card' => 'fnqFegsktRe', 'name' => 'Siddarth Iyer', 'roll_no' => '106113089']);
        Student::create(['festember_id' => '4', 'card' => 'DjqpdfDjshf', 'name' => 'Desikan S', 'roll_no' => '106113093']);
    }
}
