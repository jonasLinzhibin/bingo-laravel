<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
	 * Set up the options.
	 *
	 */
	public function __construct()
	{
        $this->table = config('setting.database.table');
        $this->key = config('setting.database.key');
        $this->value = config('setting.database.value');
        $this->group = config('setting.database.group');
        $this->description = config('setting.database.description');
        $this->status = config('setting.database.status');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->table, function(Blueprint $table) {
			$table->increments('id');
			$table->string($this->key)->index();
			$table->text($this->value);
			$table->tinyInteger($this->group)->default(false);
			$table->text($this->description);
			$table->tinyInteger($this->status)->default(false);
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
		Schema::drop($this->table);
	}
}
