<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Assets\DockerViteCompiler('http://localhost:3000'), fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

tailpress();

/**
 * Production Vite bundles are ES modules; without type="module" top-level bindings
 * (e.g. minified `const _`) leak into the global scope and break plugins like Ninja Forms.
 */
add_filter( 'script_loader_tag', static function ( string $tag, string $handle ): string {
	if ( $handle === 'tailpress-app' && ! str_contains( $tag, 'type="module"' ) ) {
		return str_replace( '<script ', '<script type="module" ', $tag );
	}

	return $tag;
}, 10, 2 );
