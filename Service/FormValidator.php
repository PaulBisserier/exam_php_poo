<?php

class formValidator
{

    /**
     * if empty return false
     */
    public function isEmpty($data)
    {

        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * if not int return false
     */
    public function isInt($data)
    {
        if (filter_var($data,  FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     */
    public function formNewLogementValidator($data)
    {
        //tableau erreurs
        $errors = [];
        //tableau valeurs validées
        $values = [];
        // champs obligatoires 
        $fields = ["title", "adresse", "ville", "cp", "surface", "type", "prix"];
        // champs devant être de type string
        $mustBeString = ["title", "ville", "adresse", "type", "description"];
        // option retour de valeurs positives
        $options = ["min_range" => 0]; 

        foreach ($fields as $field) {
            if ($this->isEmpty($data[$field])) {
                if (in_array($field, $mustBeString) == true) {
                    if (!is_numeric($data[$field])) {
                        $values[$field] = $data[$field];
                    } else {
                        $errors[] = $field;
                    }
                } else {
                    if (filter_var($data[$field], FILTER_VALIDATE_INT, $options)) {
                        echo gettype($data[$field]). " " . $field ." " . " " . $data[$field] .  "<br>"; 
                        $values[$field] = $data[$field];
                    } else {
                        $errors[] = $field;
                    }
                }
            } else {
                $errors[] = $field;
            }
        }
        if (!empty($errors)) {
            return "erreur";
        } else {
            return $values;
        }
    }
}
