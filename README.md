# SeedDMS BIBBOX application

## Hints
* approx. time with medium fast internet connection: **5 minutes**
* initial user/passwordd: **admin / admin**


## Docker Images Used
 * [BIBBOX/seeddms](https://hub.docker.com/r/bibbox/seeddms/) 
 * [mySQL](https://hub.docker.com/_/mysql/), offical mySQL container
 * [busybox](https://hub.docker.com/_/busybox/), offical data container
 
## Install Environment Variables
  *	MYSQL_ROOT_PASSWORD = password, only used within the docker container
  * MYSQL_DATABASE = name of the mysql database, typical *phenotips*. The DB file is stored in the mounted volume
  * MYSQL_USER = name of the mysql user, typical *phenotips*
  * MYSQL_PASSWORD = mysql user password, only used within the docker container

## Mounted Volumes

* the mysql datafolder _/var/lib/mysql_ will be mounted to _/opt/apps/INSTANCE_NAME/var/lib/mysql_ in your BIBBOX kit 
* the SeedDMS datafolder _/var/seeddms50x/data_ will be mounted to _/opt/apps/INSTANCE_NAME/var/seeddms50x/data_ in your BIBBOX kit 
