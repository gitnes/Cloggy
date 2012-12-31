<div id="cloggy-dashboard">

	<div class="container">

		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="<?php echo $this->request->here; ?>">Cloggy</a>
				<ul class="nav">					
					<?php $menus = $this->CloggyMenus->menu('cloggy'); ?>
					<?php if(!empty($menus)) : ?>						
						<?php foreach($menus as $menu => $link) :?>
						<li><?php echo $this->CloggyMenus->getLink($menu,$link); ?></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>			
				<form class="navbar-search pull-right" id="form-search">
					<input type="text" id="module_q" class="search-query" placeholder="Search">
				</form>
			</div>			
		</div>	

		<div class="row">
			<div class="span2">
				<ul class="nav nav-tabs nav-stacked">					
					<?php $menus = $this->CloggyMenus->menu('cloggy_sidebar'); ?>
					<?php if(!empty($menus)) : ?>
						<li class="nav-header"><?php echo $cloggy_sidebar_title;?></li>
						<?php foreach($menus as $menu => $link) :?>
						<li><?php echo $this->CloggyMenus->getLink($menu,$link); ?></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="span10">

				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Module Name</th>
							<th>Description</th>
							<th>Author</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($modules) && !empty($modules)) : ?>
							<?php foreach($modules as $module) :?>
							<tr>
								<td>
									<a href="<?php echo Router::url('/'.Configure::read('Cloggy.url_prefix').'/module/'.Inflector::underscore($module['name'])); ?>">
										<?php echo $module['name']; ?>
									</a>
								</td>
								<td><?php echo $module['desc']; ?></td>
								<td><?php echo $module['author'];?></td>
							</tr>						
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5">No modules registered</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

</div>

<?php echo $this->start('cloggy_js_main'); ?>
<script type="text/javascript">
	var cloggy = new CloggyYepNope();  
	
	cloggy.setHost({
		bootstrap: '<?php echo $this->CloggyAsset->getVendorUrl('bootstrap/css/bootstrap.min.css'); ?>',
		bootstrapJs: '<?php echo $this->CloggyAsset->getVendorUrl('bootstrap/js/bootstrap.min.js'); ?>',
		jquery: '<?php echo $this->CloggyAsset->getVendorUrl('jquery-1.8.3.js'); ?>',	
	});
	
	cloggy.main(function() {
		
		//set host
		var host = '<?php echo Router::url('/'.Configure::read('Cloggy.url_prefix').'/'.Configure::read('Cloggy.theme_used').'/',true); ?>';
		
		/*
		inject global + login css
		*/
		yepnope.injectCss(host+'app/css/style.global.css');							
		
		//manipulate dom
		jQuery(document).ready(function() {
			jQuery('body').css('margin-top','40px');			
			
			/*
			search on page
			*/
			jQuery('#form-search').on('submit',function(e) {
				
				e.preventDefault();
				var q = jQuery('#module_q').val();
				jQuery('td').removeAttr('style');
				jQuery('td:contains("'+q+'")').css('background-color','#F2F0F0');
				
			});		
											
		});
		
	});			
</script>
<?php echo $this->end(); ?>