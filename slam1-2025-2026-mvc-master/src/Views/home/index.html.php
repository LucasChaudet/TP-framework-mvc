<?php
// Déclaration des variables pour la vue
/** @var $username string */
/** @var $rooms \App\Model\Room[] */
?>
<h1>Homepage</h1>
<?= $username; ?>

<ul>
  <?php foreach ($rooms as $room) : ?>
      <li>
        <h2>
          <?= $room->getName() ?>
        </h2>
        <span><?= $room->getCategory()->getName() ?></span>
      </li>
  <?php endforeach; ?>
</ul>
