<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('from')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 30)->nullable();
            $table->text('details')->nullable();
            $table->enum('type', ['purchase', 'commission', 'withdraw', 'deposit'])->default('purchase');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired', 'completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
