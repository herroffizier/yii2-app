# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "herroffizier/php7"

  config.vm.network "private_network", ip: "VAGRANT-IP"

  config.vm.provider "virtualbox" do |vb| 
    vb.cpus = 1
    vb.customize ["modifyvm", :id, "--cpuexecutioncap", "70"]
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/vagrant", "1"]
  end

  config.vm.provision "shell", inline: <<-SHELL
    replace localhost.localdomain PROJECT-ID -- /etc/sysconfig/network /etc/hosts
    hostname PROJECT-ID
    mysqladmin create PROJECT-ID
  SHELL
end
