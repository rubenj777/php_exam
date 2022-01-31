<form action="?type=velo&action=new" method="post" class="d-flex flex-column w-25">
    <input type="text" name="name" placeholder="name" class="mb-2" value="">
    <input type="text" name="image" placeholder="image" class="mb-2" value="">
    <input type="text" name="price" placeholder="price" class="mb-2" value="">
    <textarea name="description" id="" cols="30" rows="10" value="" placeholder="description" class=" mb-2"></textarea>
    <button type="submit" class="btn btn-success" value="<?= $velo->id ?>">Enregistrer</button>
</form>