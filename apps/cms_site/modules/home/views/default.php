<?php if($single_page_layout): ?>
	<?php foreach($template_files as $page_title => $template_file): ?>
		<?php $settings['page_title'] = $page_title; ?>
		<?php include_once('../web/designs/'.$settings['design_code'].'/html/'.$template_file); ?>
	<?php endforeach; ?>
<?php else: ?>
	<?php include_once('../web/designs/'.$settings['design_code'].'/html/'.$template_file); ?>
<?php endif; ?>