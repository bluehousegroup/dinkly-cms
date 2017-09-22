<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">View Analytics <span class="loading" style="display: none;"></span></h2>
			</div>
			<div class="content-body scrollable">
				<div class="block">
					<div class="pad">
						<?php if(isset($noAuth) && $noAuth): ?>
							<div class="block">
								<div class="pad">
									Google Analytics is not currently enabled. Please contact help@fourtopper.com and request it be enabled.
								</div>
							</div>
						<?php else: ?>
								<h3>Your Website Stats for the Last Thirty Days</h3>
						<?php endif; ?>
					</div>
				</div>
				<?php if(isset($siteUrl)): ?>
				<div class="block">
					<div class="pad">
						<div class="column-left">
							<div class="block">
								<div class="pad">
									<h4>Visits to <?= $siteUrl ?> by Month</h4>
									<br />
									<canvas id="canvas" height="330" width="430" style="width: 100%; height: 330px;"></canvas>
									<div class="ga-legend">
										<h5>Legend</h5>
										<div>
											<i style="background-color:rgba(220,220,220,0.5);border:1px solid rgba(220,220,220,1);"></i><span>Page Views</span>
										</div>
										<div>
											<i style="background-color:rgba(151,187,205,0.5);border:1px solid rgba(151,187,205,1);"></i><span>Visitors</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-right" >
							<div class="block" style="min-height:416px">
								<div class="pad">
									<h4>Stats</h4>
									Total Visits:
									<?= (isset($totalVisitors) ? $totalVisitors : "Not Available") ?>
									<br/>

									New Visitors:
									<?= (isset($newVisitors) ? $newVisitors . "%" : "Not Available") ?>
									<br/>

									Mobile Visitors:
									<?= (isset($mobileVisitors) ? $mobileVisitors . "%" : "Not Available") ?>

									<br/><br/>

									<!-- Locations -->
									<?php if (isset($locations)): ?>
										<h4>Top Locations</h4>
										<table class="table">
											<thead>
												<tr>
													<?php foreach ($locations['headers'] as $header): ?>
														<th><?= $header ?></th>
													<?php endforeach; ?>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($locations['rows'] as $row): ?>
													<tr>
														<?php foreach ($row as $value): ?>
															<td><?= $value ?></td>
														<?php endforeach; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="pad">
						<div class="column-left">
							<div class="block">
								<div class="pad">
									<!-- Referrers -->
									<?php if (isset($referrers)): ?>
										<h4>Top Referrers</h4>
										<table class="table">
											<thead>
												<tr>
													<?php foreach ($referrers['headers'] as $header): ?>
														<th><?= $header ?></th>
													<?php endforeach; ?>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($referrers['rows'] as $row): ?>
													<tr>
														<?php foreach ($row as $value): ?>
															<td><?= $value ?></td>
														<?php endforeach; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="column-right">
							<div class="block">
								<div class="pad">
									<!-- Top Content -->
									<?php if (isset($topContent)): ?>
										<h4>Top Content</h4>
										<table class="table">
											<thead>
												<tr>
													<?php foreach ($topContent['headers'] as $header): ?>
														<th><?= $header ?></th>
													<?php endforeach; ?>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($topContent['rows'] as $row): ?>
													<tr>
														<?php foreach ($row as $value): ?>
															<td><?= $value ?></td>
														<?php endforeach; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									<?php endif; ?>
								</div>		
							</div>
						</div>
					</div>
					<?php //echo '<pre>'; print_r($month_visitors); die(); ?>
				</div>
				<?php else: ?>
				<div class="block">
					<div class="pad">
						Analytics are not available for this site.
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script>
	var lineChartData = {
		labels : [<?= $chart_months ?>],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "rgba(220,220,220,1)",
				pointStrokeColor : "#fff",
				label : "Page Views",
				data : [<?= $month_pageviews ?>]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,1)",
				pointColor : "rgba(151,187,205,1)",
				pointStrokeColor : "#fff",
				data : [<?= $month_visitors ?>]
			}
		]
		
	}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
</script>