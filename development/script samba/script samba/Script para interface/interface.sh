#!/bin/bash

if [ $USER != "root" ]
then
	yad --title "ERRO" --aling rigth \
        --width="200"  --height=100 \
        --image=dialog-error --text="<b> é root? </b> " \
        --button="Exit":1
	exit 0
fi

#inicio do programa

MenuPrincipal(){

	opcao=$(yad --list --title "   MENU    " --image=gtk-home \
		--column "ID":NUM \
		--column "OPCOES":TEXT \
		1 "Download" \
		2 "Instalacao" \
		3 "Configuração" \
		4 "Sair" \
 		--print-column=1 \
		--hide-column=1 \
 		--width="250" \
		--height="200" \
		--button "Ok":0 \
		--button "Cancel":1 \
	)

#verificar se o usuario clicou em 'sair' ou no 'x'

	acao="$?"
	test "$acao" -eq "1" || test "$acao" -eq "252"
	if [ "$?" -eq "0" ]
	then
        	exit
	fi

#pega um numero da coluna ID
	opcao=$(echo $opcao | grep -o '^[0-9]')

	case $opcao in

	1)ListarVersoes ;;
	2)Instalacao ;;
	3)Configuracao ;;
	4)Sair ;;

	esac
}

ListarVersoes(){

	mkdir /tmp/samba4/ >> log.txt
	cd /tmp/samba4
	wget -nv http://ftp.samba.org/pub/samba/stable/ -o log.txt
	cat index.html | awk ' /tar.gz/ {print $5} ' | cut -d '"' -f 2 | grep -v '></td><td><a' | grep samba-4 > versoes_samba.txt
	samba=$(cat versoes_samba.txt | yad --list --title "SAMBA" \
		--column "VERSOES" \
		--width="300" \
		--height="300"  \
		--button="Ok":0 \
		--button="Cancel":1 \
	)

	acao="$?"
	test "$acao" -eq "1" || test "$acao" -eq "252"
	if [ "$?" -eq "0" ]
	then
        	exit
	fi


	echo $samba > /tmp/samba4/versao.txt
	samba=` cat versao.txt | cut -c 1-18 `

	xterm -e wget -v  http://ftp.samba.org/pub/samba/stable/$samba 2> erros.txt


	if [ "/tmp/samba4/$samba" != ""  ]
	then
		yad --title "$samba" --aling right \
			--image=gtk-save \
		    	--text "Download concluido" \
			--width="250" --button "OK":0

	else
		yad --title "ERRO" --aling right \
			--image=dialog-error --text "Download abortado" \
			--button "OK":0

	fi


	MenuPrincipal

}

Instalacao(){
	

	yad --title "Warning" --aling right \
		 --text="Atualização do repósitorio pe nescessária" --image=dialog-warning \
		 --width="200" --height="150" \
		 --button="Ok":0 --button="Cancel":1	

#Verifica se o usuário concorda com a atualização do repósitorio

	acao="$?"
	if [ $? -eq 0 ]
	then

awk '{ if (($2 == "ftp://mirrors.kernel.org/debian/") && ($3 == "wheezy") && ($4 == "main") && ($5 == "contrib") && ($6 == "non-free"))
         i++
}
END { if (i == 0){ 
        system("echo " " >> /etc/apt/sources.list");
        system("echo \#\#\#\#\#Repositorios Adcionados Automaticamente para Dependencias do Samba 4\#\#\#\#\#\#\# >> /etc/apt/sources.list");
        system("echo deb ftp://mirrors.kernel.org/debian/ wheezy main contrib non-free >> /etc/apt/sources.list");
        system("echo deb-src ftp://mirrors.kernel.org/debian/ wheezy main contrib non-free >> /etc/apt/sources.list");
	system("xterm -e apt-get update && xterm -e apt-get upgrade");
    
}}' /etc/apt/sources.list


fi

	variavel=$( yad --title "Dependências a serem instaladas" --image=gtk-file \
	--text "build-essential libacl1-dev libattr1-dev libblkid-dev libgnutls-dev  build-essential
	libacl1-dev libattr1-dev libblkid-dev libgnutls-dev libpopt-dev libldap2-dev 
	dnsutils libbsd-dev attr krb5-user docbook-xsl libcups2-dev acl " \
	--width="350" \
	--heigth="300" \
	--button="Cancelar":1 \
	--button="continuar":0 )

	acao="$?"
	test "$acao" -eq "1" || test "$acao" -eq "252"
	if [ "$?" -eq "0" ]
	then
        	exit
	fi

	xterm -e apt-get  install -y python2.7-dev build-essential libacl1-dev libattr1-dev libblkid-dev  libreadline-dev python-dev python-dnspython gdb pkg-config libpopt-dev libldap2-dev dnsutils libbsd-dev attr krb5-user docbook-xsl libcups2-dev acl


	tar -zxvf $samba >> /tmp/samba4/log.txt 2> /tmp/samba4/erros.txt ; 
	 cat /tmp/samba4/versao.txt | cut -c 1-11 > versao.txt
	versao=`cat versao.txt `
	cd /tmp/samba4/$versao
 	 xterm -e ./configure
	sleep 5
	 xterm -e make
	sleep 5
	xterm -e make install
	sleep 5

	yad --title "Instalação Samba 4" --aling right \
		--image=gtk-save --text "Instalação completa" \
		--widht="250" --height="200" \
		--button="Ok":0

MenuPrincipal

}

Configuracao(){

formulario=$(yad --form \
		--title="Configuração de rede" \
		--width="350"	\
		--height="350"	\
		--image=gtk-network	\
		--field="Interfaces de Rede:":CB lo!eth0!eth1 \
		--field="IP"	\
		--field="MASCARA"	\
		--field="GATEWAY"	\
		--field="DNS PRIMARIO"	\
		--field="DNS SECUNDARIO"	\
		--button="Ok":0	\
		--button="Cancel":1	\
) 

if [ $? -eq 1 ]
then
	exit 0
fi

echo $formulario > /tmp/formulario.txt

inter=`cat /tmp/formulario.txt | cut -d "|" -f 1 `
ip=`cat /tmp/formulario.txt | cut -d "|" -f 2 ` 
mask=` cat /tmp/formulario.txt | cut -d "|" -f 3 ` 
gate=` cat /tmp/formulario.txt | cut -d "|" -f 4 `
dns1=` cat /tmp/formulario.txt | cut -d "|" -f 5 `
dns2=` cat /tmp/formulario.txt | cut -d "|" -f 6 `

sed -i 's/eth0//g' /etc/network/interfaces
echo auto $inter >> /etc/network/interfaces
echo iface $inter inet static >> /etc/network/interfaces
echo "      address $ip" >> /etc/network/interfaces
echo "      netmask $mask" >> /etc/network/interfaces
echo "      gateway $gate" >> /etc/network/interfaces
echo nameserver $dns1 > /etc/resolv.conf
echo nameserver $dns2 >> /etc/resolv.conf
sed -i 's/remount-ro/remount-ro,acl,user_xattr/g' /etc/fstab;
mount -o remount /
xterm -e /usr/local/samba/bin/samba-tool domain provision

MenuPrincipal	
	
}

Sair(){
	exit 0
}
MenuPrincipal
	
