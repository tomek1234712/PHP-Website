<?php 
/*
 *  Elastic slider for custom post type
 *  Author: Lukas / Fresh IT Lab
 *  WWW: freshitlab.net
 */


define('ELASTICSLIDERS_TITLE_IN_MENU', "Przydział do widoku");
define('ELASTICSLIDERS_TITLE_ON_PAGE', "Ustawienia przydziału slajderów do poszczególnych stron");
define('ELASTICSLIDERS_UPDATED_NOICE', "Zmiany zostały pomyślnie zapisane");
define('ELASTICSLIDERS_BUTTON_SAVE', "Zapisz zmiany");
define('ELASTICSLIDERS_SLIDERS_NOT_FOUND', "Nie znalesiono sliderów.");


include_once 'inc-elastic-slider.php';

function slider_rel_panel(){
  add_submenu_page( 'edit.php?post_type=slider', ELASTICSLIDERS_TITLE_IN_MENU, ELASTICSLIDERS_TITLE_IN_MENU, 'manage_options', 'slider-relationship', 'wps_theme_func_settings');
}
add_action('admin_menu', 'slider_rel_panel');

add_action('admin_head', 'slider_rel_css');

function slider_rel_css() {
  echo '<style>
    #sliderreltables .title{font-weight: 600;}
    #sliderreltables table{width: 100%;
margin-bottom: 20px;}
    #sliderreltables tr th{text-align: left;
background: #333;
color: #FFF;}
    #sliderreltables tr td, #sliderreltables tr th{padding: 6px 5px;}
    #sliderreltables tr td:first-child, #sliderreltables tr th:first-child{width: 80%;}
    #sliderreltables tr:not(:first-child):nth-child(2n){background: #ccc;}
  </style>';
}

function wps_theme_func_settings(){

    if ( ! defined('ICL_LANGUAGE_CODE' ) ) {
        define('ICL_LANGUAGE_CODE', '');
    }


    $updateopt = false;
    
    if(isset($_POST['sl']) && !empty($_POST['sl'])){
        
        $updateopt = update_option( 'slider_relationships_'.ICL_LANGUAGE_CODE, $_POST['sl']);
        
    }

    $current_slider_rel = get_option( 'slider_relationships_'.ICL_LANGUAGE_CODE );

    $sliderTerms = get_terms('slider_cat' );
    

    $sliders = array();
    foreach ($sliderTerms as $value) {
        $sliders = array(
            'name' => $value->name,
            'slug' => $value->slug,
            'term_id' => $value->term_id,
        );
    }
    $namespaceExclude = array('post','page','attachment','revision','nav_menu_item','acf-field-group','acf-field','slider','post_tag','nav_menu','link_category','post_format','slider_cat','category','','','','','','');
    
    $post_types = get_post_types();
    $taxonomies = get_taxonomies();

?>
<h2><?php echo ELASTICSLIDERS_TITLE_ON_PAGE; ?></h2>
<?php
if($updateopt){
    echo '<div id="message" class="updated below-h2" style="margin-bottom: 19px;"><p>'.ELASTICSLIDERS_UPDATED_NOICE.'</p></div>';
}
?>
<?php if(!empty($sliders)): ?>
    <?php if(!empty($post_types)): ?>
<div id='sliderreltables'>
    <form action="" method="post">
    <table class="post_types">
        <tr>
            <th>Page type</th>
            <th>Slider</th>
        </tr>
        <?php foreach ($post_types as $key => $value): ?>
            <?php if(!in_array($key, $namespaceExclude)): ?>
            <tr>
                <td>
                    <span class='title'><?php 
                            $obj = get_post_type_object($key);
                            echo $obj->labels->singular_name;
                    ?></span>
                </td>
                <td>
                    <select name='sl[post_type][<?php echo $key;?>]'><?php 
                        echo "<option value='0' ";
                        if(!isset($current_slider_rel['post_type'][$key]) || (isset($current_slider_rel['post_type'][$key]) && $current_slider_rel['post_type'][$key] == 0) ){
                            echo "selected='selected'";
                        }
                        echo ">disabled</option>";
                        
                        foreach ($sliderTerms as $value) {
                            echo "<option value='".$value->term_id."'";
                            if(isset($current_slider_rel['post_type'][$key]) && $current_slider_rel['post_type'][$key] == $value->term_id ){
                                echo " selected='selected'";
                            }
                            echo ">".$value->name."</option>";
                        }
                    ?></select>
                </td>
            </tr>
            <?php endif;?>
        <?php endforeach; ?>
    </table>
    <?php endif;?>



    <?php if(!empty($taxonomies)): ?>
    <table class="taxonomies">
        <tr>
            <th>Taxonomies</th>
            <th>Slider</th>
        </tr>
        <?php foreach ($taxonomies as $key => $value): ?>
            <?php if(!in_array($key, $namespaceExclude)): ?>
            <tr>
                <td>
                    <span class='title'><?php 
                            $obj = get_taxonomy($key);
                            $oN = $obj->object_type;
                            $objp = get_post_type_object($oN[0]);
                            echo $objp->labels->singular_name;
                            echo " > ";
                            echo $obj->labels->singular_name;
                    ?></span>
                </td>
                <td>
                    <select name='sl[taxonomy][<?php echo $key;?>]'><?php 
                        echo "<option value='0' ";
                        if(!isset($current_slider_rel['taxonomy'][$key]) || (isset($current_slider_rel['taxonomy'][$key]) && $current_slider_rel['taxonomy'][$key] == 0) ){
                            echo "selected='selected'";
                        }
                        echo ">disabled</option>";
                        
                        foreach ($sliderTerms as $value) {
                            echo "<option value='".$value->term_id."'";
                            if(isset($current_slider_rel['taxonomy'][$key]) && $current_slider_rel['taxonomy'][$key] == $value->term_id ){
                                echo " selected='selected'";
                            }
                            echo ">".$value->name."</option>";
                        }
                    ?></select>
                </td>
            </tr>
            <?php endif;?>
        <?php endforeach; ?>
    </table>
    <?php endif;?>


    <?php if(!empty($taxonomies)): ?>
    <table class="taxonomies">
        <tr>
            <th>Taxonomy terms</th>
            <th>Slider</th>
        </tr>
        <?php foreach ($taxonomies as $key => $value): ?>
            <?php if(!in_array($key, $namespaceExclude)): ?>
            <?php $aTerms = get_terms($key); ?>
                <?php if(!empty($aTerms)): ?>
                    <?php foreach ($aTerms as $term_d): ?>
                        <tr>
                            <td>
                                <span class='title'><?php 
                                        $obj = get_taxonomy($key);
                                        $oN = $obj->object_type;
                                        $objp = get_post_type_object($oN[0]);
                                        echo $objp->labels->singular_name;
                                        echo " > ";
                                        echo $obj->labels->singular_name;
                                        echo " > ";
                                        echo $term_d->name;
                                ?></span>
                            </td>
                            <td>
                                <select name='sl[term][<?php echo $key;?>][<?php echo $term_d->term_id;?>]'><?php 
                                    echo "<option value='0' ";
                                    if(!isset($current_slider_rel['term'][$key][$term_d->term_id]) || (isset($current_slider_rel['term'][$key][$term_d->term_id]) && $current_slider_rel['term'][$key][$term_d->term_id] == 0) ){
                                        echo "selected='selected'";
                                    }
                                    echo ">disabled</option>";

                                    foreach ($sliderTerms as $value) {
                                        echo "<option value='".$value->term_id."'";
                                        if(isset($current_slider_rel['term'][$key][$term_d->term_id]) && $current_slider_rel['term'][$key][$term_d->term_id] == $value->term_id ){
                                            echo " selected='selected'";
                                        }
                                        echo ">".$value->name."</option>";
                                    }
                                ?></select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
            <?php endif;?>
        <?php endforeach; ?>
    </table>
    <?php endif;?>


    <?php if(!empty($taxonomies)): ?>
    <table class="taxonomies">
        <tr>
            <th>Taxonomy terms post</th>
            <th>Slider</th>
        </tr>
        <?php foreach ($taxonomies as $key => $value): ?>
            <?php if(!in_array($key, $namespaceExclude)): ?>
            <?php $aTerms = get_terms($key); ?>
                <?php if(!empty($aTerms)): ?>
                    <?php foreach ($aTerms as $term_d): ?>
        
                    <?php
                        $args = array(
                                
                                'post_status'		=> 'publish',
                                'posts_per_page'	=> -1,
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => $key,
                                                'field'    => 'term_id',
                                                'terms'    => $term_d->term_id,
                                        ),
                                ),
                        );
                        $the_query = new WP_Query( $args );
                        if ( $the_query->have_posts() ):
                            while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <tr>
                                    <td>
                                        <span class='title'><?php 
                                                $obj = get_taxonomy($key);
                                                $oN = $obj->object_type;
                                                $objp = get_post_type_object($oN[0]);
                                                echo $objp->labels->singular_name;
                                                echo " > ";
                                                echo $term_d->name;
                                                echo " > ";
                                                echo get_the_title();
                                        ?></span>
                                    </td>
                                    <td>
                                        <select name='sl[post][<?php echo get_the_ID(); ?>]'><?php 
                                            echo "<option value='0' ";
                                            if(!isset($current_slider_rel['post'][get_the_ID()]) || (isset($current_slider_rel['post'][get_the_ID()]) && $current_slider_rel['post'][get_the_ID()] == 0) ){
                                                echo "selected='selected'";
                                            }
                                            echo ">disabled</option>";

                                            foreach ($sliderTerms as $value) {
                                                echo "<option value='".$value->term_id."'";
                                                if(isset($current_slider_rel['post'][get_the_ID()]) && $current_slider_rel['post'][get_the_ID()] == $value->term_id ){
                                                    echo " selected='selected'";
                                                }
                                                echo ">".$value->name."</option>";
                                            }
                                        ?></select>
                                    </td>
                                </tr>
                        <?php endwhile;
                        endif;
                    ?>
                    <?php endforeach; ?>
                <?php endif;?>
            <?php endif;?>
        <?php endforeach; ?>
    </table>
    <?php endif;?>
        
    <table class="taxonomies">
        <tr>
            <th>Pages</th>
            <th>Slider</th>
        </tr>
        <?php
            $args = array(
                    'post_type'     => 'page',
                    'post_status'   => 'publish',
                    'posts_per_page'	=> -1,
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ):
                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <tr>
                        <td>
                            <span class='title'><?php 
                                    echo get_the_title();
                            ?></span>
                        </td>
                        <td>
                            <select name='sl[page][<?php echo get_the_ID(); ?>]'><?php 
                                echo "<option value='0' ";
                                if(!isset($current_slider_rel['page'][get_the_ID()]) || (isset($current_slider_rel['page'][get_the_ID()]) && $current_slider_rel['page'][get_the_ID()] == 0) ){
                                    echo "selected='selected'";
                                }
                                echo ">disabled</option>";

                                foreach ($sliderTerms as $value) {
                                    echo "<option value='".$value->term_id."'";
                                    if(isset($current_slider_rel['page'][get_the_ID()]) && $current_slider_rel['page'][get_the_ID()] == $value->term_id ){
                                        echo " selected='selected'";
                                    }
                                    echo ">".$value->name."</option>";
                                }
                            ?></select>
                        </td>
                    </tr>
            <?php endwhile;
            endif;
        ?>
    </table>
</table>
<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="<?php echo ELASTICSLIDERS_BUTTON_SAVE; ?>" accesskey="p">
</form>
</div>
<?php else: ?>
<?php echo ELASTICSLIDERS_SLIDERS_NOT_FOUND; ?>
<?php endif; ?>
<?php }