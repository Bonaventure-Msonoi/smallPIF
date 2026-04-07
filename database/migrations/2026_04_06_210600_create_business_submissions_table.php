<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('other_names')->nullable();
            $table->string('surname');
            $table->string('nrc');
            $table->string('man_number');
            $table->decimal('amount', 15, 2);
            $table->string('fund_name');
            $table->date('start_date');
            $table->string('phone_no');
            $table->string('email');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('physical_address');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_submissions');
    }
};
