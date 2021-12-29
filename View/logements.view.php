<?php ob_start();?>

<table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th>Titre</th>
      <th>adresse</th>
      <th>ville</th>
      <th>code postal</th>
      <th>surface</th>
      <th>prix</th>
      <th>photo</th>
      <th>type</th>
      <th colspan="4">description</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach( $logements as $logement ) : ?>
        <tr>
            <td><?= $logement->getTitre()?></td>
            <td><?= $logement->getAdresse()?></td>
            <td><?= $logement->getVille()?></td>
            <td><?= $logement->getCp()?></td>
            <td><?= $logement->getSurface()?></td>
            <td><?= $logement->getPrix()?></td>
            <td>
              <?php if($logement->getPhoto()) :?>
              <img src="../Images/<?=$logement->getPhoto()?>" class="img-thumbnail" alt="">
              <?php endif;?>
            </td>
            <td><?= $logement->getType()?></td>
            <td><?= $logement->getDescription()?></td>
            <td><a href="<?= URL ?>logement/edit/<?= $logement->getId_logement() ?>"><i class="fas fa-edit"></i></a></td>
            <td>
              <form action="<?= URL ?>logement/delete/<?= $logement->getId_logement() ?>" method="post" 
                            onSubmit=" return confirm('Êtes-vous certain de vouloir supprimer ce logement ?')">
                <button class="btn" type="submit"><i class="fas fa-trash"></i></button>
            </form>
            </td>
        </tr>      
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?= URL ?>logement/add"  class="btn btn-success w-25 d-block m-auto">Ajouter un Logement</a>

<?php
$content = ob_get_clean();
$title = "Liste des logements";
require_once "base.html.php";
?>