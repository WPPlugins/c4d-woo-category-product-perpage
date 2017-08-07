<?php 
	$options = array(
		array('text' => esc_html__('3', 'c4d-woo-cpp'), 'value' => '3'),
		array('text' => esc_html__('6', 'c4d-woo-cpp'), 'value' => '6'),
		array('text' => esc_html__('9', 'c4d-woo-cpp'), 'value' => '9'),
		array('text' => esc_html__('12', 'c4d-woo-cpp'), 'value' => '12'),
		array('text' => esc_html__('15', 'c4d-woo-cpp'), 'value' => '15')
		);
	$selected = isset($_GET['product_perpage']) ? esc_attr($_GET['product_perpage']) : 6;
?>
<form class="c4d-woo-cpp-form" action="">
	<select name="product_perpage">
		<?php foreach ($options as $option): ?>
			<?php 
				$checked = '';
				if ($selected == $option['value']) {
					$checked = 'selected="selected"';
				}
			?>
			<option <?php echo $checked; ?> value="<?php esc_attr_e($option['value']); ?>"><?php echo $option['text']; ?></option>
		<?php endforeach; ?>
	</select>
</form>