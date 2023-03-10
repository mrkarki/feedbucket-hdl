<?php
class FeedbucketAdmin
{
    public function __construct()
    {

        add_action('admin_menu', array($this, 'feedbucket_add_settings_page'));
        add_action('admin_init', array($this, 'feedbucket_register_settings'));
    }
    public function feedbucket_add_settings_page()
    {
        add_options_page('FeedBucket', 'FeedBucket', 'manage_options', 'feedbucket', array($this, 'feedbucket_render_plugin_settings_page'));
    }
    public function feedbucket_render_plugin_settings_page()
    {
?>
        
        <form action="options.php" method="post">
            <?php
            settings_fields('feedbucket_plugin_options');
            do_settings_sections('feedbucket'); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
        </form>
<?php
    }
    public function feedbucket_register_settings()
    {
        register_setting('feedbucket_plugin_options', 'feedbucket_plugin_options', array($this,'feedbucket_plugin_options_validate'));
        add_settings_section('api_settings', 'API Settings', array($this,'feedbucket_plugin_section_text'), 'feedbucket');

        add_settings_field('feedbucket_plugin_setting_enable', 'Enable', array($this,'feedbucket_plugin_setting_enable'), 'feedbucket', 'api_settings');
        add_settings_field('feedbucket_plugin_setting_enable_for', 'Enable for', array($this,'feedbucket_plugin_setting_enable_for'), 'feedbucket', 'api_settings');
        add_settings_field('feedbucket_plugin_setting_enable_backend', 'Enable for Backend', array($this,'feedbucket_plugin_setting_enable_backend'), 'feedbucket', 'api_settings');
        add_settings_field('feedbucket_plugin_setting_api_key', 'API Key', array($this,'feedbucket_plugin_setting_api_key'), 'feedbucket', 'api_settings');
    }
    public function feedbucket_plugin_section_text()
    {
        echo '<p>Here you can set all the options for using the API</p>';
    }
    public function feedbucket_plugin_setting_enable()
    {
        $options = get_option('feedbucket_plugin_options');
        $check ='';
        if(isset($options['setting_enable'])){
            $check = 'checked';
        }
        echo "<input id='feedbucket_plugin_setting_enable' name='feedbucket_plugin_options[setting_enable]' type='checkbox' value='enable' ". $check." />";
    }
    public function feedbucket_plugin_setting_enable_for()
    {
        $options = get_option('feedbucket_plugin_options');
        $check_admin ='';
        $check_all ='';
        if(isset($options['setting_enable_for'])){
            if($options['setting_enable_for']=='admin'){
                $check_admin = 'checked';
            }
            if($options['setting_enable_for']=='all'){
                $check_all = 'checked';
            }
        }
        echo "<input id='feedbucket_plugin_setting_enable_admin' name='feedbucket_plugin_options[setting_enable_for]' type='radio' value='admin' ". $check_admin." style='margin-bottom:10px'/> Admin Only <br>";
        echo "<input id='feedbucket_plugin_setting_enable_all' name='feedbucket_plugin_options[setting_enable_for]' type='radio' value='all' ". $check_all." /> All (login/none login)";
    }
    public function feedbucket_plugin_setting_enable_backend()
    {
        $options = get_option('feedbucket_plugin_options');
        $check ='';
        if(isset($options['enable_backend'])){
            $check = 'checked';
        }
        echo "<input id='feedbucket_plugin_setting_enable_backend' name='feedbucket_plugin_options[enable_backend]' type='checkbox' value='enable' ". $check." />";
    }
    public function feedbucket_plugin_setting_api_key()
    {
        $options = get_option('feedbucket_plugin_options');
        echo "<input id='feedbucket_plugin_setting_api_key' name='feedbucket_plugin_options[api_key]' type='text' value='" . esc_attr(isset($options['api_key']) ? $options['api_key']:'') . "' required/>";
    }

    public function feedbucket_plugin_options_validate( $input ) {
        // $newinput['api_key'] = trim( $input['api_key'] );
        // if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['api_key'] ) ) {
        //     $newinput['api_key'] = '';
        // }
    
        return $input;
    }
}
$FeedbucketAdmin = new FeedbucketAdmin();
