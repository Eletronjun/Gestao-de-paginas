class apache {

  package { "httpd":
    name => "httpd",
    ensure  => present,  
 }
  service { 'httpd':
    ensure => running,
    enable => true,
    require => Package["httpd"],
  }

}
