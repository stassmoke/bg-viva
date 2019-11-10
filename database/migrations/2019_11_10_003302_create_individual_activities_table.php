<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('legal_entry_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('legal_entity_id')->unsigned();
            $table->mediumText('description');

            $table->index('legal_entity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_entry_activities');
    }
}
