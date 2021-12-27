<?php ob_start();
?>

<table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th>Titre</th>
      <th>Nombre de joueurs</th>
      <th colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<a href="<?= URL ?>games/add"  class="btn btn-success w-25 d-block m-auto">Ajouter un jeu</a>

<?php
$content = ob_get_clean();
$title = "Liste de jeux";
require_once "base.html.php";
?>