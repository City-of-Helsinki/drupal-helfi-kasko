<?php

/**
 * @file
 * Contains site specific overrides.
 */

$databases['default']['default']['init_commands'] = [
  'sql_mode' => 'SET sql_mode="STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_ENGINE_SUBSTITUTION"',
];

if ($drush_options_uri = getenv('DRUSH_OPTIONS_URI')) {
  if (str_contains($drush_options_uri, 'www.hel.fi')) {
    $config['helfi_proxy.settings']['default_proxy_domain'] = 'www.hel.fi';
  }
}

// Elasticsearch settings.
if (getenv('ELASTICSEARCH_URL')) {
  $config['elasticsearch_connector.cluster.kasko']['url'] = getenv('ELASTICSEARCH_URL');

  if (getenv('ELASTIC_USER') && getenv('ELASTIC_PASSWORD')) {
    $config['elasticsearch_connector.cluster.kasko']['options']['use_authentication'] = '1';
    $config['elasticsearch_connector.cluster.kasko']['options']['authentication_type'] = 'Basic';
    $config['elasticsearch_connector.cluster.kasko']['options']['username'] = getenv('ELASTIC_USER');
    $config['elasticsearch_connector.cluster.kasko']['options']['password'] = getenv('ELASTIC_PASSWORD');
  }
}

// Elastic proxy URL.
$config['elastic_proxy.settings']['elastic_proxy_url'] = getenv('ELASTIC_PROXY_URL');

// Sentry DSN for React.
$config['react_search.settings']['sentry_dsn_react'] = getenv('SENTRY_DSN_REACT');

// @todo remove separate client once edu.hel.fi users work with keycloak.
$config['openid_connect.client.keycloak']['settings']['client_id'] = getenv('KEYCLOAK_CLIENT_ID');
$config['openid_connect.client.keycloak']['settings']['client_secret'] = getenv('KEYCLOAK_CLIENT_SECRET');
if ($keycloak_environment_url = getenv('KEYCLOAK_ENVIRONMENT_URL')) {
  $config['openid_connect.client.keycloak']['settings']['environment_url'] = $keycloak_environment_url;
}
