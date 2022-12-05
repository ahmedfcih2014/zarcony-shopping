<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\OrderEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("payment_method_id");
            $table->double("order_amount", 10, 2);
            $table->double("delivery_fees", 10, 2);
            $table->double("tax_amount", 10, 2);
            $table->double("total_amount", 10, 2);
            $table->enum("order_status", OrderEnum::getStatus());
            $table->foreign("user_id", "user_foreign_key")
                ->on("users")
                ->references("id");
            $table->foreign("payment_method_id", "payment_method_foreign_key")
                ->on("payment_methods")
                ->references("id");
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
        Schema::dropIfExists('orders');
    }
};
