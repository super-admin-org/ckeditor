<?php

namespace SuperAdmin\Admin\CKEditor;

use Illuminate\Support\ServiceProvider;
use SuperAdmin\Admin\Admin;
use SuperAdmin\Admin\Form;

class CKEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CKEditor $extension)
    {
        if (!CKEditor::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'super-admin-ckeditor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/super-admin-org/ckeditor')],
                'super-admin-ckeditor'
            );
        }

        Admin::booting(function () {
            Admin::js('vendor/super-admin-org/ckeditor/ckeditor.js', false); // prevent minifying (last arg)
            Form::extend('ckeditor', Editor::class);
        });
    }
}
