<?php

class Cadenas {

    public function Delimitar($cadenas) {
        $result = "";
        foreach ($cadenas as $key => $value) {
            if ($key) {
                $result .= ",";
            }
            $result .= $value;
        }
        return $result;
    }

}

?>