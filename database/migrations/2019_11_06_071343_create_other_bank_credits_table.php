<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherBankCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('other_bank_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('name');
            $table->decimal('sum',18,2);
            $table->date('date');
            $table->integer('client_id')->unsigned();

            $table->index('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('other_bank_credits');
    }
}
