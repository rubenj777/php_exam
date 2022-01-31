<div class="mt-3 mb-5 p-3 card">
    <h2><?= $velo->getName() ?></h2>
    <img src="<?= $velo->getImage() ?>" alt="">
    <p><?= $velo->getDescription() ?></p>
    <p><?= $velo->getPrice() ?>€</p>
    <div class="d-flex">
        <a class="btn btn-info w-25 me-2" href="?type=velo&action=edit&id=<?= $velo->getId() ?>">Modifier le vélo</a>
        <form action="?type=velo&action=delete" method="post">
            <button type="submit" name="id" value="<?= $velo->getId() ?>" class="btn btn-danger">Supprimer le vélo</button>
        </form>
    </div>
</div>

<!-- ici le formulaire et l'affichage des avis -->

<?php if (!$avis) { ?>
    <p>Soyez le premier à donner votre avis sur le <?= $velo->getName() ?> </p>
<?php } ?>

<form class="" action="?type=avis&action=new" method="post">
    <div class="form-group mb-2">
        <input type="text" name="author" id="" placeholder="Votre nom">
    </div>
    <div class="form-group mb-2">
        <textarea type="text" name="content" id="" placeholder="Votre avis"></textarea>
    </div>
    <div class="form-group mb-2">
        <button type="submit" name="id" value="<?= $velo->getId() ?>" class="btn btn-success">Poster</button>
    </div>
</form>

<?php foreach ($avis as $unAvis) { ?>
    <div class="row p-2 mt-2 mb-2 card">
        <h5><?= $unAvis->getAuthor() ?></h5>
        <p><?= $unAvis->getContent() ?></p>
        <div class="d-flex">
            <a class="btn btn-info w-25 me-2" href="?type=avis&action=edit&id=<?= $unAvis->getId() ?>">Modifier l'avis</a>
            <form action="?type=avis&action=delete" method="post">
                <button type="submit" name="id" value="<?= $unAvis->getId() ?>" class="btn btn-warning">Supprimer l'avis</button>
            </form>
        </div>
    </div>
<?php } ?>