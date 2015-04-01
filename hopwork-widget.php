<?php
/*
  Plugin Name: Hopwork widget
  Plugin URI: https://copier-coller.com/hopwork-widget
  Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=43XMASQSUE4YE
  Description: A widget to display your hopwork profile.
  Version: 1.1
  Author: Matthieu Solente
  Author URI: https://copier-coller.com
  License: GPL2
 */

class Hopwork_widget extends WP_Widget {
 
    //Constructeur
    function Hopwork_widget()
    {
        parent::WP_Widget(false, $name = 'Mon Profil Hopwork', array('name' => 'Mon Profil Hopwork', 'description' => 'Affichage du profil'));
    }


    function widget($args, $instance)
    {
      
            //Récupération des paramètres
            extract($args);
            $title      = apply_filters('widget_title', $instance['title']);
            $profil     = $instance['profil'];
            $dataid     = $instance['dataid'];
            $picture    = $instance['picture'];
            $tags       = $instance['tags'];
            $recos      = $instance['recos'];    
            $height     = $instance['height'];
            $style      = $instance['style'];
            $width      = $instance['width'];
            
            $args       = array(
		'profil' 	=> $profil,
                'dataid' 	=> $dataid, 
                'picture'       => $picture,
                'tags'          => $tags,
                'recos'          =>$recos,
                'height' 	=> $height,
                'style' 	=> $style,
                'width' 	=> $width,	
		);
            
            //Affichage
            echo $before_widget;
            if (isset($title))
                echo $before_title . $title . $after_title;
            else
                echo $before_title . 'Mon profil Hopwork' . $after_title;
                 
            echo '<div>';
            echo' <a class="hopwork_widget" href="https://www.hopwork.com/profile/" '.$profil.' " data-id=" '.$dataid.' " data-picture="'.$picture.'" data-tags="'.$tags.'" data-recos="'.$recos.'" data-height="'.$height.'" data-style="'.$style.'" data-width=" '.$width.'">Voir mon profil freelance</a>';
            echo '</div>';
            echo $after_widget?>
                     <script type="text/javascript"> 
                    (function(d,id) { 
                    if (d.getElementById(id)) return;
                    var s = d.createElement('script'); 
                    var c = d.getElementsByTagName('script')[0]; 
                    s.type = 'text/javascript'; 
                    s.async = true; 
                    s.src = 'https://widgets.hopwork.com/1.0.0/js/sdk.wgt.min.js'; 
                    c.parentNode.insertBefore(s, c); 
                    })(document,'hopwork-sdkjs-wgt'); 
                    </script>
        
<?php    }
 
    //Mise à jour des paramètres du widget
    
/*    deux paramètres : son titre affiché et le nombre d’articles à inclure.
 *  La méthode suivante permet de modifier ces deux paramètres :* /
 A chaque création ou mise à jour d’une instance de notre widget, la méthode enregistre dans la base 
 * de données du blog le titre et le nombre d’articles de l’instance.*/
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
 
        //Récupération des paramètres envoyés
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['profil'] =  strip_tags($new_instance['profil']);
        $instance['style'] =  strip_tags($new_instance['style']);
        $instance['picture'] =  strip_tags($new_instance['picture']);
        $instance['tags'] =  strip_tags($new_instance['tags']);
        $instance['recos'] =  strip_tags($new_instance['recos']);
        $instance['dataid'] =  strip_tags($new_instance['dataid']);
        $instance['height'] =  strip_tags($new_instance['height']);
        $instance['width'] =  strip_tags($new_instance['width']);
        return $instance;
    }
 
    //Affichage des paramètres du widget dans l'admin
/*     la méthode form() permet d’afficher le formulaire dans l’interface d’administration de WordPress **/ 
   /*On commence par récupérer les valeurs actuelles des options, puis on les affiche dans les champs correspondants. Pour cela, deux méthodes de la classe WP_Widget vont être utilisée : 
    * get_field_id() pour récupérer l’ID du paramètre, et get_field_name() pour son nom.*/ 
    function form($instance)
    {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $profil = isset( $instance['profil'] ) ? esc_attr( $instance['profil'] ) : '';
        $style= isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : '';
        $dataid = isset( $instance['dataid'] ) ? esc_attr( $instance['dataid'] ) : '';
        $picture = isset( $instance['picture'] ) ? esc_attr( $instance['picture'] ) : '';
        $tags = isset( $instance['tags'] ) ? esc_attr( $instance['tags'] ) : '';
        $recos = isset( $instance['recos'] ) ? esc_attr( $instance['recos'] ) : '';
        $height = isset( $instance['height'] ) ? esc_attr( $instance['height'] ) : '';
        $width = isset( $instance['width'] ) ? esc_attr( $instance['width'] ) : '';
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'Titre:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('profil'); ?>">
                <?php echo 'Votre profil:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('profil'); ?>" name="<?php echo $this->get_field_name('profil'); ?>" type="text" value="<?php echo $profil; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('dataid'); ?>">
                <?php echo 'Votre data ID:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('dataid'); ?>" name="<?php echo $this->get_field_name('dataid'); ?>" type="text" value="<?php echo $dataid; ?>" />
            </label>
        </p>
        <p> 
        <?php echo 'Style du widget:'; ?>
            <label for="<?php echo $this->get_field_name('style'); ?>">
                    <?php _e('dark'); ?>
                    <input class="" id="<?php echo $this->get_field_id('dark'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="dark" <?php if($style === 'dark'){ echo 'checked="checked"'; } ?> />
            </label>
            <label for="<?php echo $this->get_field_name('style'); ?>">
                    <?php _e('light'); ?>
                    <input class="" id="<?php echo $this->get_field_id('light'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="light" <?php if($style === 'light'){ echo 'checked="checked"'; } ?> />
            </label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id('picture'); ?>" name="<?php echo $this->get_field_name('picture'); ?>" type="checkbox" value="true" <?php checked( 'true', $picture ); ?>/>
          <label for="<?php echo $this->get_field_id('picture'); ?>"><?php _e('Photo du profil?'); ?></label>
        </p>
        
        <p>
          <input id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" type="checkbox" value="true" <?php checked( 'true', $tags ); ?>/>
          <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Competences du profil?'); ?></label>
        </p>
        
        <p>
          <input id="<?php echo $this->get_field_id('recos'); ?>" name="<?php echo $this->get_field_name('recos'); ?>" type="checkbox" value="true" <?php checked( 'true', $recos ); ?>/>
          <label for="<?php echo $this->get_field_id('recos'); ?>"><?php _e('Recommandations du profil?'); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>">
                <?php echo 'Hauteur du widget:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>">
                <?php echo 'Largeur du widget:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
            </label>
        </p>

    <?php
    }
}

class Hopwork_button extends WP_Widget {
 
    //Constructeur
    function Hopwork_button()
    {
        parent::WP_Widget(false, $name = 'Mon Boutton Hopwork', array('name' => 'Mon Boutton Hopwork', 'description' => 'Affichage du boutton Hopwork'));
    }


    function widget($args, $instance)
    {
      
            //Récupération des paramètres
          extract($args);
            $title          = apply_filters('widget_title', $instance['title']);
            $profil         = $instance['profil'];
            $dataid         = $instance['dataid'];
            $datawidth      = $instance['datawidth'];
            $datalayout     = $instance['datalayout'];
            $datacolor      = $instance['datacolor'] ;
            $datarecos = $instance ['datarecos'];
            $args           = array(
		'profil' 	=> $profil,
                'dataid' 	=> $dataid, 
                'datawidth' 	=> $datawidth,
                'datalayout'    => $datalayout,
                'datacolor'     => $datacolor,
                'datarecos'     => $datarecos
		);
              
            //Affichage
            echo $before_widget;
            if (isset($title))
                echo $before_title . $title . $after_title;
            else
                echo $before_title . 'Mon profil Hopwork' . $after_title;
                 
            echo '<div>';
            echo' <a href="https://www.hopwork.com/profile/"'.$profil.'" data-id="'.$dataid.'" class="hopwork_button" data-width="'.$datawidth.'" data-layout="'.$datalayout.'" data-recos="'.$datarecos.'" data-bgrecos="clear" data-colorscheme="'.$datacolor.'">Mon Profil Hopwork!</a>';
            echo '</div>';
            echo $after_widget?>
               <script type="text/javascript"> 
                (function(d,id) { 
                if (d.getElementById(id)) return;
                var s = d.createElement('script'); 
                var c = d.getElementsByTagName('script')[0]; 
                s.type = 'text/javascript'; 
                s.async = true; 
                s.src = 'https://widgets.hopwork.com/1.0.0/js/sdk.min.js'; 
                c.parentNode.insertBefore(s, c); 
                })(document,'hopwork-sdkjs-btn'); 
                </script>
        
<?php    }
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        //Récupération des paramètres envoyés
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['profil'] =  strip_tags($new_instance['profil']);
        $instance['dataid'] =  strip_tags($new_instance['dataid']);
        $instance['datawidth'] =  strip_tags($new_instance['datawidth']);
        $instance['datalayout'] =  strip_tags($new_instance['datalayout']);
        $instance['datacolor'] =  strip_tags($new_instance['datacolor']);
        $instance['datarecos'] =  strip_tags($new_instance['datarecos']);
        return $instance;
    }

    function form($instance)
    {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
         $profil = isset( $instance['profil'] ) ? esc_attr( $instance['profil'] ) : '';
       
        $dataid = isset( $instance['dataid'] ) ? esc_attr( $instance['dataid'] ) : '';
        $datawidth = isset( $instance['datawidth'] ) ? esc_attr( $instance['datawidth'] ) : '';
        $datalayout = isset( $instance['datalayout'] ) ? esc_attr( $instance['datalayout'] ) : '';
        $datacolor = isset( $instance['datacolor'] ) ? esc_attr( $instance['datacolor'] ) : '';
        $datarecos = isset( $instance['datarecos'] ) ? esc_attr( $instance['datarecos'] ) : '';
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'Titre:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('profil'); ?>">
                <?php echo 'Votre profil:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('profil'); ?>" name="<?php echo $this->get_field_name('profil'); ?>" type="text" value="<?php echo $profil; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('dataid'); ?>">
                <?php echo 'Votre data ID:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('dataid'); ?>" name="<?php echo $this->get_field_name('dataid'); ?>" type="text" value="<?php echo $dataid; ?>" />
            </label>
        </p>
        <p> 
        <?php echo 'largeur du boutton:&nbsp;'; ?>
            <label for="<?php echo $this->get_field_name('datawidth'); ?>">
                    <?php _e('small'); ?>
                    <input class="" id="<?php echo $this->get_field_id('small'); ?>" name="<?php echo $this->get_field_name('datawidth'); ?>" type="radio" value="small" <?php if($datawidth === 'small'){ echo 'checked="checked"'; } ?> />
            </label>
            <label for="<?php echo $this->get_field_name('datawidth'); ?>">
                    <?php _e('big'); ?>
                    <input class="" id="<?php echo $this->get_field_id('big'); ?>" name="<?php echo $this->get_field_name('datawidth'); ?>" type="radio" value="big" <?php if($datawidth === 'big'){ echo 'checked="checked"'; } ?> />
            </label>
        </p>
       
        
            <p> 
        <?php echo 'Layout du boutton:&nbsp;'; ?>
            <label for="<?php echo $this->get_field_name('datalayout'); ?>">
                    <?php _e('scare'); ?>
                    <input class="" id="<?php echo $this->get_field_id('scare'); ?>" name="<?php echo $this->get_field_name('datalayout'); ?>" type="radio" value="scare" <?php if($datalayout === 'scare'){ echo 'checked="checked"'; } ?> />
            </label>
            <label for="<?php echo $this->get_field_name('datalayout'); ?>">
                    <?php _e('basic'); ?>
                    <input class="" id="<?php echo $this->get_field_id('basic'); ?>" name="<?php echo $this->get_field_name('datalayout'); ?>" type="radio" value="basic" <?php if($datalayout === 'basic'){ echo 'checked="checked"'; } ?> />
            </label>
                
                 <label for="<?php echo $this->get_field_name('datalayout'); ?>">
                    <?php _e('round'); ?>
                    <input class="" id="<?php echo $this->get_field_id('round'); ?>" name="<?php echo $this->get_field_name('datalayout'); ?>" type="radio" value="round" <?php if($datalayout === 'round'){ echo 'checked="checked"'; } ?> />
            </label>
        </p>
       
         <p> 
        <?php echo 'Couleur du boutton:&nbsp;'; ?>
            <label for="<?php echo $this->get_field_name('datacolor'); ?>">
                    <?php _e('blue'); ?>
                    <input class="" id="<?php echo $this->get_field_id('blue'); ?>" name="<?php echo $this->get_field_name('datacolor'); ?>" type="radio" value="blue" <?php if($datacolor === 'blue'){ echo 'checked="checked"'; } ?> />
            </label>
            <label for="<?php echo $this->get_field_name('datacolor'); ?>">
                    <?php _e('orange'); ?>
                    <input class="" id="<?php echo $this->get_field_id('orange'); ?>" name="<?php echo $this->get_field_name('datacolor'); ?>" type="radio" value="orange" <?php if($datacolor === 'orange'){ echo 'checked="checked"'; } ?> />
            </label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id('datarecos'); ?>" name="<?php echo $this->get_field_name('datarecos'); ?>" type="checkbox" value="true" <?php checked( 'true', $datarecos ); ?>/>
          <label for="<?php echo $this->get_field_id('datarecos'); ?>"><?php _e('Recommandations du profil?'); ?></label>
        </p>
        
    <?php
    }
}

    function register_Hopwork_widget() {
        register_widget( 'Hopwork_widget' );
        register_widget('Hopwork_button');
    }
    add_action('widgets_init', 'register_Hopwork_widget');

