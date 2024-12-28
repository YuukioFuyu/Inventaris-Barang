{php_tag_open}
<?php if (get_option('landing_page_id') == 'default'): ?>
$route['default_controller'] = 'web';
<?php else: ?>
$route['default_controller'] = 'page/landing';
<?php endif; ?>