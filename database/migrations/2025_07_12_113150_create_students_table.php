<?php

use App\Models\Lga;
use App\Models\Level;
use App\Models\State;
use App\Models\Gender;
use App\Models\School;
use App\Models\Semester;
use App\Models\Department;
use App\Models\Academicsession;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname');
            $table->string('other_name')->nullable();
            $table->string('reg_no');
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('email')->unique();
            $table->string('phone', 15)->unique();
            $table->string('address')->nullable();

            // foriengID
            $table->foreignIdFor(Gender::class);
            $table->foreignIdFor(State::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Lga::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(School::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Department::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Academicsession::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Semester::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Level::class)->constrained()->onDelete('cascade');

            $table->string('status')->default('Active');
            $table->string('jamb_no')->nullable();
            $table->string('agree')->default('notagree');
            $table->string('passport')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
