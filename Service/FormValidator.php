<?php
require_once 'Model/Logement.php';
require_once 'Service/Utils.php';


class formValidator
{

    private $utils;

    public function __construct()
    {
        $this->utils = new Utils;
    }

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
     * formNewLogementValidator
     *
     * @param  mixed $data
     * @return void
     */
    public function formNewLogementValidator($data)
    {
        //tableau erreurs
        $errors = [];
        //tableau valeurs validées
        $values = [];
        // tableau renvoyé
        $result = [];
        // Tous les champs
        $fields = ["title", "adresse", "ville", "cp", "surface", "type", "prix", "description"];
        // champs devant être de type string
        $mustBeString = ["title", "ville", "adresse", "type", "description"];
        // options retour de valeurs positives
        $options = ["options" => ["min_range" => 0]];
        //controle des champs soumis par l'utilisateur
        foreach ($fields as $field) {
            if ($this->isEmpty($data[$field])) {
                if (in_array($field, $mustBeString) == true) {
                    if (!is_numeric($data[$field])) {
                        $values[$field] = $data[$field];
                    } else {
                        $errors[$field] = [
                            "message" => "Entrez une chaine de caractère valide",
                            "invalid_value" => $data[$field]
                        ];
                    }
                } else {
                    if (filter_var($data[$field], FILTER_VALIDATE_INT, $options) && is_numeric($data[$field])) {
                        // echo gettype($data[$field]) . " " . $field . " " . " " . $data[$field] .  "<br>";
                        $values[$field] = $data[$field];
                    } else {
                        //echo $data[$field];
                        $errors[$field] = $field;
                        $errors[$field] = [
                            "message" => "Entrez un entier positif",
                            "invalid_value" => $data[$field]
                        ];
                    }
                }
            } else {
                $errors[] = $field;
            }
        }
        if (!empty($errors)) {
            $result["status"] = false;
            $result["errors"] =  $errors;
            $result["valid_values"] = $values;
            return $result;
        } else {
            $result["status"] = true;
            $result["valid_values"] = $values;
            return $result;
        }
    }


    /**
     * imageFormValidator
     * Retourne l'image avec un nouveau nom
     * @param  mixed $data
     * @return void
     */
    public function imageFormValidator($data)
    {
        $result = false;
        if ($data["photo"]["error"] == UPLOAD_ERR_OK) {
            // Extensions autorisées.
            $extensionValid = ['gif', 'jpeg', 'jpg', 'png'];
            $imageInfo = new SplFileInfo($data["photo"]["name"]);
            // test de validité de l'extension
            if (in_array($imageInfo->getExtension(), $extensionValid)) {
                $newfilename = $this->renameImage($data);
            } else {
                $errors = "L'extension " . $imageInfo->getExtension() . " n'est pas valide ";
            }

            if (!empty($errors)) {
                //$this->utils->dd($errors); 
                $result = [
                    "status" => false,
                    "message" => "invalid",
                    "newPath" => null,
                    "raison" => $errors
                ];
            } else {
                $result = [
                    "status" => true,
                    "message" => "valid",
                    "newPath" => $newfilename
                ];
                // création du dossier
                $this->utils->createDirectory();
            }
        } else {
            $result = [
                "status"  => true,
                "message" => "empty_post",
                "newPath" => null
            ];
        }

        return $result;
    }
    /**
     *  Renome le nom des fichiers qui sont passés en paramètre. 
     */
    public function renameImage($data)
    {
        // Création du nouveau nom du fichier
        $temp = explode(".", $data["photo"]["name"]);
        $newfilename = "Logement_" . round(microtime(true)) . '.' . end($temp);
        return $newfilename;
    }
}
