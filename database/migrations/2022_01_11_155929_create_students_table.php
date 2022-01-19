<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('Studentid')->nullable()->index();
            //$table->primary('Studentid');
            //$table->string('name', 100)->nullable();
            //$table->string('email')->unique();
            $table->biginteger('number', 50)->nullable();
            $table->date('Birth');
            $table->string('Address', 100);
            $table->string('courseid')->default(0);
            $table->string('Grades');
            $table->string('Mentor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
