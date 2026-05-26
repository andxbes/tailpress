<p align="center"><a href="https://tailpress.io" target="_blank"><img src="https://raw.githubusercontent.com/tailpress/art/main/logo.svg" width="200" alt="TailPress"></a></p>

<p align="center">
<a href="https://github.com/tailpress/tailpress/releases/"><img src="https://img.shields.io/github/release/tailpress/tailpress?include_prereleases=&sort=semver" alt="GitHub release"></a>
<a href="https://packagist.org/packages/tailpress/tailpress"><img src="https://img.shields.io/packagist/dt/tailpress/tailpress" alt="Total Downloads"></a>
<a href="#license"><img src="https://img.shields.io/badge/License-MIT-blue" alt="License"></a>
</p>

## About TailPress

[TailPress](https://tailpress.io) is your go-to starting point for your next [Tailwind CSS](https://tailwindcss.com) powered [WordPress](https://wordpress.org) theme.

To get started, have a look at the [documentation](https://tailpress.io/docs).

## Contributors

- [Jeffrey van Rossum](https://github.com/jeffreyvr)
- [All contributors](https://github.com/tailpress/tailpress/graphs/contributors)

## License

MIT. Please see the [License File](/LICENSE) for more information.



## To run the development environment in Docker:

- In `docker-compose.yml`, add the following to your `php and nginx` container:

  ```yaml
    extra_hosts:
      - "host.docker.internal:host-gateway"
  ```

- In `wp-config.php`, add these lines:

  ```php
  define( 'WP_ENVIRONMENT_TYPE', 'local' ); // This enables development mode for WordPress and ViteCompiler
  define( 'VITE_PROBE_URL', 'http://host.docker.internal:3000' ); // URL for Vite probe from PHP in Docker
  ```
- for resourses in dev  set nginx rules 
```conf
        location ^~ /resources/ {
                proxy_pass http://host.docker.internal:3000;
                proxy_http_version 1.1;
                proxy_set_header Host $host;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
                proxy_set_header X-Forwarded-Proto $scheme;
        }
```
