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
        if (!Schema::hasTable('logs')) {
        //     Schema::connection('mongodb')->create('logs', function (Blueprint $table) {
        //         $table->id();
        //         $table->index('user_id');
        //         $table->index('model');
        //         $table->index('model_id');
        //         $table->index('model_take_action_name');
        //         $table->index('model_take_action_id');

        //         $table->index('action');
                
        //         $table->timestamps();
        //     });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};