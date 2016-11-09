<?php get_header(); ?>
<?php

    $sectionOrder = get_field('rozmieszczenie_sekcji','option');
    if(!empty($sectionOrder)):

        foreach($sectionOrder as $page_id):

            printPageBuilderSectionsByPageID($page_id);

        endforeach;

    endif;

?>
<?php get_footer(); ?>