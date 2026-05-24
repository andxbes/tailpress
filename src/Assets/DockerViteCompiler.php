<?php

namespace TailPress\Assets;

use TailPress\Framework\Assets\ViteCompiler;

class DockerViteCompiler extends ViteCompiler
{
    public function isDevServerRunning(): bool
    {
        if (! in_array(wp_get_environment_type(), ['local', 'development'], true)) {
            return false;
        }

        $args = [];

        if ($this->ssl) {
            $args['sslverify'] = $this->sslVerify;
        }

        $probeUrl = defined('VITE_PROBE_URL')
            ? VITE_PROBE_URL
            : 'http://host.docker.internal:3000';

        $response = wp_remote_get(rtrim($probeUrl, '/').'/@vite/client', $args);

        return ! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;
    }
}
