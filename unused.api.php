<?php
/**
 * Documents API hooks for the Unused module.
 */

/**
 * Define when a module is considered 'unused'.
 *
 * @return array
 *   An associative array of modules where the keys are module names and the
 *   values are either translated strings explaining the reason for the module
 *   being unused, or FALSE if the module is in-use.
 */
function hook_unused() {
  // Check if My Module is enabled in the settings or not.
  $my_module_reason = FALSE;
  if (!config_get('my_module.settings', 'enabled')) {
    $my_module_reason = t('This has been disabled in the <a href="@settings_url">settings</a>.', array(
      '@settings_url' => url('admin/config/system/my-module'),
    ));
  }

  // Check if any role has the 'Administer My Submodule' permission.
  $my_submodule_reason = unused_check_permission('administer my submodule');

  return array(
    'my_module' => $my_module_reason,
    'my_submodule' => $my_submodule_reason,
  );
}
