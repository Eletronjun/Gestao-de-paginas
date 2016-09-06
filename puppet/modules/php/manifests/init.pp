class php {

  package { ['php', 'php-mysql', 'php-gd', 'php-mbstring','php-pear']:
    ensure  => present,
    require => Package["httpd"],
	notify  => Service['httpd'], 
  }

  package { 'php-phpunit-PHPUnit':
    ensure  => present,
    require => Package["httpd",'php'],
	notify  => Service['httpd'], 
  }

  exec{'pear install php_codesniffer':
  	command => 'pear install php_codesniffer',
  	require => Package['php-pear'],
  }

}
