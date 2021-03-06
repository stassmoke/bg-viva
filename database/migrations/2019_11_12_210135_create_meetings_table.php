<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->default(1)->index();
            $table->integer('user_id')->index();
            $table->string('name')->nullable();
            $table->string('branch_code')->nullable()->index();
            $table->integer('edrpou_code')->nullable();
            $table->string('ipn')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->date('date_at')->nullable();
            $table->time('time_at')->nullable();
            $table->text('comment')->nullable();
            $table->integer('result')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
}
