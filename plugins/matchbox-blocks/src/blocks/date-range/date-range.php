<?php
/**
 * Renders ACF dates in a range.
 *
 * @package MatchboxBlocks
 */

// phpcs:disable

echo '<!-- Render template loaded: kindling/date-range -->';

// Support custom "anchor" values.
$anchor = '';
if (! empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'mwb-date-range';
if (! empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (! empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

$dates = get_field( 'dates', get_the_ID() );
$date_start = $dates['date_start'];
$date_end = $dates['date_end'];

?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>">
  <div class="date-range__dates">
	<span class="date-range__date-start">
		<?php
		$date_obj = DateTime::createFromFormat( 'd/m/Y', $date_start ); // current format is day/month/year
		if ( $date_obj ) {
			echo $date_obj->format( 'F j, Y' ); // → April 25, 2025
		}
		?>
	</span>
	-
	<span class="date-range__date-end">
		<?php
		$date_obj = DateTime::createFromFormat( 'd/m/Y', $date_end ); // current format is day/month/year
		if ( $date_obj ) {
			echo $date_obj->format( 'F j, Y' ); // → April 25, 2025
		}
		?>
	</span>
  </div>
  <div class="date-range__content">
	<?php echo $content; ?>
  </div>
</div>
