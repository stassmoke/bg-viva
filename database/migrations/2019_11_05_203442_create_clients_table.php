<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('type')->unsigned();
            $table->integer('legal_entity_id')->unsigned()->nullable();
            $table->integer('individual_id')->unsigned()->nullable();
            $table->string('branch_code')->nullable();
            $table->mediumText('credit_meta')->nullable();
            $table->boolean('is_contract_concluded')->default(false);
            $table->integer('contract_number')->unsigned()->nullable();
            $table->date('contract_date')->nullable();
            $table->bigInteger('contract_sum')->nullable();
            $table->decimal('contract_percent')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('type');
            $table->index('legal_entity_id');
            $table->index('individual_id');
            $table->index('branch_code');
            $table->index('contract_number');
            $table->index('is_contract_concluded');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
}
