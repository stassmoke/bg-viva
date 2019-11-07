<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fio')->nullable();
            $table->string('ipn')->nullable();
            $table->string('registration_address')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('work_place')->nullable();
            $table->string('work_place_phone')->nullable();
            $table->decimal('average_monthly_income',12,2)->nullable();
            $table->decimal('another_income',12,2)->nullable();
            $table->boolean('is_married')->default(false);
            $table->integer('dependents_count')->default(0);
            $table->boolean('is_have_guarantor')->default(false);
            $table->integer('guarantor_id')->unsigned()->nullable();

            $table->index('guarantor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('individuals');
    }
}
