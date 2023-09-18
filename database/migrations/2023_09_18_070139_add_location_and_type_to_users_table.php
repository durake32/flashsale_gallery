<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationAndTypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('customer_type_id')
            ->nullable()->after('apple_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')
            ->nullable()->after('customer_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['customer_type_id']);
            $table->dropForeign(['location_id']);
            $table->dropColumn(['location_id','customer_type_id']);
        });
    }
}
