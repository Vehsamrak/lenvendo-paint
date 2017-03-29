<header>Lenvendo Paint</header>

<div class="image-box">
    <a href="<?= $createImageUrl ?>" class="button">Create New Image</a>

    <?php foreach ($imageUrl as $imageUrl) { ?>
        <a href="<?= $imageUrl ?>" class="image"></a>
    <?php } ?>
</div>
