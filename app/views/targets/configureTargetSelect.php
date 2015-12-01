<div id="workspace">
	<div class="container">
		<div id='configure_target_select'>
			<div class='panel panel-default'>
				<ol class='panel-heading breadcrumb'>
					<li><a href='#'>Targets</a></li>
					<li class='active'>Configure</li>
				</ol>
				<div class='panel-body'>
					<select id="targetSelect" data-live-search="true" data-width="100%" title="Select a target to configure" data-size="10">
						<?php foreach ($data['targets'] as $target) { ?>
							<option <?php if (isset($target['lun'])) { echo "data-subtext=\"" . count($target['lun']) . " lun/s\""; } ?>
								<?php if ($target['iqn'] === $data['iqn']) echo 'selected'?> value="<?php echo htmlspecialchars($target['iqn']); ?>"><?php echo htmlspecialchars($target['iqn']); ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div id="configureTargetMenu"></div>
	<div id='configureTargetBody'></div>
	<script>
		require(['common'],function() {
			require(['pages/target/configureTarget', 'domReady'],function(methods, domReady) {
				domReady(function () {
					methods.addEventHandler();
					methods.initialLoad();
				});
			});
		});
	</script>
</div>