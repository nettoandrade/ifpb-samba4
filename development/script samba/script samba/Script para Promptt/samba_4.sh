#!/bin/bash

if [ $USER != "root" ]
then
	echo "É necessario ser super-usuario(root)?"
	exit 0;
fi

MenuPrincipal(){
        clear
        echo "SAMBA 4"
        echo "1 - Listar e baixar as versões disponiveis do samba 4"
        echo "2 - Instalação"
        echo "3 - Configuração"
	echo "4 - Sair"
        echo -n "Opção desejada: "
        read opcao

        case $opcao in

                1)ListarVersoes ;;
                2)Instalacao ;;
                3)Configuracao;;
                4)Sair ;;
                *)echo "Opção desconhecida";MenuPrincipal;;

        esac

}

ListarVersoes(){
clear
echo "Verssões do samba 4"
mkdir /tmp/samba4/ >> log.txt;
cd /tmp/samba4/
wget -nv http://ftp.samba.org/pub/samba/stable/ -o log.txt
cat index.html | awk ' /tar.gz/ {print $5} ' | cut -d '"' -f 2 | grep -v '></td><td><a' | grep samba-4 > versoes_samba.txt
cat versoes_samba.txt

echo "Digite a versão desejada: "
read versao;

echo $versao > /tmp/samba4/versao.txt;

wget http://ftp.samba.org/pub/samba/stable/$versao
MenuPrincipal
}

Instalacao(){
mkdir /tmp/samba4;
cd /tmp/samba4;
versaotmp=`cat /tmp/samba4/versao.txt`;

awk '{ if (($2 == "ftp://mirrors.kernel.org/debian/") && ($3 == "wheezy") && ($4 == "main") && ($5 == "contrib") && ($6 == "non-free"))
         i++
}
END { if (i == 0){ 
        system("echo " " >> /etc/apt/sources.list");
        system("echo \#\#\#\#\#Repositorios Adcionados Automaticamente para Dependencias do Samba 4\#\#\#\#\#\#\# >> /etc/apt/sources.list");
        system("echo deb ftp://mirrors.kernel.org/debian/ wheezy main contrib non-free >> /etc/apt/sources.list");
        system("echo deb-src ftp://mirrors.kernel.org/debian/ wheezy main contrib non-free >> /etc/apt/sources.list");
        system("apt-get update && apt-get upgrade");
}}' /etc/apt/sources.list

apt-get install build-essential libacl1-dev libattr1-dev libblkid-dev libgnutls-dev libreadline-dev python-dev python-dnspython gdb pkg-config libpopt-dev libldap2-dev dnsutils libbsd-dev attr krb5-user docbook-xsl libcups2-dev acl ;

tar -zxvf $versaotmp >> /tmp/samba4/log.txt 2> /tmp/samba4/erros.txt ;
versao=`cat /tmp/samba4/log.txt | grep samba-4 | tail -1 | cut -d / -f 1` ;
cd /tmp/samba4/$versao;
./configure;
make;
make install;
sleep 3;
MenuPrincipal

}

Configuracao(){
echo Interfaces Disponiveis:
ifconfig | awk '/Link encap/ {print $1}';
echo 
echo Escolha uma das interfaces:
read interface
clear
echo Configurando Sua interface local de Rede:
echo
echo Informe IP:
read ip
echo Informe Mascara:
read mask
echo Informe Gateway:
read gw
echo Informe DNS Primario:
read dns1
echo Informe DNS Secundario:
read dns2

sed -i 's/eth0//g' /etc/network/interfaces
echo auto $interface >> /etc/network/interfaces
echo iface $interface inet static >> /etc/network/interfaces
echo "      address $ip" >> /etc/network/interfaces
echo "      netmask $mask" >> /etc/network/interfaces
echo "      gateway $gw" >> /etc/network/interfaces
echo nameserver $dns1 > /etc/resolv.conf
echo nameserver $dns2 >> /etc/resolv.conf
sed -i 's/remount-ro/remount-ro,acl,user_xattr/g' /etc/fstab;
mount -o remount,rw / ;
clear;
/usr/local/samba/bin/samba-tool domain provision ;

MenuPrincipal;
}

Sair(){
rm -r /tmp/samba4
exit
}

MenuPrincipal

