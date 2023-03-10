<?php
class FeedbucketFrontend
{
    public function __construct()
    {

        add_action('wp_footer', array($this, 'feedbucket_script_footer'));
        add_action('admin_footer', array($this, 'feedbucket_script_backend_footer'));
    }
    public function feedbucket_script_footer()
    {
        $options = get_option('feedbucket_plugin_options');
        if (isset($options['setting_enable']) && isset($options['api_key'])) {
            if ($options['setting_enable_for'] == 'all') {
?>
                <!-- Qq3W0axYAZQvFz1fmMwG -->
                <script module src="https://cdn.feedbucket.app/assets/feedbucket.js" feedbucket-key="<?php echo $options['api_key']; ?>" defer></script>
                <?php
            } else {
                if (is_user_logged_in()) {
                ?>
                    <!-- Qq3W0axYAZQvFz1fmMwG -->
                    <script module src="https://cdn.feedbucket.app/assets/feedbucket.js" feedbucket-key="<?php echo $options['api_key']; ?>" defer></script>
<?php
                }
            }
        }
    }
    public function feedbucket_script_backend_footer()
    {
        $options = get_option('feedbucket_plugin_options');
        if (isset($options['setting_enable']) && isset($options['api_key']) && isset($options['enable_backend'])) {
            if ($options['enable_backend'] == 'enable') {
               
?>
                <!-- Qq3W0axYAZQvFz1fmMwG -->
                <script module src="https://cdn.feedbucket.app/assets/feedbucket.js" feedbucket-key="<?php echo $options['api_key']; ?>" defer></script>
                <?php
            }
        }
    }
}
$FeedbucketFrontend = new FeedbucketFrontend();
