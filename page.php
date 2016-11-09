<?php get_header(); ?>
<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <?php printPageBuilderSectionsByPageID(get_the_ID()); ?>
    <?php endwhile; ?>
<?php endif; ?>
<script type="text/javascript">
    jQuery( document ).ready(function(){setCurrentMenuPage('<?php echo sanitize_title(get_the_title(get_the_ID())); ?>')});
</script>
<?php get_footer(); ?>