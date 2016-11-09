<?php

/*
 * debug function
 */

function tab($arr){
    echo '<pre style="border: 1px solid #797979;background: #EEEEEE;font-size: 13px;max-width: 100%;display: block;">';
    print_r($arr);
    echo '</pre>';
}

/*
 * Function print class
 */

function print_class_if($view,$echo = true){

    switch($view){
        case 'mobile':
            $class = 'hidden-lg hidden-md hidden-sm';
            break;
        default:
            $class = "";
            break;
    }

    if($echo)
        echo $class;
    else
        return $class;
}

/*
 * Pulawska14 page builder
 */

function printPageBuilderSectionsByPageID($page_id, $echo = true){

    $pageBuilder = get_field('page_builder', $page_id);

    $HtmlOutput = '';

    $defaultSectionStart = function($color = '#FFFFFF',$id, $class = '' ,$full = false){
        return '<section id="'.$id.'" class="pageSection '.$class.( (!$full) ? ' notFull' : ' full').'" style="background-color: '.$color.'">' . ( (!$full) ? '<div class="page-wrap">' : '');
    };

    $defaultSectionEnd = function($full = false){
        return ( (!$full) ? '</div>' : '' ) . '</section>';
    };

    $rainbow = function($bg = false){
        $backgr = ($bg) ? ' style="background-image: url('.$bg.')"' : '';
        return '<div class="rainbow"><div><span'.$backgr.'></span><span'.$backgr.'></span><span'.$backgr.'></span><span'.$backgr.'></span><span'.$backgr.'></span><span'.$backgr.'></span><span'.$backgr.'></span></div></div>';
    };

    if(!empty($pageBuilder)):

        foreach($pageBuilder as $key => $pageSection):

            if(!empty($pageSection)):

                switch($pageSection['acf_fc_layout']){

                    case 'grafika_z_haslem':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ), '', true );

                        $sectionImage = wp_get_attachment_image_src( $pageSection['grafika'], 'heading-image', false );

                        $HtmlOutput .= '<div class="grafika_z_haslem" style="background-image: url('. ( (isset($sectionImage[0])) ? $sectionImage[0] : '' ) .');">';

                        $HtmlOutput .= '<div class="page-wrap"><div class="kwadrat"><mark></mark><mark></mark><mark></mark><mark></mark><div class="t"><div class="t-r"><div class="t-c"><h1>'.$pageSection['tytul'].'</h1><div class="desc">'.$pageSection['opis'].'</div></div></div></div></div>';

                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= $defaultSectionEnd(true);
                        break;

                    case 'grafika_tresc':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        $sectionImage = wp_get_attachment_image_src( $pageSection['grafika'], 'medium', false );
                        $sectionCol1Offset = "";
                        $sectionCol2Offset = "";
                        if($pageSection['polozenie'] == 'textright'){
                            $sectionCol1Offset = " col-lg-push-6 col-md-push-6 col-sm-push-6";
                            $sectionCol2Offset = " col-lg-pull-6 col-md-pull-6 col-sm-pull-6";
                        }

                        $HtmlOutput .= '<div class="grafika_tresc">';

                        $HtmlOutput .= '<div class="row">';

                        $HtmlOutput .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12'.$sectionCol1Offset.'">';
                        $HtmlOutput .= '<article><div class="t"><div class="t-r"><div class="t-c">';
                        $HtmlOutput .= '<h3 class="title withborder">'.$pageSection['tytul'].'</h3>';
                        $HtmlOutput .= $pageSection['tresc'];
                        $HtmlOutput .= '</div></div></div></article>';
                        $HtmlOutput .= '</div>';
                        $HtmlOutput .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12'.$sectionCol2Offset.'">';
                        $HtmlOutput .= '<div class="imgContainer"><img src="'. ( (isset($sectionImage[0])) ? $sectionImage[0] : '' ) .'" alt="'.$pageSection['tytul'].'" /></div>';
                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= '</div>';


                        $HtmlOutput .= $defaultSectionEnd();
                        break;

                    case 'grafika_z_tytulem':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ), '', true );

                        $sectionImage = wp_get_attachment_image_src( $pageSection['grafika'], 'heading-image', false );

                        $HtmlOutput .= '<div class="grafika_z_tytulem">';

                        $HtmlOutput .= '<div>' . $rainbow( $sectionImage[0] );

                        $HtmlOutput .= '<div class="page-wrap"><h2 class="title">'.$pageSection['tytul'].'</h2></div></div>';

                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= $defaultSectionEnd(true);
                        break;

                    case 'tekst':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ), 'textOnly' );

                        $HtmlOutput .= '<div class="tekst">';

                        $HtmlOutput .= $pageSection['tresc'];

                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= $defaultSectionEnd();
                        break;

                    case 'tabela':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        $rowsCount = count($pageSection['kolumna1_wiersze']);

                        $HtmlOutput .= '<div class="tabelaBox">';
                        $HtmlOutput .= '<div class="tabela">';

                        $HtmlOutput .= '<div class="t-r">';

                        for($i = 1; $i <= 5; $i++){

                            $HtmlOutput .= '<div class="t-c t-h t-h-'.$i.'">'.( (isset($pageSection['kolumna'.$i.'_tytul']) ) ? $pageSection['kolumna'.$i.'_tytul'] : '' ).'</div>';

                        }

                        $HtmlOutput .= '</div>';

                        for($r = 0; $r < $rowsCount; $r++){

                            $HtmlOutput .= '<div class="t-r">';

                            for($i = 1; $i <= 5; $i++){

                                $HtmlOutput .= '<div class="t-c t-r-'.$r.' t-c-'.$i.'">'.( (isset($pageSection['kolumna'.$i.'_wiersze'][$r]['tresc_w_wierszu']) ) ? $pageSection['kolumna'.$i.'_wiersze'][$r]['tresc_w_wierszu'] : '' ).'</div>';

                            }

                            $HtmlOutput .= '</div>';

                        }

                        $HtmlOutput .= '</div>';
                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= $defaultSectionEnd();
                        break;
                    case 'opis_i_cena':

                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        $HtmlOutput .= '<div class="opis_i_cena">';

                        $HtmlOutput .= '<div class="row">';

                        $HtmlOutput .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
                        $HtmlOutput .= '<article>';
                        $HtmlOutput .= '<h3 class="title withborder">'.$pageSection['tytul'].'</h3>';
                        $HtmlOutput .= $pageSection['tresc'];
                        $HtmlOutput .= '</article>';
                        $HtmlOutput .= '</div>';
                        $HtmlOutput .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
                        $HtmlOutput .= '<div class="pricebox" data-before="'.$pageSection['tekst_przed'].'" data-after="'.$pageSection['tekst_po'].'">'.$pageSection['cena'].'</div>';
                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= '</div>';


                        $HtmlOutput .= $defaultSectionEnd();
                        break;


                    case 'galeria_grafik':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        if(!empty($pageSection['galeria'])){

                            $HtmlOutput .= '<div class="galeria_grafik">';

                            $HtmlOutput .= '<div class="row">';

                            $columnWidth = 'col-lg-'.( 12 / $pageSection['liczba_kolumn'] ).' col-md-'.( 12 / $pageSection['liczba_kolumn'] ).' col-sm-'.( 12 / $pageSection['liczba_kolumn'] );

                            foreach($pageSection['galeria'] as $img){

                                $sectionImage = wp_get_attachment_image_src( $img['ID'], 'thumbnail', false );

                                $HtmlOutput .= '<div class="'.$columnWidth.' col-xs-12">';
                                $HtmlOutput .= '<div class="imgContainer"><a href="'.$img['url'].'" data-lightbox="Galeria" title="'.$img['description'].'"><img src="'. ( (isset($sectionImage[0])) ? $sectionImage[0] : '' ) .'" alt="" /></a></div>';
                                $HtmlOutput .= '</div>';

                            }

                            $HtmlOutput .= '</div>';

                            $HtmlOutput .= '</div>';

                        }
                        $HtmlOutput .= $defaultSectionEnd();
                        break;

                    case 'mapa':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        if(!empty($pageSection['map'])){

                            $HtmlOutput .= '<div class="mapa">';

                            $HtmlOutput .= '<div class="gMap" id="gMap" data-location=\''.json_encode($pageSection['map'],true).'\'></div>';

                            $HtmlOutput .= '</div>';

                        }
                        $HtmlOutput .= $defaultSectionEnd();
                        break;


                    case 'tresc_2_3__1_3':
                        $HtmlOutput .= $defaultSectionStart( ((isset($pageSection['kolor_tla'])) ? $pageSection['kolor_tla'] : '#FFFFFF') , ( ($key == 0) ? sanitize_title(get_the_title($page_id )) : 'section_'.$key.'_'.$page_id ) );

                        $HtmlOutput .= '<div class="tresc_2_3__1_3">';

                        $HtmlOutput .= '<div class="row">';

                        $HtmlOutput .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
                        $HtmlOutput .= '<article>';
                        $HtmlOutput .= $pageSection['tresc23'];
                        $HtmlOutput .= '</article>';
                        $HtmlOutput .= '</div>';
                        $HtmlOutput .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
                        $HtmlOutput .= '<article>';
                        $HtmlOutput .= $pageSection['tresc13'];
                        $HtmlOutput .= '</article>';
                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= '</div>';

                        $HtmlOutput .= $defaultSectionEnd();
                        break;
                }

            endif;

        endforeach;

    endif;

    if($echo)
        echo $HtmlOutput;
    else
        return $HtmlOutput;
}

/*
 * Function to Convert Youtube and Vimeo URLs to array with attributes
 */

class parseVideoUrl{

    public $video_url;
    public $video_type;
    public $video_cover;
    public $video_enbed_link;
    public $video_id;
    public $youtube_prefix = 'https://www.youtube.com/embed/';
    public $vimeo_prefix = '//player.vimeo.com/video/';
    public $youtube_sufix = '?showinfo=0&rel=0&playsinline=1&autohide=1';
    public $vimeo_sufix = '?api=1&player_id=player1&title=0&byline=0&portrait=0';



    public function set_url($url){
        $this->video_url = $url;
        if( $this->_is_youtube() ){
            $this->video_type = 'youtube';
            $this->video_id = $this->_youtube_video_id();
            $this->video_enbed_link = $this->youtube_prefix . $this->_youtube_video_id() . $this->youtube_sufix;
        }
        if( $this->_is_vimeo() ){
            $this->video_type = 'vimeo';
            $this->video_id = $this->_vimeo_video_id();
            $this->video_enbed_link = $this->vimeo_prefix . $this->_vimeo_video_id() . $this->vimeo_sufix;
        }
        $this->video_cover = $this->get_video_cover();

    }

    public function get_video_data($url){

        $this->set_url($url);

        $returnData = array(
            'type' => $this->video_type,
            'id' => $this->video_id,
            'enbed' => $this->video_enbed_link,

            'cover' => $this->video_cover
        );

        return $returnData;

    }

    public function _is_youtube()
    {
        return (preg_match('/youtu\.be/i', $this->video_url) || preg_match('/youtube\.com\/watch/i', $this->video_url));
    }

    public function _is_vimeo()
    {
        return (preg_match('/vimeo\.com/i', $this->video_url));
    }

    public function _youtube_video_id()
    {
        if($this->_is_youtube())
        {
            $pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
            preg_match($pattern, $this->video_url, $matches);
            if (count($matches) && strlen($matches[7]) == 11)
            {
                return $matches[7];
            }
        }

        return '';
    }

    public function _vimeo_video_id()
    {
        if($this->_is_vimeo())
        {
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            preg_match($pattern, $this->video_url, $matches);
            if (count($matches))
            {
                return $matches[2];
            }
        }

        return '';
    }

    public function get_video_cover(){

        $coverArr = array();

        if( $this->_is_youtube() ){
            $coverArr[] = 'http://img.youtube.com/vi/' . $this->_youtube_video_id() . '/0.jpg';
            $coverArr[] = 'http://img.youtube.com/vi/' . $this->_youtube_video_id() . '/2.jpg';
        }
        if( $this->_is_vimeo() ){

            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . $this->_vimeo_video_id() . ".php"));

            if (!empty($hash) && is_array($hash)) {
                $coverArr[] = $hash[0]['thumbnail_large'];
                $coverArr[] = $hash[0]['thumbnail_small'];

            }
        }

        return $coverArr;
    }
}