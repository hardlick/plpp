<?php 
class db_config {
	public static $db_conection_config = array('baul' => array(
            'serverDBName' => 'localhost',
            'serverPort' => '3306',
            'dbName' => 'baul',
            'dbNameEtl' =>'',
            'dbUser' => 'root',
            'dbPassword' => '280510jt',
            'environment' => 'live',
            'culqi_environment' => 'live',
            'url_test' => 'http://bauldepeliculas',
            'url_live' => 'https://bauldepeliculas.info',            
            'culqi_public_test' => 'pk_test_RM0mtUtHCs4BJHF6',
            'culqi_private_test' => 'sk_test_umG01cubv75ChqX5',
            'culqi_public_live' => 'pk_live_ePX6YR0QVpvDteWN',
            'culqi_private_live' =>'sk_live_3i2jBQ6ZtTRXomd3',
            'movie_one_amt' => '300',
            'movie_one_amt_r' => '3.00',
            'movie_three_amt' => '1000',
            'movie_three_amt_r' => '10.00',
            'movie_five_amt' => '1500',
            'movie_five_amt_r' => '15.00',
            'movie_ten_amt' => '3000',
            'movie_ten_amt_r' => '30.00',
            'serie_all_amt' => '3000',
            'serie_all_amt_r' => '30.00',
            'serie_cap_amt' => '300',
            'serie_cap_amt_r' => '3.00',
            'serie_season_amt' => '1000',
            'serie_season_amt_r' => '10.00',
        )
    );
}
