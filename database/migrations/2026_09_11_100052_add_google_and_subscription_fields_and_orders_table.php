<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->index()->after('email');
            $table->string('subscription_plan')->default('core')->after('is_active');
            $table->string('subscription_status')->default('active')->after('subscription_plan');
            $table->string('billing_interval')->default('monthly')->after('subscription_status');
            $table->unsignedInteger('seats_count')->default(5)->after('billing_interval');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->string('plan_name');
            $table->string('billing_interval')->default('monthly'); // monthly, annual
            $table->unsignedInteger('seats')->default(5);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('currency')->default('USD');
            $table->string('payment_status')->default('paid');
            $table->string('card_brand')->default('Visa');
            $table->string('card_last_four', 4)->default('4242');
            $table->string('receipt_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'subscription_plan',
                'subscription_status',
                'billing_interval',
                'seats_count',
            ]);
        });
    }
};
