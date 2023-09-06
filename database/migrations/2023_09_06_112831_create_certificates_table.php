<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;
use App\Models\Certificate;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('is_active')->default(1)->index();
            $table->timestamps();
        });

        Schema::create('certificate_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Certificate::class);
            $table->text('description');
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
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('certificate_student');
    }
};
