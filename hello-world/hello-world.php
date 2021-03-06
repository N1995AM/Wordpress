<?php
/**
 *Plugin Name: Hello world 
 *Description: This is the first Plugin
*/
    function hello_world_function(){
        $information = "This is very basic plugin";
        return $information;
    }
    add_shortcode('example', 'hello_world_function');

    function hell_world_admin_menu_option(){
        add_menu_page('Header & Footer Scripts', 'Site Scripts', 'manage_options', 'helloworld-admin-menu',  'hello_world_script_page', '', 200);
    }

    add_action('admin_menu', 'hell_world_admin_menu_option'); 

    function hello_world_script_page(){
        if( array_key_exists('submit_scripts_update', $_POST)){
            update_option('helloworld_header_scripts', $_POST['header_scripts']);
            update_option('helloworld_footer_scripts', $_POST['footer_scripts']);

            ?>
            <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Settings have been saved.</strong></div>
            <?php
        }

        $header_scripts = get_option('helloworld_header_scripts','none');
        $footer_scripts = get_option('helloworld_footer_scripts','none');
        ?>
        <div class="wrap">
            <h2> Update Scripts </h2>
            <form method="post" action="">
                    <label for="header_scripts"> Header Scripts </label>
                    <textarea name="header_scripts" class="large-text"><?php echo $header_scripts?></textarea>
                    <label for="footer_scripts"> Footer Scripts </label>
                    <textarea name="footer_scripts" class="large-text"><?php echo $footer_scripts?></textarea>
                    <input type="submit" name="submit_scripts_update" class="button button-primary" value="Save Changes"/>
            </form>
        </div>
        <?php
    }

    function hello_world_display_header_scripts(){
        $header_scripts = get_option('helloworld_header_scripts','none');
        print $header_scripts;
    }

    add_action('wp_head', 'hello_world_display_header_scripts');

    function hello_world_display_footer_scripts(){
        $footer_scripts = get_option('helloworld_footer_scripts','none');
        print $footer_scripts;
    }

    add_action('wp_footer', 'hello_world_display_footer_scripts');


    function helloworldformfunction(){
        $content = "";
        $content .= "<form method='post' action='http://localhost/wordpress/thank-you/'>";
        $content .= "<input type='text' name='full_name' placeholder='Your Full Name' />";
        $content .= "<br/>";
        $content .= "<input type='text' name='email_address' placeholder='Your Full Name' />";
        $content .= "<br/>";
        $content .= "<input type='text' name='phone_number' placeholder='Your Full Name' />";
        $content .= "<br/>";
        $content .= "<textarea name='comments' placeholder='Give us your comments'></textarea>";
        $content .= "<br/>";
        $content .= "<input type='submit' name='helloworld_submit_form' value='Submit your information'>";
        $content .= "</form>";
        
                
        return $content;
    }
    add_shortcode('helloworldform', 'helloworldformfunction');

    function set_html_content_type(){
        return 'text/html';
    }

    function helloworld_form_capture(){
        if(array_key_exists('helloworld_submit_form', $_POST)){
            $to = 'taregetmailaddressihere';
            $subject = 'Hello World Custom Plugin Test';
            $body = '';

            $body .= 'Name: '.$_POST['full_name'].'<br/>';
            $body .= 'Email: '.$_POST['email_address'].'<br/>';
            $body .= 'Phone: '.$_POST['phone_number'].'<br/>';
            $body .= 'Comments: '.$_POST['comments'].'<br/>';

            add_filter('wp_mail_content_type', 'set_html_content_type' );
            wp_mail($to, $subject, $body);
            remove_filter('wp_mail_content_type', 'set_html_content_type' );
        }
    }
    add_action('wp_head', 'helloworld_form_capture');

?>  
