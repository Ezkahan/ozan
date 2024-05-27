<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ModalBannerRepositoriesTable.
 */
class ModalBannerRepositoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('../../packages/_webkul/_admin/src/_repositories/_modal_banner_repositories', function(Blueprint $table) {
            $table->increments('id');

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
		Schema::drop('../../packages/_webkul/_admin/src/_repositories/_modal_banner_repositories');
	}
}
