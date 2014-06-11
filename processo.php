<?
include 'check.php';
include 'connection.php';
extract($_GET);
extract($_POST);

	switch ($page) {
		case 'create':
				ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user create '.$name.' '.$password);
				header('Location:index.php?page=list');
			break;
	
		case 'remove':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user delete '.$name);
				header('Location:index.php?page=list');
			break;

		case 'disable':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user disable '.$name);
				header('Location:index.php?page=list');
			break;

		case 'enable':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user enable '.$name);
				header('Location:index.php?page=list');
			break;

		case 'setpwd':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user setpassword '.$name.' --newpassword='.$password);
				header('Location:index.php?page=list');
			break;

		case 'gcreate':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user create '.$group.' '.$password);
				header('Location:index.php?page=glist');
			break;

		case 'gremove':
			 	ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user delete '.$group);
				header('Location:index.php?page=glist');
			break;
	}


	

?>