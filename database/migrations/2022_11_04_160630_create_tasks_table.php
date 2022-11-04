<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // 教科
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnUpdate('subjects');

            // 進行状態
            $table->foreignId('state_id')->default(1)
                ->constrained('states')
                ->cascadeOnUpdate('states');

            $table->integer('total_page');
            $table->integer('finish_page')->default(0);
            $table->integer('page_time');

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
        Schema::dropIfExists('tasks');
    }
}
