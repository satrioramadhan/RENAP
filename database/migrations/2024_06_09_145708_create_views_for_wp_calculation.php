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
            CREATE OR REPLACE VIEW normalized_weights AS
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
            CREATE OR REPLACE VIEW accommodation_vectors AS
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
                POW(ua.distance, -nw.normalized_weight_distance) AS distance_vector,
                POW(a.public_facilities, nw.normalized_weight_public_facilities) AS public_facilities_vector,
                POW(a.facilities, nw.normalized_weight_facilities) AS facilities_vector,
                POW(a.distance_to_city, -nw.normalized_weight_distance_to_city) AS distance_to_city_vector  -- Cost criteria, hence negative exponent
            FROM user_accommodations ua
            JOIN accommodations a ON ua.accommodation_id = a.id
            JOIN normalized_weights nw ON ua.user_id = nw.user_id;
        ");

        // View untuk menghitung nilai preferensi
        DB::statement("
            CREATE OR REPLACE VIEW preference_values AS
            SELECT
                user_id,
                accommodation_id,
                rating_vector * price_vector * distance_vector * public_facilities_vector * facilities_vector * distance_to_city_vector AS preference_value
            FROM accommodation_vectors;
        ");

        // View untuk menjumlahkan semua nilai preferensi
        DB::statement("
            CREATE OR REPLACE VIEW total_preference AS
            SELECT
                user_id,
                SUM(preference_value) AS total_preference_value
            FROM preference_values
            GROUP BY user_id;
        ");

        // View untuk menghitung nilai akhir untuk setiap akomodasi
        DB::statement("
            CREATE OR REPLACE VIEW final_scores AS
            SELECT
                pv.user_id,
                pv.accommodation_id,
                pv.preference_value / tp.total_preference_value AS final_score
            FROM preference_values pv
            JOIN total_preference tp ON pv.user_id = tp.user_id
            ORDER BY final_score DESC;
        ");


        //SAW
        DB::statement("
        CREATE OR REPLACE VIEW normalized_decision_matrix AS
        SELECT
            ua.user_id,
            ua.accommodation_id,
            a.rating / (SELECT MAX(rating) FROM accommodations) AS normalized_rating,
            (SELECT MIN(price) FROM accommodations) / a.price AS normalized_price,
            (SELECT MIN(distance) FROM user_accommodations WHERE user_id = ua.user_id) / ua.distance  AS normalized_distance,
            a.public_facilities / (SELECT MAX(public_facilities) FROM accommodations) AS normalized_public_facilities,
            a.facilities / (SELECT MAX(facilities) FROM accommodations) AS normalized_facilities,
            (SELECT MIN(distance_to_city) FROM accommodations) / a.distance_to_city AS normalized_distance_to_city
        FROM user_accommodations ua
        JOIN accommodations a ON ua.accommodation_id = a.id;");


        DB::statement("
        CREATE OR REPLACE VIEW saw_preference_values AS
        SELECT
            ndm.user_id,
            ndm.accommodation_id,
            (ndm.normalized_rating * w.normalized_weight_rating) +
            (ndm.normalized_price * w.normalized_weight_price) +
            (ndm.normalized_distance * w.normalized_weight_distance) +
            (ndm.normalized_public_facilities * w.normalized_weight_public_facilities) +
            (ndm.normalized_facilities * w.normalized_weight_facilities) +
            (ndm.normalized_distance_to_city * w.normalized_weight_distance_to_city) AS preference_value
        FROM normalized_decision_matrix ndm
        JOIN normalized_weights w ON ndm.user_id = w.user_id
        ORDER BY preference_value DESC;");
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
        DB::statement('DROP VIEW IF EXISTS normalized_decision_matrix');
        DB::statement('DROP VIEW IF EXISTS saw_preference_values');
    }
}
