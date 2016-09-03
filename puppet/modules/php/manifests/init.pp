class php {

  package { ['php', 'php-mysql', 'php-gd', 'php-mbstring']:
    ensure  => present,
    require => Package["httpd"],
	notify  => Service['httpd'], 
  }

}
