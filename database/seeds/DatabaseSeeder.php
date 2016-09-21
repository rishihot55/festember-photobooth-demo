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

        Student::create(['festember_id' => '1', 'card' => 'aXnfhFSsfds', 'name' => 'Rishi Rajasekaran', 'roll_no' => '106113078', 'facebook_id' => 'rajasekaran.rishi']);
        Student::create(['festember_id' => '2', 'card' => 'bFDDhfqFdxs', 'name' => 'Suyash Behera', 'roll_no' => '106113096',  'facebook_id' => 'sne9x']);
        Student::create(['festember_id' => '3', 'card' => '0013276499', 'name' => 'Siddarth Iyer', 'roll_no' => '106113089', 'facebook_id' =>'mindstormer619']);
        Student::create(['festember_id' => '4', 'card' => 'DjqpdfDjshf', 'name' => 'Desikan S', 'roll_no' => '106113093', 'facebook_id' => 'desikan93']);
    }
}
