<?php

class Utils
{

    /**
     * dd
     * Dump and Die. 
     * @param  mixed $data
     * @return void
     */
    public function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        echo "--FIN DU SCRIPT--";
        die;
    }
    /**
     * créer le dossier images s'il n'existe pas.
     */
    public function createDirectory()
    {
        $path = "Images";
        // création du dossier Images s'il n'existe pas
        if (!is_dir($path)) {
            //echo "on est la";
            mkdir($path, 0777, true);
        }
    }
        
    /**
     * textView
     * Retourne les chaines de caratères > 150 char avec "..." à la fin. 
     * @param  mixed $string
     * @return void
     */
    public function textView($string)
    {
        // compte le nb de caractères présent dans la chaine de caractères.
        if( strlen($string) > 150) {
            $newString = substr($string, 0, 150) . "..."; 
            return $newString;
        } else {
            return $string; 
        }
    }
}
