<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('status'); // まず削除
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->string('status')->default('new'); // 再追加（string型）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('status'); // 巻き戻しも削除→追加
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('status')->default(0); // 元の整数型に戻す
        });
    }
};
