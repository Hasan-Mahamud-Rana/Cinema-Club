<span class="search">
  <a data-open="menuModalSearch">Søg</a>
</span>
<div class="full reveal menu-modal small-12 medium-12 large-12 columns" id="menuModalSearch" data-reveal data-animation-out="fade-out">
  <div class="row">
    <div class="small-12 medium-12 large-12 columns">
      <button class="close-button-menu" data-close aria-label="Close modal" type="button">
      <a class="crossText"></a>
      </button>
    </div>
    <div class="small-12 medium-12 large-12 columns">
		<form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
		  <label>
			<div class="inputStyle">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Indtast søgeord...', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Søge efter:', 'jointswp' ) ?>" autofocus>
			</div>
		  </label>
		  <div class="searchButton calculatedButton">
			<input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'SØG', 'jointswp' ) ?>" />
		  </div>
		</form>
    </div>
  </div>
</div>