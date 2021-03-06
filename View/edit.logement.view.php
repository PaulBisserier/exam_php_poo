<?php ob_start() ?>

<form method="POST" action="<?= URL ?>logement/editvalid" enctype="multipart/form-data">
 <!--Titre du logement-->
 <div class="form-group">
        <label for="title">titre du logement</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $logement->getTitre()?>" required="required">
    </div>
    <!-- Adresse du logement -->
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $logement->getAdresse()?>" required="required">
    </div>
    <!-- Ville du logement -->
    <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $logement->getVille()?>" required="required">
    </div>
    <!-- Code postal du logement  -->
    <div class="form-group">
        <label for="cp">Code postal du logement</label>
        <input type="" class="form-control" name="cp" id="cp" value="<?= $logement->getCp()?>" required="required">
    </div>
    <!-- Surface du logement -->
    <div class="form-group">
        <label for="surface">Surface du logement</label>
        <input type="number" class="form-control" name="surface" id="surface" value="<?= $logement->getSurface()?>" required="required">
    </div>
    <!-- Prix du logement -->
    <div class="form-group">
        <label for="prix">Prix du logement</label>
        <input type="number" class="form-control" name="prix" id="prix" value="<?= $logement->getPrix()?>" required="required">
    </div>
    <!-- Photo du logement -->
    <div class="form-group">
        <label for="photo">Photo du logement</label>
        <input type="file" class="form-control" name="photo" id="photo" value="<?= $logement->getPhoto()?>">
    </div>
    <!-- Type du logement  -->
    <div class="form-group">
        <label for="type" class="form-label mt-4">Type de logement</label>
        <select class="form-select" name="type" id="type"  required="required">
            <option selected value="<?= $logement->getType()?>"><?= $logement->getType()?></option>
            <option value="location">Location</option>
            <option value="vente">Vente</option>
        </select>
    </div>
    <!-- Description du logement-->
    <div class="form-group">
        <label for="description" class="form-label mt-4">Description du logement</label>
        <textarea type="text" class="form-control" name="description" id="description" value="<?=$logement->getDescription()?>" rows="3"></textarea>
    </div>
  <input type="hidden" name="id-logement" value="<?= $logement->getId_logement()?>">
  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php
$content =  ob_get_clean();
$title = "Edition de: " . $logement->getTitre() ;
require_once "base.html.php";
?>