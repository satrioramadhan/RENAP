<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewsForWpCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // View untuk normalisasi bobot
        DB::statement("
            CREATE VIEW normalized_weights AS
            SELECT
                user_id,
                weight_rating / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_rating,
                weight_price / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_price,
                weight_distance / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_distance,
                weight_public_facilities / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_public_facilities,
                weight_facilities / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_facilities,
                weight_distance_to_city / SUM(weight_rating + weight_price + weight_distance + weight_public_facilities + weight_facilities + weight_distance_to_city) OVER (PARTITION BY user_id) AS normalized_weight_distance_to_city
            FROM weights;
        ");

        // View untuk menghitung nilai vektor S untuk setiap akomodasi
        DB::statement("
            CREATE VIEW accommodation_vectors AS
            SELECT
                ua.user_id,
                ua.accommodation_id,
                a.rating,
                a.price,
                ua.distance,
                a.public_facilities,
                a.facilities,
                a.distance_to_city,
                POW(a.rating, nw.normalized_weight_rating) AS rating_vector,
                POW(a.price, -nw.normalized_weight_price) AS price_vector,  -- Cost criteria, hence negative exponent
                POW(ua.distance, nw.normalized_weight_distance) AS distance_vector,
                POW(a.public_facilities, nw.normalized_weight_public_facilities) AS public_facilities_vector,
                POW(a.facilities, nw.normalized_weight_facilities) AS facilities_vector,
                POW(a.distance_to_city, -nw.normalized_weight_distance_to_city) AS distance_to_city_vector  -- Cost criteria, hence negative exponent
            FROM user_accommodations ua
            JOIN accommodations a ON ua.accommodation_id = a.id
            JOIN normalized_weights nw ON ua.user_id = nw.user_id;
        ");

        // View untuk menghitung nilai preferensi
        DB::statement("
            CREATE VIEW preference_values AS
            SELECT
                user_id,
                accommodation_id,
                rating_vector * price_vector * distance_vector * public_facilities_vector * facilities_vector * distance_to_city_vector AS preference_value
            FROM accommodation_vectors;
        ");

        // View untuk menjumlahkan semua nilai preferensi
        DB::statement("
            CREATE VIEW total_preference AS
            SELECT
                user_id,
                SUM(preference_value) AS total_preference_value
            FROM preference_values
            GROUP BY user_id;
        ");

        // View untuk menghitung nilai akhir untuk setiap akomodasi
        DB::statement("
            CREATE VIEW final_scores AS
            SELECT
                pv.user_id,
                pv.accommodation_id,
                pv.preference_value / tp.total_preference_value AS final_score
            FROM preference_values pv
            JOIN total_preference tp ON pv.user_id = tp.user_id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS final_scores');
        DB::statement('DROP VIEW IF EXISTS total_preference');
        DB::statement('DROP VIEW IF EXISTS preference_values');
        DB::statement('DROP VIEW IF EXISTS accommodation_vectors');
        DB::statement('DROP VIEW IF EXISTS normalized_weights');
    }
}
