<?php
/**
 * Project profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('camerproject:notfound');
	return true;
}

$camerproject = $vars['entity'];
$owner = $camerproject->getOwnerEntity();

if (!$owner) {
	// not having an owner is very bad so we throw an exception
	$msg = "Sorry, '" . 'project owner' . "' does not exist for guid:" . $camerproject->guid;
	throw new InvalidParameterException($msg);
}

?>
<div class="groups-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="groups-profile-icon">
			<?php
				// we don't force icons to be square so don't set width/height
				echo elgg_view_entity_icon($camerproject, 'large', array(
					'href' => '',
					'width' => '',
					'height' => '',
				)); 
			?>
		</div>
		<div class="groups-stats">
			<p>
				<b><?php echo elgg_echo("camerproject:owner"); ?>: </b>
				<?php
					echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));
				?>
			</p>
			<p>
			<?php
				$num_members = $camerproject->getMembers(array('count' => true));
				echo elgg_echo('camerproject:members') . ": " . $num_members;
			?>
			</p>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php
			echo elgg_view('groups/profile/fields', $vars);
		?>
	</div>
</div>
