<?php
/**
 * searcform.php
 *
 * Wordpress search form.
 * ============================================ *
 */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   <div>
      <input type="hidden" name="post_type" class="search-type" value="post">
      <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="search-content" class="search-content" />
      <button type="submit" class="searchsubmit">
         <i class="zmdi zmdi-search"></i>
      </button>
   </div>
</form>