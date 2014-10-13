<?php

$array = array("country" => array("Россия" => array(
																										"Краснодарский край" => array(
																																									"Краснодар",
																																									"Новороссийск",
																																									"Ейск"
																																								 )
																									 ),
																	"Украину" => array(
																											"Киевская область" => array(
																																									"Киев"
																																								 )
																										)


																 )
							);

echo "<pre>";
foreach($array as $index => $value) {
	foreach($array[$index] as $index2 => $value2) {

		echo "<h1>{$index2}</h1>";

		foreach($array[$index][$index2] as $index3 => $value3) {
			echo "<h2>{$index3}</h2>";

			foreach($array[$index][$index2][$index3] as $index4 => $value4) {
				echo "{$value4}"."<br />";
			}

		}

	}

}
echo "</pre>";
?>