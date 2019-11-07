<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('legal_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->nullable();
            $table->integer('edrpou_code')->unsigned()->nullable();
            $table->string('legal_address',255)->nullable();
            $table->string('actual_address',255)->nullable();
            $table->string('contact_person',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('landline_phone',255)->nullable();
            $table->mediumText('activity')->nullable();
            $table->integer('net_profit_type')->unsigned()->default(\App\Enums\IncomingEnum::INCOMING_FIRST_TYPE);
            $table->decimal('сarrying_amount',18,2)->nullable();
            $table->date('carrying_date')->nullable();
            $table->integer('carrying_type')->unsigned()->default(\App\Enums\IncomingEnum::INCOMING_FIRST_TYPE);
            $table->decimal('payables',18,2)->unsigned()->nullable();
            $table->date('payables_date')->nullable();
            $table->integer('payables_type')->unsigned()->default(\App\Enums\IncomingEnum::INCOMING_FIRST_TYPE);
            $table->decimal('receivables',18,2)->unsigned()->nullable();
            $table->date('receivables_date')->nullable();
            $table->integer('receivables_type')->unsigned()->default(\App\Enums\IncomingEnum::INCOMING_FIRST_TYPE);

            $table->index('edrpou_code');
            $table->index('net_profit_type');
            $table->index('carrying_type');
            $table->index('payables_type');
            $table->index('receivables_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_entries');
    }
}
