<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('exams', function (Blueprint $table) {
      $table->id();
      $table->text("name");
      $table->text("desc");
      $table->string("image");
      $table->tinyInteger("questions_no");
      $table->tinyInteger("difficulty");
      $table->smallInteger("duration_mins");
      $table->boolean("active")->default(true);
      $table->foreignId("skill_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
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
    Schema::dropIfExists('exams');
  }
}
