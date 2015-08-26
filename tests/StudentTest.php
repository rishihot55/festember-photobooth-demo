<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testStudentFromRFID()
    {
        $response = $this->call('GET', 'students/aXnfhFSsfds');
        $this->assertResponseOk();
        $student = json_decode($response->getContent());
        $this->assertEquals('Rishi Rajasekaran', $student->name);
    }
}
