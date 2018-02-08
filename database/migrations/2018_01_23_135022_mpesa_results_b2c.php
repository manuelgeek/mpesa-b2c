<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MpesaResultsB2c extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ResultType')->nullable();
            $table->string('ResultCode')->nullable();
            $table->string('ResultDesc')->nullable();
            $table->string('OriginatorConversationID')->nullable();
            $table->string('ConversationID')->nullable();
            $table->string('TransactionID')->nullable();
            $table->string('TransactionReceipt')->nullable();
            $table->string('TransactionAmount')->nullable();
            $table->string('B2CWorkingAccountAvailableFunds')->nullable();
            $table->string('B2CUtilityAccountAvailableFunds')->nullable();
            $table->string('TransactionCompletedDateTime')->nullable();
            $table->string('ReceiverPartyPublicName')->nullable();
            $table->string('B2CChargesPaidAccountAvailableFunds')->nullable();
            $table->string('B2CRecipientIsRegisteredCustomer')->nullable();
            $table->string('QueueTimeoutURL')->nullable();
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
        Schema::table('transactions', function (Blueprint $table) {
            Schema::dropIfExists('transactions');
        });
    }
}
