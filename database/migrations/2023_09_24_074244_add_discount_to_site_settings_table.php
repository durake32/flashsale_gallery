<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->after('minimum_amount', function (Blueprint $table){
                $table->boolean('enable_flash_sale')->default(false);
                $table->date('sale_from')->nullable();
                $table->date('sale_to')->nullable();
                $table->string('flash_title')->nullable();
                $table->string('flash_image')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['enable_flash_sale','sale_from','sale_to','flash_title','flash_image']);
        });
    }
}
