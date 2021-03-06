<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patients', function(Blueprint $table)
		{
			$table->foreign('blood_type_id', 'fk_patients_blood_types')->references('id')->on('blood_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('gender_id', 'fk_patients_genders')->references('id')->on('genders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('doctor_id', 'fk_patients_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patients', function(Blueprint $table)
		{
			$table->dropForeign('fk_patients_blood_types');
			$table->dropForeign('fk_patients_genders');
			$table->dropForeign('fk_patients_users');
		});
	}

}
