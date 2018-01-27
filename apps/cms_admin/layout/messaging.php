<div class="mt-4">
    <?php if(DinklyFlash::exists('success')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo DinklyFlash::get('success'); ?>
        </div>
    <?php endif; ?>
    <?php if(DinklyFlash::exists('error')): ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo DinklyFlash::get('error'); ?>
        </div>
    <?php endif; ?>
    <?php if(DinklyFlash::exists('errors')): ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                <?php foreach(DinklyFlash::get('errors') as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>