class system-update {

  exec { 'yum update -y':
    command => 'yum update -y',
  }
}
