<?php 
      function explode_date($input, $var) {
        // Current ate format: d/m/Y
        // Check ACF custom fields for correct format
        if ($input && is_string($input)) {
            $date_array = explode('/', $input);

            switch($var) {
                case 'month' :
                    $date_var = $date_array[1];
                    break;
                case 'day' :
                    $date_var = $date_array[0];
                    break;
                case 'year' :
                    $date_var = $date_array[2];
                    break;                            
            }
            return $date_var;
        }
    };
?>