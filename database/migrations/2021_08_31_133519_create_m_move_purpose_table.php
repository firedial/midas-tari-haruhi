<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMovePurposeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_move_purpose', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('item', 50);
            $table->foreignId('before_id');
            $table->foreignId('after_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('before_id')
                ->references('id')
                ->on('m_purpose_element')
                ->onDelete('restrict');

            $table->foreign('after_id')
                ->references('id')
                ->on('m_purpose_element')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_move_purpose');
    }
}
