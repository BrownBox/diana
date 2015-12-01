<?php

echo '<article class="small-24 medium-15 large-17 columns">'."\n";
echo '	<h1>'.strtoupper( get_the_title()).'</h1>'."\n";
while ( have_posts() ) : the_post();
the_content();
endwhile;
echo '	</article>'."\n";
echo '	<aside class="small-24 medium-9 large-7 columns">'."\n";
get_sidebar();
echo '	</aside>'."\n";
