<?php

/**
 * WordPress Bootstrap Pagination
 */

function wp_bootstrap_pagination($args = array())
{

	$defaults = array(
		'range' => 4,
		'custom_query' => FALSE,
		'previous_string' => __('Trang trước', 'canhcamtheme'),
		'next_string' => __('Trang kế', 'canhcamtheme'),
		'before_output' => '<div class="wp-pagination">
	  <ul class="pager">',
		'after_output' => '</ul>
  </div>'
	);

	$args = wp_parse_args(
		$args,
		apply_filters('wp_bootstrap_pagination_defaults', $defaults)
	);

	$args['range'] = (int) $args['range'] - 1;
	if (!$args['custom_query'])
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page = intval(get_query_var('paged'));
	$ceil = ceil($args['range'] / 2);

	if ($count <= 1) return FALSE;
	if (!$page) $page = 1;
	if ($count > $args['range']) {
		if ($page <= $args['range']) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ($page >= ($count - $ceil)) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ($page >= $args['range'] && $page < ($count - $ceil)) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}
	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr(get_pagenum_link($previous));
	$firstpage = esc_attr(get_pagenum_link(1));

	if ($previous && (1 != $page))
		$echo .= '<li class="btn prev-page"><a href="' . $previous . '" title="' . __('Trước', 'canhcamtheme') . '">' . $args['previous_string'] . '</a></li>';
	if (!empty($min) && !empty($max)) {
		for ($i = $min; $i <= $max; $i++) {
			if ($page == $i) {
				$echo .= '<li class="active"><a href="javascript:;">' . sprintf('%2d', $i) . '</a></li>';
			} else {
				$echo .= sprintf('<li><a href="%s">%2d</a></li>', esc_attr(get_pagenum_link($i)), $i);
			}
		}
	}
	$next = intval($page) + 1;
	$next = esc_attr(get_pagenum_link($next));
	if ($next && ($count != $page))
		$echo .= '<li class="btn next-page"><a href="' . $next . '" title="' . __('Kế tiếp', 'canhcamtheme') . '">' . $args['next_string'] . '</a></li>';
	$lastpage = esc_attr(get_pagenum_link($count));
	if (isset($echo)) echo $args['before_output'] . $echo . $args['after_output'];
}



function pagination_ajax_custom($custom_query = null, $currentUrl = null, $params = null, $paged = 1)
{
	global $wp_query, $wp_rewrite;
	if ($custom_query) $main_query = $custom_query;
	else $main_query = $wp_query;
	$big = 999999999;
	$total = isset($main_query->max_num_pages) ? $main_query->max_num_pages : '';
	//if($total > 1) echo '<div class="wp-pagination mt-35px">';
	$pagination = paginate_links(array(
		'base'            => $currentUrl . "/{$wp_rewrite->pagination_base}/%#%/?" . $params,
		'format'           => '?paged=%#%',
		'current'          => max(1, $paged),
		'total'            => $total,
		'mid_size'         => '5',
		'type'              => 'array', //default it will return anchor
		'prev_next'     => false
	));


	if (!empty($pagination)) {

?>
		<div class="wp-pagination mt-35px">
			<ul class="pager list-item-added">
				<?php foreach ($pagination as $key => $page_link) :

				?>
					<li class="<?php $link = htmlspecialchars($page_link);
								$link = str_replace(' current', '', $link);
								if (strpos($page_link, 'current') !== false) {
									echo ' active';
								} ?> ">
						<?php if ($link) {
							$link = str_replace('page-numbers', 'page-link', $link);
							$link = str_replace('span', 'a href="javascript:voild(0);"', $link);
						}
						echo htmlspecialchars_decode($link);
						?>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
<?php }
}
