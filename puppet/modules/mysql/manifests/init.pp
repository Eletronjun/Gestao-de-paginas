class mysql {

  package { "mysql-server":
    ensure  => present,
  }

  service { 'mysqld':
    ensure => running,
    enable => true,
    require => Package["mysql-server"],
  }

  exec{ 'mysql -u root < /vagrant/databaseDocumentation/physical.sql':
	  command => 'mysql -u root < /vagrant/databaseDocumentation/physical.sql',
	  require => Package['mysql-server'],
	}
}

class phpmyadmin {
  package { "epel-release":
    ensure  => present,
  }

  package { "phpmyadmin":
    ensure  => present,
    require => Package["mysql-server","httpd","php","epel-release"],
  }

  exec{ 'cp /vagrant/config/phpMyAdmin.conf /etc/httpd/conf.d/phpMyAdmin.conf':
	  command => 'cp /vagrant/config/phpMyAdmin.conf /etc/httpd/conf.d/phpMyAdmin.conf',
	  notify  => Service['httpd'], 
	  require => Package['httpd'],
	}
}

#	exec{ 'cp /vagrant/config/config.inc.php /etc/phpmyadmin/config.inc.php':
#	command => 'cp /vagrant/config/config.inc.php /etc/phpmyadmin/config.inc.php',
#	notify  => Service['apache2'], 
#	require => Package['phpmyadmin'],
#	}

#	exec{ 'mysql -u root < /vagrant/databaseDocumentation/physical.sql':
#	command => 'mysql -u root < /vagrant/databaseDocumentation/physical.sql',
#	require => Package['mysql-server'],
#	}

#}
