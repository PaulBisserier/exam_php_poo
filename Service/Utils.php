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

    public function createDirectory()
    {
        $path = "Images";
        // création du dossier Images s'il n'existe pas
        if (!is_dir($path)) {
            //echo "on est la";
            mkdir($path, 0777, true);
        }
    }
}
