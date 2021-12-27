<?php ob_start() ?>

<form method="POST" action="<?= URL ?>logement/formValidator"  enctype="multipart/form-data">
<!--Titre du logement-->
  <div class="form-group">
    <label for="title">titre du logement</label>
    <input type="" class="form-control" name="title" id="title">
  </div>
  <!-- Adresse du logement -->
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="" class="form-control" name="adresse" id="adresse">
  </div>
  <!-- Code postal du logement  -->
  <div class="form-group">
    <label for="cp">Code postal du logement</label>
    <input type="" class="form-control" name="cp" id="cp">
  </div>
  <!-- Surface du logement -->
  <div class="form-group">
    <label for="surface">Surface du logement</label>
    <input type="" class="form-control" name="surface" id="surface">
  </div>
  <!-- Prix du logement -->
  <div class="form-group">
    <label for="prix">Prix du logement</label>
    <input type="number" class="form-control" name="prix" id="prix">
  </div>
<!-- Photo du logement -->
  <div class="form-group">
    <label for="photo">Photo du logement</label>
    <input type="file" class="form-control" name="photo" id="photo">
  </div>
  <!-- Type du logement  -->
  <div class="form-group">
      <label for="type" class="form-label mt-4">Type de logement</label>
      <select class="form-select" name="type" id="type">
        <option>--Choississez un type--</option>
        <option>Location</option>
        <option>Vente</option>
      </select>
    </div>
    <!-- Description du logement-->
    <div class="form-group">
      <label for="description" class="form-label mt-4">Description du logement</label>
      <textarea class="form-control" name="description" id="description" rows="3"></textarea>
    </div>
  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php
$content =  ob_get_clean();
$title = "Ajouter un jeu";
require_once "base.html.php";
?>