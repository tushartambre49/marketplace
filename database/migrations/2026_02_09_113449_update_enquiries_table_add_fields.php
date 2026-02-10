<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {

            $table->text('message')
                  ->after('provider_id');

            $table->string('status')
                  ->default('pending')
                  ->after('message');

        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {

            $table->dropColumn([
                'message',
                'status'
            ]);

        });
    }
};
