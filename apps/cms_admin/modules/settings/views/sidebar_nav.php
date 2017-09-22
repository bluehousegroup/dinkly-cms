<ul class="nav nav-pills nav-stacked">
	<li <?php echo ($this->getCurrentView() == 'general') ? 'class="active"' : ''; ?>><a href="/site_admin/settings/general"><i class="icon icon-info-sign"></i> General Information</a></li>
	<li <?php echo ($this->getCurrentView() == 'address') ? 'class="active"' : ''; ?>><a href="/site_admin/settings/address"><i class="icon icon-map-marker"></i> Address &amp; Mapping</a></li>
	<li <?php echo ($this->getCurrentView() == 'analytics') ? 'class="active"' : ''; ?>><a href="/site_admin/settings/analytics"><i class="icon icon-bar-chart"></i> Tracking &amp; Analytics</a></li>
	<li <?php echo ($this->getCurrentView() == 'seo') ? 'class="active"' : ''; ?>><a href="/site_admin/settings/seo"><i class="icon icon-search"></i> Global SEO</a></li>
</ul>